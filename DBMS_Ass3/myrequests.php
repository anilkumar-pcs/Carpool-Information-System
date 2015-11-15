<html>
<link rel = 'stylesheet' href = 'style.css'>
<script type='text/javascript' src='jQuery.js' ></script>
<?php
echo "Return to <a href='home.php'>Home</a>.<br>";
session_start();
$name = $_SESSION['name'];
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("dbms");
	$query1 = mysql_query("SELECT user_id FROM users WHERE name = '$name'");
	while($row = mysql_fetch_array($query1)){
		$user_id = $row['user_id'];
	}
	$query2 = mysql_query("SELECT * FROM sharing WHERE user_id = '$user_id'");
	$numrows = mysql_num_rows($query2);
	if($numrows != 0){
		echo "<b>Total Requests : ".$numrows."</b><br><br>";
		$i = 0;
			while($row1 = mysql_fetch_array($query2)){
				echo "
				Request ".($i+1)."
				<span style='color: red;margin-left: 20px;'><a href='delete_req.php?req_id=".($i+1)."'>[ Delete ]</a></span><br>
				<table id='myrequests'>
				<tr id='myrequests_head'>
				<td>Starting Point</td><td>Destination Point</td><td>Date</td><td>Vehicle Type</td><td>Vehicle Preference</td><td>Cost</td>
				</tr>
				<tr id='myrequests_body'>
				<td>".$row1['start']."</td><td>".$row1['dest']."</td><td>".$row1['date']."</td><td>".$row1['veh_id']."</td><td>".$row1['veh_pref']."</td><td>".$row1['cost']."</td>
				</tr>
				</table>
				";
				$i++;
			}
	}
	else{
		echo "You do not have any Requests.";
	}
?>
</html>