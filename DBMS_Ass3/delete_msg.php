<?php
$conn = mysql_connect("localhost","root","");
mysql_select_db("dbms");

$msg_id = $_GET['msg_id'];
$query = "DELETE FROM message WHERE msg_id = '$msg_id'";
$result = mysql_query($query) or die("Unable to delete database entry.");
$page = 'mymessages.php';
header('Location: '.$page);
?>