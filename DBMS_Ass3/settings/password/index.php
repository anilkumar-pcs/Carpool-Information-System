<html>
<link rel="stylesheet" href="../style.css" />
<div id="menu" >
<ul style='float:left;list-style-type:none;display:block'>
<li><a class="notselected" href="../personal/" >Personal</a></li>
<li><a class="selected" href="../password/" >Password</a></li>
<li><a class="notselected" href="../../home.php">Home</a></li>
</ul>
</div>
<div id="content">
<?php
session_start();
$name = $_SESSION['name'];

if($name){
	if(isset($_POST['update']) && $_POST['update']){
		$oldpassword = $_POST['oldpass'];
		$newpassword = $_POST['newpass'];
		$repeatnewpassword = $_POST['renewpass'];
		$conn = mysql_connect("localhost","root","");
		mysql_select_db("dbms");
		$query = mysql_query("SELECT * FROM users WHERE name = '$name'");
		$numrows = mysql_num_rows($query);
		if($numrows != 0){
			while($row = mysql_fetch_array($query)){
				$dbpassword = $row['password'];
			}
		}
		if($dbpassword == $oldpassword){
			if($newpassword == $repeatnewpassword){
				$query = mysql_query("
				UPDATE users SET password='$newpassword' WHERE name='$name'
				");
				echo "Your Password has been Changed.";
			}
			else{
				echo "New Passwords doesn't match!";
			}
		}
		else{
			echo "Old Password doesn't match!";
		}
	}
}
?>
<h2>Change Password</h2>
<form action="index.php" method="POST">
<table>
<tr>
<td>Current Password : </td><td><input type="password" name="oldpass" /></td>
</tr>
<tr>
<td>New Password : </td><td><input type="password" name="newpass" /></td>
</tr>
<tr>
<td>Repeat New Password : </td><td><input type="password" name="renewpass" /></td>
</tr>
</table>
<p><input type="submit" value="Update" name="update" id="submit"/></p>
</form>
</div>
</html>