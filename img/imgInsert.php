<?php
include('../session.php');

if(!isset($_SESSION['login_id'])){
echo "You have to login first";
}
else {
if (isset($_POST['dataImg'])&&isset($_POST['dataCont'])&&isset($_POST['dataFrn'])) {

// Make connection with database
  include('../config.php');
			
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}
//Get the name of user from the content
$cont = $_POST['dataCont'];
$dataFrn = $_POST['dataFrn'];
$img = $_POST['dataImg'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);

$Iquery = "INSERT INTO `msg`(`sender`, `receiver`, `atchMsg`, `image`) VALUES (?,?,?,?)";

if ($stmt = $conn->prepare($Iquery)) {
  $stmt->bind_param("ssss", $session_username, $dataFrn, $cont, $data); 
  $stmt->execute();
}
else {
	echo "Wrong";
}

$stmt->close();
$conn->close();
}
else {
	echo "Please select a friend";
}
}
?>