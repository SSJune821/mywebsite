<?php
// 이거 있으면 게시판 목록 못 가져옴
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
mysqli_report(MYSQLI_REPORT_OFF);

require_once "common.php";
require_once "login_kind.php";


if (!empty($_POST["type"])) {
    if (strcmp($_POST["type"], "list") == 0) {
        echo get_board_list();
    } else if (strcmp($_POST["type"], "paging") == 0 && !empty($_POST["page"]) && !empty($_POST["cnt"])) {
        $cnt = $_POST["cnt"];
        $index = ($_POST["page"] - 1) * $cnt;
        // echo $index;
        echo get_board_list_paging($index, $cnt);
    } else if (strcmp($_POST["type"], "searchList") == 0 && !empty($_POST["kind"]) && !empty($_POST["search"])) {
        $kind = $_POST["kind"];
        $search = $_POST["search"];
        echo get_board_list_by_search($kind, $search);
    } else if (
        strcmp($_POST["type"], "searchListPaging") == 0
        && !empty($_POST["page"]) && !empty($_POST["cnt"])
        && !empty($_POST["kind"]) && !empty($_POST["search"])
    ) {
        $cnt = $_POST["cnt"];
        $index = ($_POST["page"] - 1) * $cnt;
        $kind = $_POST["kind"];
        $search = $_POST["search"];
        echo get_board_list_by_search_paging($kind, $search, $index, $cnt);
    } else if (
        strcmp($_POST["type"], "searchListPagingOrder") == 0
        && !empty($_POST["page"]) && !empty($_POST["cnt"])
        && !empty($_POST["kind"]) && !empty($_POST["search"]
            && !empty($_POST["column"]) && !empty($_POST["order"]))
    ) {
        $cnt = $_POST["cnt"];
        $index = ($_POST["page"] - 1) * $cnt;
        $kind = $_POST["kind"];
        $search = $_POST["search"];
        $column = $_POST["column"];
        $order = $_POST["order"];
        echo get_board_list_by_search_paging_order($kind, $search, $index, $cnt, $column, $order);
    } else {
        //전체 리스트 리턴
        echo get_board_list();

        //갯수 제한 리스트 리턴
        // $cnt = $_POST["cnt"] ? $_POST["cnt"] : 5;
        // $index = (($_POST["page"] - 1) * $cnt) ? (($_POST["page"] - 1) * $cnt) : 0;
        // echo get_board_list_paging($index, $cnt);
    }
}



$upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/week7/uploads/";

//전체 게시글 갯수
function get_board_list_cnt()
{
    $conn = connect_to_db();
    $sql = "select count(*) from my_board";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $row[0]["count(*)"];
}

// 전체 게시글 목록
function get_board_list()
{
    $conn = connect_to_db();
    $sql = "select * from my_board as b left join (select user, id as _id from my_user) u on b.user_id = u._id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return json_encode($row);
}

// 게시글 목록 with 페이징
function get_board_list_paging($index, $count)
{
    $conn = connect_to_db();
    $sql = "select * from my_board as b left join (select user, id as _id from my_user) u on b.user_id = u._id limit $index, $count";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return json_encode($row);
}

function get_board_list_cnt_by_search($kind, $search)
{
    $conn = connect_to_db();
    $sql = "select count(*) from my_board as b left join (select user, id as _id from my_user) u on b.user_id = u._id";

    if (strcmp($kind, "all") == 0) {
        $sql = $sql . " where (title like '%$search%' OR content like '%$search%' OR user like '%$search%')";
    } else if (strcmp($kind, "title") == 0) {
        $sql = $sql . " where (title like '%$search%')";
    } else if (strcmp($kind, "content") == 0) {
        $sql = $sql . " where (content like '%$search%')";
    } else if (strcmp($kind, "user") == 0) {
        $sql = $sql . " where (user like '%$search%')";
    } else if (strcmp($kind, "titlecontent") == 0) {
        $sql = $sql . " where (title like '%$search%' OR content like '%$search%')";
    } else {
    }

    // print_r($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $row[0]["count(*)"];
}


// 전체 게시글 목록 (검색)
function get_board_list_by_search($kind, $search)
{
    $conn = connect_to_db();
    $sql = "select * from my_board as b left join (select user, id as _id from my_user) u on b.user_id = u._id";

    if (strcmp($kind, "all") == 0) {
        $sql = $sql . " where (title like '%$search%' OR content like '%$search%' OR user like '%$search%')";
    } else if (strcmp($kind, "title") == 0) {
        $sql = $sql . " where (title like '%$search%')";
    } else if (strcmp($kind, "content") == 0) {
        $sql = $sql . " where (content like '%$search%')";
    } else if (strcmp($kind, "user") == 0) {
        $sql = $sql . " where (user like '%$search%')";
    } else if (strcmp($kind, "titlecontent") == 0) {
        $sql = $sql . " where (title like '%$search%' OR content like '%$search%')";
    } else {
    }

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return json_encode($row);
}



// 전체 게시글 목록 with 페이징 (검색)
function get_board_list_by_search_paging($kind, $search, $index, $count)
{
    $conn = connect_to_db();
    $sql = "select * from my_board as b left join (select user, id as _id from my_user) u on b.user_id = u._id";

    if (strcmp($kind, "all") == 0) {
        $sql = $sql . " where (title like '%$search%' OR content like '%$search%' OR user like '%$search%')";
    } else if (strcmp($kind, "title") == 0) {
        $sql = $sql . " where (title like '%$search%')";
    } else if (strcmp($kind, "content") == 0) {
        $sql = $sql . " where (content like '%$search%')";
    } else if (strcmp($kind, "user") == 0) {
        $sql = $sql . " where (user like '%$search%')";
    } else if (strcmp($kind, "titlecontent") == 0) {
        $sql = $sql . " where (title like '%$search%' OR content like '%$search%')";
    } else {
    }

    $sql = $sql . " limit $index, $count";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return json_encode($row);
}

