<?php
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
		echo "<td><a href='./item.php?id=". $prodrow['id'] . "'><img src='./images/dummy.jpg' alt='". $prodrow['name'] . "'></a></td>";
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
    echo "<td>Select Quantity <select name='amountBox'>";
    for($i=1;$i<=50;$i++)
    {
        echo "<option>" . $i . "</option>";
    }
    echo "</select></td>";
    echo "<td><strong>$". sprintf('%.2f', $prodrow['price']) . "</strong></td>";
    echo "<td><input type='submit' name='submit' value='Add to basket'></td>";
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
		echo "<td><a href='./item.php?id=". $prodrow['id'] . "'><img src='./images/dummy.jpg' alt='". $prodrow['name'] . "'></a></td>";
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
    echo "<td>Select Quantity <select name='amountBox'>";
    for($i=1;$i<=50;$i++)
    {
        echo "<option>" . $i . "</option>";
    }
    echo "</select></td>";
    echo "<td><strong>$". sprintf('%.2f', $prodrow['price']) . "</strong></td>";
    echo "<td><input type='submit' name='submit' value='Add to basket'></td>";
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
