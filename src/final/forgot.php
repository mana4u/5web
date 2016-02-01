<?php
require("header.php");
if(isset($_SESSION['SESS_LOGGEDIN']))
{
header("Location: index.php");
}

if(isset($_POST['submit'])){
        $email_rec = $_POST['email'];
        $recoverysql = "SELECT * from FROM customers WHERE email = '".filter_input(INPUT_POST,'email').
                    "';";
        $recoveryres = mysqli_query($mysqli,$recoverysql) or die(mysqli_error($mysqli));
	$numrows = mysqli_num_rows($recoveryres);
		if($numrows == 1)
		{
                    echo("<script>alert('Thank you, an email has been sent to $email_rec);</script>");
                    header("Location: login.php");
                } else {
                    echo("<script>alert('Account not found, please try again);</script>");
                    header("Location: forgot.php");
                }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Password Recovery</title>
    </head>
    <body>
        <h3>Password Recovery</h3>
        <p>Please enter the email address used for your account, a message will be sent to this email with instructions to reset your password</p> 
        <form action="forgot.php" method="POST">
            <table>
                <tr>
                    <td>Email</td>
                    <td><input type="textbox" name="email"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Recover Password">
                </tr>
            </table>
        </form>  
    </body>
</html>
<?php
require("footer.php");
?>

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

