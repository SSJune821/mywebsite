<?php



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board Register</title>
    <link rel="stylesheet" href="../css/board_register.css">
</head>

<body>
    <div id="board_reg_header">게시글 등록</div>
    <form action="./process/process_board_register.php" method="post">
        <input type="text" name="title" placeholder="title" id="board_reg_title"> <br>
        <input type="text" name="content" placeholder="content" id="board_reg_content"> <br>
        <button type="submit">등록</button>
    </form>

</body>

</html>