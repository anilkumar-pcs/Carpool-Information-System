<html>
<link rel = 'stylesheet' href = 'style.css'>
<script type='text/javascript' src='jQuery.js' ></script>
<?php
error_reporting(0);
session_start();
$name = $_SESSION['name'];

$msg = $_GET['msg'];
echo "<span style='color:red'>".$msg."</span><br>";

echo "Return to <a href='home.php'>Home</a>.<br>";

$conn = mysql_connect("localhost","root","");
mysql_select_db("dbms");

$query = mysql_query("SELECT * FROM message WHERE reciever_name='$name' ORDER BY msg_id DESC");
$numrows = mysql_num_rows($query);
$i = 0;
	if($numrows != 0){
		echo "<p>You have ".$numrows." Messages.</p>";
	?>
	<div id='messages' style='width:470px'>
	<?php
		while($row = mysql_fetch_array($query)){
			//echo "<p>Message ".($i+1)."</p>";
			$status = $row['status'];
			
			$msg_id = $row['msg_id'];
			$sender_id = $row['sender_id'];
			$reciever_id = $row['reciever_id'];
			
			$query1 = mysql_query("SELECT name FROM users WHERE user_id = '$sender_id'");
			while($row1 = mysql_fetch_array($query1)){
				$from = $row1['name'];
			}
			
			$share_id = $row['share_id'];
			$req_id = $row['req_id'];
			
			if($req_id == 0){ // In case of normal message
				$query2 = mysql_query("SELECT * FROM sharing WHERE share_id='$share_id'");
				while($row2 = mysql_fetch_array($query2)){
					$start = $row2['start'];
					$dest = $row2['dest'];
					$date = $row2['date'];
				}
				if($status == 0){
					echo "
					<div id='msg_box'>
					<table style='text-align:center'>
					<tr>
					<td>From : </td><td>".$from."</td><td>Date : </td><td>".$date."</td>
					</tr>
					<tr>
					<td>Start : </td><td>".$start."</td><td>Destination : </td><td>".$dest."</td>
					</tr>
					</table>
					<b>He wants to share your vehicle.</b><br>
					<span><a href='send_msg.php?share_id=".$share_id."&&req_id=".$req_id."&&sender_id=".$reciever_id."&&reciever_id=".$sender_id."&&reciever_name=".$from."&&status=1'>Accept</a></span>
					<span style='margin-left:10px'><a href='send_msg.php?share_id=".$share_id."&&req_id=".$req_id."&&sender_id=".$reciever_id."&&reciever_id=".$sender_id."&&reciever_name=".$from."&&status=2'>Reject</a></span>
					</div>
					";
				}
				else if($status == 1){
					echo "
					<div id='msg_box'>
					<table style='text-align:center'>
					<tr>
					<td>From : </td><td>".$from."</td><td>Date : </td><td>".$date."</td>
					</tr>
					<tr>
					<td>Start : </td><td>".$start."</td><td>Destination : </td><td>".$dest."</td>
					</tr>
					</table>
					<b>He Accepted your Request.</b><br>
					<a href='delete_msg.php?msg_id=".$msg_id."'>[ Delete ]</a>
					</div>
					";
				}
				else{
					echo "
					<div id='msg_box'>
					<table style='text-align:center'>
					<tr>
					<td>From : </td><td>".$from."</td><td>Date : </td><td>".$date."</td>
					</tr>
					<tr>
					<td>Start : </td><td>".$start."</td><td>Destination : </td><td>".$dest."</td>
					</tr>
					</table>
					<b>He Rejected your Request.</b><br>
					<a href='delete_msg.php?msg_id=".$msg_id."'>[ Delete ]</a>
					</div>
					";
				}
			}
			else{//in case of Open message
			
				$query3 = mysql_query("SELECT * FROM request WHERE request_id = '$req_id'");
				while($row3 = mysql_fetch_array($query3)){
					$start = $row3['start'];
					$dest = $row3['dest'];
					$date = $row3['date'];
					$veh_type = $row3['veh_type'];
					$cost = $row3['cost'];
				}
				if($status == 0){
					echo "
					<div id='msg_box'>
					<table style='text-align:center'>
					<tr>
					<td>From : </td><td>".$from."</td><td>Date : </td><td>".$date."</td>
					</tr>
					<tr>
					<td>Start : </td><td>".$start."</td><td>Destination : </td><td>".$dest."</td>
					</tr>
					<tr>
					<td>Vehicle Type : </td><td>".$veh_type."</td><td>Max Affordable Cost : </td><td>".$cost."</td>
					</tr>
					</table>
					<b>An Open Message.</b><br>
					<span><a href='send_msg.php?share_id=".$share_id."&&req_id=".$req_id."&&sender_id=".$reciever_id."&&reciever_id=".$sender_id."&&reciever_name=".$from."&&status=1'>Accept</a></span>
					<span style='margin-left:10px'><a href='send_msg.php?share_id=".$share_id."&&req_id=".$req_id."&&sender_id=".$reciever_id."&&reciever_id=".$sender_id."&&reciever_name=".$from."&&status=2'>Reject</a></span>
					</div>
					";
				}
				else if($status == 1){
					echo "
					<div id='msg_box'>
					<table style='text-align:center'>
					<tr>
					<td>From : </td><td>".$from."</td><td>Date : </td><td>".$date."</td>
					</tr>
					<tr>
					<td>Start : </td><td>".$start."</td><td>Destination : </td><td>".$dest."</td>
					</tr>
					</table>
					<b>He Accepted your Open Request.</b><br>
					<a href='delete_msg.php?msg_id=".$msg_id."'>[ Delete ]</a>
					</div>
					";
				}
				else{
					echo "
					<div id='msg_box'>
					<table style='text-align:center'>
					<tr>
					<td>From : </td><td>".$from."</td><td>Date : </td><td>".$date."</td>
					</tr>
					<tr>
					<td>Start : </td><td>".$start."</td><td>Destination : </td><td>".$dest."</td>
					</tr>
					</table>
					<b>He Rejected your Open Request.</b><br>
					<a href='delete_msg.php?msg_id=".$msg_id."'>[ Delete ]</a>
					</div>
					";
				}
			}
			$i++;
		}
	}
	else{
		echo "<p>You do not have any Messages.</p>";
	}	
?>
</div>
</html>