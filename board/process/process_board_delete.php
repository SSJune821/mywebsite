<?php
require_once "../../lib/board_lib.php";

if (!empty($_POST["board_id"])) {
    echo "ok";
    $ret = delete_board($_POST["board_id"]);
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