// 전체 게시글 목록 with 페이징 (검색, 정렬)
function get_board_list_by_search_paging_order($kind, $search, $index, $count, $column, $order)
{
    $conn = connect_to_db();
    $sql = "select * from my_board as b left join (select user, id as _id from my_user) u on b.user_id = u._id";

    if (strcmp($column, "id") == 0) {
        $sql = $sql . " order by id $order";
    } else if (strcmp($column, "title") == 0) {
        $sql = $sql . " order by title $order";
    } else if (strcmp($column, "user") == 0) {
        $sql = $sql . " order by user $order";
    } else if (strcmp($column, "comment") == 0) {
        $sql = $sql . " order by comment $order";
    } else if (strcmp($column, "view") == 0) {
        $sql = $sql . " order by views $order";
    } else if (strcmp($column, "rec") == 0) {
        $sql = $sql . " order by recommendation $order";
    } else if (strcmp($column, "created") == 0) {
        $sql = $sql . " order by created $order";
    }


    if (strcmp($kind, "all") == 0) {
        $sql = $sql . " where (title like '%$search%' OR content like '%$search%' OR user like '%$search%')";
    } else if (strcmp($kind, "title") == 0) {
        $sql = $sql . " where (title like '%$search%')";
    } else if (strcmp($kind, "content") == 0) {
        $sql = $sql . " where (content like '%$search%')";
    } else if (strcmp($kind, "user") == 0) {
        $sql = $sql . " where (user like '%$search%')";
    } else if (strcmp($kind, "titlecontent") == 0) {
        $sql = $sql . " where (title like '%$search%' OR content like '%$search%')";
    } else {
    }


    $sql = $sql . " limit $index, $count";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return json_encode($row);
}


// 게시글 등록
function register_board($title, $content, $files)
{
    $conn = connect_to_db();
    $user_id = get_user_id();
    $sql = "insert into my_board(title, content, user_id) values ('$title', '$content', '$user_id')";
    print_r($sql);
    // die();

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        return false;
    }

    $board_id = mysqli_insert_id($conn);

    if ($files) {
        // var_dump($files);
        global $upload_dir;
        $file_name = $files["name"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $file_tmp_name = $files["tmp_name"];
        $file_size = $files["size"];

        $new_file_name = uniqid() . "." . $file_ext;
        $upload_path = $upload_dir . $new_file_name;

        // 임시 파일의 경로를 UTF-8로 변환합니다.
        //출처: https://syudal.tistory.com/entry/PHP-파일-업로드-하기 [수달의 IT 세상:티스토리]
        $file_tmp_name_utf8 = mb_convert_encoding($file_tmp_name, 'UTF-8', 'auto');

        // echo nl2br("\n");
        // var_dump($file_name);
        // echo nl2br("\n");
        // var_dump($file_ext);
        // echo nl2br("\n");
        // var_dump($file_tmp_name);
        // echo nl2br("\n");
        // var_dump($new_file_name);
        // echo nl2br("\n");
        // var_dump($upload_path);
        // echo nl2br("\n");
        // var_dump($file_tmp_name_utf8);
        // echo nl2br("\n");

        if (move_uploaded_file($file_tmp_name_utf8, $upload_path)) {
            echo "파일 업로드 성공: " . $new_file_name;
            $sql = "insert into my_board_file(user_id, board_id, file_org_name, file_name, file_path, file_ext, file_size)
             values ('$user_id', '$board_id', '$file_name', '$new_file_name', '$upload_dir', '$file_ext', '$file_size')";
        } else {
            echo "파일 업로드 실패.";
            echo $files["error"];
        }
    }
    print_r($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}


function get_board_detail($board_id)
{
    $conn = connect_to_db();
    // $sql = "select * from my_board where id=$board_id";
    $sql = "select * from my_board mb left join 
    (select board_id, file_org_name, file_name, file_path, file_ext, file_size from my_board_file) 
    mbf on mb.id=mbf.board_id where mb.id=$board_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return array($row["title"], $row["content"], $row["user_id"], $row["file_org_name"], $row["file_path"], $row["file_name"]);
}

function get_board_detail_by_id_and_file($board_id, $file_org_name)
{
    $conn = connect_to_db();
    // $sql = "select * from my_board where id=$board_id";
    $sql = "select * from my_board mb left join 
    (select board_id, file_org_name, file_name, file_path, file_ext, file_size from my_board_file) 
    mbf on mb.id=mbf.board_id where mb.id=$board_id and mbf.file_org_name='$file_org_name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return array($row["title"], $row["content"], $row["user_id"], $row["file_org_name"], $row["file_path"], $row["file_name"]);
}


function update_board($title, $content, $board_id)
{
    $conn = connect_to_db();
    $user_id = get_user_id();
    $sql = "update my_board set title='$title', content='$content' where id=$board_id";
    // print_r($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}


function delete_board($board_id)
{
    $conn = connect_to_db();
    $sql = "delete from my_board where id=$board_id";
    // print_r($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}
