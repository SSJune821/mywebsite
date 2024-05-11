<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
require_once "../lib/login_kind.php";


$board_id="";
if(isset($_GET["board"])){
    $board_id=$_GET["board"];
}
else{
    header("location: ../index.php");
    exit();
}

$conn = connect_to_db();
$sql = "select * from my_board where id='{$board_id}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

print_r($row);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board detail</title>
</head>
<body>
    <div>hello</div>
</body>
</html>