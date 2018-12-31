<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<ul class="w3-ul">
    <li class="w3-bar w3-padding-small alert-secondary">
      <div class="">
        <span class="font-weight-bold">Jill</span><span class="w3-right text-secondary small">11:02</span><br>
        <span class="w3-text-gray">Web Designer</span>
      </div>
    </li>

    <li class="w3-bar w3-padding-small alert-secondary">
      <div>
        <span class="font-weight-bold">Mike</span><span class="w3-right text-secondary small">11:56</span><br>
        <span class="w3-text-gray">Support</span>
      </div>
    </li>

  <?php
  include('../session.php');
  // Make connection with database
  include('../config.php');

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 

    $Squery = "SELECT id, msgFrom, msg, msgDate FROM `msgpm` 
where msgTo = ? OR msgFrom = ? ORDER  BY id DESC LIMIT 25";
    
    if ($stmt = $conn->prepare($Squery)) {
      $stmt->bind_param("ss", $session_username, $session_username); 
          $stmt->execute(); 
          $stmt->bind_result($id, $msgFrom, $msg, $msgDate);

     while($stmt->fetch()) {
      if ($msgFrom == $session_username) {
        echo "<li class='w3-bar w3-padding-small alert-secondary lastPM' value='" . $id . "'>
               <div>
                <span class='font-weight-bold'>Me</span><span class='w3-right text-secondary small'>" . $msgDate . "</span><br>
                <span class='w3-text-gray'>" . $msg . "</span>
               </div>
              </li>";
      }
      else {
        echo "<li class='w3-bar w3-padding-small alert-primary lastPM' value='" . $id . "'>
               <div>
                <span class='font-weight-bold text-capitalize'>" . $msgFrom . "</span><span class='w3-right text-secondary small'>" . $msgDate . "</span><br>
                <span class='w3-text-gray'>" . $msg . "</span>
               </div>
              </li>";
      } 
      }
    } else {
        echo "Error occur on select";
    }
    $stmt->close();
    $conn->close();

  ?>
  </ul>

</body>
</html>