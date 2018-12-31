<?php
$error = ''; // Variable To Store Error Message

if (isset($_POST['signUp'])) {
if (empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['email']) || empty($_POST['password'])) {
$error = "<div class='col-4 alert alert-danger text-center'>Please fill up all the required field.</div>";
}
else
{
// Define $name, $email and $password
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$hash = password_hash($password, PASSWORD_DEFAULT);
// Make a connection with MySQL server.
include('config.php');

// SQL query to fetch information of registerd users and finds user match.
$sQuery = "SELECT id from account where email=? LIMIT 1";
$iQuery = "INSERT Into account (fname, lname, email, password) values(?, ?, ?, ?)";

// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($sQuery);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($id);
$stmt->store_result();
$rnum = $stmt->num_rows;

if($rnum==0) { //fetching the contents of the row
          $stmt->close();
          
          $stmt = $conn->prepare($iQuery);
    	  $stmt->bind_param("ssss", $fname, $lname, $email, $hash);
          $stmt->execute();

        $error = '<div class="alert alert-success text-center fade in alert-dismissable show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size:20px;">×</span></button>Register successfully, Please login with your login details</div>';
        } else { 
       $error = '<div class="alert alert-danger text-center fade in alert-dismissable show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size:20px;">×</span></button>Someone already register with this email address.</div>';
     }
$stmt->close();
$conn->close(); // Closing Connection
}
}
?>