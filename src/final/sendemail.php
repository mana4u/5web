<?php
require("header.php"); 
include ("gmail.php");
$squery = "SELECT * FROM newsletter";
$sresult = mysqli_query($mysqli, $squery);
$semail = "";
while ($srow = mysqli_fetch_array($sresult)) 
{
	$semail = $semail . $srow['email'].", ";
}

$cquery = "SELECT * FROM customers";
$cresult = mysqli_query($mysqli, $cquery);
$cemail = "";
while ($crow = mysqli_fetch_array($cresult)) 
{
	$cemail = $cemail . $crow['email'].", ";
}
$aemail = $semail . $cemail;
if(isset($_POST['submit'])){
	 if ((filter_input(INPUT_POST, 'Recipient'))&& (filter_input(INPUT_POST, 'Subject')) &&
		 (filter_input(INPUT_POST, 'Message'))){
			$email = $_POST['Recipient'];
			$subject = $_POST['Subject'];	 
			$message = $_POST['Message'];
				gmail($email, $subject, $message);
				echo("<script>alert('Emails have been sent');</script>");
				echo("<script>location.href = 'sendemail.php';</script>");
             }else {
                 echo("<script>alert('please fill All the forms');</script>");
                 echo("<script>location.href = 'sendemail.php';</script>");
             }
}
?>

<script>
function Sub() {
    document.getElementById("recep").setAttribute("value", " <?php echo $semail; ?>");
}
function Customer() {
    document.getElementById("recep").setAttribute("value", " <?php echo $cemail; ?>");
}
function Everyone() {
    document.getElementById("recep").setAttribute("value", " <?php echo $aemail; ?>");
}
function None() {
    document.getElementById("recep").setAttribute("value", "");
}
</script>

<table>
<tr><td>Select</td><td><button onclick="Sub()">Subscriber</button> <button onclick="Customer()">Customers</button> <button onclick="Everyone()">Everyone</button> <button onclick="None()">None</button></td></tr>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>Recipient</td><td><input type="text" name="Recipient" id="recep" size="129"></input></td></tr>
<tr><td>Subject</td><td><input type="text" name="Subject" size="129"></input></td></tr>
<tr><td>Message</td><td><textarea rows="20"  name ="Message" cols="130"></textarea></input></td></tr>
<tr><td></td><td><input type='submit' name='submit' value='Send Emails'></td></tr>
</form>
</table>




<?php
	require("footer.php");
?>
