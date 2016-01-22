<?php
session_start();
require("header.php");
if(isset($_SESSION['SESS_LOGGEDIN']))
{
	$total = 0;
    $custsql = "SELECT id from orders WHERE customer_id = ". $_SESSION['SESS_USERID'];
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
        echo "<p><h2><a href='https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=kmana4u%40gmmail.com&item_name=". urlencode($config_sitename)
        . "+Order&item_number=PROD" . $_SESSION['SESS_USERID']."&amount=" . urlencode(sprintf('%.2f',$total)) . "&no_note=1&currency_code=CAD&lc=US&submit.x=41&submit.y=15'>Pay with PayPal</a></h2></p>";
        require("footer.php");
    }
}
else
{
    echo("<script>alert('Please Login first')</script>");
    echo("<script>window.location = 'login.php';</script>");
}
?>
