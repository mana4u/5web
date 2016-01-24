<?php

require("header.php");
$prodcatsql = "SELECT * FROM products";
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
    echo "<h2>" . $prodrow['name'] . "</h2>";
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
    echo "<td><input type='submit' name='submit' value='Add to Cart'></td>";
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
