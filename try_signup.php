<?php 
include ('db_connect.php');
include ('functions.php');
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image" href="trash.png">
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="so.css">

	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<style type="text/css">
		.error{color: red;}
	</style>
</head>
<body>
	<?php
$usernameErr = $emailErr = $passwordErr = $usertypeErr = $addressErr = $contactErr = $c_nameErr = $c_contactErr = $networkErr = $momoErr = $nameErr = $paymentErr = "";
$username = $email = $password = $usertype = $address = $c_name = $c_contact = $network = $momo = $name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["username"])) {
    $usernameErr = "Name is required";
  } else {
    $username = test_input($_POST["username"]);
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }
    
  if (empty($_POST["password"])) {
    $passwordErr = "Password Field is Empty";
  } else {
    $password = test_input($_POST["password"]);
    $password = md5($password);
  }
  if (empty($_POST["address"])) {
    $addressErr = "You did not input an address";
  } else {
    $address  = test_input($_POST["address"]);
  }
  if (empty($_POST["c_name"])) {
	    $c_nameErr = "You did not input Your Company Name";
	  } else {
	    $c_name  = test_input($_POST["c_name"]);
	  }
	 if (empty($_POST["c_contact"])) {
	    $c_contactErr = "You did not input Your contact";
	  } else {
	    $c_contact  = test_input($_POST["c_contact"]);
	  }
	   if (empty($_POST["network"])) {
	    $networkErr = "You did not select network";
	  } else {
	    $network  = test_input($_POST["network"]);
	  }
	   if (empty($_POST["momo"])) {
	    $momoErr = "You did not input Your Momo";
	  } else {
	    $momo  = test_input($_POST["momo"]);
	  }
	  if (empty($_POST["name"])) {
	    $nameErr = "You did not input Your Momo name";
	  } else {
	    $name  = test_input($_POST["name"]);
	  }
  $user_type = "Company";
 	if(!empty($username) && !empty($email) && !empty($address) && $password !=='d41d8cd98f00b204e9800998ecf8427e' && !empty($momo)){
 		$query = "SELECT * from users where username = '$username' limit 1";
 		$equery = "SELECT * FROM users where email = '$email' limit 1";
 		$result = mysqli_query($con, $query);
 		$eresult = mysqli_query($con,$equery);
 		if($result && mysqli_num_rows($result) > 0){
				echo "That username already exists";
			}
		elseif ($eresult && mysqli_num_rows($eresult) > 0){
			echo "Email has been used to register already";
		}	
			else{
 				$user_id = uniqid('COM-');
 			$query = "INSERT INTO users (username,email,password,user_id,user_type,address,company_name,c_contact,network,momo,m_name) VALUES ('$username','$email','$password','$user_id','$user_type','$address','$c_name','$c_contact','$network','$momo','$name')";
 			$result = mysqli_query($con,$query);
 	if($result){
 		header('Location:login.php');
 	}	
 			}
 	}
 
 	else{ echo "Empty fields";}

 }
 function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 
		?>
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

		
			<div class="step-row">
			<div id="progress"></div>
			<div class="step-col"><small>Step 1</small></div>
			<div class="step-col"><small>Step 2</small></div>
	</div>	
	<div class="container">
	<form  method="post" id="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<h1 id="up">Create Company Account</h1><br>
		<label class="word">Username</label><span class="las la-id-badge"></span><span class="error">* <?php echo $usernameErr;?></span>
		<input class="text" type="text" name="username" placeholder="Enter User Name" autofocus><br><br>
		<label class="word">E-mail </label><span class="las la-envelope"></span><span class="error">* <?php echo $emailErr;?></span>
		<input class="text" type="text" name="email" placeholder="Enter email"><br><br>
		<label class="word">Password</label><span class="las la-lock"></span><span class="error">* <?php echo $passwordErr;?></span>
		<input class="text" type="password" name="password" placeholder="Enter password"><br><br>
		<label for="u" class="word">Digital Address</label><span class="las la-map-marker-alt"></span><span class="error">* <?php echo $addressErr;?></span>
		<input type="text" class="text" name="address" id="u" placeholder="Enter your digital address"><br><br>
		<label class="word">Contact</label><span class="las la-phone"></span><span class="error">* <?php echo $c_contactErr;?></span>
		<input type="number" class="text" name="c_contact" placeholder="Enter phone number">
		<label class="word">Company Name</label><span class="error">* <?php echo $c_nameErr;?></span>
		<input type="text" name="c_name" class="text" placeholder="Enter company name">
		<div class="btn-box">
		<button type="button" id="Next1">Next</button>
		</div>
		<br>
		<br>
		<h1 id="up">ADD</h1>
		<h2 id="up">PAYMENT METHOD</h2><br>
		<label class="word">Select Network</label><span class="las la-server"></span><span class="error">* <?php echo $networkErr;?></span> <br>
		<select name="network">
			<option disabled selected>Select Mobile Money Provider</option>
			<option>MTN</option>
			<option>Vodaphone</option>
			<option>AirtelTigo</option>
			<option>Other</option>
		</select><br><br>
		<label class="word">Number </label><span class="las la-phone-alt"></span><br><span class="error">* <?php echo $momoErr;?></span>
		<input class="text" type="number" name="momo" placeholder="Enter Momo Number"><br><br>
		<label class="word">Name</label><span class="las la-user"></span><br><span class="error">* <?php echo $nameErr;?></span>
		<input class="text" type="text" name="name" placeholder="Enter Name that will be displayed"><br><br>
		<br>
		<div class="btn-box">
				<button type="button" id="Back1">Back</button>
				<button type="button" onclick= javascript:sender()>Create </button>
			</div>
		</form>
		</div>
		
		
</div>
</section>

</script>
<!--
	<div class="container">
		<form method="post" id="form1">
			<h3>Create</h3>
			<input type="text" name="username" placeholder = "Username" required><br>
			<input type="text" name="email" placeholder="Email" required><br>
			<input type="password" name="password" placeholder="Password" required>
			<input type="text" name="c_name" placeholder="Password" required>
			<div class="btn-box">
				<button type="button" id="Next1">Next</button>
			</div>
		</form>
		<form method="post" id="form2">
			<h3>Payment Method</h3>
			Selcet Network
			<select name="network">
				<option>MTN</option>
				<option>Voda</option>
				<option>Tigo</option>
			</select>
			<input type="number" name="momo" placeholder="Momo Number Here" ><br>
			<input type="text" name="name" placeholder="name to refer" >

			<div class="btn-box">
				<button type="button" id="Back1">Back</button>
				<button type="submit" name="submit">Submit</button>
			</div>
		</form>
		<div class="step-row">
			<div id="progress"></div>
			<div class="step-col"><small>Step 1</small></div>
			<div class="step-col"><small>Step 2</small></div>
		</div>
	</div>-->
	<script type="text/javascript">
		var Form1 = document.getElementById("form1");
		var Form2 = document.getElementById("form2");

		var Next1 = document.getElementById('Next1');
		var Back1 = document.getElementById('Back1');


		var progress = document.getElementById('progress');
		Next1.onclick = function(){
			//document.getElementById('change').style.display = 'none';
			//document.getElementById('change1').style.display = 'block';
			form1.style.top = "-680px";
			
			progress.style.width = "360px";
		}
		Back1.onclick = function(){
			//document.getElementById('change').style.display = 'block';
			//document.getElementById('change1').style.display = 'none';
			form1.style.top = "50px";
			
			progress.style.width = "180px";
		}
	</script>

</body>
</html>