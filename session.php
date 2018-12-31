<?php

  // Make connection with database
  include('config.php');

session_start();// Starting Session

// Storing Session
$user_id = $_SESSION['login_id'];

$Squery = "SELECT id, fname from account where id = ? LIMIT 1";

// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($Squery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($id, $fname);
$stmt->store_result();

if($stmt->fetch()) //fetching the contents of the row
        {
        	$session_username = $fname;
        	$session_id = $id;
          $stmt->close();
          mysqli_close($conn);
        }
?>