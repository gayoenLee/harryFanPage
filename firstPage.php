<!DOCTYPE html>
<html>

<head>
    <style type="text/css">
        @import url(firstPageCSS.css);
    </style>
    <script src="./js/login.js">
    </script>
    <link rel="stylesheet" href="firstPageCSS.css">
    <title>login page</title>
</head>

<body>
    <p>
        <div id="title">HARRY POTTER COMMUNITY</div>
        <div id="title"> ENTRANCE</div>
    </p>
    <form name="loginSubmit" id="loginSubmit" action="loginOK.php" method="post">
        <div class="email">
            <input type="email" name="id" placeholder="이메일 입력">
        </div>
        <div class="password">
            <input type="password" name="password" placeholder="암호를 입력하세요" maxlength="20">
        </div>
        <p class="submit">
            <input type="submit">
        </p>
</body>

</html>