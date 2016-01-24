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
        <p>Welcome to DorothyBiagioni.com, home of dorothy///////////////</p>
		<h3>Current Freebie:</h3>
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

			require("footer.php");
?>		
    </body>
</html>
