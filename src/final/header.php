<?php
session_start();
require("config.php");

?>
<!DOCTYPE HTML>
<head>
    <title><?php echo $config_sitename; ?></title>
    <link href="css/stylesheet.css" rel="stylesheet" type="text/css">
</head>
<body>	
    <div id="header">
        <img src='./images/header.jpg'>
    </div>
    <div id="menu">
        <a href="<?php echo $config_basedir; ?>home.php">Home</a> -
        <a href="<?php echo $config_basedir; ?>index.php">About me</a> -
        <a href="<?php echo $config_basedir; ?>products.php">Shop</a> -
        <?php
        if(!isset($_SESSION['SESS_LOGGEDIN'])) {
        echo "<a href=login.php>Log In</a> " ;
        }
	if(isset($_SESSION['SESS_LOGGEDIN'])) {
		echo "<a href=showcart.php>Shopping Cart</a> -";
        echo "  <a href=myaccount.php>My Account</a> " ;
	}
        ?>
	<?php
	if(isset($_SESSION['SESS_LOGGEDIN'])) {
        echo " - <a href=logout.php>Log Out</a> " ;
        }
	?>
    </div>
    <div id="container">
    <div id="main">
