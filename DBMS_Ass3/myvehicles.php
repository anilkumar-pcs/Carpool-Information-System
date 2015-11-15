<html>
<link rel = 'stylesheet' href = 'style.css'>
<script type='text/javascript' src='jQuery.js' ></script>
<?php
error_reporting(0);
session_start();
$name = $_SESSION['name'];

echo "Return to <a href='home.php'>Home</a>.<br>
	  <a href='vehicle_reg.php'>Register</a> New Vehicle. <br>";

$conn = mysql_connect("localhost","root","");
mysql_select_db("dbms");

	$query1 = mysql_query("SELECT * FROM vehicle1 WHERE user_id IN (SELECT user_id FROM users WHERE name = '$name')");
	$numrows = mysql_num_rows($query1);
	if($numrows != 0){
		echo "<p>You have ".$numrows." Vehicles Registered.</p>";
	?>
	<div id="messages" style="width: auto;max-width: 540px;">
	<?php
		while($row = mysql_fetch_array($query1)){
			$veh_id = $row['veh_id'];
			$vtype = $row['vtype'];
			$vmodel = $row['vmodel'];
			$year = $row['year'];
			$seat_cap = $row['seat_cap'];
			$dname = $row['dname'];
			$licenseno = $row['licenseno'];
			$licensedate = $row['licensedate'];
			
			echo "
			<div id='msg_box' >
			<table style='text-align:center'>
			<tr>
			<td>Vehicle Type : </td><td>".$vtype."</td><td>Manufacture Year : </td><td>".$year."</td>
			</tr>
			<tr>
			<td>Seating Capacity : </td><td>".$seat_cap."</td><td>Driver Name : </td><td>".$dname."</td>
			</tr>
			<tr>
			<td>License No : </td><td>".$licenseno."</td><td>License Date : </td><td>".$licensedate."</td>
			</tr>
			</table>
			<a href='delete_veh.php?id=".$veh_id."'>[ Delete ]</a>
			</div>
			";
		}	
	}
	else{
		echo "<p>You do not have any Vehicles registered.</p>";
	}
	
?>
</div>
</html>