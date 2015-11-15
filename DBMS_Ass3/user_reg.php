<?php
if(isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['password']) && isset($_POST['repassword']) && isset($_POST['address'])){
	$submit = $_POST['submit'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$address = $_POST['address'];
	
	if($submit){
		if($name && $email && $mobile && $password && $repassword && $address){
			if($password == $repassword){
				if(strlen($mobile) == 10){
					$conn = mysql_connect("localhost","root","");
					mysql_select_db("dbms");
					
					$query = mysql_query("
					INSERT INTO users VALUES('','$name','$email','$mobile','$password','$address')
					");
					
					echo "You have been Registered.<a href='login.php'>Login</a> Here.";
				}
				else{
					echo "Please enter a valid mobile number.";
				}
			}
			else{
				echo "Your Passwords do not match."; 
			}
		}
		else{
			echo "Please fill in <b>ALL FIELDS</b>.";
		}
	}
}
?>

<html>
<link rel='stylesheet' href='style.css'>
<h1>User Registration</h1>
<p>Return to <a href='home.php'>Home</a>.</p>
<p>Fill in the form to get yourself registered.</p>
<form action='user_reg.php' method='POST' >
	<table>
		<tr>
		<td>Name : </td>
		<td><input type='text' autocomplete='off' name='name' ></td>
		</tr>
		<tr>
		<td>E-mail : </td>
		<td><input type='text' autocomplete='off' name='email' ></td>
		</tr>
		<tr>
		<td>Mobile : </td>
		<td><input type='text' autocomplete='off' name='mobile' ></td>
		</tr>
		<tr>
		<td>Choose a Password : </td>
		<td><input type='password' name='password' ></td>
		</tr>
		<tr>
		<td>Repeat your Password : </td>
		<td><input type='password' name='repassword' ></td>
		</tr>
		<tr>
		<td>Address : </td>
		<td><textarea name='address' rows='4' cols='22'></textarea></td>
		</tr>
	</table>
	<p><input type='submit' value='Register' name='submit' id='submit'></p>
</form>
</html>