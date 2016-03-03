<?php
require("config.php");
$sql = "DELETE FROM products WHERE id = " . $_GET['id'];
$del=mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));

if($del){
	header("Location: editProduct.php");
}
require('footer.php');
?>