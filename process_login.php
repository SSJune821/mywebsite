<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
require_once("./lib/login_kind.php");

//로그인 전 기존 로그인 데이터 삭제
init_cookie_session_jwt();

// echo "login_devide";
// echo $_POST["login_divide"];
// echo "<br>";
// echo "login_hash";
// echo $_POST["login_hash"];
// echo "<br>";
// echo "login_cookie";
// echo $_POST["login_cookie"];
// echo "<br>";
// echo "login_session";
// echo $_POST["login_session"];


$user = $_POST["id"];
$pw = $_POST["pw"];

if(isset($_POST["login_divide"])){
    if(isset($_POST["login_hash"])){
        list($ret, $id) = login_divide_hash($user, $pw);
    }
    else{
        list($ret, $id) = login_divide($user, $pw);
    }
}
else{
    if(isset($_POST["login_hash"])){
        list($ret, $id) = login_combine_hash($user, $pw);
    }
    else{
        list($ret, $id) = login_combine($user, $pw);
    }
}

//쿠키 사용
if(isset($_POST["login_cookie"])){
    if($ret){
        setcookie("id", $id, time() + 3600);
    }
}
//세션 사용
else if(isset($_POST["login_session"])){
    if($ret){
        if (!session_id()) {
            session_start();
        }        
        $_SESSION["id"] = $id;
    }
}
//jwt 사용
else if(isset($_POST["login_jwt"])){
    if($ret){
        $jwt = remember_me_jwt($id);
        setcookie("token", $jwt, time() + 3600);
    }
}
//그 외는 없음


if ($ret) {
?>
    <script>
        alert("로그인 성공");
        location.href = "index.php";
    </script>
<?php
} else { ?>
    <script>
        alert("로그인 실패");
        location.href = "index.php";
    </script>
<?php
}
?>