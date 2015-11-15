<?php
$conn = mysql_connect("localhost","root","");
mysql_select_db("dbms");

$id = intval($_GET['req_id']);
$sql="DELETE FROM request WHERE request_id = '$id'";
$result = mysql_query($sql) or die("Unable to delete database entry.");
$page = 'myrequests.php';
header('Location: '.$page);
?>