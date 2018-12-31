<?php
echo '<form action="friend/friendQuery.php" method="post">
<table class="table bg-white rounded">
	<tr>
		<th colspan="2" class="w3-blue-grey">Friend Request Sent To</th>
	</tr>';
	include('config.php');
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$Squery = "SELECT f.id, CONCAT(a.fName,' ', a.lName)
from friend f
INNER join account a on a.id = f.friend_id
WHERE f.username_id = ? AND act = 'r'
ORDER BY f.id LIMIT 20";
		
		if ($stmt = $conn->prepare($Squery)) {
		  $stmt->bind_param("i", $session_id); 
          $stmt->execute(); 
          $stmt->bind_result($id, $friend);

		 while($stmt->fetch()) {
			 echo '<tr><td><span style="text-transform: capitalize;">' . $friend . '</span></td><td> <button type="submit" class="frs btn btn-danger btn-sm float-right" name="frsDelete" value="' . $id . '" >Delete Request</button> </td></tr>';
			}
			echo "</table></form>";
		} else {
				echo "Error occur on select";
		}
		$stmt->close();
		$conn->close();
	?>