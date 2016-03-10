<?php
require("header.php");
?>
<table cellspacing="10">
    <tr>
    <td colspan="2">
	<h2>Kickstart 2016!   <p>
	Make this YOUR year - filled with everything you have ever wanted. Give yourself a Gift of Life.</h2></p>
    </td>
    <tr>
        <td>
            <img src="images/dorothy.jpg" alt="Picture of Dorothy">
        </td>
        <td>
            <p>Is your Life less than what you desire?  Less than what you dream of? <p>

	Have you experienced Betrayal? (betrayal from a love partner, business partner, family member, friend, co-worker...)  Are you living from Restrictive Self-Vows? Self-Loathing? Silent Shame?  Are you tired of feeling less than... are you tired of living in mental/emotional poverty, money poverty, health poverty? Have you given up on ever achieving and living the Life you desire?   This could include; Love, Money, Career, Business, Marriage and Romance, Weight - too high or too low, Athletic Achievement, Low Self-Acceptance?<p>

	Wouldn't you just love to live your Life without carrying the "secrets" the "drudge" of whatever it is that is holding you back?  Sure you would.  And I can help you with your Transformation.  Even if you have no clear memory of what it is that has you locked up, we can "unlock" you</p>
        </td>
    </tr>
</table>


	<div class="container">
<!-- Feedback Form Starts Here -->
<div id="feedback">
<!-- Heading Of The Form -->
<div class="head">
<h3>FeedBack Form</h3>
<p>Ask me any question!</p>
</div>
<!-- Feedback Form -->
<form action="#" id="form" method="post" name="form">
<input name="vname" placeholder="Your Name" type="text" value=""></br>
<input name="vemail" placeholder="Your Email" type="text" value=""></br>
<input name="sub" placeholder="Subject" type="text" value=""></br>
<textarea name="msg" placeholder="Type your text here..." rows="10" cols="90"></textarea></br>
<input id="send" name="submit" type="submit" value="Send Feedback">
</form>
</div>
<!-- Feedback Form Ends Here -->
</div>
	
	
	<?php
if(isset($_POST["submit"])){
// Checking For Blank Fields..
if($_POST["vname"]==""||$_POST["vemail"]==""||$_POST["sub"]==""||$_POST["msg"]==""){
echo "Fill All Fields..";
}else{
// Check if the "Sender's Email" input field is filled out
$email=$_POST['vemail'];
// Sanitize E-mail Address
$email =filter_var($email, FILTER_SANITIZE_EMAIL);
// Validate E-mail Address
$email= filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email){
echo "Invalid Sender's Email";
}
else{
$subject = $_POST['sub'];
$message = $_POST['msg'];
$headers = 'From:'. $email . "\r\n"; // Sender's Email
$headers .= 'Cc:'. $email . "\r\n"; // Carbon copy to Sender
// Message lines should not exceed 70 characters (PHP rule), so wrap it
$message = wordwrap($message, 70);
// Send Mail By PHP Mail Function
mail("kimpossible014@gmail.com", $subject, $message, $headers);
echo "Your mail has been sent successfuly ! Thank you for your feedback";
}
}
}
?>
	
	

	<?php
require("footer.php");
?>



		