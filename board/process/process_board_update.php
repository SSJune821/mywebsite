<?php
require_once "../../lib/board_lib.php";

if (!empty($_POST["title"]) && !empty($_POST["content"]) && !empty($_POST["board_id"])) {
    echo "ok";
    $ret = update_board($_POST["title"], $_POST["content"], $_POST["board_id"]);
    if($ret){
        // echo "true";
    }
    else{
        // echo "false";
    }
    

} else {
    // echo "xx";
}


header("location: ../../index.php");

?>
