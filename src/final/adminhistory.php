<?php
session_start();
require("header.php");

if(isset($_SESSION['SESS_ADMINLOGGEDIN']))
{
		echo "<h3><a href=adminhistory.php>Completed Orders</a> -";
        echo " <a href=addProduct.php>Add a Product</a> -";
		echo " <a href=sendemail.php>Email</a></h3>";	
	$total = 0;
    $custsql = "SELECT orders.id, orders.date, orders.total, customers.email from orders,customers WHERE Paid = 1 and orders.customer_id=customers.id";
    $custres = mysqli_query($mysqli,$custsql) or die(mysqli_error($mysqli));
	$custnumrows = mysqli_num_rows($custres);
	if($custnumrows != 0)
    {   
		
		echo "<table cellspacing=10>";
		while($row = mysqli_fetch_assoc($custres))
		{
		echo "<tr>";
		echo "<td>[<a href='admindetail.php?id=" . $row['id']. "'>View</a>]</td>";
		echo "<td>". date("D jS F Y g.iA", strtotime($row['date'])). "</td>";
		echo "<td>";
		echo "</td>";
		echo "<td>".$row['email']."</td>";
		echo "<td>$" . sprintf('%.2f',$row['total']) . "</td>";
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
