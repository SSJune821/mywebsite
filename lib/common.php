<?php
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

function get_user_id()
{
    $id = "";
    if (!session_id()) {
        // id가 없을 경우 세션 시작
        session_start();
    }
    //쿠키가 있으면 쿠기 사용
    if (isset($_COOKIE["id"])) {
        $id = $_COOKIE["id"];
    }
    //아니면 세션 사용
    else if (isset($_SESSION["id"])) {
        $id = $_SESSION["id"];
    }
    //아니면 JWT 사용
    else if (isset($_COOKIE["token"])) {
        $token = $_COOKIE["token"];
        $id = validate_jwt($token);
        if (!isset($id)) {
            header("Location: ./login.php");
            exit();
        }
    }
    // 다 아니면 로그인 화면으로
    else {
        header("Location: ./login.php");
        exit();
    }

    return $id;
}

function get_user_from_id($id)
{
    $conn = connect_to_db();
    $sql = "select user from my_user where id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    // print_r($row);
    return $row["user"];
}
