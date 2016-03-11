<?php

require("header.php");
require("config.php");

$usersql = "SELECT * From customers WHERE id = ". $_SESSION['SESS_USERID'];
$userres = mysqli_query($mysqli,$usersql) or die(mysqli_error($mysqli));
$userrow = mysqli_fetch_assoc($userres);
$check = filter_input(INPUT_POST, "redeemcode");
$realcode = "SELECT code from redeem WHERE code == '".$check."' ";	

$total = 0;
$custsql = "SELECT * from redeem WHERE code = '".$check."' ";
$custres = mysqli_query($mysqli,$custsql) or die(mysqli_error($mysqli));
$custnumrows = mysqli_num_rows($custres);
$custnumres = mysqli_fetch_assoc($custres);

if(isset($_POST['submit_redeem']))
{	
		$pro=$_POST['confrim'];
		$custsql = "SELECT * from redeem WHERE code = '".$pro."' ";	
		$custres = mysqli_query($mysqli,$custsql) or die(mysqli_error($mysqli));
		$custnumrows = mysqli_num_rows($custres);
		$custnumres = mysqli_fetch_assoc($custres);
		$sql = "INSERT INTO orders(customer_id, date, total, Paid) VALUES('". $_SESSION['SESS_USERID']. "', NOW(),'".$custnumres['price']."','1')";
		mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
		$_SESSION['OLD_SESS_ORDERNUM'] = $_SESSION['SESS_ORDERNUM'];
		$_SESSION['SESS_ORDERNUM'] = mysqli_insert_id($mysqli);
		$buyid = $_SESSION['SESS_ORDERNUM'];
		$itemsql = "INSERT INTO orderitems(order_id, product_id) VALUES('".$_SESSION['SESS_ORDERNUM']."', '".$custnumres['pro_id']."')";
		mysqli_query($mysqli,$itemsql) or die(mysqli_error($mysqli));
		$_SESSION['SESS_ORDERNUM'] = $_SESSION['OLD_SESS_ORDERNUM'];
		$upsql ="UPDATE redeem SET used=1 WHERE code = '".$pro."'";
		mysqli_query($mysqli,$upsql) or die(mysqli_error($mysqli));
		echo("<script>alert('Thank you for reedem your code')</script>");
		echo("<script>window.location = 'history_mo.php';</script>");
   
}

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
    height: 450px;
}


</style>
<body>

<div class="move">

<table class="one" style = "width:60%">
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
<tr><td><a href="redeem_mo.php"><u>Redeem giftcode</u></a></td></tr>

</table>

</div>

<td class="one" valign=top width="40%">

<table>
<form id="redeem" action="" method="post">
<h3>Please write your code to redeem gift card</h3>
<tr><td>Code: <input type="text" name="redeemcode" id="redeemcode" value="<?php echo $check;?>" /></td></tr>
<tr><td><input type="submit" name="submit" value="Submit"/>
	<input type="submit" value="Cancel"></td></tr>
</form>
</table>





<?php

	
if(isset($_POST['submit']))
{
	if(($custnumrows != 0)&&(strlen($check)>0)&&($custnumres['used']==0))
    {   
		$itemssql = "SELECT * FROM products WHERE id = " .$custnumres['pro_id']. ";";
		$itemsres = mysqli_query($mysqli,$itemssql) or die(mysqli_error($mysqli));
		$itemsrow = mysqli_fetch_assoc($itemsres);
		echo "<table >";
		echo "<th></th>";
		echo "<th>Product</th>";
		echo "<th>Price</th>";
		echo "<th></th>";
		echo "<tr>";
		if(empty($itemsrow['image'])) {
		echo "<td><img src='./images/dummy.jpg' width='50' alt='". $itemsrow['name'] . "'></td>";
		}
		else {
		echo "<td><img src='./images/". $itemsrow['image'] . "' width='50' alt='". $itemsrow['name'] . "'></td>";
		}
		echo "<td>" . $itemsrow['name'] . "</td>";
		echo "<td><strong>$" . sprintf('%.2f',$itemsrow['price']) . "</strong></td>";
		echo "<td>";
		echo "<form action='' method='POST'>";
		echo "<input type='hidden' name='confrim' value='".$check."'>";
		echo "<input type='submit' name='submit_redeem' value='Redeem Coupon'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
    }
    elseif(($custnumrows != 0)&&(strlen($check)>0)&&($custnumres['used']==1)){
		echo "<strong>The code is already used</strong>";
	}
	else{
		echo "<strong>Incorrect code</strong>";
    }
		
}
	
	

	


?>


</td>
</table>
</div>

</body>

</html>

