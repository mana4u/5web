<?php
session_start();
require("config.php");
if(isset($_SESSION['SESS_LOGGEDIN']))
{
header("Location: index.php");
}

if(isset($_POST['submit_reg'])){
    if ((!filter_input(INPUT_POST, 'firstname'))
        || (!filter_input(INPUT_POST, 'lastname'))
        || (!filter_input(INPUT_POST, 'email'))
        || (!filter_input(INPUT_POST, 'password')))
		{
	$message = 'Please fill all information';
        header("Location: http://" .$_SERVER['HTTP_HOST']. $_SERVER['SCRIPT_NAME'] . "?error2=1");
        }
    else{
        $fname = filter_input(INPUT_POST, 'firstname');
        $lname = filter_input(INPUT_POST, 'lastname');
        $password = filter_input(INPUT_POST, 'password');
        $email = strtolower(filter_input(INPUT_POST, 'email'));
		if (isset($_POST['subscription'])) {
		$subscription = 1;
		}
		else{
			$subscription = 0;
		}
	
    // Checkbox is selected
        $emailck = "SELECT count(email) FROM customers WHERE email='$email'";
        $resultt = mysqli_query($mysqli,$emailck) or die(mysqli_error($mysqli));

   	if( $resultt->num_rows == 1 ){
  	  header("Location: http://" .$_SERVER['HTTP_HOST']. $_SERVER['SCRIPT_NAME'] . "?error3=1");
	}
   
	
        $sql = "INSERT INTO customers VALUES ('','".$fname."','".$lname."','".$email."',PASSWORD('".$password."'), '".$subscription."')";
		$res = mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));

	if ($res === TRUE) {
            echo("<script>alert('Your new account has been created. Thank you for joining us!');</script>");
            echo("<script>location.href = 'login.php';</script>");

	} else {

        echo "<SCRIPT>alert('Unexpected error occured, please contact us');</SCRIPT>";	
        echo("<script>location.href = 'login.php';</script>");

   
	}

	mysqli_close($mysqli);
    }

}else{
            
}


if(isset($_POST['submit']))
	{
	$loginsql = "SELECT id, firstName, lastName FROM customers WHERE email = '".filter_input(INPUT_POST,'email').
                    "' AND password = "."PASSWORD('".filter_input(INPUT_POST,'password')."');";
	$loginres = mysqli_query($mysqli,$loginsql) or die(mysqli_error($mysqli));
	$numrows = mysqli_num_rows($loginres);
		if($numrows == 1)
		{
		$loginrow = mysqli_fetch_assoc($loginres);
		
		$_SESSION['SESS_LOGGEDIN'] = 1;
		$_SESSION['SESS_USERNAME'] = $loginrow['firstName'];
		$_SESSION['SESS_USERID'] = $loginrow['id'];
		$ordersql = "SELECT id FROM orders WHERE Paid =0 and customer_id = " . $_SESSION['SESS_USERID'];
		$orderres = mysqli_query($mysqli,$ordersql) or die(mysqli_error($mysqli));
		$orderrow = mysqli_fetch_assoc($orderres);
		$_SESSION['SESS_ORDERNUM'] = $orderrow['id'];
		header("Location: " . $config_basedir);
		}
		else
		{
			$adminloginsql = "SELECT * FROM admin WHERE email = '".filter_input(INPUT_POST,'email').
                    "' AND password = "."PASSWORD('".filter_input(INPUT_POST,'password')."');";
			$adminloginres = mysqli_query($mysqli,$adminloginsql) or die(mysqli_error($mysqli));
			$adminnumrows = mysqli_num_rows($adminloginres);
			if($adminnumrows == 1)
			{
			$_SESSION['SESS_ADMINLOGGEDIN'] = 1;
			header("Location: " . $config_basedir);
			}
			else
			{
			header("Location: http://" .$_SERVER['HTTP_HOST']. $_SERVER['SCRIPT_NAME'] . "?error=1");
			}
		}
	}
	else
	{
	require("header.php");?>	


<!DOCTYPE html>
<html>
<head>
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
    top:80px;
}
</style>
</head>
<body>


<div class="move">

    <table class="one" align=center style = "width:60%">
    <tr>
    <td class="one" valign=center width="30%">
     
    <h1 align="center" style="background-color:Khaki;">Customer Login</h1>

    <form action="login.php" method="POST">
    <table align=center>
        <tr>
            
    <?php
if(isset($_GET['error'])) 
{
    echo "<p align='center'><font color='red'><strong>Incorrect username/password</strong></font></p>";
    echo "\n";
}
?>
</tr>
<tr>
            <td>Email</td>
            <td><input type="email" name="email">
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password">
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Log in"></td>
	    <tr></tr>
            <td><td><a href="forgot.php">Forgot Password</a></td></td>
        </tr>
    </table>
    </form>
    </td>

    <td class="one" valign=center width="30%">
    <form action="login.php" method="POST">
            <h2 align="center" style="background-color:Khaki">Create New Account</h2>

<?php
if(isset($_GET['error2'])) 
{
    echo "<p align='center'><font color='red'><strong>Please fill all information</strong></font></p>";
    echo "\n";
}
?>

<?php
if(isset($_GET['error3'])) 
{
    echo "<p align='center'><font color='red'><strong>This email address is already in use</strong></font></p>";
    echo "\n";
}
?>

            <table align="center">
            <tr><td>First name</td><td><input type='text' name='firstname' id='firstname' /></td></tr>
            <tr><td>Last name</td><td> <input type="text" name="lastname" id="lastname" /></td></tr>
            <tr><td>Email</td><td> <input type="email" name="email" id="email" /></td></tr>
            <tr><td>Password</td><td> <input type="password" name="password" id="password"/></td></tr> 
			<tr><td>Newsletter</td><td> <input type="checkbox" name="subscription" id="subscription" /></td></tr>  		
            <tr><td></td><td><input type="submit" name="submit_reg" value="Register" /> </td></tr>
            </table>
        </form>
    
</td>
</tr>
</table>
</form>

</div>

</body>
</html>

<?php 
} 
if(isset($_SESSION['SESS_LOGGEDIN']))
{
header("Location: index.php");
}
if(isset($_SESSION['SESS_ADMINLOGGEDIN']))
{
header("Location: index.php");
}
?>
