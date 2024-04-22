<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="login.css" />
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
          <button type="submit" name="login" id="login_btn">로그인</button>
        </form>
      </div>
    </div>

  </body>
</html>
