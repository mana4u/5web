<?php

require("header.php");

if(isset($_SESSION['SESS_ADMINLOGGEDIN']))
{
		echo "<h3><a href=adminhistory.php>Completed Orders</a> -";
		echo " <a href=gifthistory.php>Purchased Gift Cards</a> -";
        echo " <a href=addProduct.php>Add a Product</a> -";
		echo " <a href=editProduct.php>Edit/Delete a Product</a> -";
		echo " <a href=sendemail.php>Email</a></h3>";	

	$custsql = "SELECT * from redeem,products where redeem.pro_id=products.id";
    $custres = mysqli_query($mysqli,$custsql) or die(mysqli_error($mysqli));
	$custnumrows = mysqli_num_rows($custres);
	if($custnumrows != 0)
    {   
		
		echo "<table cellspacing=10>";
		echo "<th></th>";
		echo "<th>Name</th>";
		echo "<th>Date</th>";
		echo "<th>Purchased Email</th>";
		echo "<th>Code</th>";
		echo "<th>Price</th>";
		echo "<th>Used</th>";
		while($row = mysqli_fetch_assoc($custres))
		{
		echo "<tr>";
		if(empty($row['image'])) {
		echo "<td><img src='./images/dummy.jpg' width='50' alt='". $row['name'] . "'></td>";
		}
		else {
		echo "<td><img src='./images/". $row['image'] . "' width='50' alt='". $row['name'] . "'></td>";
		}
		echo "<td>".$row['name']."</td>";
		echo "<td>". date("D jS F Y g.iA", strtotime($row['date'])). "</td>";
		echo "<td>".$row['user_email']."</td>";
		echo "<td>".$row['code']."</td>";
		echo "<td>$".$row['price']."</td>";
		if(($row['used'])==0) {
		echo "<td>Not used</td>";
		}
		else {
		echo "<td>Used</td>";
		}
		echo "</tr>";
		}
		echo "</table>";		
    }
    else
	{
		echo "<strong>No orders</strong>";
    }

}
else
{
    echo("<script>alert('You are not administer.')</script>");
    echo("<script>window.location = 'login.php';</script>");
}
?>
