<?php
include('../session.php');

if(!isset($_SESSION['login_user'])){
header("location: ../index.php"); // Redirecting To Home Page
}
if (isset($_POST['content'])) {

// Make connection with database
  include('../config.php');

//Get the name of user from the content
$str = $_POST['content'];
$split = preg_split("/[\,]+(\s+)/", $str, -1, PREG_SPLIT_NO_EMPTY);
$checkUser = $split[0];
$content = $_POST['content'];
$frnId = $_POST['frnId'];

$Squery = "SELECT a1.fName
      from friend f1
      INNER join account a1 on a1.id = f1.friend_id
      WHERE f1.username_id = ? AND act = 'f' And f1.friend_id = ?
      UNION ALL
      SELECT a2.fName
      from friend f2
      INNER join account a2 on a2.id = f2.username_id
      WHERE f2.friend_id = ? AND act = 'f' And f2.username_id = ? LIMIT 1";

		if ($stmt = $conn->prepare($Squery)) {
		  $stmt->bind_param("iiii", $session_id, $frnId, $session_id, $frnId); 
          $stmt->execute(); 
          $stmt->bind_result($friend);
          if($stmt->fetch()) {
if ($friend) {
  echo "string";
$stmt->close();
// Code to insert Chat
if ($_POST['msgType'] == 'chat') {
			
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}


$Iquery = "INSERT INTO msgchat(msgFrom, msgTo, msg) VALUES (? ,? ,?)";

if ($stmt = $conn->prepare($Iquery)) {
  $stmt->bind_param("sss", $session_username, $friend, $content); 
  $stmt->execute(); 
}
$stmt->close();
$conn->close();
}

// Code to insert PM
if ($_POST['msgType'] == 'pm') {
			
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

$Iquery = "INSERT INTO msgpm(msgFrom, msgTo, msg) VALUES (?, ?, ?)";

if ($stmt = $conn->prepare($Iquery)) {
  $stmt->bind_param("sss", $session_username, $friend, $content); 
  $stmt->execute(); 
}
$stmt->close();
$conn->close();
}
}
}}}
?>