<!DOCTYPE html>

<head>
    <style type="text/css">
        @import url(mainPageCSS.css);
    </style>
    <link rel="stylesheet" href="firstPageCSS.css">
    <title>홈</title>
</head>

<body>


    <div class="wrapper">
        <h1>LOGO</h1>
        <nav>
            <ul class="menu">
                <li><a href="#">HOME</a></li>
                <li><a href="aboutPage.html">ABOUT</a></li>
                <li><a href="imageBoardPage.php">BOARD</a></li>
                <li><a href="newsPage.html">NEWS</a></li>
                <li><a href="goodsPage.html">GOODS</a></li>

            </ul>
        </nav>
    </div>
    <span class="username">WELCOME !</span>
    <span class="username">
        <?php 
            echo $_POST["email"]; 
            ?>
    </span>

</body>

</html>