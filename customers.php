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
	<title>Company Customers</title>
	<link rel="stylesheet" type="text/css" href="recent.css">
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


				<li><a href="companypage.php" ><span class="las la-bars"></span><span>Home</span></a></li>
				<li><a href="customers.php" class="active"><span class="las la-users"></span><span>Customers</span></a></li>
				<li><a href="appointments.php"><span class="las la-handshake"></span><span>Appointments</span></a></li>
				<li><a href="awaiting_pickup.php"><span class="las la-hourglass-half"></span><span>Awaiting Pickup</span></a></li>
				<li><a href="reports.php"><span class="lar la-check-circle"></span><span>Complete</span></a></li>
				<li><a href="c_profile.php"><span class="las la-user-circle"></span><span>Account & Settings</span></a></li>
				<li><a href=""><span class="las la-money-bill"></span><span>Invoices</span></a></li>
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
					<small><?php echo($_SESSION['company_name'])?></small>
				</div>

				
			</div>
	</header>
	<main>
		<div class="cards11">
			<div class="card-single11">
		CUSTOMERS
	</div>
	</div>
		

		<?php
			$c = $_SESSION['company_name']; 
			$query = "SELECT * FROM users  where client_company = '$c' " ;
			$result = mysqli_query($con,$query);
			if($result){
			if($result && mysqli_num_rows($result) > 0){
				// the results of the query is stored in $result which is then stored in $user_data and accessed as an array for futher validation
				//$used_data = mysqli_fetch_array($result);
		
		
		?>
		
		<br>
		
		<?php 
		while ($used_data = mysqli_fetch_array($result)){


		 ?><div class="cards">
			<div class="card-single">
				<?php 
				echo $used_data['username'];
				 ?><br>
			</div>
			<div class="card-single">
				<?php
				echo $used_data['user_id'];
				?>
			</div>
			</div>
		<?php } } } ?>
		
		</div>
	</main>

</body>
</html>