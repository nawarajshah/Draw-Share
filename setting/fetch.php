<?php
include('config.php');

$sQuery = "SELECT fName,lName, email, country, phone, DOB, gender from account where id=? LIMIT 1";

// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($sQuery);
$stmt->bind_param("i", $_SESSION['login_id']);
$stmt->execute();
$stmt->bind_result($fName, $lName, $email, $country, $phone, $DOB, $gender);
$stmt->store_result();

if($stmt->fetch()) 

?>