<?php
session_start();
require("header.php");
if(isset($_SESSION['SESS_LOGGEDIN']))
{
		
	$total = 0;
    $custsql = "SELECT * from orders WHERE Paid = 1 AND customer_id = ". $_SESSION['SESS_USERID']." order by date";
    $custres = mysqli_query($mysqli,$custsql) or die(mysqli_error($mysqli));
	$custnumrows = mysqli_num_rows($custres);
	if($custnumrows != 0)
    {       
		echo "<table cellspacing=10>";
		while($row = mysqli_fetch_assoc($custres))
		{
		echo "<tr>";
		echo "<td>[<a href='detail.php?id=" . $row['id']. "'>View</a>]</td>";
		echo "<td>". date("D jS F Y g.iA", strtotime($row['date'])). "</td>";
		echo "<td>";
		echo "</td>";
		echo "<td>$" . sprintf('%.2f',$row['total']) . "</td>";
		echo "<td>";
		echo "</td>";
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
    echo("<script>alert('Please Login first')</script>");
    echo("<script>window.location = 'login.php';</script>");
}
?>
