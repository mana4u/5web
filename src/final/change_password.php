<?php
require("header.php");
require("config.php");

$usersql = "SELECT * From customers WHERE id = ". $_SESSION['SESS_USERID'];
$userres = mysqli_query($mysqli,$usersql) or die(mysqli_error($mysqli));
$userrow = mysqli_fetch_assoc($userres);

if(isset($_POST['submit'])){

    if ((filter_input(INPUT_POST, 'field_pwd1'))
	&& (filter_input(INPUT_POST, 'field_pwd2')))
	{

        $password_new = filter_input(INPUT_POST, 'field_pwd2');

	$sql = "UPDATE customers SET password= PASSWORD('" .$password_new. "') WHERE id = ". $_SESSION['SESS_USERID'];
        $query = $mysqli->query($sql);
	
	echo("<script>alert('Thank you, your password has been changed!');</script>");
	echo("<script>location.href = 'myaccount.php';</script>");
	mysqli_close($mysqli);
	}
    else{
	echo("<script>alert('Please fill all information');</script>");
        echo("<script>location.href = 'change_password.php';</script>");
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

<form id="myForm" action="" method="post">
<h3>Change Password</h3>
<p>Please enter new password: <input id="field_pwd1" name="field_pwd1" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd1"></p>
<p>Please re-enter new password: <input id="field_pwd2" name="field_pwd2" title="Please enter the same Password as above." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd2"></p>

<input type="submit" name="submit" value="Change my password" />
<button type="cancel">Cancel</button>

</form>
</div>
</div>

</td>
</tr>
</table>

</body>

</html>
