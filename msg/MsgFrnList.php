<table class="table bg-white rounded">
	<tr>
		<th colspan="2" class="w3-blue-grey">Online Friends</th>
	</tr>
	<?php
include('config.php');
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$Squery = "SELECT account.username, account.online
FROM account
where account.id != ? AND account. loginTime  >= (NOW() - INTERVAL 5 MINUTE) AND account.online = 1 AND account.username
IN (SELECT friend.username
        FROM friend
        WHERE friend.friend = ?
        UNION ALL
        SELECT friend.friend
        FROM friend 
        WHERE friend.username = ?)
        LIMIT 20";

		if ($stmt = $conn->prepare($Squery)) {
		  $stmt->bind_param("sss", $session_id, $session_username, $session_username); 
          $stmt->execute(); 
          $stmt->bind_result($username, $online);

		 // output data of each row
		 while($stmt->fetch()) {
		 	if ($online){
			 echo "<tr><td><svg height='12' width='12'><circle cx='6' cy='6' r='6' fill='rgb(66, 183, 42)'/></svg> <span style='text-transform: capitalize;'>". $username . "</span></td></tr>";
		 	}
		 	else {
		 	 echo "<tr><td><svg height='12' width='12'><circle cx='6' cy='6' r='6' fill='lightgray'/></svg> <span style='text-transform: capitalize;'>" . $username . "</span></td></tr>";
		 	}
			}
			echo "</table>";
			$stmt->close();
         }
		$conn->close();

	?>
</table>
