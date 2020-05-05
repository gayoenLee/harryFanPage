s
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale="1">
    <title>PHP 게시판 웹 사이트</title>
    <script>
        function checkInput() {
            if (!$("#id").val()) {
                alert("아이디를 입력하세요!");
                $("#id").focus();
                return;
            }
            if (!$("#password").val()) {
                alert("비밀번호를 입력하세요!");
                $("#id").focus();
                return;
            }
            if (!$("#passwordConfirm").val()) {
                alert("비밀번호 확인을 입력하세요!");
                $("#passwordConfirm").focus();
                return;
            }
            if (!$("#name").val()) {
                alert("이름을 입력하세요!");
                $("#name").focus();
                return;
            }
            if (!$("#email").val()) {
                alert("이메일을 입력하세요!");
                $("#email").focus();
                return;
            }
            if (!$("#password").val()) {
                alert("비밀번호가 일치하지 않습니다. \n다시 입력해 주세요");
                $("#password").focus();
                $("#password").select();
                return;
            }
            document.join.submit();
        }
        /*초기화*/
        function resetForm() {
            document.join.id.value = "";
            document.join.password.value.value = "";
            document.join.password.confirm.value = "";
            document.join.name.value = "";
            document.join.email.value = "";
            document.join.id.focus();
            return;
        }
    </script>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" ></script>
    <nav>
        <div>
            <button type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="iconBar"></span>
                <span class="iconBar"></span>
                <span class="iconBar"></span>
            </button>
            <a href="mainPage.php">메인</a>
        </div>
        <div>
            <ul>
                <li class="active">
                    <a href="mainPage.php">메인</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown=toggle" date-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">접속하기<span class="caret"></span></a>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="login.php">로그인</a></li>
                        <li class="active"><a href="joinMember.php">회원가입</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div style="padding-top: 20px;">
                <form name="join" method="post" action="joinMemberOK.php">
                    <h3 style="text-align: center">회원가입 화면</h3>
                    <div class="col-lg-4"></div>
                    <div class="formGroup">
                        <input type="text" class="formControl" placeholder="아이디" name="id" id="id" maxlength="115">
                    </div>
                    <div class="formGroup">
                        <input type="password" class="formControl" placeholder="비밀번호" name="password" id="password" maxlength="20">
                    </div>
                    <div class="formGroup">
                        <input type="password" class="formControl" placeholder="비밀번호 확인" name="passwordConfirm" id="passwordConfirm" maxlength="20">
                    </div>
                    <div class="formGroup">
                        <input type="text" class="formControl" placeholder="이름" name="name" id="name" maxlength="20">
                    </div>
                    <div class="formGroup">
                        <input type="email" class="formControl" placeholder="이메일" name="email" id="email" maxlength="20">
                    </div>
                    <span onclick="checkInput()">회원가입</span>&nbsp;
                    <span onclick="resetForm()">초기화</span>
                </form>
            </div>
        </div>
    </div>
</body>

</html>