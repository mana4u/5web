<?php

require("header.php");
$prodcatsql = "SELECT * FROM products WHERE id = " . $_GET['id'] . ";";
$prodcatres = mysqli_query($mysqli,$prodcatsql) or die(mysqli_error($mysqli));
$prodrow = mysqli_fetch_assoc($prodcatres);

    echo "<table cellpadding='10'>";

        echo "<tr>";
        if(empty($prodrow['image'])) {
		echo "<td><img src='./images/dummy.jpg' alt='". $prodrow['name'] . "'></td>";
		}	
		else {
		echo "<td><img src='./images/" . $prodrow['image']. "' alt='". $prodrow['name'] . "'></td>";
		}
    echo "<td>";
    echo "<form action='addtobasket.php?id=". $prodrow['id'] . "' method='POST'>";
    echo "<h2>" . $prodrow['name'] . "</h2>";
    echo "<p>Long Description";
	echo "<p>Long Description";
	echo "<p>Design need to be changed.";

    echo "<tr>";
    echo "<td>Select Quantity <select name='amountBox'>";
    for($i=1;$i<=50;$i++)
    {
        echo "<option>" . $i . "</option>";
    }
    echo "</select></td>";
    echo "<td><strong>Price $". sprintf('%.2f', $prodrow['price']) . "</strong></td>";
    echo "<td>  <input type='submit' name='submit' value='Add to basket'></td>";
    echo "</tr>";
    echo "</table>";
    echo "</form>";
    


require("footer.php");


?>
