<?php

if(isset($_POST['submit_gift']))
{
session_start();
require("config.php");
$prodsql = "SELECT * FROM products WHERE id = " . $_GET['id'] . ";";
$prodres = mysqli_query($mysqli,$prodsql) or die(mysqli_error($mysqli));
$numrows = mysqli_num_rows($prodres);
$prodrow = mysqli_fetch_assoc($prodres);

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
header("Location: " . $config_basedir . "showcart_gift.php");
}


if(isset($_POST['submit'])){
	require("header.php");
	$name=$_POST['name']; 
	$prodcatsql = "SELECT * FROM products WHERE name like '%" . $name . "%' OR description LIKE '%" . $name  ."%' OR cata LIKE '%" . $name  ."%' OR price LIKE '%" . $name  ."%'";
	$prodcatres = mysqli_query($mysqli,$prodcatsql) or die(mysqli_error($mysqli));
	$numrows = mysqli_num_rows($prodcatres);
	if($numrows == 0)
	{
    echo "<h1>No products</h1>";
    echo "There are no products in this category.";
	}
	else
	{
		echo '<table><tr><td>';
	echo '<div class="dropdown">';
	echo '<button class="dropbtn">Category</button>';
	echo '<div class="dropdown-content">';
		echo '<a href="./products.php">Everything</a>';
		echo '<a href="./products.php?cata=1">Category 1</a>';
		echo '<a href="./products.php?cata=2">Category 2</a>';
		echo '<a href="./products.php?cata=3">Category 3</a>';
	echo '</div>';
	echo '</div></td>';

		echo '<td width="60%"></td><td><form  method="post" action="products.php"  id="searchform">'; 
	    echo '<input  type="text" name="name">';
	    echo '<input  type="submit" name="submit" value="Search"> ';
	    echo '</form></td></table>';
	
    echo "<table width='60%' cellpadding='10'>";
    while($prodrow = mysqli_fetch_assoc($prodcatres))
    {
		echo "<tr align='left' ><td width='20%'>";
        if(empty($prodrow['image'])) {
		echo "<td width='150px' height='150px'><a href='./item.php?id=". $prodrow['id'] . "'><img src='./images/dummy.jpg' alt='". $prodrow['name'] . "'></a></td>";
		}	
		else {
		echo "<td width='150px' height='150px'><a href='./item.php?id=". $prodrow['id'] . "'><img src='./images/" . $prodrow['image']. "' alt='". $prodrow['name'] . "' height='150px' width='150px'></a></td>";
		}
    echo "<td>";
    echo "<form action='addtobasket.php?id=". $prodrow['id'] . "' method='POST'>";
	echo "<a href='./item.php?id=". $prodrow['id'] . "'><h2>" . $prodrow['name'] . "</h2></a>";
    echo "<p>" . $prodrow['description'];
    echo "<table cellpadding='10'>";
    echo "<tr>";
    echo "<td><strong>$". sprintf('%.2f', $prodrow['price']) . "</strong></td>";
    echo "<td><input type='submit' name='submit' value='Add to basket'></td>";
    echo "</tr>"; 
    echo "</form>";
    echo "<form action='products.php?id=". $prodrow['id'] . "' method='POST'>";
    echo "<tr>";
    echo "<td><input type='submit' name='submit_gift' value='Buy as Gift'></td>";
    echo "</tr>"; 
    echo "</table>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
    }
    echo "</table>";
	}
}else{
	
require("header.php");
if(empty($_GET['cata']))
{
	$prodcatsql = "SELECT * FROM products;";
}
else{
	$prodcatsql = "SELECT * FROM products WHERE cata = " . $_GET['cata'] . ";";
}
$prodcatres = mysqli_query($mysqli,$prodcatsql) or die(mysqli_error($mysqli));
$numrows = mysqli_num_rows($prodcatres);

if($numrows == 0)
{
    echo "<h1>No products</h1>";
    echo "There are no products in this category.";
}
else
{
	echo '<table><tr><td>';
	echo '<div class="dropdown">';
	echo '<button class="dropbtn">Category</button>';
	echo '<div class="dropdown-content">';
		echo '<a href="./products.php">Everything</a>';
		echo '<a href="./products.php?cata=1">Category 1</a>';
		echo '<a href="./products.php?cata=2">Category 2</a>';
		echo '<a href="./products.php?cata=3">Category 3</a>';
	echo '</div>';
	echo '</div></td>';

		echo '<td width="60%"></td><td><form  method="post" action="products.php"  id="searchform">'; 
	    echo '<input  type="text" name="name">';
	    echo '<input  type="submit" name="submit" value="Search"> ';
	    echo '</form></td></table>';
	
    echo "<table width='60%' cellpadding='10'>";
    while($prodrow = mysqli_fetch_assoc($prodcatres))
    {
        echo "<tr align='left' ><td width='20%'>";
        if(empty($prodrow['image'])) {
		echo "<td width='150px' height='150px'><a href='./item.php?id=". $prodrow['id'] . "'><img src='./images/dummy.jpg' alt='". $prodrow['name'] . "'></a></td>";
		}	
		else {
		echo "<td><a href='./item.php?id=". $prodrow['id'] . "'><img src='./images/" . $prodrow['image']. "' alt='". $prodrow['name'] . "' height='150px' width='150px'></a></td>";
		}
    echo "<td>";
    echo "<form action='addtobasket.php?id=". $prodrow['id'] . "' method='POST'>";
    echo "<a href='./item.php?id=". $prodrow['id'] . "'><h2>" . $prodrow['name'] . "</h2></a>";
    echo "<p>" . $prodrow['description'];
    echo "<table cellpadding='10'>";
    echo "<tr>";
    echo "<td><strong>$". sprintf('%.2f', $prodrow['price']) . "</strong></td>";
    echo "<td><input type='submit' name='submit' value='Add to basket'></td>";
    echo "</tr>";
    echo "</form>";
    echo "<form action='products.php?id=". $prodrow['id'] . "' method='POST'>";
    echo "<tr>";
    echo "<td></td>";
    echo "<td><input type='submit' name='submit_gift' value='Buy as Gift'></td>";
    echo "</tr>"; 
    echo "</table>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
    }
    echo "</table>";
}
require("footer.php");
}

?>
