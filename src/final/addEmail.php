<?php
session_start();
include ("gmail.php");
require("config.php");
if(isset($_POST['submitN'])){
	 if ((filter_input(INPUT_POST, 'emailN'))){
            $email = strtolower(filter_input(INPUT_POST, 'emailN'));
            $newslettersql = "SELECT * FROM newsletter WHERE email = '".$email."';";
            $newslres = mysqli_query($mysqli,$newslettersql) or die(mysqli_error($mysqli));
            $numrows = mysqli_num_rows($newslres);
            if ($numrows > 0){
                echo("<script>alert('Email address already being used');</script>");
            } else {
                $addrecsql = "INSERT INTO newsletter VALUES ('".$email."');";
                $res = mysqli_query($mysqli,$addrecsql) or die(mysqli_error($mysqli));
				$subject = "Thank you for signing up!";
                $message = "<p>Hello. I am Dorothy Biagioni.Thank you for sighing for our Newsletter!</p>";
                gmail($email, $subject, $message);
            }
                if ($res == true){
                    echo("<script>alert('Thank you for signing up for the newsletter $email');</script>");
                    echo("<script>location.href = 'index.php';</script>");
                } else {
                    echo ("<script>alert('Something went wrong, please try again later');</script>");
                    echo("<script>location.href = 'index.php';</script>");
                }
             } else {
                 echo("<script>alert('please enter your email');</script>");
                 echo("<script>location.href = 'index.php';</script>");
             }
} else{
    echo("<script>location.href = 'index.php';</script>");
}
?>


