<html>
<link rel="stylesheet" href="../style.css" />
<div id="menu" >
<ul style='float:left;list-style-type:none;display:block'>
<li><a class="selected" href="../personal/" >Personal</a></li>
<li><a class="notselected" href="../password/" >Password</a></li>
<li><a class="notselected" href="../../home.php">Home</a></li>
</ul>
</div>
<div id="content" >
<?php
session_start();
$name = $_SESSION['name'];
if($name){
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
<h2>Edit Details</h2>
<table>
<tr>
<td>Name : </td><td><?php echo $name; ?></td><td><a style="background:none;text-decoration:underline;color:blue" href="#" >Edit</a></td>
</tr>
<tr>
<td>Email : </td><td><?php echo $email; ?></td><td><a style="background:none;text-decoration:underline;color:blue" href="#" >Edit</a></td>
</tr>
<tr>
<td>Mobile : </td><td><?php echo $mobile; ?></td><td><a style="background:none;text-decoration:underline;color:blue" href="#" >Edit</a></td>
</tr>
<tr>
<td>Address : </td><td><?php echo $address; ?></td><td><a style="background:none;text-decoration:underline;color:blue" href="#" >Edit</a></td>
</tr>
</table>
</div>
</html>