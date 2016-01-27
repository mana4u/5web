<?php
session_start();
require("user_default_page.php");
require("config.php");

$usersql = "SELECT * From customers WHERE id = ". $_SESSION['SESS_USERID'];
$userres = mysqli_query($mysqli,$usersql) or die(mysqli_error($mysqli));
$userrow = mysqli_fetch_assoc($userres);


?>

<!DOCTYPE html>
<html>

<style type="text/css">

label{
float: left;
width: 120px;
font-weight: bold;
}

input, textarea{
width: 180px;
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

<div id="text_myaccount">
	
 <div style= "font-size: 15px; font-weight: bold; color: #000000; position: relative; top:10px; left:20px;">User page</div>
 <img src='./images/line-myaccount2.png', alt="line-myaccount" style= "position:relative; top:0px; left:20px">

<div style= "font-size: 15px; color: #004466; position: relative; top:5px; left:20px;"><u>Identification</u></div>

<div style="position: relative; top:-5px; left:25px;">
<form>
<br />
<div style= "position: relative; top:5px; left:0px;">
<label for="user">First name:</label>
<label for="user"><?php echo $userrow['firstName'];?></label>
</div>
<br />

<div style= "position: relative; top:10px; left:0px;">
<label for="user">Last name:</label>
<label for="user"><?php echo $userrow['lastName'];?></label>
</div>
<br />

<div style= "position: relative; top:15px; left:0px;">
<label for="emailaddress">Email Address:</label>
<label for="emailaddress"><?php echo $userrow['email'];?></label>
</div>
<br />

<div style= "position: relative; top:20px; left:0px;">
<label for="password">Password:</label>
<button type="changebutton" value="Submit">Change password</button>
</div>
<br />

<div style= "font-size: 15px; color: #004466; position: relative; top:20px; left:-5px;"><u>Subscription</u></div>
<br />
<br />
<div style= "position: relative; top:0px; left:0px;">
<label for="membership">Membership:</label>
<label for="user">Inactive</label>
<div style= "position: relative; top:0px; left:-60px;">
<button type="activate" value="Submit">Change</button>
</div>
</div>

<div style= "position: relative; top:5px; left:0px;">
<label for="newsletter">Newsletter:</label>
<label for="user">Inactive</label>
<div style= "position: relative; top:0px; left:-60px;">
<button type="activate" value="Submit">Change</button>
</div>
</div>

<br />

</form>
</div>
</div>
</body>

</html>
