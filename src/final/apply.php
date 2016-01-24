<?php
require("header.php");

if(isset($_POST['submit'])){
    if ((!filter_input(INPUT_POST, 'firstname'))
        || (!filter_input(INPUT_POST, 'lastname'))
        || (!filter_input(INPUT_POST, 'email'))
        || (!filter_input(INPUT_POST, 'password'))
		|| (!filter_input(INPUT_POST, 'phone')))
        {
	$message = 'Please fill all information';
        echo( "<SCRIPT>alert('$message');</SCRIPT>");
        echo("<script>location.href = 'apply.php';</script>");
        }
    else{
        $fname = filter_input(INPUT_POST, 'firstname');
        $lname = filter_input(INPUT_POST, 'lastname');
        $password = filter_input(INPUT_POST, 'password');	
		$phone = filter_input(INPUT_POST, 'phone');
        $email = strtolower(filter_input(INPUT_POST, 'email'));
        $sql = "INSERT INTO customers VALUES ('','".$fname."','".$lname."','".$phone."','".$email."',PASSWORD('".$password."'))";
		$res = mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));

	if ($res === TRUE) {

            echo("<script>alert('Your new account has been created. Thank you for joining us!');</script>");
            echo("<script>location.href = 'login.php';</script>");

 
	} else {

        echo "<SCRIPT>alert('Your emal address has already been used!! Please use different email address for a new account.');</SCRIPT>";	
        echo("<script>location.href = 'apply.php';</script>");

   
	}

	mysqli_close($mysqli);
    }

}else{
            
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="refresh">
        <title>Sign up</title>

    </head>
    <body>
      
        <form action="apply.php" method="post" name="registration">
            <h2>Create New Account</h2>
            <table>
            <tr><td>First name</td><td><input type='text' name='firstname' id='firstname' /></td></tr>
            <tr><td>Last name</td><td> <input type="text" name="lastname" id="lastname" /></td></tr>
            <tr><td>Email</td><td> <input type="text" name="email" id="email" /></td></tr>
            <tr><td>Password</td><td> <input type="password" name="password" id="password"/></td></tr>
            <tr><td>Phone</td><td> <input type="text" name="phone" id="phone" /></td></tr>  
            <tr><td></td><td><input type="submit" name="submit" value="Register" /> </td></tr>
            </table>
        </form>
   
    </body>
</html>
<?php } ?>
