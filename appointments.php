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
	<title>Company Appointments</title>
	<link rel="stylesheet" type="text/css" href="recent2.css">
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
				<li><a href="customers.php"><span class="las la-users"></span><span>Customers</span></a></li>
				<li><a href="appointments.php" class="active"><span class="las la-handshake"></span><span>Appointments</span></a></li>
				<li><a href="awaiting_pickup.php"><span class="las la-hourglass-half"></span><span>Awaiting Pickup</span></a></li>
				<li><a href="reports.php"><span class="lar la-check-circle"></span><span>Complete</span></a></li>
				<li><a href="c_profile.php" ><span class="las la-user-circle"></span><span>Account & Settings</span></a></li>
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
	<?php
		if(isset($_POST['accept'])){
			$request = $_POST['req'];
			$q = "UPDATE requests SET status = 'accepted' where request_id = '$request' ";
			$r = mysqli_query($con,$q);
			if ($r) {
				echo " <script> alert('Your Have Accepted the Request ID : $request'); window.location.href = 'companypage.php' </script>";
			}
			else{echo "Failed";}
			//$q = "SELECT * FROM requests where request_id = '$request'";
			//$r = mysqli_query($con,$q);
			//$okay = mysqli_fetch_array($r);
			//$id_req = $okay['id_of_requester'];
			//$req_id = $okay['request_id'];
			//$l = $okay['location'];
			//$ti = $okay['time_requested'];

			//$accept = "INSERT INTO accepted (id_of_requester,request_id,location,date_created) VALUES ('$id_req','$req_id','$l','$ti')";
			//$accept_q = mysqli_query($con,$accept);
			//if ($accept_q) {
			//	echo " <script> alert('Your Request Has Been Submitted'); window.location.href = 'companypage.php' </script>";
				
				//header('Location: done.html');
		//	}

		}

	?>
	<main>
		<?php
		$comp = $_SESSION['company_name'];
		$query = "SELECT * FROM requests where company_requested = '$comp' AND status = 'pending' ";
		$result = mysqli_query($con,$query);
		if($result){
			if($result && mysqli_num_rows($result) > 0){	
		?>
		<br>
		
		
		 	<div class="recent-grid">
			<div class="projects">
				<div class="card">
					<div class="card-header">
						<h2>Open Requests</h2>
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
									<td>Accept</td>
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
				<td><form method="post">
					<input type="hidden" name="req" value="<?php echo $used_data['request_id'];?>">
					<input type="submit" name="accept" value="Accept Request" >
				</form>
				</td>
								</tr>
								<?php } } else{echo "No Open Appointments";}} ?>
							</tbody>
						</table>
					</div>
					</div>
				</div>
			</div>
		</div>
	</main>

</body>
</html>