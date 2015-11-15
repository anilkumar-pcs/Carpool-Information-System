<html>
<link rel='stylesheet' href='style.css' >
<h1>CARPOOL INFORMATION SYSTEM</h1>
<?php
error_reporting(0);
session_start();

if($_SESSION['name']){
	$name = $_SESSION['name'];
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("dbms");
	$query = mysql_query("SELECT COUNT(share_id) AS count FROM sharing WHERE user_id IN (SELECT user_id FROM users WHERE name = '$name')");
	$data=mysql_fetch_assoc($query);
	$query1 = mysql_query("SELECT COUNT(reciever_name) AS msg_count FROM message WHERE reciever_name = '$name'");
	$msg_count=mysql_fetch_assoc($query1);
	$query2 = mysql_query("select sum(rows) as veh_count from ( select count(user_id) as rows from vehicle1 WHERE user_id IN (SELECT user_id FROM users WHERE name = '$name') union all select count(user_id) as rows from vehicle2 WHERE user_id IN (SELECT user_id FROM users WHERE name = '$name')) as u");
	$veh_count=mysql_fetch_assoc($query2);
	//echo $data['count'];
	echo "<p>Welcome <b>$name</b></p>
		  <a href='settings/personal'>Settings</a><br>
		  <a href='myrequests.php'>My Requests (".$data['count'].")</a><br>
		  <a href='myvehicles.php'>My Vehicles (".$veh_count['veh_count'].")</a><br>
		  <a href='mymessages.php'>My Messages (".$msg_count['msg_count'].")</a><br>
		  <a href='logout.php' >Logout</a><br>
		  ";
}
else{
	echo "You are not logged in. <a href='login.php' >Login</a> Here.";
}

?>
<h2>Available Facilities : </h2>
<p><a href='user_reg.php' >User Registration</a></p>
<p><a href='vehicle_reg.php' >Register Vehicle</a></p>
<p><a href='share_vehicle.php' >Share Your Vehicle</a></p>
<p><a href='req_vehicle.php' >Request a Shared Vehicle (Sends Open Message to all Users).</a></p>
<p><a href='find_vehicle.php' >Find Shared Vehicle</a></p>
<p><a href='search_req.php' >Search for Requester</a></p>
</html>