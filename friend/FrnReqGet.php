<?php
echo '<form action="friend/friendQuery.php" method="post">
<table class="table bg-white rounded">
	<tr>
		<th colspan="2" class="w3-blue-grey">Friend Request Receive From</th>
	</tr>';
	include('config.php');
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$Squery = "SELECT f.id, CONCAT(a.fName,' ', a.lName)
from friend f
INNER join account a on a.id = f.username_id
WHERE f.friend_id = ? AND act = 'r'
ORDER BY f.id LIMIT 20";
		
		if ($stmt = $conn->prepare($Squery)) {
		  $stmt->bind_param("i", $session_id); 
          $stmt->execute(); 
          $stmt->bind_result($id, $username);

		 while($stmt->fetch()) {
			 echo '<tr><td><span style="text-transform: capitalize;">' . $username . '</span></td><td> <button class="btn btn-primary btn-sm float-right ml-1" name="frgAccept" value="' . $id . '" >Accept</button> <button type="submit" class="btn btn-danger btn-sm float-right" name="frgDelete" value="' . $id . '" >Delete</button> </td></tr>';
			}
			echo "</table></form>";
		} else {
				echo "Error occur on select";
		}
		$stmt->close();
		$conn->close();
	?>