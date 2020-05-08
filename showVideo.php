<?php
include 'dbConnect.php';
?>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
.video-list-thumbs{}
.video-list-thumbs > li{
    margin-bottom:12px;
}
.video-list-thumbs > li:last-child{}
.video-list-thumbs > li > a{
	display:block;
	position:relative;
	background-color: #111;
	color: #fff;
	padding: 8px;
	border-radius:3px
    transition:all 500ms ease-in-out;
    border-radius:4px
}
.video-list-thumbs > li > a:hover{
	box-shadow:0 2px 5px rgba(0,0,0,.3);
	text-decoration:none
}
.video-list-thumbs h2{
	bottom: 0;
	font-size: 14px;
	height: 33px;
	margin: 8px 0 0;
}
.video-list-thumbs .glyphicon-play-circle{
    font-size: 60px;
    opacity: 0.6;
    position: absolute;
    right: 39%;
    top: 31%;
    text-shadow: 0 1px 3px rgba(0,0,0,.5);
    transition:all 500ms ease-in-out;
}
.video-list-thumbs > li > a:hover .glyphicon-play-circle{
	color:#fff;
	opacity:1;
	text-shadow:0 1px 3px rgba(0,0,0,.8);
}
.video-list-thumbs .duration{
	background-color: rgba(0, 0, 0, 0.4);
	border-radius: 2px;
	color: #fff;
	font-size: 11px;
	font-weight: bold;
	left: 12px;
	line-height: 13px;
	padding: 2px 3px 1px;
	position: absolute;
	top: 12px;
    transition:all 500ms ease;
}
.video-list-thumbs > li > a:hover .duration{
	background-color:#000;
}
@media (min-width:320px) and (max-width: 480px) { 
	.video-list-thumbs .glyphicon-play-circle{
    font-size: 35px;
    right: 36%;
    top: 27%;
	}
	.video-list-thumbs h2{
		bottom: 0;
		font-size: 12px;
		height: 22px;
		margin: 8px 0 0;
	}
}
</style>
</head>
<!------ Include the above in your HEAD tag ---------->
<body>
<div class="container">

<p>
    <h5>Features:</h5>
    <ul>
        <li>Responsive design with hover effect</li>
        <li>Compatible with bootstrap 3.0.0 and Up</li>
        <li>No Javascript</li>
    </ul>
    <hr>
</p>

<ul class="list-unstyled video-list-thumbs row">
	<li class="col-lg-3 col-sm-4 col-xs-6">
		<a href="#" title="해리포터 애니메이션">
        <iframe class = "img-responsive" src="https://player.vimeo.com/video/184312722" width="440" height="260" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
<p><a href="https://vimeo.com/184312722">Grant Berry_Harry Potter</a> from <a href="https://vimeo.com/grantberry">Grant Berry</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
			<h2>Claudio Bravo, antes su debut con el Barça en la Liga</h2>
			<span class="duration">01:00</span>
		</a>
	</li>
	<li class="col-lg-3 col-sm-4 col-xs-6">
		<a href="#" title="Claudio Bravo, antes su debut con el Barça en la Liga">
        <iframe src="https://player.vimeo.com/video/267474969" width="640" height="265" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
<p><a href="https://vimeo.com/267474969">Harry Potter - Test</a> from <a href="https://vimeo.com/sagararun">Sagar Arun</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
			<h2>Claudio Bravo, antes su debut con el Barça en la Liga</h2>
			<span class="duration">00:06</span>
		</a>
	</li>
	<li class="col-lg-3 col-sm-4 col-xs-6">
		<a href="#" title="Claudio Bravo, antes su debut con el Barça en la Liga">
        <iframe src="https://player.vimeo.com/video/196616926" width="640" height="267" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
<p><a href="https://vimeo.com/196616926">Harry Potter Symmetry</a> from <a href="https://vimeo.com/user59429282">Sergio Rojo</a> on <a href="https://vimeo.com">Vimeo</a>.</p>			<h2>Claudio Bravo, antes su debut con el Barça en la Liga</h2>
			<span class="duration">03:15</span>
		</a>
	</li>
	<li class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
		<a href="#" title="Claudio Bravo, antes su debut con el Barça en la Liga">
			<img src="http://i.ytimg.com/vi/ZKOtE9DOwGE/mqdefault.jpg" alt="Barca" class="img-responsive" height="130px" />
			<h2>Claudio Bravo, antes su debut con el Barça en la Liga</h2>
			<span class="duration">03:15</span>
		</a>
	</li>
    <li class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
		<a href="#" title="Claudio Bravo, antes su debut con el Barça en la Liga">
			<img src="http://i.ytimg.com/vi/ZKOtE9DOwGE/mqdefault.jpg" alt="Barca" class="img-responsive" height="130px" />
			<h2>Claudio Bravo, antes su debut con el Barça en la Liga</h2>
			<span class="duration">03:15</span>
		</a>
	</li>
</ul>

</div>
</body>
</html>