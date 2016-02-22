
<?php
require("header.php");
require("config.php");

$usersql = "SELECT * From customers WHERE id = ". $_SESSION['SESS_USERID'];
$userres = mysqli_query($mysqli,$usersql) or die(mysqli_error($mysqli));
$userrow = mysqli_fetch_assoc($userres);

if(isset($_POST['submit_iden'])){

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

if(isset($_POST['submit_mem'])){
    if ($userrow['membership']==0) 
	{
	$sql = "UPDATE customers SET membership= '1' WHERE id = ". $_SESSION['SESS_USERID'];
	$query = $mysqli->query($sql);
	echo("<script>alert('Thank you for subscription');</script>");
        echo("<script>location.href = 'myaccount.php';</script>");
	mysqli_close($mysqli);
	}
    else{
	$sql = "UPDATE customers SET membership= '0' WHERE id = ". $_SESSION['SESS_USERID'];
	$query = $mysqli->query($sql);
	echo("<script>alert('You have successfully unsubscribed from our membership');</script>");
        echo("<script>location.href = 'myaccount.php';</script>");
	mysqli_close($mysqli);
	}
}

if(isset($_POST['submit_news'])){
    if ($userrow['newsletter']==0) 
	{
	$sql = "UPDATE customers SET newsletter= '1' WHERE id = ". $_SESSION['SESS_USERID'];
	$query = $mysqli->query($sql);
	echo("<script>alert('Thank you for subscription');</script>");
        echo("<script>location.href = 'myaccount.php';</script>");
	mysqli_close($mysqli);
	}
    else{
	$sql = "UPDATE customers SET newsletter= '0' WHERE id = ". $_SESSION['SESS_USERID'];
	$query = $mysqli->query($sql);
	echo("<script>alert('You have successfully unsubscribed from our newsletter');</script>");
        echo("<script>location.href = 'myaccount.php';</script>");
	mysqli_close($mysqli);
	}
}
	


?>

<!DOCTYPE html>
<html>
<style type="text/css">

table {
	border-spacing: 0px;
}

</style>

<body>

<table style = "width:100%" border-collapse: collapse;>
<tr>
<td valign=top width="20%" bgcolor="#cceeff" style="padding:0px 30px 0px 30px; border:1px solid #66ccff;">
<br><br>
      <div style= "font-size: 20px; font-weight: bold; color: #004466;">
      <?php echo "Hello, ";?></div>
      
      <div style= "font-size: 20px; color: black;">
      <?php echo $userrow['firstName'];?><?php echo " ";?><?php echo $userrow['lastName'];?>
      <img src='./images/smile.png', alt="smile" width="30" height="30"></div>
      <br>
      <div style= "font-size: 20px; font-weight: bold; color: #004466;">main-user-info</div>

      <div style= "font-size: 15px; color: black;">
      <p><a href="myaccount.php"><u>Change User Information</u></a></p>
      <p><a href="history.php"><u>Purchase History</u></a></p>
      <p><a href="myaccount.php"><u>Downloads</u></a></p>
      </div>
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

<input type="submit" name="submit_iden" value="Change Username"/>
<button type="cancel">Cancel</button>
<br>
<br>-----------------------------------------------------------<br />

<h3>Change Password</h3>
<p>To change your password please <text><a href="change_password.php"><u><b>Click here</b></u></a></text>

<br>-----------------------------------------------------------<br />

<h3>Subscription</h3>

<p>Membership: <input type="text" name="membership" id="membership" 
value= "<?php 
if ($userrow['membership']==0)
	echo "Inactive"; 
else
	echo "Active"; 
?>"/>
<input type="submit" name="submit_mem" value="<?php 
if ($userrow['membership']==0)
	echo "Subscribe!"; 
else
	echo "Cancel Subscription"; 
?>"/></p>

<p>Newsletter: <input type="text" name="newsletter" id="newsletter" 
value= "<?php 
if ($userrow['newsletter']==0)
	echo "Inactive"; 
else
	echo "Active"; 
?>"/>
<input type="submit" name="submit_news" value="
<?php 
if ($userrow['newsletter']==0)
	echo "Subscribe!"; 
else
	echo "Cancel Subscription"; 
?>"/></p>


</form>

</div>
</div>

</td>
</tr>
</table>

</body>

</html>
