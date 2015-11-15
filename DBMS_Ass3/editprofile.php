<?php
session_start();
$name = $_SESSION['name'];
if($name){
	echo "<h2>Your Details : </h2>";
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("dbms");
	$query = mysql_query("SELECT * FROM users WHERE name = '$name'");
	$numrows = mysql_num_rows($query);
	if($numrows != 0){
		while($row = mysql_fetch_array($query)){
			$email = $row['email'];
			$mobile = $row['mobile'];
			$password = $row['password'];
			$address = $row['address'];
		}
	}
}
else{
	die("You must be logged in to view this page!!!");
}
?>
<html>
<link rel='stylesheet' href='style.css'>
	<table>
	<tr>
	<td>Name : </td><td><?php echo $name;?></td><td><input type='button' name='change_name' value='Change'></td>
	</tr>
	<tr>
	<td>Email : </td><td><?php echo $email;?></td><td><input type='button' name='change_email' value='Change'></td>
	</tr>
	<tr>
	<td>Mobile : </td><td><?php echo $mobile;?></td><td><input type='button' name='change_mobile' value='Change'></td>
	</tr>
	<tr>
	<td>Address : </td><td><?php echo $address;?></td><td><input type='button' name='change_addr' value='Change'></td>
	</tr>
	</table>
	<p><input type='button' value='Change Password' name='changepass' /></p>
</html>