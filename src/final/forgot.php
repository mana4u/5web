<?php
require("header.php");

if(isset($_SESSION['SESS_LOGGEDIN'])){
header("Location: index.php");
}

if(isset($_POST['submit'])){
        $email_rec = $_POST['email'];
        $recoverysql = "SELECT * FROM customers WHERE email = '$email_rec';";
        $recoveryres = mysqli_query($mysqli,$recoverysql) or die(mysqli_error($mysqli));
	$numrows = mysqli_num_rows($recoveryres);
        if($numrows > 0){
            //insert email stuff here
            echo("<h3>Thank you, a message has been sent to $email_rec</h3>");
        } else {
            echo("<h3>Email not found, please try again</h3>");
        }
}
?>

<!DOCTYPE html>
<html>
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

