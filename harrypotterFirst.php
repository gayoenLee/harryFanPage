
<!DOCTYPE html>
<html>
  <head>
     <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-165857365-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-165857365-1');
</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>harrypotter fan page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/wow.min.js"></script>
    <script> new WOW().init(); </script>
  </head>
  <body>
    <div class="header">
      <div class="navbar">
        <div class="logo">
          <h3>Logo</h3>
        </div>
        <ul class=""  id="navbarid">
          <li><a href="#"> </a></li>
          <li><a id="about-me" class="active" href="#">ABOUT</a></li>
          <li><a id="work" href="#">HARRY POTTER</a></li>
          <li><a id="contact" href="#">회원가입하기</a></li>
          <li class="icon"><a href="#">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </a></li>
        </ul>
      </div>
      <div class="header-content">
        <h1>My I introduce myself ?</h1>
        <h3>Fontend Designer | UI/UX Designer</h3>
      </div>
      <img src="img/container.png" alt="">
      
      <div class="goahead">
        <a href="#">해리포터를 좋아하는 사람들의 공간입니다.</a>
      </div>
    </div>
    <!-- about-me -->
    <div class="about-me">
      <div class="about-me-intero wow fadeIn  data-wow-duration="1s" data-wow-delay="1s"">
        <h1>LIKE HARRYPOTTER</h1>
        <p>회원정보가 없으신가요?</p>
        <p>페이지 제일 아래에서 회원가입을 할 수 있습니다</p>
        <form name="loginSubmit" id="loginSubmit" action="loginOK.php" method="post">     
        <p>  <input type="id" name="id" placeholder="아이디 입력"> </p>
        <p>  <input type="password" name="password" placeholder="패스워드를 입력하세요" maxlength="20"></p>
        <p> <input type="submit"></p>
</form>
      </div>
      <div class="about-me-block col-md-12">
        <div class="item col-md-4 wow fadeIn  data-wow-duration="1s" data-wow-delay="1.5s"">
          <img src="img/icon1.png" alt="">
          <h3>자유게시판</h3>
          <p>다양한 이야기를 함께 나눌 수 있는 공간이 마련돼 있어요</p>
        </div>
        <div class="item col-md-4 wow fadeIn  data-wow-duration="1s" data-wow-delay="2s"">
          <img src="img/icon2.png" alt="">
          <h3>최신 소식</h3>
          <p>해리포터와 관련된 모든 매체의 최신 소식을 발빠르게 전해드립니다.</p>
        </div>
        <div class="item col-md-4 wow fadeIn  data-wow-duration="1s" data-wow-delay="2.5s"">
          <img src="img/icon3.png" alt="">
          <h3>열린 공간</h3>
          <p>누구나 제한없이 이용 가능합니다. 많은 사람들과 함께할 수 있습니다</p>
        </div>
      </div>
    </div>
    <div class="separate"></div>
    <!-- work -->
    <div class="work col-md-12">
      <div class="work-item col-md-6 wow fadeIn  data-wow-duration="2s" data-wow-delay="1s"">
        <img src="img/work1.png" alt="">
        <div class="more-details">
          <img src="img/show.png" alt="">
          <div class="description">
            <h3>Lorem ipsum dolor sit</h3>
            <p>amet consetetur sadipscing elitr</p>
          </div>
        </div>
      </div>
      <div class="work-item col-md-6 wow fadeIn  data-wow-duration="2s" data-wow-delay="1.5s"">
        <img src="img/work2.png" alt="">
        <div class="more-details">
          <img src="img/show.png" alt="">
          <div class="description">
            <h3>Lorem ipsum dolor sit</h3>
            <p>amet consetetur sadipscing elitr</p>
          </div>
        </div>
      </div>
      <div class="work-item col-md-6 wow fadeIn  data-wow-duration="2s" data-wow-delay="1s"">
        <img src="img/work3.png" alt="">
        <div class="more-details">
          <img src="img/show.png" alt="">
          <div class="description">
            <h3>Lorem ipsum dolor sit</h3>
            <p>amet consetetur sadipscing elitr</p>
          </div>
        </div>
      </div>
      <div class="work-item col-md-6 wow fadeIn  data-wow-duration="2s" data-wow-delay="1.5s"">
        <img src="img/work4.png" alt="">
        <div class="more-details">
          <img src="img/show.png" alt="">
          <div class="description">
            <h3>Lorem ipsum dolor sit</h3>
            <p>amet consetetur sadipscing elitr</p>
          </div>
        </div>
      </div>
      <div class="view-more wow zoomIn  data-wow-duration="2s" data-wow-delay="1s"">
        <a href="#">더 많은 뉴스 보기</a>
      </div>
    </div>
    <div class="separate"></div>

    <!-- contact-us -->

    <div class="contact-us wow fadeIn  data-wow-duration="2s" data-wow-delay="1s"">
      <h1>회원가입</h1>
      <form action="joinMemberOK.php" method="post" name="join">
        <div class="name-info">
          <input type="text" name="name"  placeholder="Name">
          <input type="email" name="email"  placeholder="Email">
          <input type="text" name="id"  placeholder="ID">
          <input type="password" name="password" placeholder="PASSWORD">
          <input type="password" name="passwordConfirm"  placeholder="PASSWORD">

        </div>
        
        <!-- <textarea name="name" rows="8" cols="80" placeholder="How I can helpe you?"></textarea> -->
       
        <div class="wow zoomIn  data-wow-duration="2s" data-wow-delay="1s"">
          <button type="submit">회원가입</button>
        </div>
      </form>
    </div>
    <div class="footer">
      <div class="sociaux col-md-12">
        <div class="facebook col-md-4 wow fadeIn  data-wow-duration="2s" data-wow-delay="1s"">
          <a href="#"></a>
        </div>
        <div class="dribbble col-md-4 wow fadeIn  data-wow-duration="2s" data-wow-delay="1.5s"">
          <a href="#"></a>
        </div>
        <div class="twitter col-md-4 wow fadeIn  data-wow-duration="2s" data-wow-delay="2s"">
          <a href="#"></a>
        </div>
      </div>
      <div class="copyright">
        <h5>Copyright (c) 2017 By  <a href="https://goo.gl/Dz4SeU">Devma</a></h5>
      </div>
    </div>
<div class="goTop"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>
    <script src="js/jquery.min.js"></script>
    <script src="js/mainscript.js"></script>
  </body>
</html>
