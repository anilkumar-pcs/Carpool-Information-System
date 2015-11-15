<?php
$conn = mysql_connect("localhost","root","");
mysql_select_db("dbms");

$req_id = intval($_GET['req_id']);
$share_id = intval($_GET['share_id']);
$sender_id = intval($_GET['sender_id']);
$reciever_id = intval($_GET['reciever_id']);
$reciever_name = $_GET['reciever_name'];
$status = $_GET['status'];

$query = "INSERT INTO message VALUES('','$share_id','$req_id','$sender_id','$reciever_id','$reciever_name','$status')";
$query1 = mysql_query("SELECT COUNT(msg_id) AS count FROM message WHERE share_id = '$share_id' AND sender_id = '$sender_id' AND reciever_id = '$reciever_id'");
$duplicate = mysql_fetch_assoc($query1);
if($duplicate['count'] == 0){
	$insert = mysql_query($query);
		if($status == 0){
		$page = "find_vehicle.php?msg=Request Sent";
		header('Location: '.$page);
		}
		else{
		$page = "mymessages.php?msg=Message sent.";
		header('Location: '.$page);
		}
}
else if($duplicate['count'] >= 1){
	$page = "mymessages.php?msg=You have already sent a reply message to ".$reciever_name." for this Request.<br>You cannot send him again.";
	header('Location: '.$page);
}
?>