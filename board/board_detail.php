<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
require_once "../lib/board_lib.php";

$board_id = "";
if (!empty($_GET["board"])) {
    $board_id = $_GET["board"];
} else {
    header("location: ../index.php");
    exit();
}

$login_user_id = "";
if (!empty($_POST["login_user_id"])) {
    $login_user_id = $_POST["login_user_id"];
} else {
    header("location: ../index.php");
    exit();
}

list($title, $content, $user_id, $file_org_name, $file_path, $file_name) = get_board_detail($board_id);

$disable_flag = 1;
if ($user_id == $login_user_id) {
    $disable_flag = 0;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board Detail</title>
    <link rel="stylesheet" href="../css/board_detail.css?ver=2">
</head>

<body>
    <div id="board_detail_header">게시글 상세</div>
    <form action="./process/process_board_delete.php" method="post" name="board_delete_form">
        <input type="hidden" name="board_id" id="board_delete_id" value="<?= $board_id ?>">
    </form>

    <form action="./process/process_board_update.php" method="post" name="board_detail_form" enctype="multipart/form-data">
        <span id="board_detail_title_label">제목: </span>
        <input type="text" name="title" placeholder="title" id="board_detail_title" value="<?= $title ?>"> <br>
        <span id="board_detail_content_label">내용: </span>
        <textarea name="content" placeholder="content" id="board_detail_content"><?= $content ?></textarea> <br>
        <span id="board_detail_file_label">첨부파일: </span>
        <div id="board_detail_filebox">
            <input id="file_upload_name" value="<?= $file_org_name ?>" placeholder="첨부파일" readonly data-id=<?= $board_id ?>>
            <label id="board_detail_file_label2" for="board_detail_file">파일찾기</label>
            <input type="file" id="board_detail_file" name="file">
        </div>

        <input type="hidden" name="board_id" value="<?= $board_id ?>">
        <span id="board_update_btn">수정</span>
        <span id="board_delete_btn">삭제</span>
    </form>


    <script>
        var disableFlag = <?= $disable_flag ?>;
        // console.log(disableFlag);

        const boardUpdateSubmitButton = document.getElementById("board_update_btn");
        boardUpdateSubmitButton.addEventListener('click', function() {
            //작성자와 현재 로그인한 사람이 다르면 클릭 이벤트 발생 안되게 함
            if (!disableFlag) {
                const form = document.forms.board_detail_form;
                form.submit();
            }
        });

        const boardDeleteSubmitButton = document.getElementById("board_delete_btn");
        boardDeleteSubmitButton.addEventListener('click', function() {
            //작성자와 현재 로그인한 사람이 다르면 클릭 이벤트 발생 안되게 함
            if (!disableFlag) {
                const form = document.forms.board_delete_form;
                form.submit();
            }
        });


        const boardFileLabelButton = document.getElementById("board_detail_file_label2");
        boardFileLabelButton.addEventListener('click', function() {
            //작성자와 현재 로그인한 사람이 다르면 클릭 이벤트 발생 안되게 함
            if (!disableFlag) {
                //pass
            } else {
                event.preventDefault();
            }
        });



        //작성자와 현재 로그인한 사람이 다르면 수정, 삭제, 파일등록 안되게 함
        if (disableFlag) {
            var board_detail_title = document.getElementById("board_detail_title");
            var board_detail_content = document.getElementById("board_detail_content");
            var board_update_btn = document.getElementById("board_update_btn");
            var board_delete_btn = document.getElementById("board_delete_btn");
            var board_detail_file_label2 = document.getElementById("board_detail_file_label2");

            // board_detail_title.className += "disable";
            // board_detail_content.className += "disable";
            // board_update_btn.className += "disable";

            board_detail_title.setAttribute("readonly", true);
            board_detail_content.setAttribute("readonly", true);
            board_update_btn.style.visibility = "hidden";
            board_delete_btn.style.visibility = "hidden";
            board_detail_file_label2.style.visibility = "hidden";
        }


        //파일찾기 클릭하면 파일명 첨부파일에 뜸 
        const fileContent = document.getElementById("board_detail_file");
        const fileUploadName = document.getElementById("file_upload_name");
        fileContent.addEventListener("change", function(e) {
            var fileName = e.target.value
            fileUploadName.value = fileName
        });

        //첨부파일 클릭하면 다운로드 진행
        fileUploadName.addEventListener("click", function(e) {
            // console.log(e.target.value)
            // console.log(e.target.dataset.id)
            var fileName = e.target.value
            var boardId = e.target.dataset.id
            if (fileName) {
                var url = "./process/process_board_file_download.php?boardid=" + boardId + "&filename=" + fileName
                console.log(url)
                window.open(url, '_blank');
            }

        });
    </script>
</body>

</html>