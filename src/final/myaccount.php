<?php
session_start();
require("header.php");
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
#nav_myaccount{
font-family: "trebuchet ms", verdana, sans-serif;
font-size: 12px;
background-color:#cceeff;
height:350px;
width:200px;
float:left;
border: 1px solid #66ccff;
padding-top: 0px;
padding-right: 0px;
padding-botton:0px;
padding-left:0px;
}
</style>

<body>
 <div id="nav_myaccount">
  <img src='./images/monster.jpg', alt="edit-user" style="width:50px;height:50px; position:absolute; top:40px; left:265px">
      <div style= "font-size: 12px; font-weight: bold; color: black; position: absolute; top:45px; left:325px;">editing-user</div>
      <div style= "font-size: 15px; font-weight: bold; color: #004466; position: absolute; top:65px; left:325px;"><?php echo $userrow['firstName'].$userrow['lastName'];?></div>
      <img src='./images/user-details2.png', alt="user-details" style= "position:absolute; top:105px; left:238px">
      <div style= "font-size: 15px; font-weight: bold; color: #004466; position: absolute; top:135px; left:265px;">main-user-info</div>
  
      <div style= "color: #004466; position: absolute; top:160px; left:270px;"><a href="home.php"><u>Change User Information</u></a></div>
      <div style= "color: #004466; position: absolute; top:185px; left:270px;"><a href="home.php"><u>Purchase History</u></a></div>
      <div style= "color: #004466; position: absolute; top:210px; left:270px;"><a href="home.php"><u>Downloads</u></a></div>

      <div style= "font-size: 15px; font-weight: bold; color: #004466; position: absolute; top:240px; left:265px;">subscription-info</div>
      <div style= "color: #004466; position: absolute; top:265px; left:270px;"><a href="home.php"><u>Membership</u></a></div>
      <div style= "color: #004466; position: absolute; top:290px; left:270px;"><a href="home.php"><u>Newsletter</u></a></div>

 </div>
 
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
