<?php
if (!session_id()) {
    // id가 없을 경우 세션 시작
    session_start();
}
$id = $_SESSION["id"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>content</title>
</head>

<body>
    <a href="process_logout.php">로그아웃</a>
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