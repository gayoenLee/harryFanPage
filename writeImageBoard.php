<!DOCTYPE html>
<head>
    <title>이미지 공유 게시판</title>
    <link rel="stylesheet" type="text/css" href="showImageBoardCSS.css"/>
</head>
<body>
    <p>
        <div class="title"><h4>게시판</h4></div>
    </p>
    <form action="writeImageProcess.php" method="POST">
        <p>
            <table class="writeTable" style="text-align: center; border: 1px solid #ddddda">
                <thead>
                    <tr>
                        <th colspan="2" style="background-color: #eeeeee; text-align: center;">
                            <h3>게시판 글쓰기</h3>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" placeholder="아이디" name="userName"><b></b></td>
                        </tr>
                        <tr>
                            <input
                                type="text"
                                placeholder="글 제목"
                                name="title"
                                id="userTitle"
                                required="required"></td>
                    </tr>
                    <tr>
                        <td><input
                            type="password"
                        
                            placeholder="글 비밀번호"
                            name="password"
                            id="userPassword"
                            style="width: 150px;"></td>
                    </tr>
                    <tr>
                        <td>
                            <textarea
                               
                                placeholder="글 내용"
                                name="contents"
                                id="userContents"
                                style="height: 350px"
                                required="required"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="boardTime" value="<?php echo date("Y-m-d H:i:s");?>">
            <input type="checkbox" value="1" name="lockpost">비밀글<br><br>
            <button class="button" type="submit">글 쓰기</button>
        </form>
    </body>

</html>