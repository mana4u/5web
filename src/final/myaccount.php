
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

 	if ((!preg_match("/\w+/",$fname))&&(preg_match("/\w+/",$lname))){
	echo("<script>alert('Firstname must not be blank and contain only letters, numbers and underscores.');</script>");
	echo("<script>location.href = 'myaccount.php';</script>");
	}
	else if ((preg_match("/\w+/",$fname))&&(!preg_match("/\w+/",$lname))){
	echo("<script>alert('Lastname must not be blank and contain only letters, numbers and underscores.');</script>");
	echo("<script>location.href = 'myaccount.php';</script>");
	}
	else if ((!preg_match("/\w+/",$fname))&&(!preg_match("/\w+/",$lname))){
	echo("<script>alert('Lastname and firstname must not be blank and contain only letters, numbers and underscores.');</script>");
	echo("<script>location.href = 'myaccount.php';</script>");
	}
	else{

	$sql = "UPDATE customers SET firstName= '".$fname."', lastName= '".$lname."' WHERE id = ". $_SESSION['SESS_USERID'];
        $query = $mysqli->query($sql);
	
	echo("<script>alert('Thank you, your information has been changed!');</script>");
	echo("<script>location.href = 'myaccount.php';</script>");
	mysqli_close($mysqli);
	}}
    else{
	echo("<script>alert('Please fill all information');</script>");
        echo("<script>location.href = 'myaccount.php';</script>");
	}

}


if(isset($_POST['submit_pw'])){

    if ((filter_input(INPUT_POST, 'field_pwd1'))
	&& (filter_input(INPUT_POST, 'field_pwd2')))
	{
	$password_old = filter_input(INPUT_POST, 'field_pwd1');
        $password_new = filter_input(INPUT_POST, 'field_pwd2');

	if ((!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/",$password_old))&&(($password_old!=$password_new))){
	echo("<script>alert('password validation fail and does not match.');</script>");
	echo("<script>location.href = 'myaccount.php';</script>");
	}
	elseif ((preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/",$password_old))&&(($password_old!=$password_new))){
	echo("<script>alert('password does not match.');</script>");
	echo("<script>location.href = 'myaccount.php';</script>");
	}
	elseif ((!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/",$password_old))&&(($password_old==$password_new))){
	echo("<script>alert('password validation fail.');</script>");
	echo("<script>location.href = 'myaccount.php';</script>");
	}
	
	else {

	$sql = "UPDATE customers SET password= PASSWORD('" .$password_new. "') WHERE id = ". $_SESSION['SESS_USERID'];
        $query = $mysqli->query($sql);
	
	echo("<script>alert('Thank you, your password has been changed!');</script>");
	echo("<script>location.href = 'myaccount.php';</script>");
	mysqli_close($mysqli);
	}}
    else{
	echo("<script>alert('Please fill all information');</script>");
        echo("<script>location.href = 'myaccount.php';</script>");
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
<style>
table.one {
    border: 1px solid grey;
    border-collapse: collapse;
}
td.one {
    border: 1px solid grey;
    border-collapse: collapse;
    padding: 30px;
}
div.move {
    position: relative;
    top:50px;
}
div.min {
    height: 360px;
}

</style>
<body>

<div class="move">

<table class="one" align=center style = "width:60%">
<tr>
<td class="one" bgcolor="#fff4b3" valign=top width="20%">

<div class="min">

<table>
<h2>Hello, <br>
<?php echo $userrow['firstName'];?><?php echo " ";?><?php echo $userrow['lastName'];?>&nbsp;
</h2>
</tr>
<hr>

<h2>User Menu ¡å</h2>
<tr><td><a href="myaccount.php"><u>Change User Information</u></a></td></tr>
<tr><td><a href="history_mo.php"><u>Purchase History</u></a></td></tr>
<tr><td><a href="downloads_mo.php"><u>Downloads</u></a></td></tr>

</table>
</div>

<td class="one" valign=center width="40%">

<table>
<form name="myForm" action="" method="post">
<h3>Identification</h3>
<tr><td>Email Address: <?php echo $userrow['email'];?> </td></tr>
<tr><td>First name: <input type="text" name="field_username1" id="field_username1" value= "<?php echo $userrow['firstName'];?>"/></td></tr>
<tr><td>Last name: <input type="text" name="field_username2" id="field_username2" value= "<?php echo $userrow['lastName'];?>"/></td></tr>

<tr><td><input type="submit" name="submit_iden" value="Change Username"/>
<form action="myaccount.php">
	<input type="submit" value="Cancel"></td></tr>
</form>
</table>

<hr>

<table>
<form id="myForm3" action="" method="post">
<h3>Change Password</h3>
<tr><td>Please enter new password: <input type="password" id="field_pwd1" name="field_pwd1" style="width:150px"></td></tr>
<tr><td>Please re-enter new password: <input type="password" id="field_pwd2" name="field_pwd2" style="width:150px"></td></tr>
<tr><td><input type="submit" name="submit_pw" value="Change my password" />
<button type="cancel">Cancel</button></td></tr>
</form>
</table>

<hr>

<table>
<form name="myForm2" action="" method="post">
<h3>Newsletter Subscription(it's free!)</h3>
<tr><td>Status: <input type="text" name="newsletter" style="width:100px" id="newsletter" 
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
?>"/></td></tr>
</form>
</table>


</table>
</div>

</body>

</html>
