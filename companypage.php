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
	<title>Company Dash board</title>
	<link rel="stylesheet" type="text/css" href="c_page.css">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
<p id="greeting"> </p>

	<script type="text/javascript">
		var today = new Date();
		let hour = today.getHours();
		
		let paragraph = document.getElementById("greeting");
		console.log(hour);
		if(hour <= 11 ){
			greeting="Good Morning";
		}
		if (hour <=17){
			greeting="Good Afternoon";
		}
		else if (hour >= 18){
			greeting="Good Evening";
		}
		else{greeting = "Hello";}

		paragraph.innerHTML = greeting;
	</script>
	<input type="checkbox" id="nav-toggle" >
	<div class="sidebar">
		<div class="sidebar-brand">
			<h2><span class=""><img src="trash.png"></span><span>The Refuse Remedy</span></h2>
		</div>
		<div class="sidebar-menu">
			<ul>

				<li><a href="" class="active"><span class="las la-bars"></span><span>Home</span></a></li>
				<li><a href="customers.php"><span class="las la-users"></span><span>Customers</span></a></li>
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
				

			</div>
			<div class="user-wrapper">
				<p id="greeting"> </p>
			</div>
			<a href="c_profile.php" style="text-decoration: none; color: black;">
			<div class="user-wrapper">
				<img src="user.png" width="30px" height="30px" alt="">
				<div>
					<h4><?php echo($_SESSION['username'])?></h4>
					<small><?php echo($_SESSION['company_name'])?></small>
				</div>

				
			</div>
		</a>
	</header>

	<main>

		<div class="cards">
			<a href="customers.php" style="text-decoration: none; color: black;">
			<div class="card-single">
				<div>
					<h1><?php
					$comp1 = $_SESSION['company_name'];
					$query1 = "SELECT * FROM users where client_company = '$comp1'  ";
		$result1 = mysqli_query($con,$query1);
					$n_rows1 = mysqli_num_rows($result1);
					echo $n_rows1;
					?></h1>
					<span><?php
					if ($n_rows1 == 1) {
						echo "Customer";
					}
					else{
						echo "Customers";
					}
					?></span>
				
				<span class="las la-users"></span>
				<br>
				<br>
				<br>
				</div>
			</div>
		</a>
		<a href="appointments.php" style="text-decoration: none; color: black;">
			<div class="card-single">
				<div>
					<h1><?php
					$comp2 = $_SESSION['company_name'];
					$query2 = "SELECT * FROM requests where company_requested = '$comp2' AND status = 'pending' ";
					$result2 = mysqli_query($con,$query2);
					$n_rows2 = mysqli_num_rows($result2);
					echo $n_rows2;
					?></h1>
					<span><?php
					if ($n_rows2 == 1) {
						echo "Appointment";
					}
					else{
						echo "Appointments";
					}
					?></span>
				<span class="las la-handshake"></span>
				</div>
			</div>
		</a>
		<a href="awaiting_pickup.php" style="text-decoration: none; color: black;">
			<div class="card-single">
				<div>
					<h1><?php
					$comp3 = $_SESSION['company_name'];
					$query3 = "SELECT * FROM requests where company_requested = '$comp3' AND status = 'accepted' ";
					$result3 = mysqli_query($con,$query3);
					$n_rows3 = mysqli_num_rows($result3);
					echo $n_rows3;
					?></h1>
					<span>Awaiting</span>
				
				<span class="las la-hourglass-half"></span>
				</div>
			</div>
		</a>
		<a href="reports.php" style="text-decoration: none; color: black;">
			<div class="card-single">
				<div>
					<h1><?php
					$comp3 = $_SESSION['company_name'];
					$query3 = "SELECT * FROM requests where company_requested = '$comp3' AND status = 'completed' ";
					$result3 = mysqli_query($con,$query3);
					$n_rows3 = mysqli_num_rows($result3);
					echo $n_rows3;
					?></h1>
					<span>Complete</span>
				
				<span class="lar la-check-circle"></span>
				</div>
			</div>
		</a>
		</div>
		<?php
		$comp = $_SESSION['company_name'];
		$query = "SELECT * FROM requests where company_requested = '$comp' AND status = 'pending' ";
		$result = mysqli_query($con,$query);
		if($result){
			if($result && mysqli_num_rows($result) > 0){	
		?>
		<br>
		<a href="appointments.php" style="text-decoration: none; color: black;">
		
		 	<div class="recent-grid">
			<div class="projects">
				<div class="card">
					<div class="card-header">
						<h2>Pending Requests</h2>
					</div>
					<div class="card-body">

					<div class="table-responsive">
									<table width="100%">
							<thead>
								<tr>
									<td>Customer ID</td>
									<td>Request ID</td>
									<td>Location</td>
									<td>Time Requested</td>
								</tr>
							</thead>
							<tbody>
															<?php 
		while ($used_data = mysqli_fetch_array($result)){


		 ?>
								<tr>
									<td><?php 
				echo $used_data['id_of_requester'];
				 ?></td>
									<td><?php
				echo $used_data['request_id'];
				?></td>
									<td><?php 
				echo $used_data['location'];
				 ?></td>
									<td><?php
				echo $used_data['time_requested'];
				?></td>
								</tr>
								<?php } } }  ?>
							</tbody>
						</table>
					</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	</div>
</a>
	

	</body>
</html>