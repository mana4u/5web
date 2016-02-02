<?php
require("config.php");
require("user_default_page.php");

if(isset($_POST['submit'])){
    if ((filter_input(INPUT_POST, 'firstname'))
	&& (filter_input(INPUT_POST, 'lastname'))
	&& (!filter_input(INPUT_POST, 'password1'))
	&& (!filter_input(INPUT_POST, 'password2'))
	&& (!filter_input(INPUT_POST, 'password3')))
	{
	$fname = filter_input(INPUT_POST, 'firstname');
        $lname = filter_input(INPUT_POST, 'lastname');

	$sql = "UPDATE customers SET firstName= '".$fname."', lastName= '".$lname."' WHERE id = ". $_SESSION['SESS_USERID'];
        $query = $mysqli->query($sql);
	
	echo("<script>alert('Thank you, your information has been changed!');</script>");
	echo("<script>location.href = 'myaccount.php';</script>");
	mysqli_close($mysqli);
	}
    else if ((filter_input(INPUT_POST, 'firstname'))
	&& (filter_input(INPUT_POST, 'lastname'))
	&& (filter_input(INPUT_POST, 'password1'))
	&& (filter_input(INPUT_POST, 'password2'))
	&& (filter_input(INPUT_POST, 'password3')))
	{
	$fname = filter_input(INPUT_POST, 'firstname');
        $lname = filter_input(INPUT_POST, 'lastname');
        $password_new = filter_input(INPUT_POST, 'password3');

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

label{
float: left;
width: 180px;
font-weight: bold;
}

label2{
float: left;
width: 100px;
font-weight: bold;
}

input, textarea{
width: 150px;
margin-bottom: 5px;
}

textarea{
width: 250px;
height: 150px;
}

.boxes{
width: 1em;
}

#changebutton{
margin-left: 100px;
margin-top: 5px;
width: 120px;
}

#cancelbutton{
margin-left: 220px;
margin-top: 5px;
width: 90px;
}

br{
clear: left;
}


#text_myaccount{
font-family: "trebuchet ms", verdana, sans-serif;
font-size: 12px;
width:400px;
float:left;
padding:10px;
}

</style>

<body>
 
<?php if(isset($error)): ?>
            <h2><?php echo $error; ?></h2>
        <?php endif; ?>
 
<div id="text_myaccount">
	
 <div style= "font-size: 15px; font-weight: bold; color: #000000; position: relative; top:10px; left:20px;">User page</div>
 <img src='./images/line-myaccount2.png', alt="line-myaccount" style= "position:relative; top:0px; left:20px">

<div style= "font-size: 15px; color: #004466; position: relative; top:5px; left:20px;"><u>Identification</u></div>

<div style="position: relative; top:-5px; left:25px;">

<form action="" method="post">

<br />
<div style= "position: relative; top:5px; left:0px;">
<label for="emailaddress">Email Address:</label>
<label for="user"><?php echo $userrow['email'];?></label>
</div>
<br />

<div style= "position: relative; top:10px; left:0px;">
<label for="user">First name:</label>
<label><input type="text" name="firstname" id="firstname" value= "<?php echo $userrow['firstName'];?>"/></label>
</div>
<br />

<div style= "position: relative; top:8px; left:0px;">
<label for="user">Last name:</label>
<label><input type="text" name="lastname" id="lastname" value= "<?php echo $userrow['lastName'];?>"/></label>
</div>
<br />

<div style= "font-size: 15px; color: #004466; position: relative; top:20px; left:-5px;"><u>Change Password</u></div>

<div style="position: relative; top:15px; left:0px;">
<br />
<div style= "position: relative; top:0px; left:0px;">
<label for="user">Please enter current password:</label>
<label><input type="password" name="password1" id="password1" /></label>
</div>
<br />

<div style="position: relative; top:-20px; left:0px;">
<br />
<div style= "position: relative; top:0px; left:0px;">
<label for="user">Please enter new password:</label>
<label><input type="password" name="password2" id="password2" /></label>
</div>
<br />

<div style="position: relative; top:-20px; left:0px;">
<br />
<div style= "position: relative; top:-0px; left:0px;">
<label for="user">Please re-enter new password:</label>
<label><input type="password" name="password3" id="password3" /></label>
</div>


<div style= "font-size: 15px; color: #004466; position: relative; top:10px; left:-5px;"><u>Subscription</u></div>
<br />
<br />
<div style= "position: relative; top:-10px; left:0px;">
<label for="membership">Membership:</label>
<select>
   <option value="active">Active</option>
   <option value="Inactive">Inactive</option>
</select>
</div>

<div style= "position: relative; top:-5px; left:0px;">
<label for="newsletter">Newsletter:</label>
<select>
   <option value="active">Active</option>
   <option value="Inactive">Inactive</option>
</select>
</div>
<br />

<div style= "position: relative; top:0px; left:0px;">
<input type="submit" name="submit" value="Change my info" />
</div>
<div style= "position: relative; top:-26px; left:155px;">
<button type="cancel">Cancel</button>
</div>

</form>
</div>
</div>
</body>

</html>
