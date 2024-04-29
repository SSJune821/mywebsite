<?php
mysqli_report(MYSQLI_REPORT_OFF);

if (!session_id()) {
    // id가 없을 경우 세션 시작
    session_start();
}
$id = $_SESSION["id"];

$ini_array = parse_ini_file("/etc/web_conf/.env");

$db_url = $ini_array["DB_URL"];
$db_user = $ini_array["DB_USER"];
$db_pw = $ini_array["DB_PW"];
$db_database = $ini_array["DB_DATABASE"];

$conn = mysqli_connect($db_url, $db_user, $db_pw, $db_database);
$sql = "SELECT * FROM my_user WHERE user='{$id}'";
$result = mysqli_query($conn, $sql);

if ($result == false) {
    echo "정보를 가져오는데 실패하였습니다.";
    echo mysqli_errno($conn);
    exit();
}

$row = mysqli_fetch_array($result);

// print_r($row);
$email = $row["email"];
$name = $row["name"];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>
    <link rel="stylesheet" href="./css/mypage.css">
</head>

<body>
    <div id="mypage_window">
        <div id="mypage_wrap">
            <p>
            <div id="mypage_title">My Page</div>
            </p>
            <div>
                <input type="text" name="id" placeholder="아이디" id="id" value="<?= $id ?>"><br>
                <input type="password" name="pw" placeholder="비밀번호" id="pw" value="xxxxxx"><br>
                <input type="password" name="pw_confirm" placeholder="비밀번호 확인" id="pw_confirm" value="xxxxxx"><br>
                <input type="email" name="email" placeholder="이메일 주소" id="email" value="<?= $email ?>"><br>
                <input type="text" name="name" placeholder="이름" id="name" value="<?= $name ?>"><br>
            </div>

        </div>
    </div>
</body>

</html>