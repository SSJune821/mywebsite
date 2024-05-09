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



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>content</title>
</head>

<body>
    <div>안녕하세요 <?=$id?> 님</div>
    <span><a href="process_logout.php">로그아웃</a></span>
    <span><a href="mypage.php">마이페이지</a></span>
    <table>
        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>작성자</th>
            <th>댓글</th>
            <th>조회수</th>
            <th>추천</th>
            <th>작성일</th>
        </tr>
        <tr>
            <th>1</th>
            <th>title</th>
            <th>user</th>
            <th>0</th>
            <th>1</th>
            <th>2</th>
            <th>2024-04-28 17:03</th>
        </tr>


    </table>
</body>

</html>