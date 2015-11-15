<?php
session_start();

if(isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['password'])){
	$page = 'home.php';
	$submit = $_POST['submit'];
	$name = $_POST['name'];
	$password = $_POST['password'];
	if($submit){
		if($name && $password){
			$conn = mysql_connect("localhost","root","");
			mysql_select_db("dbms");
			
			$query = mysql_query("SELECT password FROM users WHERE name='$name'");
			$numrows = mysql_num_rows($query);
			if($numrows != 0){
				while($row = mysql_fetch_array($query))
				{
					$dbpassword = $row['password'];
				}
				if($password == $dbpassword){
					$_SESSION['name'] = $name;
					header('Location: '.$page);
				}
				else{
					echo "Incorrect Password!";
				}
			}
			else{
				echo "That User do not Exist!";
			}
		}
		else{
			echo "Please fill in Details.";
		}
	}
}
?>
<html>
<link rel='stylesheet' href='style.css'>
	<form action ='login.php' method='POST' >
	<table>
	<tr>
	<td>Name : </td><td><input type='text' autocomplete='off' name='name' /></td>
	</tr>
	<tr>
	<td>Password : </td><td><input type='password' name='password' /></td>
	</tr>
	</table>
	<p><input type='submit' name= 'submit' value='Log In' id='submit'/></p>
	</form>
	<a href='#'>Forgot Password ?</a><br>
	<a href='user_reg.php'>Register ?</a> 
</html>