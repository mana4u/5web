
<?php
require("header.php");
require("config.php");

$usersql = "SELECT * From customers WHERE id = ". $_SESSION['SESS_USERID'];
$userres = mysqli_query($mysqli,$usersql) or die(mysqli_error($mysqli));
$userrow = mysqli_fetch_assoc($userres);

if(isset($_POST['submit'])){

    if ((filter_input(INPUT_POST, 'field_username1'))
	&& (filter_input(INPUT_POST, 'field_username2')))
	{
   
	$fname = filter_input(INPUT_POST, 'field_username1');
        $lname = filter_input(INPUT_POST, 'field_username2');

	$sql = "UPDATE customers SET firstName= '".$fname."', lastName= '".$lname."' WHERE id = ". $_SESSION['SESS_USERID'];
        $query = $mysqli->query($sql);
	
	echo("<script>alert('Thank you, your information has been changed!');</script>");
	echo("<script>location.href = 'myaccount.php';</script>");
	mysqli_close($mysqli);
	}
    else{
	echo("<script>alert('Please fill all information');</script>");
        echo("<script>location.href = 'myaccount.php';</script>");
	}
}
?>

<!DOCTYPE html>
<html>
<style type="text/css">

#nav_myaccount{
font-family: "trebuchet ms", verdana, sans-serif;
font-size: 12px;
background-color:#cceeff;
height:320px;
width:200px;
border: 1px solid #66ccff;
padding-top: 0px;
padding-right: 0px;
padding-botton:0px;
padding-left:0px;
}

table {
	border-spacing: 0px;
}

</style>

<body>

<table style = "width:100%" border-collapse: collapse;>
<tr>
<td style="width:20%">

<div id ="nav_myaccount">
  <img src='./images/monster.jpg', alt="edit-user" style="width:50px;height:50px; position:absolute; top:45px; left:425px">
      <div style= "font-size: 12px; font-weight: bold; color: black; position: absolute; top:45px; left:485px;">editing-user</div>
      <div style= "font-size: 15px; font-weight: bold; color: #004466; position: absolute; top:65px; left:485px;">
      <?php echo $userrow['firstName'];?><?php echo " ";?><?php echo $userrow['lastName'];?></div>
      <img src='./images/user-details2.png', alt="user-details" style= "position:absolute; top:105px; left:380px">
      <div style= "font-size: 15px; font-weight: bold; color: #004466; position: absolute; top:135px; left:435px;">main-user-info</div>
</div>

      <div style= "color: #004466; position: absolute; top:160px; left:420px;"><a href="myaccount.php"><u>Change User Information</u></a></div>
      <div style= "color: #004466; position: absolute; top:185px; left:420px;"><a href="history.php"><u>Purchase History</u></a></div>
      <div style= "color: #004466; position: absolute; top:210px; left:420px;"><a href="myaccount.php"><u>Downloads</u></a></div>
</td>

<?php if(isset($error)): ?>
            <h2><?php echo $error; ?></h2>
        <?php endif; ?>
 
<td style="width:80%">
<div style= "position: relative; top:10px; left:30px;">

<form name="myForm" action="" method="post">
<h3>Identification</h3>
<p>Email Address: <?php echo $userrow['email'];?> </p>
<p>First name: <input type="text" name="field_username1" id="field_username1" title="Firstname must not be blank and contain only letters, numbers and underscores." required pattern="\w+"
value= "<?php echo $userrow['firstName'];?>"/></p>

<P>Last name: <input type="text" name="field_username2" id="field_username2" title="Lastname must not be blank and contain only letters, numbers and underscores." required pattern="\w+"
value= "<?php echo $userrow['lastName'];?>"/></p>

<h3>Subscription</h3>

<p>Membership:
<select>
   <option value="active">Active</option>
   <option value="Inactive">Inactive</option>
</select>
</p>

<p>Newsletter:
<select>
   <option value="active">Active</option>
   <option value="Inactive">Inactive</option>
</select>
</p>

<input type="submit" name="submit" value="Change my info" />
<button type="cancel">Cancel</button>

<br>-----------------------------------------------------------<br />
<h3>Change Password</h3>
<p>Click to change your password <button type="button" onclick="location.href='change_password.php'">Change Password</button></p>


</form>

</div>
</div>

</td>
</tr>
</table>

</body>

</html>
