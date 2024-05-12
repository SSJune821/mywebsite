<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board Register</title>
    <link rel="stylesheet" href="../css/board_register.css?ver=1">
</head>

<body>
    <div id="board_reg_header">게시글 등록</div>
    <form action="./process/process_board_register.php" method="post" name="board_reg_form">
        <span id="board_reg_title_label">제목: </span>
        <input type="text" name="title" placeholder="title" id="board_reg_title"> <br>
        <span id="board_reg_content_label">내용: </span>
        <textarea name="content" placeholder="content" id="board_reg_content"></textarea> <br>
        <span id="board_reg_btn">등록</span>
    </form>


    <script>
        const submitButton = document.getElementById("board_reg_btn");
        submitButton.addEventListener('click', function() {
            const form = document.forms.board_reg_form;
            form.submit();
        });
    </script>
</body>

</html>