<?php 
session_start();
include('functions.php');
include('db_connect.php');
$user_data=check_login($con);
$a = $user_data['address'];
//$array = array.filter($array,function($a){ return trim($a) !== "";});

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image" href="trash.png">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
	<title>Make A Request</title>
	<link rel="stylesheet" type="text/css" href="req.css">
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
				<li><a href="request.php" class="active"><span class="las la-map-marked-alt" ></span><span>Schedule A Pickup</span></a></li>
				<li><a href="pending.php"><span class="las la-hourglass-half"></span><span>Pending Pickups</span></a></li>
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

	<?php
		if(isset($_POST['submit'])){
			$pLocation = addslashes($_POST['location']);
			$pLocation = mysqli_real_escape_string($con,$pLocation);
			$sCompany = $_SESSION['client_company'];
			$C_id = $_SESSION['user_id'];
			$u_id = 'R'.random_num(10);
			$req = 'pending';
			if ($location == "other") {
				$o_loc = addslashes($_POST('olocation'));
			$o_loc = mysqli_real_escape_string($con,$o_loc);
				$query = "INSERT INTO requests (id_of_requester,request_id,company_requested,location,status) VALUES ('$C_id','$u_id','$sCompany','$o_loc','$req')";
			$result = mysqli_query($con,$query);
			if ($result) {
				echo " <script> alert('Your Request Has Been Submitted'); window.location.href = 'mainpage.php' </script>";
				
				//header('Location: done.html');
			}
			}
			else {
				$query = "INSERT INTO requests (id_of_requester,request_id,company_requested,location,status) VALUES ('$C_id','$u_id','$sCompany','$pLocation','$req')";
				$result = mysqli_query($con,$query);
			if ($result) {
				echo " <script> alert('Your Request Has Been Submitted'); window.location.href = 'mainpage.php' </script>";
				//header('Location: done.html');
			}
			}
		}
	?>
<script type="text/javascript">
	window.onload = function(){
		document.getElementById('e_loc').style.display = 'none';
	}
	function show(){
		if(document.getElementById("o_loc").checked) {
			document.getElementById('e_loc').style.display = 'flex';
		}
		else if(document.getElementById("m_loc").checked){
			document.getElementById('e_loc').style.display = 'none';
		}
	}
</script>
	<main>
		<div class="cards">

			<div class="card-single">
				<h1>Make Request</h1>
<form method="post">
	<div class="no">
	<label class="n">Pickup Location:</label><small>(Tick one)</small><br>
	<input class="i" type="radio" id="m_loc" name="location" value="<?php echo $user_data['address']; ?>"><label class="o">My Location</label><br>
	<input class="i" type="radio" id="o_loc" name="location" value="other" onclick="javascript:show();"><label class="o">Other Location</label><br><br>
	<input class="o_lo" type="text" name="oLocation" id="e_loc" style="display: none" placeholder="Enter Digital Address of Location New Location">
</div>
	<input type="hidden" name="u_id" value="<?php echo $user_data['id'];?>">
	<input type="submit" name="submit" class="sub" value="Request">
</form>
</div>
</div>
</main>
</body>
</html>

<?php //$a = $user_data['address']; $arr = array_filter($arr,function($a){ return $a !== "";} );?>