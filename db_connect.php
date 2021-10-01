<?php
$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "trr";

$con = mysqli_connect($hostname,$username,$password,$db_name);
if(!$con){
	echo "Failed to connect";
}
?>