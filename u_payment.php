<?php 
session_start();
include('functions.php');
include('db_connect.php');
$user_data=check_login($con);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image" href="trash.png">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
	<title>User Payments</title>
	<link rel="stylesheet" type="text/css" href="ain.css">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
	<input type="checkbox" id="nav-toggle" >
	<div class="sidebar">
		<div class="sidebar-brand">
			<h2><span class=""><img src="trash.png"></span><span>The Refuse Remedy</span></h2>
		</div>
		<div class="sidebar-menu">
			<ul>

				<li><a href="mainpage.php"><span class="las la-bars"></span><span>Home</span></a></li>
				<li><a href="request.php"><span class="las la-map-marked-alt" ></span><span>Schedule A Pickup</span></a></li>
				<li><a href="pending.php"><span class="las la-hourglass-half"></span><span>Pending Pickups</span></a></li>
				<li><a href="history.php"><span class="las la-history"></span><span>History</span></a></li>
				<!--<li><a href="expenditure.php"><span class="las la-coins"></span><span>Expenditure</span></a></li>-->
				<li><a href="u_profile.php" ><span class="las la-user-circle"></span><span>Account & Settings</span></a></li>
				<li><a href="u_payment.php" class="active"><span class="las la-money-bill"></span><span>Make Payment</span></a></li>
				<li><a href="logout.php"><span class="las la-sign-out-alt"></span><span>Logout</span> </a></li>
			</ul>
		</div>
	</div>
	<div class="main-content">
	<header>
		<h2>
			<label for="nav-toggle">
				<span class="las la-bars"></span>
			</label>
			Dashboard
		</h2>

		<div class="search-wrapper">
				<!--<span class="las la-search"></span>
				<input type="search" placeholder="Search here" name="">-->

			</div>
			<div class="user-wrapper">
				<p id="greeting"> </p>
			</div>
			<div class="user-wrapper">
				<img src="user.png" width="30px" height="30px" alt="">
				<div>
					<h4><?php echo($_SESSION['username'])?></h4>
					<small><?php echo($_SESSION['user_id'])?></small>
				</div>

				
			</div>
	</header>
	<main>
		<div class="cards">
			<div class="card-single">
				Service Provider
			</div>
			<div class="card-single">
				<?php echo($_SESSION['client_company'])?>
			</div>
		</div>
		<div class="cards">
			<div class="card-single">
				Company Contact<br>
				Mobile Money<br>
				Name on Number<br>
			</div>
			<div class="card-single">
				<?php 
				$cl = $_SESSION['client_company'];
				$cont = "SELECT * FROM users where company_name = '$cl' ";
				$con_query = mysqli_query($con,$cont);
				if($con_query){
				$data = mysqli_fetch_array($con_query);
				echo $data['c_contact'];?><br>
				<?php
				echo $data['momo'];?><br>
				<?php
				echo $data['m_name'];
			}
				?>
			</div>	
		</div>
	</main>

</body>
</html>