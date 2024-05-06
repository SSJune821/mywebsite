<?php
function init_db_for_login()
{

    $ini_array = parse_ini_file("/etc/web_conf/.env");

    $db_url = $ini_array["DB_URL"];
    $db_user = $ini_array["DB_USER"];
    $db_pw = $ini_array["DB_PW"];
    $db_database = $ini_array["DB_DATABASE"];

    $conn = mysqli_connect($db_url, $db_user, $db_pw, $db_database);

    return $conn;
}

function my_login($id, $pw){
    $conn = init_db_for_login();
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
    $conn = init_db_for_login();
    $sql = "select * from my_user where user='{$id}' and pw='{$pw}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // die();

    if(!empty($row)){
        return true;
    }
    return false;

}

// 식별/인증을 분리해서 수행함
function login_divide($id, $pw)
{
    $conn = init_db_for_login();
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
    $conn = init_db_for_login();
    $hashedPw = hash('sha256', $pw);
    $sql = "select * from my_user where user='{$id}' and pw='{$hashedPw}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // die();

    if(!empty($row)){
        return true;
    }
    return false;
}

// 식별/인증을 분리해서 수행함
function login_divide_hash($id, $pw)
{
    $conn = init_db_for_login();
    $sql = "select * from my_user where user='{$id}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $hashedPw = hash('sha256', $pw);

    if ($pw != "" && $hashedPw == $row["pw"]) {
        return true;
    }
    return false;
}


function init_cookie_session()
{
    //쿠키 있으면 쿠키 삭제
    setcookie("id", NULL, 0);


    //세션 있으면 세션 삭제
    if (!session_id()) {
        session_start();
    }

    session_destroy();
}