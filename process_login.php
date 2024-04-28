<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

if (!session_id()) {
    session_start();
}

$id = $_POST["id"];
$pw = $_POST["pw"];

$ini_array = parse_ini_file("/etc/web_conf/.env");

$db_url = $ini_array["DB_URL"];
$db_user = $ini_array["DB_USER"];
$db_pw = $ini_array["DB_PW"];
$db_database = $ini_array["DB_DATABASE"];


$conn = mysqli_connect($db_url, $db_user, $db_pw, $db_database);
$sql = "select * from my_user where user='{$id}' and pw='{$pw}'";
// die($sql);
$result = mysqli_query($conn, $sql);
$row = $row = mysqli_fetch_array($result);

if (($id != "" && $pw != "") && ($id == $row["user"] && $pw == $row["pw"])) {
    $_SESSION["id"] = $id;
?>
    <script>
        alert("로그인 성공");
        location.href = "index.php";
    </script>
<?php
} else { ?>
    <script>
        alert("로그인 실패");
        location.href = "index.php";
    </script>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login process</title>
</head>

<body>

</body>

</html>