<?php
require_once "../../lib/board_lib.php";

if (!empty($_POST["title"]) && !empty($_POST["content"])) {
    echo "ok";
    $ret = register_board($_POST["title"], $_POST["content"]);
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
