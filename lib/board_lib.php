<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
mysqli_report(MYSQLI_REPORT_OFF);

require_once "common.php";
require_once "login_kind.php";


if (isset($_POST["type"])) {
    if (strcmp($_POST["type"], "list") == 0) {
        echo get_board_list();
    }
}



function get_board_list()
{
    $conn = connect_to_db();
    $sql = "select * from my_board as b left join (select user, id as _id from my_user) u on b.user_id = u._id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return json_encode($row);
}



function register_board($title, $content)
{
    $conn = connect_to_db();
    $user_id = get_user_id();
    $sql = "insert into my_board(title, content, user_id) values ('$title', '$content', '$user_id')";
    // print_r($sql);
    // die();
    $result = mysqli_query($conn, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}


function get_board_detail($board_id){
    $conn = connect_to_db();
    $sql = "select * from my_board where id=$board_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return array($row["title"], $row["content"], $row["user_id"]);
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