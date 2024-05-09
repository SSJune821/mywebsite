<?php
require_once("./lib/login_kind.php");

init_cookie_session_jwt();
header("location: ./login.php");
