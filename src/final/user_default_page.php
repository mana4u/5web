<?php
require("header.php");
?>

<!DOCTYPE html>
<html>

<style>
a:link, a:hover, a:active, a:visited {
text-decoration: none;
border-bottom: none;
color: #004466;
}
.doubleUnderline {
    font-family: "trebuchet ms", verdana, sans-serif;
    font-size: 20px;
    text-decoration:underline;
    border-bottom: 1px solid #000;
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
      <div style= "font-size: 15px; font-weight: bold; color: #004466; position: absolute; top:65px; left:325px;">User's name</div>
      <img src='./images/user-details2.png', alt="user-details" style= "position:absolute; top:105px; left:238px">
      <div style= "font-size: 15px; font-weight: bold; color: #004466; position: absolute; top:135px; left:265px;">main-user-info</div>
  
      <div style= "color: #004466; position: absolute; top:160px; left:270px;"><a href="home.php"><u>Change User Information</u></a></div>
      <div style= "color: #004466; position: absolute; top:185px; left:270px;"><a href="home.php"><u>Purchase History</u></a></div>
      <div style= "color: #004466; position: absolute; top:210px; left:270px;"><a href="home.php"><u>Downloads</u></a></div>

      <div style= "font-size: 15px; font-weight: bold; color: #004466; position: absolute; top:240px; left:265px;">subscription-info</div>
      <div style= "color: #004466; position: absolute; top:265px; left:270px;"><a href="home.php"><u>Membership</u></a></div>
      <div style= "color: #004466; position: absolute; top:290px; left:270px;"><a href="home.php"><u>Newsletter</u></a></div>

 </div>


</body>

</html>