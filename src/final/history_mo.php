
<?php
require("header.php");
require("config.php");

$usersql = "SELECT * From customers WHERE id = ". $_SESSION['SESS_USERID'];
$userres = mysqli_query($mysqli,$usersql) or die(mysqli_error($mysqli));
$userrow = mysqli_fetch_assoc($userres);

?>

<!DOCTYPE html>
<html>
<style>
table.one {
    border: 1px solid grey;
    border-collapse: collapse;
}
td.one {
    border: 1px solid grey;
    border-collapse: collapse;
    padding: 30px;
}
div.move {
    position: relative;
    top:50px;
}
div.min {
    height: 360px;
}


</style>
<body>

<div class="move">

<table class="one" align=center style = "width:60%">
<tr>
<td class="one" bgcolor="#fff4b3" valign=top width="20%">


<div class="min">

<table>
<h2>Hello, <br>
<?php echo $userrow['firstName'];?><?php echo " ";?><?php echo $userrow['lastName'];?>&nbsp;
</h2>
</tr>
<hr>

<h2>User Menu ¡å</h2>
<tr><td><a href="myaccount.php"><u>Change User Information</u></a></td></tr>
<tr><td><a href="history_mo.php"><u>Purchase History</u></a></td></tr>
<tr><td><a href="downloads_mo.php"><u>Downloads</u></a></td></tr>

</table>

</div>

<td class="one" valign=top width="40%">

<?php
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

</table>
</div>

</body>

</html>
