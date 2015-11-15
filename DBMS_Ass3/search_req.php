<?php
error_reporting(0);
session_start();
?>
<html>
<link rel='stylesheet' href='style.css' >
<h2>Enter Details :</h2>
<p>Return to <a href='home.php' >Home</a>.</p>
<form action = "search_req.php" method="POST" id="myForm">
<table style='position:relative;top:35px'>
<tr>
<td>Starting Point : </td>
<td>
<select name="start" id="select">
<option value="city1"<?php if(isset($_POST['start']) && $_POST['start'] == 'city1') echo ' selected="selected"';?> >City1</option>
<option value="city2"<?php if(isset($_POST['start']) && $_POST['start'] == 'city2') echo ' selected="selected"';?> >City2</option>
<option value="city3"<?php if(isset($_POST['start']) && $_POST['start'] == 'city3') echo ' selected="selected"';?> >City3</option>
<option value="city4"<?php if(isset($_POST['start']) && $_POST['start'] == 'city4') echo ' selected="selected"';?> >City4</option>
<option value="city5"<?php if(isset($_POST['start']) && $_POST['start'] == 'city5') echo ' selected="selected"';?> >City5</option>
</select>
</td>
</tr>
<tr>
<td>Destination Point : </td>
<td>
<select name="dest" id="select">
<option value="city1"<?php if(isset($_POST['dest']) && $_POST['dest'] == 'city1') echo ' selected="selected"';?> >City1</option>
<option value="city2"<?php if(isset($_POST['dest']) && $_POST['dest'] == 'city2') echo ' selected="selected"';?> >City2</option>
<option value="city3"<?php if(isset($_POST['dest']) && $_POST['dest'] == 'city3') echo ' selected="selected"';?> >City3</option>
<option value="city4"<?php if(isset($_POST['dest']) && $_POST['dest'] == 'city4') echo ' selected="selected"';?> >City4</option>
<option value="city5"<?php if(isset($_POST['dest']) && $_POST['dest'] == 'city5') echo ' selected="selected"';?> >City5</option>
</select>
</td>
</tr>
</table>
<div id='usersort' style="position: absolute;top: 90px;left: 425px;">
<span><b>Sort By : </b></span>
<select name="sort" id="select" class="SortBy">
<option value="none" <?php if(isset($_POST['sort']) && $_POST['sort'] == 'none') echo ' selected="selected"';?> >Select</option>
<optgroup label="COST">
<option value="cost" <?php if(isset($_POST['sort']) && $_POST['sort'] == 'cost') echo ' selected="selected"';?> >Cost</option>
</optgroup>
<optgroup label="Gender">
<option value="male" >Male</option>
<option value="female" >Female</option>
</optgroup>
<optgroup label="AGE">
<option value="upto 25" >upto 25</option>
<option value="25-40" >25-40</option>
<option value="> 40" >> 40</option>
</optgroup>
</select>
<input type="submit" value="Go!" name="submit" id="submit" style="height:25px"/>
</div>
<p style='position:relative;top:35px'><input type='submit' value='Search' name='submit' id='submit' /></p>
</form>
<div id='results' >
<?php
$name = $_SESSION['name'];
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("dbms");
	$query1 = mysql_query("SELECT user_id FROM users WHERE name = '$name'");
	while($row1 = mysql_fetch_array($query1)){
		$user_id = $row1['user_id'];
	}
	$start = "Not Selected";
	$dest = "Not Selected";

	if(isset($_POST['submit']) && $_POST['submit']){
	
		$start = $_POST['start'];
		$dest = $_POST['dest'];
		if($start && $dest){
		
		$sortby = $_POST['sort'];
		
			if($sortby == 'cost'){
				$query2 = mysql_query("SELECT * FROM request WHERE (user_id != '$user_id' AND start = '$start' AND dest = '$dest') ORDER BY `cost` DESC");
			}
			else if($sortby == 'male'){
				$query2 = mysql_query("SELECT * FROM request WHERE (user_id != '$user_id' AND start = '$start' AND dest = '$dest' AND gender = 'male')");
			}
			else if($sortby == 'female'){
				$query2 = mysql_query("SELECT * FROM request WHERE (user_id != '$user_id' AND start = '$start' AND dest = '$dest' AND gender = 'female')");
			}
			else if($sortby == 'upto 25'){
				$query2 = mysql_query("SELECT * FROM request WHERE (user_id != '$user_id' AND start = '$start' AND dest = '$dest' AND age = 'upto 25')");
			}
			else if($sortby == '25 - 40'){
				$query2 = mysql_query("SELECT * FROM request WHERE (user_id != '$user_id' AND start = '$start' AND dest = '$dest' AND age = '25 - 40')");
			}
			else if($sortby == '> 40'){
				$query2 = mysql_query("SELECT * FROM request WHERE (user_id != '$user_id' AND start = '$start' AND dest = '$dest' AND age = '> 40')");
			}
			else{
				$query2 = mysql_query("SELECT * FROM request WHERE (user_id != '$user_id' AND start = '$start' AND dest = '$dest')");
			}
			$numrows = mysql_num_rows($query2);
			if($numrows != 0){
				while($row2 = mysql_fetch_array($query2)){
					
					$id = $row2['user_id'];
					$query3 = mysql_query("SELECT name FROM users WHERE user_id = '$id'");
					while($row3 = mysql_fetch_array($query3)){
						$requester = $row3['name'];
					}
					
					$req_id = $row2['request_id'];
					$cost = $row2['cost'];
					$gender = $row2['gender'];
					$age = $row2['age'];
					$date = $row2['date'];
					$veh_type = $row2['veh_type'];
					
					echo "
					<div id='search_result'>
					<span id='requestID'>Request ID : ".$req_id."</span><br>
					Date : ".$date."<br>
					Service Requester : ".$requester."<br>
					Vehicle Type : ".$veh_type."<br>
					Cost : ".$cost."<br>
					Gender : ".$gender."<br>
					Age-Group : ".$age."<br>
					<div id='send_req'><a href='send_msg.php?req_id=".$req_id."&&share_id=0&&sender_id=".$user_id."&&reciever_id=".$id."&&reciever_name=".$requester."&&status=1'><input type='submit' name='submit1' value='Send Message' id='submit1'></a></div>
					</div>
					";
				}
			}
			else{
				echo "No Results Found.";
			}
		}
		else{
			echo "Please fill in <b>ALL FIELDS</b>.";
		}
	}
	
?>
</div>
<h2><span style="position: absolute;top: 9px;left: 425px;">Requesters : (<?php echo $numrows; ?>)</span></h2>
<div id='details'>
<p>
<span style="margin-right:3px"><b>Starting Point : </b><?php echo $start;?></span>
<span style="margin-right:3px"><b>Destination Point : </b><?php echo $dest;?></span>
</p>
</div>
</html>