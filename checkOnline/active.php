<?php
$user_id = $_GET['user_id'];

  // Make connection with database
  include('../config.php');

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$Uquery = "UPDATE account SET loginTime=NOW() WHERE id=? LIMIT 1";

		if ($stmt = $conn->prepare($Uquery)) {
		  $stmt->bind_param("s", $user_id); 
          $stmt->execute();
         }

         $stmt->close();
		$conn->close();
?>