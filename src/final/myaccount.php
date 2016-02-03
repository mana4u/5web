<?php
require("config.php");
require("user_default_page.php");

if(isset($_POST['submit'])){

    if ((filter_input(INPUT_POST, 'field_username1'))
	&& (filter_input(INPUT_POST, 'field_username2'))
	&& (!filter_input(INPUT_POST, 'password1'))
	&& (!filter_input(INPUT_POST, 'field_pwd1'))
	&& (!filter_input(INPUT_POST, 'field_pwd2')))
	{
   
	$fname = filter_input(INPUT_POST, 'field_username1');
        $lname = filter_input(INPUT_POST, 'field_username2');

	$sql = "UPDATE customers SET firstName= '".$fname."', lastName= '".$lname."' WHERE id = ". $_SESSION['SESS_USERID'];
        $query = $mysqli->query($sql);
	
	echo("<script>alert('Thank you, your information has been changed!');</script>");
	echo("<script>location.href = 'myaccount.php';</script>");
	mysqli_close($mysqli);
	}

        else if ((filter_input(INPUT_POST, 'field_username1'))
	&& (filter_input(INPUT_POST, 'field_username2'))
	&& (filter_input(INPUT_POST, 'password1'))
	&& (filter_input(INPUT_POST, 'field_pwd1'))
	&& (filter_input(INPUT_POST, 'field_pwd2')))
	{

	$password_old = filter_input(INPUT_POST, 'password1');
	$password_match = "SELECT password from CUSTOMERS where id = ". $_SESSION['SESS_USERID'];
	if(password_old != password_match){
	echo("<script>alert('Password not matching!');</script>");
	echo("<script>location.href = 'myaccount.php';</script>");
	}

	$fname = filter_input(INPUT_POST, 'field_username1');
        $lname = filter_input(INPUT_POST, 'field_username2');
        $password_new = filter_input(INPUT_POST, 'field_pwd2');

	$sql = "UPDATE customers SET firstName= '".$fname."', lastName= '".$lname."', 
		password= PASSWORD('" .$password_new. "') WHERE id = ". $_SESSION['SESS_USERID'];
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
</style>

<body>
 
<?php if(isset($error)): ?>
            <h2><?php echo $error; ?></h2>
        <?php endif; ?>
 
<div style= "position: relative; top:10px; left:30px;">

<form id="myForm" action="" method="post">
<h3>Identification</h3>
<p>Email Address: <?php echo $userrow['email'];?> </p>
<p>First name: <input type="text" name="username" id="field_username1" title="Firstname must not be blank and contain only letters, numbers and underscores." required pattern="\w+"
value= "<?php echo $userrow['firstName'];?>"/></p>

<P>Last name: <input type="text" name="username" id="field_username2" title="Lastname must not be blank and contain only letters, numbers and underscores." required pattern="\w+"
value= "<?php echo $userrow['lastName'];?>"/></p>

<h3>Change Password</h3>
<p>Please enter new password: <input id="field_pwd1" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd1"></p>
<p>Please re-enter new password: <input id="field_pwd2" title="Please enter the same Password as above." type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd2"></p>

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



</form>
</div>
</div>
</body>

</html>
