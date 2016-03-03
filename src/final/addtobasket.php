<?php
session_start();
require("config.php");
$prodsql = "SELECT * FROM products WHERE id = " . $_GET['id'] . ";";
$prodres = mysqli_query($mysqli,$prodsql) or die(mysqli_error($mysqli));
$numrows = mysqli_num_rows($prodres);
$prodrow = mysqli_fetch_assoc($prodres);
if(isset($_POST['submit']))
{
	if(isset($_SESSION['SESS_ORDERNUM']))
	{
	$itemsql = "INSERT INTO orderitems(order_id,product_id) VALUES(". $_SESSION['SESS_ORDERNUM'] . ", ". $_GET['id'] . ")";
	mysqli_query($mysqli,$itemsql) or die(mysqli_error($mysqli));
	}
	elseif(isset($_SESSION['SESS_USERID']))
	{	
	$sql = "INSERT INTO orders(customer_id, date) VALUES(". $_SESSION['SESS_USERID'] . ", NOW())";
	mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
	$_SESSION['SESS_ORDERNUM'] = mysqli_insert_id($mysqli);
	$itemsql = "INSERT INTO orderitems(order_id, product_id) VALUES(". $_SESSION['SESS_ORDERNUM']. ", " . $_GET['id'] . ")";
	mysqli_query($mysqli,$itemsql) or die(mysqli_error($mysqli));	
	}
	else
	{
		echo("<script>alert('Please Login first')</script>");
		echo("<script>window.location = 'login.php';</script>");
	}
$totalprice = $prodrow['price'] * $_POST['amountBox'] ;
$updsql = "UPDATE orders SET total = total + ". $totalprice . " WHERE id = ". $_SESSION['SESS_ORDERNUM'] . ";";
mysqli_query($mysqli,$updsql) or die(mysqli_error($mysqli));
header("Location: " . $config_basedir . "showcart.php");
}
require("footer.php");
?>
