<?php
$conn = mysql_connect("localhost","root","");
mysql_select_db("dbms");

$veh_id = $_GET['id'];
$query = "DELETE FROM vehicle1 WHERE veh_id = '$veh_id'";
$result = mysql_query($query) or die("Unable to delete database entry.");
$page = 'myvehicles.php';
header('Location: '.$page);
?>