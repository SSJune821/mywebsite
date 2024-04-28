<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <title>register</title>
</head>

<body>
    <div id="register_window">
        <div id="register_wrap">
            <p><a href="login.php" id="register_title">My Web Site</a></p>
            <form action="process_register.php" method="post" onsubmit="return checkBeforeSubmit()">
                <input type="text" name="id" placeholder="아이디" id="id"><br>
                <input type="password" name="pw" placeholder="비밀번호" id="pw"><br>
                <input type="password" name="pw_confirm" placeholder="비밀번호 확인" id="pw_confirm"><br>
                <input type="email" name="email" placeholder="이메일 주소" id="email"><br>
                <input type="text" name="name" placeholder="이름" id="name"><br>
                <div id="idMsg"></div>
                <div id="pwMsg"></div>
                <div id="pwConfirmMsg"></div>
                <div id="emailMsg"></div>
                <div id="nameMsg"></div>
                <button type="submit" name="register" id="register_btn2">회원가입</button>
            </form>

        </div>
    </div>


    <script>
        var idMsg = document.getElementById("idMsg");
        var pwMsg = document.getElementById("pwMsg");
        var pwConfirmMsg = document.getElementById("pwConfirmMsg");
        var emailMsg = document.getElementById("emailMsg");
        var nameMsg = document.getElementById("nameMsg");
        var regBtn = document.getElementById("register_btn2");

        var idIsOk = false;
        var pwIsOk = false;
        var emailIsOk = false;
        var nameIsOk = false;

        function checkBeforeSubmit() {
            if(idIsOk && pwIsOk && emailIsOk && nameIsOk){
                return true;
            }else{
                return false;
            }
        }

        var inputId = document.getElementById("id");
        inputId.addEventListener("focusout", (event) => {
            // 비어있다면 경고
            if (inputId.value == "") {
                inputId.style.border = "2px solid red";
                idMsg.textContent = "아이디를 입력해주세요.";
                idMsg.style.fontSize = "13px";
                idMsg.style.color = "red";
                idIsOk = false;

            }
            // 값이 있다면 규칙 확인 작업 필요
            else {
                inputId.style.border = "1px solid gray";
                idMsg.textContent = "";
                idIsOk = true;
            }
        });

        var inputPw = document.getElementById("pw");
        inputPw.addEventListener("focusout", (event) => {
            // 비어있다면 경고
            if (inputPw.value == "") {
                inputPw.style.border = "2px solid red";
                pwMsg.textContent = "패스워드를 입력해주세요.";
                pwMsg.style.fontSize = "13px";
                pwMsg.style.color = "red";
                pwIsOk = false;

            }
            // 값이 있다면 규칙 확인 작업 필요
            else {
                inputPw.style.border = "1px solid gray";
                pwMsg.textContent = "";
                pwIsOk = true;
            }
        })

        var inputPwConfirm = document.getElementById("pw_confirm");
        inputPwConfirm.addEventListener("focusout", (event) => {
            // 비어있다면 경고
            if (inputPwConfirm.value == "") {
                inputPwConfirm.style.border = "2px solid red";
                pwConfirmMsg.textContent = "확인용 비밀번호를 입력해주세요.";
                pwConfirmMsg.style.fontSize = "13px";
                pwConfirmMsg.style.color = "red";
                pwIsOk = false;
            }
            // 확인용 비밀번호가 다르면
            else if (inputPw.value != inputPwConfirm.value) {
                pwConfirmMsg.textContent = "확인용 비밀번호가 틀립니다.";
                pwConfirmMsg.style.fontSize = "13px";
                pwConfirmMsg.style.color = "red";
                pwIsOk = false;
            }
            // 값이 있다면 규칙 확인 작업 필요
            else {
                inputPwConfirm.style.border = "1px solid gray";
                pwConfirmMsg.textContent = "";
                pwIsOk = true;
            }
        })

        var inputEmail = document.getElementById("email");
        inputEmail.addEventListener("focusout", (event) => {
            // 비어있다면 경고
            if (inputEmail.value == "") {
                inputEmail.style.border = "2px solid red";
                emailMsg.textContent = "이메일을 입력해주세요.";
                emailMsg.style.fontSize = "13px";
                emailMsg.style.color = "red";
                emailIsOk = false;
            }
            // 값이 있다면 규칙 확인 작업 필요
            else {
                inputEmail.style.border = "1px solid gray";
                emailMsg.textContent = "";
                emailIsOk = true;
            }
        })

        var inputName = document.getElementById("name");
        inputName.addEventListener("focusout", (event) => {
            // 비어있다면 경고
            if (inputName.value == "") {
                inputName.style.border = "2px solid red";
                nameMsg.textContent = "이름을 입력해주세요.";
                nameMsg.style.fontSize = "13px";
                nameMsg.style.color = "red";
                nameIsOk = false;
            }
            // 값이 있다면 규칙 확인 작업 필요
            else {
                inputName.style.border = "1px solid gray";
                nameMsg.textContent = "";
                nameIsOk = true;
            }
        })
    </script>
</body>


</html>