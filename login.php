<!DOCTYPE html>
<?php 
session_start();
include('functions.php');
include('db_connect.php')
?>
<html>
<head>
	<link rel="shortcut icon" type="image" href="trash.png">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="s.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
	<style type="text/css">
		.error {color: #FF0000;}
	</style>

</head>
<body>
	<?php
// define variables and set to empty values
$usernameErr = $emailErr = $passwordErr = $usertypeErr = "";
$username = $email = $password = $usertype = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
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
  if (empty($_POST["user_type"])) {
    $usertypeErr = "You did not select Account Type";
  } else {
    $usertype  = test_input($_POST["user_type"]);
  }
  if(!empty($username) && !empty($email) && $password !=='d41d8cd98f00b204e9800998ecf8427e'){
 		$query = "SELECT * from users where username = '$username' limit 1";
		$result = mysqli_query($con, $query);
		if($result){
			if($result && mysqli_num_rows($result) > 0){
				// the results of the query is stored in $result which is then stored in $user_data and accessed as an array for futher validation
				$user_data = mysqli_fetch_assoc($result);
				//validation of credentials begin
				if ($user_data['password'] === $password && $user_data['email'] === $email && $user_data['user_type'] === $usertype){
					$_SESSION['username'] = $user_data['username'];
					$_SESSION['user_id'] = $user_data['user_id'];
					$_SESSION['address'] = $user_data['address'];
					$_SESSION['id'] = $user_data['id'];
					$_SESSION['email'] = $user_data['email'];
					if ($usertype === 'Client') {
						$_SESSION['client_company'] = $user_data['client_company'];
						$_SESSION['c_contact'] = $user_data['c_contact'];
						
						header("Location: mainpage.php?ID = {$row['id']}");
					}
					elseif ($usertype === 'Company') {
						
						$_SESSION['network'] = $user_data['network'];
						$_SESSION['momo'] = $user_data['momo'];
						$_SESSION['name'] = $user_data['m_name'];

						$_SESSION['contact'] = $user_data['contact'];
						$_SESSION['company_name'] = $user_data['company_name'];
					header("Location: companypage.php?ID = {$row['id']}");	
					}
					
							die;
				}else{echo "wrong credentials";}
			}
}}}

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
				
					<li><a href="login.php" class="active"><div  class="las la-sign-in-alt"></div></div>Login</a></li>
					<li><a href="to_signup.php"><div  class="las la-user-plus"></div> Sign Up</a></li>
					<li><a href="contact_us.php"><div class="las la-sms"></div>About Us</a></li>
				</ul>
			</header>
			<img src="garbage2.png">
	<div class="form">
	<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<h1>LOGIN</h1><br>
		<label class="word">Username</label><span class="las la-id-badge"></span><span class="error">* <?php echo $usernameErr;?></span>
		<input class="text" type="text" name="username" placeholder="Enter User Name" autofocus><br><br>
		<label class="word">E-mail </label><span class="las la-envelope"></span><span class="error">* <?php echo $emailErr;?></span>
		<input class="text" type="text" name="email" placeholder="Enter email"><br><br>
		<label class="word">Password</label><span class="las la-lock"></span><span class="error">* <?php echo $passwordErr;?></span>
		<input class="text" type="password" name="password" placeholder="Enter password"><br><br>
		<p class="word">Select Account Type Below:</p><span class="error"> <?php echo $usertypeErr;?></span><br>
		<label for="user" class="word">Client</label>
		<input type="radio" name="user_type" id="user" value="Client" ><br>
		<label for="use" class="word">Waste Company</label>
		<input type="radio" name="user_type" id="use" value="Company"><br><br>
		<input class="text-submit" type="submit" name="submit" value="LOGIN">
	</form>
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
</div>
</body>
</html>