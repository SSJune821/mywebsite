<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
require_once $_SERVER['DOCUMENT_ROOT'].'/week4/vendor/autoload.php';


use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use UnexpectedValueException;

function connect_to_db()
{

    $ini_array = parse_ini_file("/etc/web_conf/.env");

    $db_url = $ini_array["DB_URL"];
    $db_user = $ini_array["DB_USER"];
    $db_pw = $ini_array["DB_PW"];
    $db_database = $ini_array["DB_DATABASE"];

    $conn = mysqli_connect($db_url, $db_user, $db_pw, $db_database);

    return $conn;
}



function init_cookie_session_jwt()
{
    //쿠키 있으면 쿠키 삭제
    setcookie("id", NULL, 0);
    //세션 있으면 세션 삭제
    if (!session_id()) {
        session_start();
    }
    session_destroy();
    //JWT 있으면 삭제
    setcookie("token", NULL, 0);
}

function my_login($id, $pw)
{
    $conn = connect_to_db();
    $sql = "select * from my_user where user='{$id}' and pw='{$pw}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if (($id != "" && $pw != "") && ($id == $row["user"] && $pw == $row["pw"])) {
        return true;
    }
    return false;
}


// 식별/인증을 동시에 수행함
function login_combine($id, $pw)
{
    $conn = connect_to_db();
    $sql = "select * from my_user where user='{$id}' and pw='{$pw}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // die();

    if (!empty($row)) {
        return true;
    }
    return false;
}

// 식별/인증을 분리해서 수행함
function login_divide($id, $pw)
{
    $conn = connect_to_db();
    $sql = "select * from my_user where user='{$id}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($pw != "" && $pw == $row["pw"]) {
        return true;
    }
    return false;
}

// 식별/인증을 동시에 수행함 (With HASH)
function login_combine_hash($id, $pw)
{
    $conn = connect_to_db();
    $hashedPw = hash('sha256', $pw);
    $sql = "select * from my_user where user='{$id}' and pw='{$hashedPw}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // die();

    if (!empty($row)) {
        return true;
    }
    return false;
}

// 식별/인증을 분리해서 수행함
function login_divide_hash($id, $pw)
{
    $conn = connect_to_db();
    $sql = "select * from my_user where user='{$id}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $hashedPw = hash('sha256', $pw);

    if ($pw != "" && $hashedPw == $row["pw"]) {
        return true;
    }
    return false;
}

//jwt 로그인 유지 기능
function remember_me_jwt($id)
{
    $key = 'MY_SECRET_KEY';
    $payload = [
        'iss' => 'my',
        'aud' => 'my site',
        'iat' => time(),
        'exp' => time() + 60 * 60,
        'id' => $id
    ];

    $jwt = JWT::encode($payload, $key, 'HS256');
    return $jwt;
}

//JWT 유효성 검증
function validate_jwt($jwt)
{
    $key = 'MY_SECRET_KEY';
    try {
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        $decoded_array = (array) $decoded;
        // print_r($decoded_array["id"]);
        return $decoded_array["id"];
    } catch (LogicException $e) {
        print_r("LogicException");
        // errors having to do with environmental setup or malformed JWT Keys
    } catch (UnexpectedValueException $e) {
        print_r("UnexpectedValueException");
        // errors having to do with JWT signature and claims
    }
    return null;
}
