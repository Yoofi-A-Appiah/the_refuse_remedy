<?php
function check_login($con){

		if (isset($_SESSION['user_id'])){

			$id = $_SESSION['id'];
			$query = "SELECT * from users where id = '$id' limit 1";
			$result = mysqli_query($con, $query);
			if($result && mysqli_num_rows($result) > 0){

				$user_data = mysqli_fetch_assoc($result);
				return $user_data;
			}

		}
		else{
		//redirect to login
		header("Location: index.html");
		die;}
	}
//function request ($con){
//	if (isset($_SESSION['user_id'])) {
//		$id = $_SESSION['user_id'];
//		$query = "SELECT * from requests where id_requested = 'id' limit 1";
//	}
//}
	function random_num($length)
	{
		$text = "";
		if($length < 5){
			$length =5;
		}
		$len = rand(4,$length);

		for ($i=0; $i < $len; $i++) { 
			# code...

			$text .= rand(0,9);
		}

		return $text;
	}
	
?>
