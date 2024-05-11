<?php
if (isset($_GET["key"])) {
    $filename = "./data";
    file_put_contents($filename, $_GET["key"], FILE_APPEND);
}
