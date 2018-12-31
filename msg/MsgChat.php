<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<ul class="w3-ul">

  <?php
  include('../session.php');

  // Make connection with database
  include('../config.php');

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 

    $Squery = "SELECT * FROM (
SELECT * FROM `msgchat` 
where msgTo = ? OR msgFrom = ? ORDER BY id DESC LIMIT 8
    ) sub
ORDER BY id ASC";
    
    if ($stmt = $conn->prepare($Squery)) {
      $stmt->bind_param("ss", $session_username, $session_username); 
          $stmt->execute(); 
          $stmt->bind_result($id, $msgFrom, $msgTo, $msg, $msgDate);

     while($stmt->fetch()) {
      if ($msgFrom == $session_username) {
        echo "<li class='w3-bar w3-padding-small alert-secondary lastChat' value='" . $id . "'>
               <div>
                <span class='font-weight-bold'>Me</span><span class='w3-right text-secondary small'>" . $msgDate . "</span><br>
                <span class='w3-text-gray'><span class='text-capitalize'>" . $msgTo . "</span>, " . $msg . "</span>
               </div>
              </li>";
      }
      else {
        echo "<li class='w3-bar w3-padding-small alert-primary lastChat' value='" . $id . "'>
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