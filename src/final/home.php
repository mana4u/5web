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
        
        <table cellpadding="1">
            <tr>
                <td style="padding-left:20px;padding-right:20px;"><a href="https://www.facebook.com/EFTDorothy?ref=br_rs">
                        <img src="./images/facebook.jpg" alt="Link to Dorothy's facebook page" width="100" height="50"</a></td>
                <td style="padding-left:20px;padding-right:20px;"><a href="https://www.youtube.com/channel/UCT2BE3NbSFZPZpYKja4EM5g">
                        <img src="./images/youtube.jpg" alt="Link to Dorothy's youtube page" width="100" height="50"</a></td>
                <td style="padding-left:20px;padding-right:20px;"><a href="https://twitter.com/eftdorothy">
                        <img src="./images/twitter.png" alt="Link to Dorothy's Twitter page" width="100" height="50"</a></td>         
                <td style="padding-left:20px;padding-right:20px;"><a href="https://www.linkedin.com/in/dorothybiagioni">
                        <img src="./images/LI.png" alt="Link to Dorothy's LinkedIn page" width="100" height="50"</a></td>
            </tr>
        </table>
        <h1>Home</h1>
        <p>Welcome to DorothyBiagioni.com, home of Dorothy///////////////</p><br/>
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
//echo "<html>";
//echo "<body>";
echo "<br/>";
echo "<h2>Sign up for our newsletter</h2>";
echo "<p>receive weekly E-mails from Dorothy about the latest news and offers!</p>";
echo "<form action='login.php' method='POST'>";
echo "<table>";
echo "<tr>";
echo "<td>Email</td>";
echo "<td><input type='textbox' name='email'>";
echo "</tr>";
echo "<tr>";
echo "<td></td>";
echo "<td><input type='submit' name='submit' value='Sign Up'>";
echo "</tr>";
echo "</table>";
echo "</form>";
//echo "</body>";
//echo "</html>";
}
else{
}
require("footer.php");
?>