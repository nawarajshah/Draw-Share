<?php
echo '<form action="friend/friendQuery.php" method="post">
<table class="table bg-white rounded">
	<tr>
		<th colspan="2" class="w3-blue-grey">My Friends</th>
	</tr>';
	include('config.php');
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$Squery = "SELECT f1.id, CONCAT(a1.fName,' ', a1.lName)
from friend f1
INNER join account a1 on a1.id = f1.friend_id
WHERE f1.username_id = ? AND act = 'f'
UNION ALL
SELECT f2.id, CONCAT(a2.fName,' ', a2.lName)
from friend f2
INNER join account a2 on a2.id = f2.username_id
WHERE f2.friend_id = ? AND act = 'f'
ORDER BY id";
		if ($stmt = $conn->prepare($Squery)) {
		  $stmt->bind_param("ii", $session_id, $session_id); 
          $stmt->execute(); 
          $stmt->bind_result($id, $friend);

		 // output data of each row
		 while($stmt->fetch()) {
			 echo '<tr><td><span style="text-transform: capitalize;">' . $friend . '</span></td><td> <button  type="submit" class="btn btn-danger btn-sm float-right" name="flDelete" value="' . $id . '" >Delete Friend</button> </td></tr>';
			}
			echo "</table></form>";
         }
         else {
         	echo "Error occur on select";
         }
         $stmt->close();
		$conn->close();
	?>