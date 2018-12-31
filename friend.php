<?php
include('session.php');
$_SESSION['pageStore'] = "friend.php";

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
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
//UpDate table with new dateTime every minutes
    setInterval(() => { fetch('checkOnline/active.php?user_id=' + <?php echo $session_id ?>)}, 60000);

    $(function() {// For saving data on database
$(".frs").click(function() {
        var frs = $(".frs:select").val();
        alert('hi');
if(dataMsg=='')
{
alert("Please enter some message");
$("#atchMsg").focus();
}
else if (frnSelect=='') {
    alert("Please select friend");
}
else
{
$.ajax({
type: "POST",
url: "img/imgInsert.php",
data: {dataImg: dataURL, dataCont: dataMsg, dataFrn: frnSelect},
cache: true,
success: function(response){
    if (response=="Please select a friend") {
    alert(response);
    $("#searchFrn").focus();
    }
}  
});
}
return false;
});

    // For searching friend
$("#frnBtn").click(function() {
var textcontent = $("#searchFrn").val();
if(textcontent=='')
{
alert("Enter your friend name");
$("#searchFrn").focus();
}
else
{
$.ajax({
type: "POST",
url: "friend/searchFriend.php",
data: {q: textcontent},
cache: true,
success: function(response){
document.getElementById("frnList").innerHTML = response;
}  
});
}
return false;
});
});
  </script>
  <style type="text/css">
    .row {
    margin-right: 5px;
    margin-left: 5px;
    margin-top: 10px;
    }
    .col-lg-3, .col-sm-12 {
    padding-right: 5px;
    padding-left: 5px;
    }
    input[type="text"]:focus {
      box-shadow: 0 0 0 0.15rem rgba(134,142,150,.5);
    }
  </style>
</head>
<body class="bg-light">
 <!Menu Heading>
 <?php include 'menuHead.php'; ?>

<!Body Div>
<div class="row">

  <!Friend Div>
  <div class="col-lg-3 col-sm-12">
    <?php include 'friend/frList.php'; ?>     
    </div>

  <!Friend request recive Div>
  <div class="col-lg-3 col-sm-12">
    <?php include 'friend/FrnReqGet.php'; ?>
  </div>

  <!Friend request send Div>
  <div class="col-lg-3 col-sm-12">
    <?php include 'friend/FrnReqSend.php'; ?>
  </div>

  <!You may know Div>
  <div class="col-lg-3 col-sm-12">
   <form method="POST">
   <div class="input-group" id="search">
    <input type="text" class="form-control" name="msgBox" id="searchFrn" placeholder="Search for new friends" required>
    <div class="input-group-btn">
    <button type="submit" id="frnBtn" class="btn btn-secondary" value="chat"><i id="SearchIcon" class="icon fa-search"></i></button>
    </div>
   </div> 
   </form>
   <div id="frnList" style="height: 460px;overflow: auto;"></div> 
   
  </div>
</div>


<script>
function myFunction() {
    var x = document.getElementById("demo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
</body>
</html>