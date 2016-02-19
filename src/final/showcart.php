<?php
session_start();
require("header.php");
if(isset($_SESSION['SESS_LOGGEDIN']))
{
	if(isset($_POST['paypalsubmit']))
	{
		
		$upsql = "UPDATE orders SET date = now(), Paid = 1 WHERE id = " . $_SESSION['SESS_ORDERNUM'];
		$upres = mysqli_query($mysqli,$upsql) or die(mysqli_error($mysqli));
		$itemssql = "SELECT * FROM orders WHERE id = " . $_SESSION['SESS_ORDERNUM'];
		unset($_SESSION['SESS_ORDERNUM']);
		$itemsres = mysqli_query($mysqli,$itemssql) or die(mysqli_error($mysqli));
		$row = mysqli_fetch_assoc($itemsres);
		header("Location: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=you%40youraddress.com&item_name=". urlencode($config_sitename)
		. "+Order&item_number=PROD" . $row['id']."&amount=" . urlencode(sprintf('%.2f',$row['total'])) . "&no_note=1&currency_code=USD&lc=US&submit.x=41&submit.y=15");
	}
	
	$total = 0;
    $custsql = "SELECT id from orders WHERE Paid = 0 AND customer_id = ". $_SESSION['SESS_USERID'];
    $custres = mysqli_query($mysqli,$custsql) or die(mysqli_error($mysqli));
	$custnumrows = mysqli_num_rows($custres);
	if($custnumrows != 0)
    {
        $custrow = mysqli_fetch_assoc($custres);
		$itemssql = "SELECT products.*, orderitems.*, orderitems.id AS itemid FROM products, orderitems WHERE orderitems.product_id =products.id AND order_id = " . $custrow['id'];
		$itemsres = mysqli_query($mysqli,$itemssql) or die(mysqli_error($mysqli));
		$itemnumrows = mysqli_num_rows($itemsres);
    }
    
    if($custnumrows  == 0)
    {
        echo "You have not added anything to your shopping cart yet.";
    }
	elseif($itemnumrows  == 0)
    {
        echo "You have not added anything to your shopping cart yet.";
    }
    else
    {
        echo "<table cellpadding='10'>";
        echo "<tr>";
        echo "<td></td>";
        echo "<td><strong>Item</strong></td>";
        echo "<td><strong>Quantity</strong></td>";
        echo "<td><strong>Unit Price</strong></td>";
        echo "<td><strong>Total Price</strong></td>";
        echo "<td></td>";
        echo "</tr>";
        while($itemsrow = mysqli_fetch_assoc($itemsres))
        {
            $quantitytotal = $itemsrow['price'] * $itemsrow['quantity'];
            echo "<tr>";
            if(!empty($itemsrow['image'])) 
            {
                echo "<td><img src='images/" .$itemsrow['image'] . "' width='50' alt='". $itemsrow['name'] . "'></td>";
            }
        echo "<td>" . $itemsrow['name'] . "</td>";
        echo "<td>" . $itemsrow['quantity'] . "</td>";
        echo "<td><strong>$" . sprintf('%.2f', $itemsrow['price']) . "</strong></td>";
        echo "<td><strong>$". sprintf('%.2f', $quantitytotal) . "</strong></td>";
        echo "<td>[<a href='delete.php?id=". $itemsrow['itemid'] . "'>X</a>]</td>";
        echo "</tr>";
        $total = $total + $quantitytotal;
        $totalsql = "UPDATE orders SET total = ". $total . " WHERE id = ". $_SESSION['SESS_ORDERNUM'];
        $totalres = mysqli_query($mysqli,$totalsql) or die(mysqli_error($mysqli));
        }
        echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td>TOTAL</td>";
        echo "<td><strong>$". sprintf('%.2f', $total) . "</strong></td>";
        echo "<td></td>";
        echo "</tr>";
        echo "</table>";
        echo "<p><h2><form action='showcart.php' method='POST'><input type='submit' name='paypalsubmit' value='Pay with PayPal'></form>
		</h2></p>";
        require("footer.php");
    }
}
else
{
    echo("<script>alert('Please Login first')</script>");
    echo("<script>window.location = 'login.php';</script>");
}
?>
