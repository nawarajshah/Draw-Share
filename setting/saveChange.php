<?php
$error = ''; // Variable To Store Error Message
if (!empty($_POST['newPass']) && isset($_POST['newPass'])) {
	$newPass = $_POST['newPass'];
  $hash = password_hash($newPass, PASSWORD_DEFAULT);
} elseif (!empty($_POST['currentPassword']) && isset($_POST['currentPassword'])) {
	$newPass = $_POST['currentPassword'];
  $hash = password_hash($newPass, PASSWORD_DEFAULT);
}

if (isset($_POST['submit'])) {
if (empty($_POST['fName']) || empty($_POST['lName']) || empty($_POST['email']) || empty($_POST['countryList']) || empty($_POST['phone']) || empty($_POST['DOB']) || empty($_POST['gender'])) {
echo "<div class='col-4 alert alert-danger text-center'>Please fill up all the required field.</div>";
}
else
{
// Define $name, $email and $password
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$email = $_POST['email'];
$countryList = $_POST['countryList'];
$phone = $_POST['phone'];
$DOB = $_POST['DOB'];
$gender = $_POST['gender'];
$currentPassword = $_POST['currentPassword'];

// Make a connection with MySQL server.
include('config.php');

// SQL query to fetch information of registerd users and finds user match.
$sQuery = "SELECT password from account where id = ? LIMIT 1";
$uQuery = "UPDATE account SET fName = ?, lName = ?, email = ?, password = ?, country = ?, phone = ?, DOB = ?, gender = ? WHERE id  = ? LIMIT 1";

// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($sQuery);
$stmt->bind_param("i", $session_id);
$stmt->execute();
$stmt->bind_result($password);
$stmt->store_result();
$rnum = $stmt->num_rows;

if($rnum==1 && $stmt->fetch() && password_verify($currentPassword, $password)) { //fetching the contents of the row
          $stmt->close();
          
          $stmt = $conn->prepare($uQuery);
    	  $stmt->bind_param("sssssissi", $fName, $lName, $email, $hash, $countryList, $phone, $DOB, $gender, $session_id);
         if ($stmt->execute())
        echo '<div class="alert alert-success text-center fade in alert-dismissable show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size:20px;">×</span></button>Your data is successfully updated</div>';
        } else { 
       echo '<div class="alert alert-danger text-center fade in alert-dismissable show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size:20px;">×</span></button>Password does not match.</div>';
     }
$stmt->close();
$conn->close(); // Closing Connection
}
}
?>