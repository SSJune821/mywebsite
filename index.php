<?php


if (!session_id()) {
    // id가 없을 경우 세션 시작
    session_start();
}

$id = "";
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
} else {
    header("Location: ./login.php");
    exit();
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