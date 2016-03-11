<?php
session_start();
require("config.php");
?>
<!DOCTYPE HTML>
<head>
    <title><?php echo $config_sitename; ?></title>
     <link href="css/stylesheet.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="pabicon.ico">
	
</head>
<body>	


    <div id="header">
	<div id="name"><h1>Dorothy Biagioni</h1></div>
	 
			<div class="SM">
			<a href="https://www.facebook.com/EFTDorothy" target="_blank"><img class="socialMedia" src="./images/facebook.png"></a>
			<a href="https://www.instagram.com/coachdorothy" target="_blank"><img class="socialMedia" src="./images/instagram.png"></a>
			<a href="http://dorothybiagioni.tumblr.com" target="_blank"><img class="socialMedia" src="./images/tumbler.png"></a>
			<a href="https://ca.linkedin.com/in/dorothybiagioni" target="_blank"><img class="socialMedia" src="./images/in.png"></a>
			<a href="https://www.youtube.com/channel/UCT2BE3NbSFZPZpYKja4EM5g" target="_blank"><img class="socialMedia" src="./images/youtube.png"></a>
			<a href="https://twitter.com/eftdorothy" target="_blank"><img class="socialMedia" src="./images/twitter.png"></a>
  
</div>
    <ul id="menu"><div id="menuItems">
        <li><a href="<?php echo $config_basedir; ?>index.php">Home</a></li>
        <li><a href="<?php echo $config_basedir; ?>about.php">About</a></li>
        <li><a href="<?php echo $config_basedir; ?>products.php">Shop</a></li>
        <?php
        if(!isset($_SESSION['SESS_LOGGEDIN']) && !isset($_SESSION['SESS_ADMINLOGGEDIN'])) {
        echo "<li><a href=login.php>Log In</a> " ;
        }
	if(isset($_SESSION['SESS_LOGGEDIN'])) {
		echo "<li><a href=showcart.php>Shopping Cart</a></li> ";
        echo "  <li><a href=myaccount.php>My Account</a></li> " ;
	}
	if(isset($_SESSION['SESS_ADMINLOGGEDIN'])) {
		echo "<li><a href=admin.php>Admin Page</a></li> ";
	}
        ?>
	<?php
	if(isset($_SESSION['SESS_LOGGEDIN']) || isset($_SESSION['SESS_ADMINLOGGEDIN'])) {
        echo " <li><a href=logout.php>Log Out</a></li> " ;
        }
	?>
	
    </ul>
    <div id="container">
    <div id="main">
