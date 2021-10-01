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
	<title>User Pending</title>
	<link rel="stylesheet" type="text/css" href="recent.css">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body>
	<?php
		if(isset($_POST['Cancel'])){
			$request = $_POST['req1'];
			$q = "DELETE FROM requests where request_id = '$request' ";
			$r = mysqli_query($con,$q);
			if ($r) {
				echo " <script> alert('Your Have Deleted the Request ID : $request'); window.location.href = 'pending.php' </script>";
			}
			else{echo "Failed";}
		}?>
	<input type="checkbox" id="nav-toggle" >
	<div class="sidebar">
		<div class="sidebar-brand">
			<h2><span class=""><img src="trash.png"></span><span>The Refuse Remedy</span></h2>
		</div>
		<div class="sidebar-menu">
			<ul>

				<li><a href="mainpage.php"><span class="las la-bars"></span><span>Home</span></a></li>
				<li><a href="request.php"><span class="las la-map-marked-alt" ></span><span>Schedule A Pickup</span></a></li>
				<li><a href="pending.php" class="active"><span class="las la-hourglass-half"></span><span>Pending Pickups</span></a></li>
				<li><a href="history.php"><span class="las la-history"></span><span>History</span></a></li>
				<!--<li><a href="expenditure.php"><span class="las la-coins"></span><span>Expenditure</span></a></li>-->
				<li><a href="u_profile.php"><span class="las la-user-circle"></span><span>Account & Settings</span></a></li>
				<li><a href="u_payment.php"><span class="las la-money-bill"></span><span>Make Payment</span></a></li>
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
	<main><?php
				$of = $_SESSION['user_id'];
				$show = "SELECT * FROM requests WHERE id_of_requester = '$of' AND status = 'pending' ";
				$show_it = mysqli_query($con,$show);
				if($show_it){
				if ($show_it && mysqli_num_rows($show_it) > 0) {
					
				
			?>
		 	<div class="recent-grid">
			<div class="projects">
				<div class="card">
					<div class="card-header">
						<h2>Pending Pickups</h2>
					</div>
					<div class="card-body">

					<div class="table-responsive">
									<table width="100%">
							<thead>
								<tr>
								
									<td>Request ID</td>
									<td>Location</td>
									<td>Time Requested</td>
									<td>Cancel Request</td>
								</tr>
							</thead>

							<tbody>
															<?php 
		while ($used_data1 = mysqli_fetch_array($show_it)){


		 ?>
								<tr>
									<td><?php
				echo $used_data1['request_id'];
				?></td>
									<td><?php 
				echo $used_data1['location'];
				 ?></td>
									<td><?php
				echo $used_data1['time_requested'];
				?></td>
				<td><form method="post">
					<input type="hidden" name="req1" value="<?php echo $used_data1['request_id'];?>">
					<input type="submit" name="Cancel" value="Cancel Request" >
				</form>
				</td>
								</tr>
								<?php } }else{ ?> <div class="nothing"><?php echo "No Pending Pickup";?></div><?php } }  ?>
							</tbody>
						</table>
					</div>
					</div>
				</div>
			</div>
		</div>
		<?php
				$of1 = $_SESSION['user_id'];
				$show1 = "SELECT * FROM requests WHERE id_of_requester = '$of' AND status = 'accepted' ";
				$show_it1 = mysqli_query($con,$show1);
				if($show_it1){
				if ($show_it1 && mysqli_num_rows($show_it1) > 0) {
					
				
			?>

		<div class="recent-grid">
			<div class="projects">
				<div class="card">
					<div class="card-header">
						<h2> Awaiting Pickup</h2>
					</div>
					<div class="card-body">

					<div class="table-responsive">
									<table width="100%">
							<thead>
								<tr>
								
									<td>Request ID</td>
									<td>Location</td>
									<td>Time Requested</td>
									<td>Cancel Request</td>
								</tr>
							</thead>

							<tbody>
															<?php 
		while ($used_data1 = mysqli_fetch_array($show_it1)){


		 ?>
								<tr>
									<td><?php
				echo $used_data1['request_id'];
				?></td>
									<td><?php 
				echo $used_data1['location'];
				 ?></td>
									<td><?php
				echo $used_data1['time_requested'];
				?></td>
				<td><form method="post">
					<input type="hidden" name="req1" value="<?php echo $used_data1['request_id'];?>">
					<input type="submit" name="Cancel" value="Cancel Request" >
				</form>
				</td>
								</tr>
								<?php } }else{ ?> <div class="nothing"><?php echo "No Awaiting Pickup";?></div><?php } }  ?>
							</tbody>
						</table>
					</div>
					</div>
				</div>
			</div>
		</div>

		</div>
		
	</main>
</body>
</html>