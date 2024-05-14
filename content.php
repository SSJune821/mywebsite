<?php
require_once "./lib/board_lib.php";

$id = get_user_id();
$user = get_user_from_id($id);

// 전체 게시글 갯수
$total_list_cnt = get_board_list_cnt();
// 페이지 당 게시글 갯수 제한
$cnt = 5;
// 전체 페이지 갯수
$total_page_cnt = ceil($total_list_cnt / $cnt);

// 현재 페이지
$page = isset($_GET["page"]) ? $_GET["page"] : 1;

//한 화면에 보여지는 최대 페이지 갯수
$max_page_cnt= 5;

//최대 페이지 갯수 넘기면 보여지는 시작 페이지 번호 설정
$start_page_cnt = (floor(($page-1) / $max_page_cnt) * $max_page_cnt) + 1;


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

        <?php
        if ($page <= 1) { ?>
            <span class="paging_span"><a href="?page=1" class="paging">이전</a></span>
        <?php } else { ?>
            <span class="paging_span"><a href="?page=<?= $page - 1; ?>" class="paging">이전</a></span>
        <?php } ?>


        <?php
        $max_page_index = $start_page_cnt + $max_page_cnt > $total_page_cnt ? $total_page_cnt+1 : $start_page_cnt + $max_page_cnt;
        for ($page_index = $start_page_cnt; $page_index < $max_page_index; $page_index++) { ?>
            <span class="paging_span"><a href="?page=<?= $page_index; ?>"  class="paging"><?= $page_index; ?></a></span>
        <?php } ?>

        <?php
        if ($page >= $total_page_cnt) { ?>
            <span class="paging_span"><a href="?page=<?= $total_page_cnt; ?>"  class="paging">다음</a></span>
        <?php } else { ?>
            <span class="paging_span"><a href="?page=<?= $page + 1; ?>"  class="paging">다음</a></span>
        <?php } ?>
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
                type: "paging",
                page: <?= $page ?>,
                cnt: <?= $cnt ?>
            },
            success: function(res) {
                console.log("success");
                // console.log(JSON.parse(res));
                var res_json = JSON.parse(res);
                res_json.forEach(element => {
                    // console.log(element);
                    $("#board_content").append(
                        "<tr><td>" + element["id"] + "</td>" +
                        "<td class='title'>" + element["title"] + "</td>" +
                        "<td>" + element["user"] + "</td>" +
                        "<td>" + 0 + "</td>" +
                        "<td>" + element["views"] + "</td>" +
                        "<td>" + element["recommendation"] + "</td>" +
                        "<td>" + element["created"] + "</td>");
                });
                // $("#board_content").append();
            },
            error: function(err) {
                console.log("error");
                console.log(err);
            }
        })


        //클릭한 게시판 상세화면으로 이동
        $("body").on("click", ".title", function() {
            boardId = $(this).prev().text();
            var newForm = $("<form></form>");
            newForm.attr("name", "newForm");
            newForm.attr("method", "post");
            newForm.attr("action", "./board/board_detail.php?board=" + boardId);

            var hiddenInput = $("<input>");
            hiddenInput.attr("type", "hidden");
            hiddenInput.attr("name", "login_user_id");
            hiddenInput.attr("value", <?= $id ?>);
            newForm.append(hiddenInput);
            newForm.appendTo("body");
            newForm.submit();
            // location.href = "./board/board_detail.php?board=" + boardId;
        })
    </script>
</body>

</html>