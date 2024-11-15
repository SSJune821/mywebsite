<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
require_once $_SERVER['DOCUMENT_ROOT'].'/week4/vendor/autoload.php';
require_once "common.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use UnexpectedValueException;



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

function my_login($user, $pw)
{
    $conn = connect_to_db();
    $sql = "select * from my_user where user='{$user}' and pw='{$pw}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if (($user != "" && $pw != "") && ($user == $row["user"] && $pw == $row["pw"])) {
        return array(true, $row["id"]);
    }
    return array(false, -1);
}


// 식별/인증을 동시에 수행함
function login_combine($user, $pw)
{
    $conn = connect_to_db();
    $sql = "select * from my_user where user='{$user}' and pw='{$pw}'";
    echo nl2br($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
    if (!empty($row)) {
        return array(true, $row["id"]);
    }
    return array(false, -1);
}

// 식별/인증을 분리해서 수행함
function login_divide($user, $pw)
{
    $conn = connect_to_db();
    $sql = "select * from my_user where user='{$user}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($pw != "" && $pw == $row["pw"]) {
        return array(true, $row["id"]);
    }
    return array(false, -1);
}

// 식별/인증을 동시에 수행함 (With HASH)
function login_combine_hash($user, $pw)
{
    $conn = connect_to_db();
    $hashedPw = hash('sha256', $pw);
    $sql = "select * from my_user where user='{$user}' and pw='{$hashedPw}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // die();

    if (!empty($row)) {
        return array(true, $row["id"]);
    }
    return array(false, -1);
}

// 식별/인증을 분리해서 수행함
function login_divide_hash($user, $pw)
{
    $conn = connect_to_db();
    $sql = "select * from my_user where user='{$user}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $hashedPw = hash('sha256', $pw);

    if ($pw != "" && $hashedPw == $row["pw"]) {
        return array(true, $row["id"]);
    }
    return array(false, -1);
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



// 로그인 로직 추가
// 식별/인증 동시 + 개행
function  login_combine_newline($user, $pw){
    $conn = connect_to_db();
    $sql = "select * from my_user where user='{$user}'\n and pw='{$pw}'";
    echo nl2br($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // die();

    if (!empty($row)) {
        return array(true, $row["id"]);
    }
    return array(false, -1);
}

// 식별/인증 동시 + 괄호
function  login_combine_bracket($user, $pw){
    $conn = connect_to_db();
    $sql = "select * from my_user where (user='{$user}' and pw='{$pw}')";
    echo nl2br($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // die();

    if (!empty($row)) {
        return array(true, $row["id"]);
    }
    return array(false, -1);
}


// 식별/인증 동시 + 괄호2
function  login_combine_bracket2($user, $pw){
    $conn = connect_to_db();
    $sql = "select * from my_user where (user='{$user}') and (pw='{$pw}')";
    echo nl2br($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // die();

    if (!empty($row)) {
        return array(true, $row["id"]);
    }
    return array(false, -1);
}


// 식별/인증 동시 + limit
function  login_combine_limit($user, $pw){
    $conn = connect_to_db();
    $sql = "select * from my_user where user='{$user}' and pw='{$pw}' limit 0,1";
    echo nl2br($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // die();

    if (!empty($row)) {
        return array(true, $row["id"]);
    }
    return array(false, -1);
}

// 식별/인증 동시 + newline + limit
function  login_combine_newline_limit($user, $pw){
    $conn = connect_to_db();
    $sql = "select * from my_user where user='{$user}' and pw='{$pw}'\n limit 0,1";
    echo nl2br($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // die();

    if (!empty($row)) {
        return array(true, $row["id"]);
    }
    return array(false, -1);
}

// 식별/인증 동시 + newline2 + limit
function  login_combine_newline2_1_limit($user, $pw){
    $conn = connect_to_db();
    $sql = "select * from my_user where user='{$user}'\n and pw='{$pw}'\n limit 0,1";
    echo nl2br($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // die();

    if (!empty($row)) {
        return array(true, $row["id"]);
    }
    return array(false, -1);
}


// 식별/인증 동시 + newline2 + limit
function  login_combine_newline2_2_limit($user, $pw){
    $conn = connect_to_db();
    $sql = "select * from my_user where user='{$user}' and\n pw='{$pw}'\n limit 0,1";
    echo nl2br($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // die();

    if (!empty($row)) {
        return array(true, $row["id"]);
    }
    return array(false, -1);
}