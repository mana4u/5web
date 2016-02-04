<?php
require("header.php");
unset($_SESSION['SESS_LOGGEDIN']);
unset($_SESSION['SESS_ADMINLOGGEDIN']);
unset($_SESSION['SESS_USERNAME']);
unset($_SESSION['SESS_USERID']);
session_destroy();
echo("<script>alert('Plese vist again')</script>");
echo("<script>window.location = 'index.php';</script>");
?>
