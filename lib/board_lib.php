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
    $sql = "select * from my_board";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // print_r($row);
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
