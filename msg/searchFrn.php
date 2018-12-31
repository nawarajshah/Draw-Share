	<?php
	include('../session.php');
$q = $_POST['q'];
$q = "%".$q."%";
  // Make connection with database
  include('../config.php');

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$Squery = "SELECT a1.id, CONCAT(a1.fName,' ', a1.lName)
      from friend f1
      INNER join account a1 on a1.id = f1.friend_id
      WHERE f1.username_id = ? AND act = 'f' AND  a1.fname LIKE ?
      UNION ALL
      SELECT a2.id, CONCAT(a2.fName,' ', a2.lName)
      from friend f2
      INNER join account a2 on a2.id = f2.username_id
      WHERE f2.friend_id = ? AND act = 'f' AND  a2.fname LIKE ?";

		if ($stmt = $conn->prepare($Squery)) {
		  $stmt->bind_param("isis", $session_id, $q, $session_id, $q); 
          $stmt->execute(); 
          $stmt->bind_result($id, $friend);

        echo "<ul class='list-group text-capitalize'>";

		 // output data of each row
		 while($stmt->fetch()) {
        echo "<li class='list-group-item'><input type='radio' class='frnSelect' id='$id' value='$id' name='selectFrn'> <label for='$id'> $friend </label></li>";
			}
			echo "</ul>";
         $stmt->close();
         }

		$conn->close();

	?>