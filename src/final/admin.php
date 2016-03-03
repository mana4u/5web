<?php
session_start();
require("header.php");
if(isset($_SESSION['SESS_ADMINLOGGEDIN']))
{
		echo "<h3><a href=adminhistory.php>Completed Orders</a> -";
        echo " <a href=addProduct.php>Add a Product</a> -";
		echo " <a href=editProduct.php>Edit/Delete a Product</a> -";
		echo " <a href=sendemail.php>Email</a></h3>";
	
	
	
}
else
{
    echo("<script>alert('You are not administer.')</script>");
    echo("<script>window.location = 'login.php';</script>");
}
?>
