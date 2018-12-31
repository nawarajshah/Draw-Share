<?php
include('config.php');

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$Squery = "SELECT sender, receiver, atchMsg, image FROM msg WHERE sender = ? OR receiver = ?";

 if ($stmt = $conn->prepare($Squery)) {
   $stmt->bind_param("ss", $session_username, $session_username); 
   $stmt->execute(); 
   $stmt->bind_result($sender, $receiver, $atchMsg, $image);

  while($stmt->fetch()) {
  	if ($sender==$session_username) {
  		echo '<div class="card">
  <img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $image ).'" alt="Card image">
  <div class="card-body">
    <h4 class="card-title text-capitalize">To '.$receiver.'</h4>
    <p class="card-text">'.$atchMsg.'</p>
  </div>
</div>';
  	}
  	else {
  		echo '<div class="card">
  <img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $image ).'" alt="Card image">
  <div class="card-body">
    <h4 class="card-title text-capitalize">From '.$sender.'</h4>
    <p class="card-text">'.$atchMsg.'</p>
  </div>
</div>';
  	}
 	 //echo "<tr><td><span style='text-transform: capitalize;'>" . $friend . "</span></td><td> <button name='delete' value='" . $id . "' class='w3-button w3-large w3-text-red w3-hover-red glyphicon glyphicon-remove' title='Delete friend request'>Delete request</button> </td></tr>";
  	}
 } else {
 	echo "Error occur on select";
		}
		$stmt->close();
		$conn->close();
//echo '<img src="data:image/png;base64,'.base64_encode( $result['image'] ).'"/>';
?>