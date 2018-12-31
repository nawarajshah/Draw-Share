<?php
include('../session.php');

if(!isset($_SESSION['login_id'])){
header("location: index.php"); // Redirecting To Home Page
}
// Make connection with database
include('../config.php');

// For delete friend request
if (isset($_POST['frsDelete'])) {

	// Define $username and $password
	$delete = intval($_POST['frsDelete']);

	deleteQuery($delete);
}

else if (isset($_POST['flDelete'])) {

	// Define $username and $password
	$delete = intval($_POST['flDelete']);

	deleteQuery($delete);
}

else if (isset($_POST['frgDelete'])) {

	// Define $username and $password
	$delete = intval($_POST['frgDelete']);

	deleteQuery($delete);
}

else if (isset($_POST['frgAccept'])) {

	// Define $username and $password
	$accept = intval($_POST['frgAccept']);

	if (!$conn) {
	    die('Could not connect: ' . mysqli_error($conn));
	}

	// SQL query to fetch information of registerd users and finds user match.
	$Aquery = "UPDATE friend SET act = 'f' WHERE act = 'r' AND id = ? LIMIT 1";

	// Query for accept
	$stmt = $conn->prepare($Aquery);
	$stmt->bind_param("i", $accept);
	$stmt->execute();
	$stmt->close();
	mysqli_close($conn); // Closing Connection
	header("location: ../friend.php");
}

else if (isset($_POST['addFrn'])) {

	// Define $username and $password
	$addFrn = $_POST['addFrn'];

	if (!$conn) {
	    die('Could not connect: ' . mysqli_error($conn));
	}

	// SQL query to fetch information of registerd users and finds user match.
	$Iquery = "INSERT INTO friend (username_id, friend_id, act) VALUES (?, ?, 'r')";

	// Query for delete
	$stmt = $conn->prepare($Iquery);
	$stmt->bind_param("ss", $session_id, $addFrn);
	$stmt->execute();
	$stmt->close();
	mysqli_close($conn); // Closing Connection
	header("location: ../friend.php");
}

function deleteQuery($delete) {
	include('../config.php');
	
	if (!$conn) {
	    die('Could not connect: ' . mysqli_error($conn));
	}

	// SQL query to fetch information of registerd users and finds user match.
	$Dquery = "DELETE FROM friend WHERE id = ? LIMIT 1";

	// Query for delete
	$stmt = $conn->prepare($Dquery);
	$stmt->bind_param("i", $delete);
	$stmt->execute();
	$stmt->close();
	mysqli_close($conn); // Closing Connection
	header("location: ../friend.php");	
}
?>