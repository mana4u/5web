<?php
session_start();
require("header.php");
echo "<h1>Order Details</h1>";

$ordsql = "SELECT * from orders WHERE id = " . $_GET['id'] . ";";
$ordres = mysqli_query($mysqli,$ordsql) or die(mysqli_error($mysqli));
$ordrow = mysqli_fetch_assoc($ordres);
echo "<table cellpadding=10>";
echo "<tr><td><strong>Order Number</strong></td><td>" . $ordrow['id'] . "</td>";
echo "<tr><td><strong>Date of order</strong></td><td>" . date('D jS F Y g.iA',strtotime($ordrow['date'])) . "</td>";
echo "</td>";
echo "</table>";
$itemssql = "SELECT products.*, orderitems.*,orderitems.id AS itemid FROM products, orderitems WHERE orderitems.product_id = products.id AND order_id = " . $_GET['id'] . ";";
$itemsres = mysqli_query($mysqli,$itemssql) or die(mysqli_error($mysqli));
$itemnumrows = mysqli_num_rows($itemsres);
echo "<h1>Products Purchased</h1>";
echo "<table cellpadding=10>";
echo "<th></th>";
echo "<th>Product</th>";
echo "<th>Price</th>";
while($itemsrow = mysqli_fetch_assoc($itemsres))
{
$quantitytotal = $itemsrow['price'];
echo "<tr>";
if(empty($itemsrow['image'])) {
echo "<td><img src='./images/dummy.jpg' width='50' alt='". $itemsrow['name'] . "'></td>";
}
else {
echo "<td><img src='./images/". $itemsrow['image'] . "' width='50' alt='". $itemsrow['name'] . "'></td>";
}
echo "<td>" . $itemsrow['name'] . "</td>";

echo "<td><strong>$" . sprintf('%.2f',$itemsrow['price']) . "</strong></td>";
echo "</tr>";
@$total = $total + $quantitytotal;

}
echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>TOTAL</td>";
echo "<td><strong>$" . sprintf('%.2f', $total). "</strong></td>";
echo "</tr>";
echo "</table>";
require("footer.php");
?>
