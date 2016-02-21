<?php
require("header.php");
if(isset($_SESSION['SESS_ADMINLOGGEDIN'])){
	
	if ((!filter_input(INPUT_POST, 'name')) ||
		(!filter_input(INPUT_POST, 'cata')) ||
		(!filter_input(INPUT_POST, 'description'))||
		(!filter_input(INPUT_POST, 'price')))
		{
			$message = "Please fill in all fields";
			echo( "<SCRIPT>alert('$message');</SCRIPT>");
			echo("<script>location.href = 'addProduct.php';</script>");
		} else {
		$target_path = "images/";
		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
		move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);				
		$name = filter_input(INPUT_POST, 'name');
		$cata = filter_input(INPUT_POST, 'cata');
		$desc = filter_input(INPUT_POST, 'description');
		$price = filter_input(INPUT_POST, 'price');
		$image = basename( $_FILES['uploadedfile']['name']);	
		$addsql = "INSERT INTO products VALUES ('','".$name."','".$cata."','".$desc."','".$image."','".$price."',0)";
		$res = mysqli_query($mysqli,$addsql) or die(mysqli_error($mysqli));
		
			if ($res === TRUE) {
				echo("<script>alert('The product has been added successfully');</script>");
				echo("<script>location.href = 'products.php';</script>");
			} else {
				echo "<SCRIPT>alert('An error occured, please try again');</SCRIPT>";	
				echo("<script>location.href = 'addProduct.php';</script>");
			}
		}
} else {
echo("<script>window.location = 'login.php';</script>");
}
?>

