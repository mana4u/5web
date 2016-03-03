<?php
require("header.php");
if(isset($_POST['buynowsubmit']))
	{
		if(!isset($_SESSION['SESS_LOGGEDIN'])){
		echo("<script>alert('Please Login first')</script>");
		echo("<script>window.location = 'login.php';</script>");
		}else{
		$sql = "INSERT INTO orders(customer_id, date,total,Paid) VALUES(". $_SESSION['SESS_USERID']. ", NOW(),".$_SESSION['buynow_price'].",1)";
		mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
		$_SESSION['OLD_SESS_ORDERNUM'] = $_SESSION['SESS_ORDERNUM'];
		$_SESSION['SESS_ORDERNUM'] = mysqli_insert_id($mysqli);
		$buyid = $_SESSION['SESS_ORDERNUM'];
		$itemsql = "INSERT INTO orderitems(order_id, product_id, quantity) VALUES(". $_SESSION['SESS_ORDERNUM']. ", " . $_SESSION['buynow_id'] . ",1)";
		mysqli_query($mysqli,$itemsql) or die(mysqli_error($mysqli));
		$_SESSION['SESS_ORDERNUM'] = $_SESSION['OLD_SESS_ORDERNUM'];		
		header("Location: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=you%40youraddress.com&item_name=". urlencode($config_sitename)
		. "+Order&item_number=ORD-" . $buyid ."&amount=" . urlencode(sprintf('%.2f',$_SESSION[buynow_price])) . "&no_note=1&currency_code=CAD&lc=US&submit.x=41&submit.y=15");
		}
	}

	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="refresh">
        <title>Home</title>
    </head>
    
    <body>
        
        <h1>Home</h1>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/dEOSwrxwpcU" frameborder="0" allowfullscreen></iframe>
	<h2>Current Special</h2>
    </body>
</html>

<?php
$prodcatsql = "SELECT * FROM products WHERE promotion = 1";
$prodcatres = mysqli_query($mysqli,$prodcatsql) or die(mysqli_error($mysqli));
$numrows = mysqli_num_rows($prodcatres);
$fprodcatsql = "SELECT * FROM products WHERE freebie = 1";
$fprodcatres = mysqli_query($mysqli,$fprodcatsql) or die(mysqli_error($mysqli));
$fnumrows = mysqli_num_rows($fprodcatres);


if($numrows == 0)
{
    echo "<h1>No Current Special</h1>";
}

else
	
{
    echo "<table cellpadding='10'>";
    while($prodrow = mysqli_fetch_assoc($prodcatres))
    {
        echo "<tr>";
        if(!empty($prodrow['image'])) 
        {
            echo "<td><img src='./images/" . $prodrow['image']. "' alt='". $prodrow['name'] . "'></td>";
		}
		echo "<td>";
	$_SESSION['buynow_id'] = $prodrow['id'];
    echo "<form action='addtobasket.php?id=". $prodrow['id'] . "' method='POST'>";
    echo "</form>";
    echo "<h2>" . $prodrow['name'] . "</h2>";
    echo "<p>" . $prodrow['description']. "</p>";
	$_SESSION['buynow_price'] = $prodrow['price'];
	echo "<strong>$" . sprintf('%.2f', $_SESSION['buynow_price']) . "</strong></P>";
	echo "<p><h2><form action='index.php' method='POST'><input type='submit' name='buynowsubmit' value='Buy Now'></form>
		  </h2></p>";
	echo "</td>";
	echo "</tr>";
	}
	echo "</table>";
}

	echo "<h2>Current FreeBie</h2>";

if($fnumrows == 0)
{
    echo "<h1>No Current Special</h1>";
}

else
	
{
    echo "<table cellpadding='10'>";
    while($fprodrow = mysqli_fetch_assoc($fprodcatres))
    {
        echo "<tr>";
        if(!empty($fprodrow['image'])) 
        {
            echo "<td><img src='./images/" . $fprodrow['image']. "' alt='". $fprodrow['name'] . "'></td>";
		}
		echo "<td>";
	$_SESSION['buynow_id'] = $fprodrow['id'];
    echo "<form action='addtobasket.php?id=". $fprodrow['id'] . "' method='POST'>";
    echo "</form>";
    echo "<h2>" . $fprodrow['name'] . "</h2>";
    echo "<p>" . $fprodrow['description']. "</p>";
	$_SESSION['buynow_price'] = 0;
	echo "<strong>$" . sprintf('%.2f', $_SESSION['buynow_price']) . "</strong></P>";
	echo "<p><h2><form action='index.php' method='POST'><input type='submit' name='buynowsubmit' value='Buy Now'></form>
		  </h2></p>";
	echo "</td>";
	echo "</tr>";
	}
	echo "</table>";
}


if(isset($_SESSION['SESS_LOGGEDIN']) || isset($_SESSION['SESS_ADMINLOGGEDIN'])){

}
else{
	echo "<html>";
echo "<body>";
echo "<br/>";
echo "<h2>Sign up for our newsletter</h2>";
echo "<p>receive weekly E-mails from Dorothy about the latest news and offers!</p>";
echo "<form action='addEmail.php' method='POST'>";
echo "<table>";
echo "<tr>";
echo "<td><strong>Email</strong></td>";
echo "<td><input type='textbox' name='emailN' id='emailN'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type='submit' name='submitN' value='Sign Up'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "</body>";
echo "</html>";
}
require("footer.php");
?>