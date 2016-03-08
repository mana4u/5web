<?php
require("header.php");
require('class.phpmailer.php');
include("class.smtp.php");
		echo "<h3><a href=adminhistory.php>Completed Orders</a> -";
		echo " <a href=gifthistory.php>Purchased Gift Cards</a> -";
        echo " <a href=addProduct.php>Add a Product</a> -";
		echo " <a href=editProduct.php>Edit/Delete a Product</a> -";
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
			$d='upload/';
			$de=$d . basename($_FILES['file']['name']);
			move_uploaded_file($_FILES["file"]["tmp_name"], $de);
			$fileName = $_FILES['file']['name'];
			$filePath = $de;
			
			$mail = new PHPMailer();
			$mail->CharSet = "UTF-8";
			// telling the class to use SMTP
			$mail->IsSMTP();
			// enables SMTP debug information (for testing)
			// 1 = errors and messages
			// 2 = messages only
			$mail->SMTPDebug  = 0;
			// enable SMTP authentication
			$mail->IsHTML(true);
			$mail->SMTPAuth   = true;
			// sets the prefix to the servier
			$mail->SMTPSecure = "ssl";
			// sets GMAIL as the SMTP server
			$mail->Host       = "smtp.gmail.com";
			// set the SMTP port for the GMAIL server
			$mail->Port       = 465;
			// GMAIL username
			$mail->Username   = "cosc213@gmail.com";// use this for now.
			// GMAIL password
			$mail->Password   = "lamp213@okc";// use this for now.
			//Set reply-to email this is your own email, not the gmail account 
			//used for sending emails
			$mail->SetFrom('admin@admin.com');//need to change later
			$mail->FromName = "Dorothy Biagioni";//need to change later
			// Mail Subject
			$mail->Subject    = $subject;

			//Main message
			$mail->Body = $message;

			//Your email, here you will receive the messages from this form. 
			//This must be different from the one you use to send emails, 
			//so we will just pass email from functions arguments
			$addresses = explode(',', $email);
			foreach ($addresses as $address) {
			$mail->AddAddress($address);
			}
			$mail->AddAttachment($filePath, $fileName);
			if(!$mail->Send()) 
			{
				//couldn't send
				return false;
			} 
			else 
			{
				echo("<script>alert('Emails have been sent');</script>");
				echo("<script>location.href = 'sendemail.php';</script>");
			}
			
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
  height: 500,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools jbimages'
  ],
  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages',
  toolbar2: 'preview | forecolor backcolor ',
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
<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>Recipient</td><td><input type="text" name="Recipient" id="recep" size="129"></input></td></tr>
<tr><td>Subject</td><td><input type="text" name="Subject" size="129"></input></td></tr>
<tr><td>Message</td><td><textarea rows="20" id="editor1" name ="Message" cols="130"></textarea></input></td></tr>
<tr><td>Attachment</td><td><input type="file" name="file"></td></tr>
<tr><td></td><td><input type='submit' name='submit' value='Send Emails'></td></tr>
</form>
</table>




<?php
	require("footer.php");
?>
