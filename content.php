<?php
$id = "";
if (!session_id()) {
    // id가 없을 경우 세션 시작
    session_start();
}
//쿠키가 있으면 쿠기 사용
if (isset($_COOKIE["id"])) {
    $id = $_COOKIE["id"];
}
//아니면 세션 사용
else if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
}
//아니면 JWT 사용
if (isset($_COOKIE["token"])) {
    $token = $_COOKIE["token"];
    $id = validate_jwt($token);
    if (!isset($id)) {
        header("Location: ./login.php");
        exit();
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/content.css?ver=1">
    <title>content</title>
</head>

<body>
    <div id="content_header">
        <span id="hello"> <?= $id ?> 님</span>
        <span id="mypage_btn"><a href="mypage.php">마이페이지</a></span>
        <span id="logout_btn"><a href="process_logout.php">로그아웃</a></span>

    </div>
    <div id="content_body">
        <div id="board_title">게시판</div>
        <table id="board_table">
            <tr id="board_header">
                <th id="header1">번호</th>
                <th id="header2">제목</th>
                <th id="header3">작성자</th>
                <th id="header4">댓글</th>
                <th id="header5">조회수</th>
                <th id="header6">추천</th>
                <th id="header7">작성일</th>
            </tr>
            <tr id="board_content">
                <td>1</td>
                <td onclick="boardDetail(this, 1)">title</td>
                <td>user</td>
                <td>0</td>
                <td>1</td>
                <td>2</td>
                <td>2024-04-28 17:03</td>
            </tr>
        </table>
        <br>
        <span id="register_board_btn" onclick="registerBoard()">글 작성</span>
    </div>



    <script>
        function registerBoard(){
            console.log("register_board");
        }

        function boardDetail(element, boardId){
            location.href="./board/board_detail.php?board="+boardId;
            // console.log(element);

        }



    </script>
</body>

</html>