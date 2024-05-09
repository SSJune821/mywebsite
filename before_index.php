<!-- index 전에 jwt 처리용도 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        var jwt = localStorage.getItem("token");
        let f = document.createElement('form');

        let obj;
        obj = document.createElement('input');
        obj.setAttribute('type', 'hidden');
        obj.setAttribute('name', 'token');
        obj.setAttribute('value', jwt);

        f.appendChild(obj);
        f.setAttribute('method', 'post');
        f.setAttribute('action', './index.php');
        document.body.appendChild(f);
        f.submit();
    </script>
</body>

</html>