<?php 
include ('db_connect.php');
include ('functions.php');
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image" href="trash.png">
	<link rel="stylesheet" type="text/css" href="s.css">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<title>Sign Up</title>
	<style type="text/css">
		.error{
			color: red;
		}
	</style>
</head>
<body>
<?php
$usernameErr = $emailErr = $passwordErr = $usertypeErr = $addressErr = $sCompanyErr = $contactErr = $c_nameErr = $c_contactErr = $networkErr = $momoErr = $nameErr = $paymentErr = "";
$username = $email = $password = $usertype = $address = $sCompany = $contact = $c_name = $c_contact = $network = $momo = $name = "";

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
  if (empty($_POST["contact"])) {
			    $contactErr = "You did not input Your contact";
			  } else {
			    $contact  = test_input($_POST["contact"]);
			  }
			  if (empty($_POST["com"])) {
   			 $sCompanyErr = "You did not select Company";
  			} else {
    		$sCompany  = test_input($_POST["com"]);
  			}
  			$usertype = "Client";
  			
 	if(!empty($username) && !empty($email) && !empty($address) && $password !=='d41d8cd98f00b204e9800998ecf8427e' && !empty($contact)){
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
		

			 
  			 
 				$user_id = uniqid('CLI-',);
 	$query = "INSERT INTO users (username,email,password,user_id,user_type,address,c_contact,client_company) VALUES ('$username','$email','$password','$user_id','$usertype','$address','$contact','$sCompany')";
 	$result = mysqli_query($con,$query);
 	if($result){
 		header('Location: Login.php');


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
			
			<img id="change1" src="garb.png" style="display: none;">
			<img id="change2" src="garbage-truck.png" style="display: none;">
			<img id="change" src="garbage2.png" style="display: block;">
			
		<div class="form">
	<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<h1 id="up">Create User Account</h1><br>
		<label class="word">Username</label><span class="las la-id-badge"></span><span class="error">* <?php echo $usernameErr;?></span>
		<input class="text" type="text" name="username" placeholder="Enter User Name" autofocus><br><br>
		<label class="word">E-mail </label><span class="las la-envelope"></span><span class="error">* <?php echo $emailErr;?></span>
		<input class="text" type="text" name="email" placeholder="Enter email"><br><br>
		<label class="word">Password</label><span class="las la-lock"></span><span class="error">* <?php echo $passwordErr;?></span>
		<input class="text" type="password" name="password" placeholder="Enter password"><br><br>
		<label for="u" class="word">Digital Address</label><span class="las la-map-marker-alt"></span><span class="error">* <?php echo $addressErr;?></span>
		<input type="text" class="text" name="address" id="u" placeholder="Enter your digital address"><br><br>
		<label class="word">Contact</label><span class="las la-phone"></span><span class="error">* <?php echo $contactErr;?></span>
		<input type="number" class="text" name="contact" placeholder="Enter phone number">
		<br><br>
		<div >
			<label class="word">Select Waste Collection Service Provider</label>
			<select name="com"> 
		<option disabled selected>Select Waste Collection Service Provider</option>
		<?php 
			$records = mysqli_query($con,"SELECT company_name FROM users where company_name != '' ");

			while($data = mysqli_fetch_array($records)){
				echo "<option value=".$data['company_name'].">".$data['company_name']."</option>";
			}
		?>
	</select>
		</div><br><br>
		<input class="text-submit" type="submit" name="submit" value="SIGN UP"><br>
	</form>
</div>
<img id="img" src="online-payment.png" style="display: none; ">
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