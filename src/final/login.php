<?php
session_start();
require("config.php");
if(isset($_SESSION['SESS_LOGGEDIN']))
{
header("Location: index.php");
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
		$ordersql = "SELECT id FROM orders WHERE customer_id = " . $_SESSION['SESS_USERID'];
		$orderres = mysqli_query($mysqli,$ordersql) or die(mysqli_error($mysqli));
		$orderrow = mysqli_fetch_assoc($orderres);
		$_SESSION['SESS_ORDERNUM'] = $orderrow['id'];
		header("Location: " . $config_basedir);
		}
		else
		{
			header("Location: http://" .$_SERVER['HTTP_HOST']. $_SERVER['SCRIPT_NAME'] . "?error=1");
		}
	}

	else
	{
		require("header.php");?>
		
<h1>Customer Login</h1>
Please enter your username and password to log into the websites. If you do not have an account, you can get one for free by <a href="apply.php">registering</a>.
<p>
<?php
if(isset($_GET['error'])) 
{
    echo "<font color='red'><strong>Incorrect username/password</strong></font>";
}
?>

<form action="login.php" method="POST">
    <table>
        <tr>
            <td>Email</td>
            <td><input type="textbox" name="email">
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password">
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Log in">
        </tr>
    </table>
</form>

<?php 
} 
if(isset($_SESSION['SESS_LOGGEDIN']))
{
header("Location: index.php");
}
require("footer.php");
?>