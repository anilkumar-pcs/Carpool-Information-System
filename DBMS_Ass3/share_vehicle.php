<?php
error_reporting(0);
session_start();
$name = $_SESSION['name'];
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("dbms");
	$query1 = mysql_query("SELECT user_id FROM users WHERE name = '$name'");
	while($row = mysql_fetch_array($query1)){
		$user_id = $row['user_id'];
	}	
	if(isset($_POST['submit'])){
		if($_POST['submit']){
			$start = $_POST['start'];
			$dest = $_POST['dest'];
			$date = $_POST['type'];
			$veh_pref = $_POST['pref'];
			$veh_id = $_POST['veh_type'];
			$cost = $_POST['cost'];
			if(!isset($_POST['type'])){
				$day = $_POST['day'];
				$month = $_POST['month'];
				$year = $_POST['year'];
				
				$date = $day."-".$month."-".$year;
			}
			if($start && $dest && $date && $veh_pref && $veh_id && $cost){
			
					$query3 = mysql_query("
					INSERT INTO sharing VALUES('$user_id','','$start','$dest','$date','$veh_pref','$veh_id','$cost')
					");
					echo "Your request has been registered.<br>
						  Create another <a href='share_vehicle.php'>Request</a><br>
						  Return to <a href='home.php' >Home</a>.";
			}
			else{
				echo "Please fill in <b>ALL FIELDS</b>.";
			}
		}
	}
?>
<html>
<link rel='stylesheet' href='style.css'>
<h2>Share a Vehicle Here : </h2>
<p>Return to <a href='home.php'>Home</a>.</p>
<form action='share_vehicle.php' method='POST'>
<table>
<tr>
<td>Starting Point : </td>
<td>
<select name="start" id="select">
<option value="city1">City1</option>
<option value="city2">City2</option>
<option value="city3">City3</option>
<option value="city4">City4</option>
<option value="city5">City5</option>
</select>
</td>
</tr>
<tr>
<td>Destination Point : </td>
<td>
<select name="dest" id="select">
<option value="city1">City1</option>
<option value="city2">City2</option>
<option value="city3">City3</option>
<option value="city4">City4</option>
<option value="city5">City5</option>
</select>
</td>
</tr>
<tr><td>Time of travel : </td></tr>
<tr>
<td><input type="checkbox" name="type" value="daily">Daily<span style="float:right"><b>OR</b></span></td>
<td> 
<select name="day" id="select" style="width:50px">
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
</select>
<select name="month" id="select" style="width:60px">
<option value="01">Jan</option>
<option value="02">Feb</option>
<option value="03">Mar</option>
<option value="04">Apr</option>
<option value="05">May</option>
</select>
<select name="year" id="select" style="width:60px">
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
</select>
</td>
</tr>
<tr><td>Vehicle Preference : </td></tr>
<tr>
<td><input type="radio" name="pref" value="owner">Owner</td>
<td><input type="radio" name="pref" value="hire">Hire</td>
</tr>
<tr>
<td>Vehicle Type : </td>
<td>
<select name="veh_type" id="select">
<?php
	$query4 = mysql_query("SELECT veh_id,vtype FROM vehicle1 WHERE user_id = '$user_id'");
	while($row2 = mysql_fetch_array($query4)){
		echo "<option value=".$row2['veh_id']."> ".$row2['vtype']." </option>";
	}
?>
</select>
</td>
</tr>
<tr>
<td>Fare / Cost : </td>
<td><input type='text' name='cost' autocomplete='off'></td>
</tr>
</table>
<p><input type='submit' name='submit' value='Submit' id='submit'></p>
</form>
</html>