<?php
session_start();
require("header.php");
if(isset($_SESSION['SESS_ADMINLOGGEDIN'])){
    echo "<h1>Add a Product</h1>";
    echo "<form action='addProduct.php' method='POST'>";
    echo "<table>";
    echo "<tr>";
    echo "<td>name</td><td><input type='Text' name='name' id='name' /></td></tr>";
    echo "<tr><td>catagory</td><td><input type='Text' name='cata' id='cata' /></td></tr>";
    echo "<tr><td>Description</td><td><input type='Text' name='description' id ='description' rows = '3' cols = '80' /></td></tr>";
    echo "<tr><td>Price</td><td><input type='Text' name='price' id='price' /></td></tr>";
    echo "<tr><td>Image</td><td><input type='file' name='fileToUpload' id='fileToUpload' accept='image/*' /></td></tr>";
    echo "<tr><td><input type='submit' name='submit' value='Submit' /></td></tr>";
    echo "</table></form>";
    if(isset($_POST['submit'])){
            if ((!filter_input(INPUT_POST, 'name')) ||
                    (!filter_input(INPUT_POST, 'cata')) ||
                    (!filter_input(INPUT_POST, 'description'))||
                    (!filter_input(INPUT_POST, 'price'))){
                $message = "Please fill in all fields";
                echo( "<SCRIPT>alert('$message');</SCRIPT>");
                echo("<script>location.href = 'addProduct.php';</script>");
            } else {
                $name = filter_input(INPUT_POST, 'name');
                $cata = filter_input(INPUT_POST, 'cata');
                $desc = filter_input(INPUT_POST, 'description');
                $price = filter_input(INPUT_POST, 'price');
                /*
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                    }
                }
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
                */
                $addsql = "INSERT INTO products VALUES ('','".$name."','".$cata."','".$desc."','','".$price."',0)";
                $res = mysqli_query($mysqli,$addsql) or die(mysqli_error($mysqli));
                
                if ($res === TRUE) {
                    echo("<script>alert('The product has been added successfully');</script>");
                    echo("<script>location.href = 'products.php';</script>");
                } else {
                    echo "<SCRIPT>alert('An error occured, please try again');</SCRIPT>";	
                    echo("<script>location.href = 'addProduct.php';</script>");
                }
            }
        }
    } else {
        echo("<script>window.location = 'login.php';</script>");
    }
    mysqli_close($mysqli);

    require("footer.php");