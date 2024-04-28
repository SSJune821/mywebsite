<?php
mysqli_report(MYSQLI_REPORT_OFF);

$id = $_POST["id"];
$pw = $_POST["pw"];
$pw_confirm = $_POST["pw_confirm"];
$email = $_POST["email"];
$name = $_POST["name"];

if ($id=="" || $pw == "" || $pw_confirm=="" || $email == "" || $name=""){
    // header("Location: ./login.php");
    exit();
}
echo "hello";
exit();

$ini_array = parse_ini_file("/etc/web_conf/.env");

$db_url = $ini_array["DB_URL"];
$db_user = $ini_array["DB_USER"];
$db_pw = $ini_array["DB_PW"];
$db_database = $ini_array["DB_DATABASE"];

$conn = mysqli_connect($db_url, $db_user, $db_pw, $db_database);
$sql = "
    INSERT INTO my_user (user, pw, email, name)
    VALUES
        ('{$id}', '{$pw}', '{$email}', '{$name}')
";


$result = mysqli_query($conn, $sql);
if($result == false){
    echo "회원가입에 실패하였습니다.";
    echo mysqli_errno($conn);
}
else{
    header("Location: ./login.php");
    // echo "회원 가입에 성공했습니다. <a href='login.php'>홈으로</a>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register process</title>
</head>
<body>
    
</body>
</html>