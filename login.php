<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/login.css?ver=1" />
  </head>
  <body>
    <div id="title">My Web Site</div>
    <div id="login_widow">
      <div id="login_wrap">
        <ul id="menu_wrap">
            <li id="login_type1">ID 로그인</li>
            <li id="login_type2">일회용 번호</li>
            <li id="login_type3">QR 코드</li>
        </ul>
        <form action="process_login.php" method="post">
          <input type="text" name="id" placeholder="아이디" id="id"/><br />
          <input type="password" name="pw" placeholder="비밀번호" id="pw"/><br />
          
          <div id="session_window">
            <input type="checkbox" name="session_check" id="session_check" />
            <label for="session_check" id="session_label">로그인 상태 유지</label>
          </div>
          <div id="login_type_window">
            <input type="checkbox" class="login_check_cls" name="login_divide" id="login_devide_check"/>
            <label for="login_devide_check" id="login_devide_check_label" class="login_check_label_cls">식별/인증 분리</label>
            <input type="checkbox" class="login_check_cls" name="login_hash" id="login_hash_check"/>
            <label for="login_hash_check" id="login_hash_check_label" class="login_check_label_cls">해시 사용 여부</label>
            <input type="checkbox" class="login_check_cls" name="login_cookie" id="login_cookie_check"/>
            <label for="login_cookie_check" id="login_cookie_check_label" class="login_check_label_cls">쿠키 사용 여부</label>
            <br>
            <input type="checkbox" class="login_check_cls" name="login_session" id="login_session_check"/>
            <label for="login_session_check" id="login_session_check_label" class="login_check_label_cls">세션 사용 여부</label>

          </div>
          <button type="submit" name="login" id="login_btn">로그인</button>
        </form>
        <a href="register.php" id="register_btn">회원가입</a>
      </div>
    </div>

  </body>
</html>
