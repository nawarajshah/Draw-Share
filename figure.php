<?php
include('session.php');
$_SESSION['pageStore'] = "figure.php";

if(!isset($_SESSION['login_id'])){
header("location: index.php"); // Redirecting To Home Page
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Your Home Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/w3.css"> 
  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="js/jquery.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<style type="text/css">

.card {
}
  </style>
  </head>
  </body>
 <?php include 'menuHead.php'; ?>
<!Body Div>

<?php
include('config.php');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$Squery = "SELECT sender, receiver, atchMsg, image, timeMs FROM msg WHERE sender = ? OR receiver = ? ORDER BY `msg`.`id` DESC";

 if ($stmt = $conn->prepare($Squery)) {
   $stmt->bind_param("ss", $session_username, $session_username); 
   $stmt->execute(); 
   $stmt->bind_result($sender, $receiver, $atchMsg, $image, $timeMs);
echo '<div class="card-deck">'; 
$i=0;
  while($stmt->fetch()) {
        if ($sender==$session_username) {
      echo '<div class="col-lg-3"><div class="card mt-3">
  <img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $image ).'" alt="Card image">
  <div class="card-body">
    <h5 class="card-title text-capitalize">To '.$receiver.'</h5>
    <p class="card-text">'.$atchMsg.'</p>
  </div>
  <div class="card-footer">
      <small class="text-muted">'.$timeMs.'</small>
    </div>
</div></div>';
    }
    else {
      echo '<div class="col-lg-3"><div class="card mt-3">
  <img class="card-img-top" src="data:image/jpeg;base64,'.base64_encode( $image ).'" alt="Card image">
  <div class="card-body">
    <h5 class="card-title text-capitalize">From '.$sender.'</h5>
    <p class="card-text">'.$atchMsg.'</p>
  </div>
  <div class="card-footer">
      <small class="text-muted">'.$timeMs.'</small>
    </div>
</div></div>';
    }
     

    }
echo "</div>";
   //echo "<tr><td><span style='text-transform: capitalize;'>" . $friend . "</span></td><td> <button name='delete' value='" . $id . "' class='w3-button w3-large w3-text-red w3-hover-red glyphicon glyphicon-remove' title='Delete friend request'>Delete request</button> </td></tr>";
 } else {
  echo "Error occur on select";
    }
    $stmt->close();
    $conn->close();
//echo '<img src="data:image/png;base64,'.base64_encode( $result['image'] ).'"/>';
?>

<script>

</script>
</body>
</html>