<?php
$id = $_POST["id"];
$pw = $_POST["pw"];


if ($id == "admin" && $pw == "admin1234") { ?>
    <script>
        alert("로그인 성공");
        location.href = "login.php"
    </script>
<?php
} else { ?>
    <script>
        alert("로그인 실패");
        location.href = "login.php"
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