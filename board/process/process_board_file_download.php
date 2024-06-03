<?php
require_once "../../lib/board_lib.php";

if (isset($_GET['filename']) && isset($_GET['boardid'])) {
    $board_id = $_GET['boardid'];
    $recv_file_name = $_GET['filename'];


    list($title, $content, $user_id, $file_org_name, $file_path, $file_name) = get_board_detail_by_id_and_file($board_id, $recv_file_name);
    $file = $file_path . $file_name; // 파일 경로

    if (file_exists($file)) {

        // 파일 다운로드 헤더 설정
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=" . $file_org_name);
        header("Content-Length: " . filesize($file));

        // 파일 출력
        readfile($file);
    } else {
        // 파일이 없을 경우 에러 처리
        http_response_code(404);
        echo "File not found!";
    }
} else {
    // 'file' 파라미터가 없는 경우 에러 처리
    http_response_code(400);
    echo "No file specified!";
}
