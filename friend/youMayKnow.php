<?php
echo '<form action="friend/friendQuery.php" method="post">
<table class="table bg-white rounded">
	<tr>
		<th colspan="2" class="w3-blue-grey">People You May Know</th>
	</tr>';
	include('config.php');
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$Squery = "SELECT account.username
FROM account
where account.username != ? AND account.username
NOT IN (SELECT friend.username
        FROM friend
        WHERE friend.friend = ?
        UNION ALL
        SELECT friend.friend
        FROM friend 
        WHERE friend.username = ?) LIMIT 20";
		
		if ($stmt = $conn->prepare($Squery)) {
		  $stmt->bind_param("sss", $session_username, $session_username, $session_username); 
          $stmt->execute(); 
          $stmt->bind_result($username);

		 while($stmt->fetch()) {
			 echo '<tr><td><span style="text-transform: capitalize;">' . $username . '</span></td><td> <button type="submit" class="btn btn-light btn-sm" name="addFrn" value="' . $username . '" >Add Friend</button> </td></tr>';
			}
			echo "</table></form>";
		} else {
				echo "Error occur on select";
		}
		$stmt->close();
		$conn->close();
	?>