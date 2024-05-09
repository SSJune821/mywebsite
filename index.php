<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
require_once("./lib/login_kind.php");

if (!isset($_POST["token"])) {
    header("Location: ./before_index.php");
} else {
    if (isset($_SERVER["HTTP_REFERER"]) && strcmp($_SERVER["HTTP_REFERER"], "http://192.168.0.14/week3/before_index.php") == 0) {
        // print_r($_POST["token"]);
    }
}


?>



<?php

if (!session_id()) {
    // id가 없을 경우 세션 시작
    session_start();
}
$id = "";

//쿠키가 있으면 쿠기 사용
if (isset($_COOKIE["id"])) {
    $id = $_COOKIE["id"];
}
//아니면 세션 사용
else if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
}
// 아니면 JWT 사용
else if (isset($_POST["token"])) {
    // print_r($_POST["token"]);
    $id = validate_jwt($_POST["token"]);
    if(!isset($id)){
        header("Location: ./login.php");
        exit();
    }
    // echo $id;
}
// 다 없으면 로그인 페이지
else {
    // header("Location: ./login.php");
    // exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>

<body>
    <?php
    if ($id != "") {
        // echo "안녕하세요. {$id} 님";
        require_once("content.php");
    } else {
    ?>
        <a href="login.php">로그인</a>
    <?php
    }

    ?>

</body>

</html>