<?php
require("header.php");

require("config.php");

$usersql = "SELECT * From customers WHERE id = ". $_SESSION['SESS_USERID'];
$userres = mysqli_query($mysqli,$usersql) or die(mysqli_error($mysqli));
$userrow = mysqli_fetch_assoc($userres);

?>

<!DOCTYPE html>
<html>

<style>

#nav_myaccount{
font-family: "trebuchet ms", verdana, sans-serif;
font-size: 12px;
background-color:#cceeff;
height:320px;
width:200px;
float:left;
border: 1px solid #66ccff;
padding-top: 0px;
padding-right: 0px;
padding-botton:0px;
padding-left:0px;
.nav_myaccount a:link {
text-decoration: none;
border-bottom: none;
color: #004466;
}
}

</style>

<body>
  <div id="nav_myaccount">
  <img src='./images/monster.jpg', alt="edit-user" style="width:50px;height:50px; position:absolute; top:40px; left:425px">
      <div style= "font-size: 12px; font-weight: bold; color: black; position: absolute; top:45px; left:485px;">editing-user</div>
      <div style= "font-size: 15px; font-weight: bold; color: #004466; position: absolute; top:65px; left:485px;">
      <?php echo $userrow['firstName'];?><?php echo " ";?><?php echo $userrow['lastName'];?></div>
      <img src='./images/user-details2.png', alt="user-details" style= "position:absolute; top:105px; left:380px">
      <div style= "font-size: 15px; font-weight: bold; color: #004466; position: absolute; top:135px; left:435px;">main-user-info</div>
  
      <div style= "color: #004466; position: absolute; top:160px; left:420px;"><a href="myaccount.php"><u>Change User Information</u></a></div>
      <div style= "color: #004466; position: absolute; top:185px; left:420px;"><a href="myaccount.php"><u>Purchase History</u></a></div>
      <div style= "color: #004466; position: absolute; top:210px; left:420px;"><a href="myaccount.php"><u>Downloads</u></a></div>


 </div>

</body>

</html>