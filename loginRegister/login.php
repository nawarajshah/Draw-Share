<?php
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message

if (isset($_POST['signIn'])) {
if (empty($_POST['email']) || empty($_POST['password'])) {
$error = "<div class='col-4 alert alert-danger text-center'>Username & Password should not be empty</div>";
}
else
{
// Define $email and $password
$email = $_POST['email'];
$password = $_POST['password'];

// Make a connection with MySQL server.
include('config.php');

// SQL query to fetch information of registerd users and finds user match.
$sQuery = "SELECT id, password from account where email=? LIMIT 1";
$uQuery = "UPDATE account SET online = 1,loginTime = NOW() WHERE email  = ? LIMIT 1";

// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($sQuery);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($id, $hash);
$stmt->store_result();


if($stmt->fetch()) { //fetching the contents of the row
  if (password_verify($password, $hash)) {
          $_SESSION['login_id'] = $id;
          $stmt->close();
          
          $stmt = $conn->prepare($uQuery);
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $stmt->close();
          $conn->close();
          if (isset($_SESSION['pageStore'])) {
            $pageStore = $_SESSION['pageStore'];
          } else {        
          $pageStore = "draw.php";
          }
          header("location: $pageStore"); // Redirecting To Profile Page
        }
else {
       echo '<div class="alert alert-danger text-center fade in alert-dismissable show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size:20px;">×</span></button>Invalid Username & Password</div>';
     }
      } else {
       echo '<div class="alert alert-danger text-center fade in alert-dismissable show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size:20px;">×</span></button>Invalid Username & Password</div>';
     }
$stmt->close();
$conn->close(); // Closing Connection
}
}
?>