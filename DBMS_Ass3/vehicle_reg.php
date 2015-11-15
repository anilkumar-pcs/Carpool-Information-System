<?php
session_start();
$name = $_SESSION['name'];
	
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("dbms");
	$query1 = mysql_query("SELECT user_id FROM users WHERE name = '$name'");
	while($row = mysql_fetch_array($query1)){
		$user_id = $row['user_id'];
	}
	
	if(isset($_POST['submit1'])){
		if($_POST['submit1']){
			$vtype = $_POST['vtype'];
			$vmodel = $_POST['vmodel'];
			$year = $_POST['year'];
			$dtype = $_POST['dtype'];
			$seat_cap = $_POST['seat_cap'];
			$dname = $_POST['dname'];
			$licenseno = $_POST['licenseno'];
			$licensedate = $_POST['licensedate'];
			if($vtype && $vmodel && $year && $dtype && $seat_cap && $dname && $licenseno && $licensedate){
				$query2 = mysql_query("
					INSERT INTO vehicle1 VALUES('','$user_id','$vtype','$vmodel','$year','$dtype','$seat_cap','$dname','$licenseno','$licensedate')
					");
					
				echo "Vehicle Registered.Return to <a href='home.php' >Home</a>.";
			}
			else{
				echo "Please fill in <b>ALL FIELDS</b>.";
			}
		}
	}
	if(isset($_POST['submit2'])){
		if($_POST['submit2']){
			$tname = $_POST['tname'];
			$cost = $_POST['cost'];
			$address = $_POST['address'];
			$passengers = $_POST['passengers'];
			if($tname && $cost && $address && $passengers){
				$query3 = mysql_query("
				INSERT INTO vehicle2 VALUES('','$user_id','$tname','$address','$cost','$passengers')
				");
				echo "Vehicle Registered.Return to <a href='home.php' >Home</a>.";
			}
			else{
				echo "Please fill in <b>ALL FIELDS</b>.";
			}
		}
	}
?>

<html>
<link rel='stylesheet' href='style.css'>
<script type='text/javascript' src='jQuery.js' ></script>
<script>
$(document).ready(function(){
	$("#own").click(function(){
	// load own page on click
		$("#content").load("own_vehicle.html");
	});
	$("#travel").click(function(){
	// load own page on click
		$("#content").load("travel_vehicle.html");
	});
});
</script>
<h1>Register Your Vehicle</h1>
<p>Return to <a href='home.php'>Home</a></p>
<a href='#' id='own'>Register your Own Vehicle</a><br>
<div id='content'></div>
</html>