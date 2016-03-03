<?php
require("header.php");
echo "<h3><a href=adminhistory.php>Completed Orders</a> -";
        echo " <a href=addProduct.php>Add a Product</a> -";
		echo " <a href=editProduct.php>Edit/Delete a Product</a> -";
		echo " <a href=sendemail.php>Email</a></h3>";
		
if(isset($_POST['submit'])){
	 if ((filter_input(INPUT_POST, 'name'))&& (filter_input(INPUT_POST, 'des')) &&
		 (filter_input(INPUT_POST, 'price'))){
			
			$id = $_POST['id']; 
			$name = $_POST['name'];
			$description = $_POST['des'];	 
			$price = $_POST['price'];
			$target_path = "images/";
			$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
			move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);	
			$image = basename( $_FILES['uploadedfile']['name']);
			if(empty($image)){
			$updateprodsql = "update products SET name = '".$name."', description = '".$description."', price = '".$price."' WHERE id = ".$id.";";
			$updateprodres = mysqli_query($mysqli,$updateprodsql) or die(mysqli_error($mysqli));			
			}
			else{
			$updateprodsql = "update products SET name = '".$name."', description = '".$description."', price = '".$price."', image = '".$image."' WHERE id = ".$id.";";
			$updateprodres = mysqli_query($mysqli,$updateprodsql) or die(mysqli_error($mysqli));			
			}
				
				echo("<script>alert('Product information has been changed');</script>");
				echo("<script>location.href = 'editProduct.php';</script>");
             }else {
                 echo("<script>alert('please fill All the forms');</script>");
                 echo("<script>location.href = 'editProduct.php';</script>");
             }
}	
	
$prodcatsql = "SELECT * FROM products;";
$prodcatres = mysqli_query($mysqli,$prodcatsql) or die(mysqli_error($mysqli));
$numrows = mysqli_num_rows($prodcatres);

if($numrows == 0)
{
    echo "<h1>No products</h1>";
    echo "There are no products in this category.";
}
else
{
	
    echo "<table width='60%' cellpadding='10'>";
    while($prodrow = mysqli_fetch_assoc($prodcatres))
    {
        echo "<tr align='left' ><td width='20%'>";
        if(empty($prodrow['image'])) {
		echo "<td><a href='./item.php?id=". $prodrow['id'] . "'><img src='./images/dummy.jpg' alt='". $prodrow['name'] . "'></a></td>";
		}	
		else {
		echo "<td><a href='./item.php?id=". $prodrow['id'] . "'><img src='./images/" . $prodrow['image']. "' alt='". $prodrow['name'] . "' height='150px' width='150px'></a></td>";
		}
    echo "<td>";
    echo "<form action='editProduct.php' method='POST' enctype='multipart/form-data'>";
	echo "<input type='hidden' name='id' value='".$prodrow['id']."'></input>";
    echo "<input type='text' name='name' value='".$prodrow['name']."'></input>";
    echo "<p><input type='text' name='des' size='40' value='".$prodrow['description']."'></input>";
	echo "<p><input type='file' name='uploadedfile' accept='image/*'></input>";
	echo "[<a href='deletePro.php?id=". $prodrow['id'] . "'>DELETE</a>]";
    echo "<table cellpadding='10'>";
    echo "<tr>";
    echo "<td><strong>$<input type='text' name='price' size='4' value='". sprintf('%.2f', $prodrow['price']) . "'></input></strong></td>";
    echo "<td><input type='submit' name='submit' value='Edit a product'></td>";
    echo "</tr>";
    echo "</table>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
    }
    echo "</table>";
}
require("footer.php");

?>