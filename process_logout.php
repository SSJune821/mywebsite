<?php
require_once("./lib/login_kind.php");

init_cookie_session();
header("location: ./login.php");
