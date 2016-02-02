<?php
require("header.php");
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
	<h2>Current Freebie:</h2>
    </body>
</html>

<?php
$prodcatsql = "SELECT * FROM products WHERE freebie = 1";
$prodcatres = mysqli_query($mysqli,$prodcatsql) or die(mysqli_error($mysqli));
$numrows = mysqli_num_rows($prodcatres);

if($numrows == 0)
{
    echo "<h1>No products</h1>";
    echo "There are no products in this category.";
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
    echo "<form action='addtobasket.php?id=". $prodrow['id'] . "' method='POST'>";
    echo "</form>";
    echo "<h2>" . $prodrow['name'] . "</h2>";
    echo "<p>" . $prodrow['description']. "</p>";
	echo "</td>";
	echo "</tr>";
	}
	echo "</table>";
}

if(!isset($_SESSION['SESS_LOGGEDIN'])){
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
else{
}
require("footer.php");
?>