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
        <img src='./images/header.jpg' usemap="#logos">
		<map name="logos">
			<area shape="rect" coords="673,96,730,150" href="https://www.facebook.com/EFTDorothy?ref=br_rs" title="Facebook" alt="Facebook" />
			<area shape="rect" coords="752,96,810,150" href="https://www.youtube.com/channel/UCT2BE3NbSFZPZpYKja4EM5g" title="Youtube" alt="Youtube" />
			<area shape="rect" coords="830,96,883,150" href="https://twitter.com/eftdorothy" title="Twitter" alt="Twitter" />
			<area shape="rect" coords="906,96,963,150" href="https://www.linkedin.com/in/dorothybiagioni" title="Linkedin" alt="Linkedin" />
		</map>
    </div>
	
    <div id="menu">
        <a href="<?php echo $config_basedir; ?>index.php">Home</a> -
        <a href="<?php echo $config_basedir; ?>about.php">About me</a> -
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
