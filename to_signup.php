<?php 
include ('db_connect.php');
include ('functions.php');
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image" href="trash.png">
	<link rel="stylesheet" type="text/css" href="i.css">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<title>Sign Up</title>
</head>
<body>

<section>
			<header>
				<a href="index.html"><img src="trash.png" class="logo"><br><p>~TRR~</p></a>
				<ul>
					<li><a href="index.html"><div class="las la-home"></div>Home</a></li>
					<li><a href="login.php"><div  class="las la-sign-in-alt"></div></div>Login</a></li>
					<li><a href="signup.php" class="active"><div  class="las la-user-plus"></div> Sign Up</a></li>
					<li><a href="contact_us.php"><div class="las la-sms"></div>About Us</a></li>
				</ul>
			</header>
			<div class="t">What Type Of Account Do You Want TO Create?</div>
			<div class="ico">
			<ul class="thumb">				
				<a href="signup.php"> <li><img  src="garb.png"><div class="small">Regular Client Account</div></li></a><br>
				<div class="t">OR</div>
				<a href="try_signup.php"> <li><img src="garbage-truck.png"><div class="small">Waste Company Account</div></li></a>
			</ul>
		</div>
			
			
</section>
<footer class="footer">
			<p class="copyright1">The Refuse Remedy</p>
			<br>
			<div class="social">
				<a href="#" class="lab la-instagram"></a>
				<a href="#" class="lab la-facebook-f"></a>
				<a href="#" class="lab la-twitter"></a>
			</div>
			<ul class="list">
				<li><a href="#">Home</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Terms</a></li>
				<li><a href="#">Privacy Policy</a></li>
			</ul>
			<p class="copyright">
				Group 10 Team 2021
			</p>
			
			<br>
		</footer>
</body>
</html>