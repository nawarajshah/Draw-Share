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

		$Squery = "SELECT a.id, CONCAT(a.fName,' ', a.lName)
FROM account a
where a.id != ? AND a.fname
NOT IN (SELECT a1.fName
      from friend f1
      INNER join account a1 on a1.id = f1.friend_id
      WHERE f1.username_id = ?
      UNION ALL
      SELECT a2.fName
      from friend f2
      INNER join account a2 on a2.id = f2.username_id
      WHERE f2.friend_id = ?) 
        AND  a.fname LIKE ? LIMIT 20";

		if ($stmt = $conn->prepare($Squery)) {
		  $stmt->bind_param("iiis", $session_id, $session_id, $session_id, $q); 
          $stmt->execute(); 
          $stmt->bind_result($id, $name);
          $stmt->store_result();

          if ($stmt->num_rows > 0) {

echo '<form action="friend/friendQuery.php" method="post">
<table class="table bg-white rounded">';
		 // output data of each row
		 while($stmt->fetch()) {
        echo "<tr><td><span style='text-transform: capitalize;'>" . $name . "</span></td><td> <button type='submit' class='btn btn-light btn-sm float-right' name='addFrn' value='" . $id . "' >Add Friend</button> </td></tr>";
			}
			echo "</table></form>";
         $stmt->close();
                   }
         }

		$conn->close();

	?>