<?php
require("header.php"); 
		echo "<h3><a href=adminhistory.php>Completed Orders</a> -";
        echo " <a href=addProduct.php>Add a Product</a> -";
		echo " <a href=sendemail.php>Email</a></h3>";
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
<head>
  <script src="/final/tinymce/tinymce.min.js"></script>
  <script type="text/javascript">
tinymce.init({
  selector: 'textarea',
  height: 400,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools'
  ],
  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
  </script>
</head>
<table>
<tr><td>Select</td><td><button onclick="Sub()">Subscriber</button> <button onclick="Customer()">Customers</button> <button onclick="Everyone()">Everyone</button> <button onclick="None()">None</button></td></tr>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>Recipient</td><td><input type="text" name="Recipient" id="recep" size="129"></input></td></tr>
<tr><td>Subject</td><td><input type="text" name="Subject" size="129"></input></td></tr>
<tr><td>Message</td><td><textarea rows="20" id="mytextarea" name ="Message" cols="130"></textarea></input></td></tr>
<tr><td></td><td><input type='submit' name='submit' value='Send Emails'></td></tr>
</form>
</table>




<?php
	require("footer.php");
?>
