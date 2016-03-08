<?php
require("config.php");
$itemsql = "SELECT * FROM orderitems WHERE id = ". $_GET['id'] . ";";
$itemres = mysqli_query($mysqli,$itemsql) or die(mysqli_error($mysqli));
$numrows = mysqli_num_rows($itemres);
$itemrow = mysqli_fetch_assoc($itemres);
$prodsql = "SELECT price FROM products WHERE id = " . $itemrow['product_id'] . ";";
$prodres = mysqli_query($mysqli,$prodsql) or die(mysqli_error($mysqli));
$prodrow = mysqli_fetch_assoc($prodres); 
$ssql = "SELECT * from orderitems WHERE id = ". $_GET['id'];
$res = mysqli_query($mysqli,$ssql) or die(mysqli_error($mysqli));
$resrow = mysqli_fetch_assoc($res);

$sql = "DELETE FROM orderitems WHERE id = " . $_GET['id'];
$del=mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));

if($del){
	header("Location: showcart.php");
}
require('footer.php');
?>