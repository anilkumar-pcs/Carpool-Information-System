<html>
<link rel='stylesheet' href='style.css' >
<script type="text/javascript" src="jQuery.js" ></script>
<h2>Enter Details :</h2>
<?php 
error_reporting(0);
session_start();
$msg = $_GET['msg'];
echo "<span style='color:red'>".$msg."</span>";
 ?>
<p>Return to <a href='home.php'>Home</a>.</p>

<form action = "find_vehicle.php" method="POST" id="myForm">
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
<tr>
<td>Choose Time : </td>
</tr>
<tr>
<td><input type="checkbox" name="type" value="daily" <?php echo empty($_POST['type']) ? '' : ' checked="checked" '; ?> />Daily<span style="float:right"><b>OR</b></span></td>
<td>
<select name="day" id="select" style="width:50px">
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
</select>
<select name="month" id="select" style="width:60px">
<option value="01">Jan</option>
<option value="02">Feb</option>
<option value="03">Mar</option>
<option value="04">Apr</option>
<option value="05">May</option>
</select>
<select name="year" id="select" style="width:60px">
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
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
<optgroup label="Vehicle Type">
<option value="SUV" >SUV</option>
<option value="MiniCab" >MiniCab</option>
<option value="VolvoBus" >VolvoBus</option>
<option value="Jeep" >Jeep</option>
<option value="Truck" >Truck</option>
</optgroup>
<optgroup label="Vehicle Preference">
<option value="owner" >Owner</option>
<option value="hire" >Hire</option>
</optgroup>
<optgroup label="Year Of Purchase">
<option value="year" >Manufacture Year</option>
</optgroup>
</select>
<input type="submit" value="Go!" name="submit1" id="submit" style="height:25px"/>
</div>
<p style='position:relative;top:35px'><input type='submit' name='submit1' value='Search' id='submit' ></p>
</form>

<div id='results'>
<?php
$name = $_SESSION['name'];
	$conn = mysql_connect("localhost","root","");
	mysql_select_db("dbms");
	$query1 = mysql_query("SELECT user_id FROM users WHERE name = '$name'");
	while($row = mysql_fetch_array($query1)){
		$user_id = $row['user_id'];
	}
	$start = "Not Selected";
	$dest = "Not Selected";
	$date = "Not Selected";
	if(isset($_POST['submit1']) && $_POST['submit1']){
		$start = $_POST['start'];
		$dest = $_POST['dest'];
		$date = $_POST['type'];
		if(!isset($_POST['type'])){
			$day = $_POST['day'];
			$month = $_POST['month'];
			$year = $_POST['year'];
				
			$date = $day."-".$month."-".$year;
		}
		if($start && $dest && $date){
			
			$sortby = $_POST['sort'];
			
			if($sortby == 'cost'){
				$query2 = mysql_query("SELECT * FROM sharing WHERE (user_id != '$user_id' AND start = '$start' AND dest = '$dest' AND date = '$date') ORDER BY `cost` ASC");
			}
			else if($sortby == 'owner'){
				$query2 = mysql_query("SELECT * FROM sharing WHERE (user_id != '$user_id' AND start = '$start' AND dest = '$dest' AND date = '$date' AND veh_pref = 'owner')");
			}
			else if($sortby == 'hire'){
				$query2 = mysql_query("SELECT * FROM sharing WHERE (user_id != '$user_id' AND start = '$start' AND dest = '$dest' AND date = '$date' AND veh_pref = 'hire')");
			}
			else if($sortby == 'none'){
				$query2 = mysql_query("SELECT * FROM sharing WHERE (user_id != '$user_id' AND start = '$start' AND dest = '$dest' AND date = '$date')");
			}
			else if($sortby == 'year'){
				$query2 = mysql_query("SELECT * FROM sharing WHERE (user_id != '$user_id' AND start = '$start' AND dest = '$dest' AND veh_id IN (SELECT veh_id FROM vehicle1 ORDER BY `year` DESC))");
			}
			else{
			//Sort by vehicle Type Here.
				$query2 = mysql_query("SELECT * FROM sharing WHERE (user_id != '$user_id' AND start = '$start' AND dest = '$dest' AND veh_id IN (SELECT veh_id FROM vehicle1 WHERE vtype='$sortby'))");
			}
			
			$numrows = mysql_num_rows($query2);
			if($numrows != 0){
				//echo "<b>No.Of Results : ".$numrows."</b><br>";
				while($row = mysql_fetch_array($query2)){
					$id = $row['user_id'];
					$query3 = mysql_query("SELECT name FROM users WHERE user_id = '$id'");
					while($row1 = mysql_fetch_array($query3)){
						$provider = $row1['name'];
					}
					$veh_pref = $row['veh_pref'];
					$cost = $row['cost'];
					$share_id = $row['share_id'];
					
					$veh_id = $row['veh_id'];
					$query4 = mysql_query("SELECT * FROM vehicle1 WHERE veh_id='$veh_id'");
					while($row4 = mysql_fetch_array($query4)){
						$vtype = $row4['vtype'];
						$myear = $row4['year'];
						$license = $row4['licensedate'];
					}
					
					echo "
					<div id='search_result'>
					<span id='requestID'>Sharing ID : ".$share_id."</span><br>
					Service Provider : ".$provider."<br>
					Vehicle Preference : ".$veh_pref."<br>
					Cost : ".$cost."<br>
					Vehicle Type : ".$vtype."<br>
					Manufacture Year : ".$myear."<br>
					License Date : ".$license."<br>
					<div id='send_req'><a href='send_msg.php?req_id=0&&share_id=".$share_id."&&sender_id=".$user_id."&&reciever_id=".$id."&&reciever_name=".$provider."&&status=0'><input type='submit' name='submit1' value='Send Request' id='submit1'></a></div>
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
<h2><span style="position: absolute;top: 9px;left: 425px;">Search Results : (<?php echo $numrows; ?>)</span></h2>
<div id='details'>
<p>
<span style="margin-right:3px"><b>Starting Point : </b><?php echo $start;?></span>
<span style="margin-right:3px"><b>Destination Point : </b><?php echo $dest;?></span>
<span style="margin-right:3px"><b>Date : </b><?php echo $date;?></span><br>
</p>
</div>
</html>