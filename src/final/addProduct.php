<?php

require("header.php");
if(isset($_SESSION['SESS_ADMINLOGGEDIN'])){
		echo "<a href=adminhistory.php><h3>Completed Orders</a> -";
		echo " <a href=gifthistory.php>Purchased Gift Cards</a> -";
        echo " <a href=addProduct.php>Add a Product</a> -";
		echo " <a href=editProduct.php>Edit/Delete a Product</a> -";
		echo " <a href=sendemail.php>Email</a></h3>";
    echo "<h1>Add a Product</h1>";
    echo "<form action='upload.php' method='POST' enctype='multipart/form-data'>";
    echo "<table>";
    echo "<tr>";
    echo "<td>name</td><td><input type='Text' name='name2' id='name2' /></td></tr>";
    echo "<tr><td>catagory</td><td><input type='Text' name='cata' id='cata' /></td></tr>";
    echo "<tr><td>Description</td><td><input type='Text' name='description' id ='description' rows = '3' cols = '80' /></td></tr>";
    echo "<tr><td>Price</td><td><input type='Text' name='price' id='price' /></td></tr>";
    echo "<tr><td>Image</td><td><input type='file' name='uploadedfile' accept='image/*' /></td></tr>";
    echo "<tr><td><input type='submit' name='submit' value='Submit' /></td></tr>";
    echo "</table></form>";

    } else {
        echo("<script>window.location = 'login.php';</script>");
    }
	
    mysqli_close($mysqli);

    require("footer.php");