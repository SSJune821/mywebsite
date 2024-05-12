<?php
require_once "./lib/board_lib.php";

$id = get_user_id();
$user = get_user_from_id($id);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/content.css?ver=2">
    <title>content</title>
</head>

<body>
    <div id="content_header">
        <span id="hello"> <?= $user ?> 님</span>
        <span id="mypage_btn"><a href="mypage.php">마이페이지</a></span>
        <span id="logout_btn"><a href="process_logout.php">로그아웃</a></span>

    </div>
    <div id="content_body">
        <div id="board_title">게시판</div>
        <table id="board_table">
            <thead id="board_header">
                <tr>
                    <th id="header1">번호</th>
                    <th id="header2">제목</th>
                    <th id="header3">작성자</th>
                    <th id="header4">댓글</th>
                    <th id="header5">조회수</th>
                    <th id="header6">추천</th>
                    <th id="header7">작성일</th>
                </tr>
            </thead>
            <tbody id="board_content">

            </tbody>

        </table>
        <br>
        <span id="register_board_btn" onclick="registerBoard()">글 작성</span>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        function registerBoard() {
            location.href = "./board/board_register.php";
            // console.log("register_board");
        }


        $.ajax({
            url: "./lib/board_lib.php",
            method: "POST",
            data: {
                type: "list"
            },
            success: function(res) {
                console.log("success");
                // console.log(JSON.parse(res));
                var res_json = JSON.parse(res);
                res_json.forEach(element => {
                    // console.log(element);
                    $("#board_content").append(
                        "<tr><td>" + element["id"] + "</td>" + 
                        "<td class='title'>" +  element["title"]+ "</td>" + 
                        "<td>" +  element["user_id"]+ "</td>" + 
                        "<td>" +  0 + "</td>" + 
                        "<td>" +  element["views"]+ "</td>" + 
                        "<td>" +  element["recommendation"]+ "</td>" + 
                        "<td>" +  element["created"]+ "</td>");
                });
                // $("#board_content").append();
            },
            error: function(err) {
                console.log("error");
                console.log(err);
            }
        })

        
        //클릭한 게시판 상세화면으로 이동
        $("body").on("click", ".title", function(){
            boardId = $(this).prev().text();
            location.href = "./board/board_detail.php?board=" + boardId;
        })

    </script>
</body>

</html>