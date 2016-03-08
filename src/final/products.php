<?php
function random_code( $length = 16 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $code = substr( str_shuffle( $chars ), 0, $length );
    return $code;
}
include ("gmail.php");
require("header.php");
if(isset($_POST['submit'])){
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
    echo "</table>";
    echo "</form>";
	if(isset($_SESSION['SESS_LOGGEDIN'])) {
	echo "<form action='products.php' method='POST'>";
	echo "<td><input type='hidden' name='pro_id' value='".$prodrow['id']."'><input type='hidden' name='pro_price' value='".$prodrow['price']."'><input type='submit' name='submitg' value='Gift'></td>";
	echo "</form>";
	}
    echo "</td>";
    echo "</tr>";
    }
    echo "</table>";
	}
}elseif(isset($_POST['submitg'])){
		$pro_id=$_POST['pro_id'];
		$pro_price=$_POST['pro_price'];
		$usersql = "SELECT * From customers WHERE id = ". $_SESSION['SESS_USERID'];
		$userres = mysqli_query($mysqli,$usersql) or die(mysqli_error($mysqli));
		$userrow = mysqli_fetch_assoc($userres);
		$email_rec = $userrow['email'];
		$code = random_code(16);
		$subject = "This is a gift Card code";
		$message = "Please go to Login/Register->Myaccount->Redeem Giftcard. Thank you.<br>
			If you have any questions, Please email me back.</p><p>Redeem code: $code</p>";
			gmail($email_rec, $subject, $message);
		$sql = "INSERT INTO redeem VALUES('','".$email_rec."','".$pro_id."','".$code."','0','".$pro_price."',NOW())";
		mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
		header("Location: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=you%40youraddress.com&item_name=". urlencode($config_sitename)
		. "+Order&item_number=Gift-" . $userrow['lastName']."&amount=" . urlencode(sprintf('%.2f',$pro_price)) . "&no_note=1&currency_code=CAD&lc=US&submit.x=41&submit.y=15");
}
else{
	
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
    echo "<td><input type='submit' name='submit' value='Add To Basket'></td>";
	echo "</form>";
	if(isset($_SESSION['SESS_LOGGEDIN'])) {
	echo "<form action='products.php' method='POST'>";
	echo "<td><input type='hidden' name='pro_id' value='".$prodrow['id']."'><input type='hidden' name='pro_price' value='".$prodrow['price']."'><input type='submit' name='submitg' value='Gift'></td>";
	echo "</form>";
	}
    echo "</tr>";
    echo "</table>";
   
    echo "</td>";
    echo "</tr>";
    }
    echo "</table>";
}
require("footer.php");
}

?>
