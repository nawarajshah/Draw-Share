<?php
include('../session.php');

  // Make connection with database
  include('../config.php');

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$Uquery = "UPDATE account SET online = 0 WHERE id = ? LIMIT 1";
		if ($stmt = $conn->prepare($Uquery)) {
		  $stmt->bind_param("s", $session_id); 
          $stmt->execute();
          $stmt->close();
        }
         else {
         	echo "Error occur on select";
         }
		$conn->close();
if(session_destroy()) // Destroying All Sessions
{
header("Location: ../index.php"); // Redirecting To Home Page
}
?>