<?php
include('session.php');
$_SESSION['pageStore'] = "draw.php";

if(!isset($_SESSION['login_id'])){
header("location: index.php"); // Redirecting To Home Page
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="js/fabric.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
        //UpDate table with new dateTime every minutes
    setInterval(() => { fetch('checkOnline/active.php?user_id=' + <?php echo $session_id ?>)}, 60000);
    
$(function() {// For saving data on database
$("#savBtn").click(function() {
        var dataURL = canvas.toDataURL();
        var dataMsg = document.getElementById('atchMsg').value;
        var frnSelect = $(".frnSelect:checked").val();
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
    } else {
    alert("Sucessfuly Send");
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
url: "draw/searchFrn.php",
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

// Increase width of input
function morewidth() {
    $("#atchMsg").animate({ width: "1340px"}, 400);
    document.getElementById('SzIcon').className = "icon fa-arrow-right";
}
// Decrease width of input
function lesswidth() {
    $("#atchMsg").animate({ width: "170px"}, 400);
    document.getElementById('SzIcon').className = "icon fa-arrow-left";
}

    </script>
      <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/w3.css"> 
    <link rel="stylesheet" href="css/bootstrap.css">

  <style type="text/css">
      input[type="text"]:focus {
      box-shadow: 0 0 0 0.2rem rgba(134,142,150,.5);
    }
    .l5, .l40, .l75, .l110, .l145 {
        position:absolute;
        width:30px;height:30px;
    }
    .l5 {
        left:5px;
    }
    .l40 {
        left:40px;
    }
    .l75 {
        left:75px;
    }
    .l110 {
        left:110px;
    }
    .l145 {
        left:145px;
    }
    .t35 {
        top:35px;
    }    
    .t70 {
        top:70px;
    }    

  </style>
  </head>
    <body class="bg-light">

 <!Menu Heading>
 <?php include 'menuHead.php'; ?>

<canvas id="c" width="1170" height="580" style="border:1px solid white"></canvas>
<div class="modal" style="width:30px;height:30px;background:#A7A9AC;"></div>
    <!Collection of colors>
    <div class="dark" onclick="chooseColor()" style="position:absolute;top:52px;right: 60px;">Choose Colors <i id="colorPen" class="icon fa-pencil" style="color:#A7A9AC;"></i></div>
    <div id="colorCollection" style="position:absolute;top:75px;right: 180px;">
    <div class="rounded l5" style="background:#A7A9AC;" id="#A7A9AC" onclick="color(this)"></div>
    <div class="rounded l40" style="background:#00AACC;" id="#00AACC" onclick="color(this)"></div>
    <div class="rounded l75" style="background:#004DE6;" id="#004DE6" onclick="color(this)"></div>
    <div class="rounded l110" style="background:#3D00B8;" id="#3D00B8" onclick="color(this)"></div>
    <div class="rounded l145" style="background:#600080;" id="#600080" onclick="color(this)"></div>
    <div class="rounded l5 t35" style="background:#FFE600;" id="#FFE600" onclick="color(this)"></div>
    <div class="rounded l40 t35" style="background:#FFAA00;" id="#FFAA00" onclick="color(this)"></div>
    <div class="rounded l75 t35" style="background:#FF5500;" id="#FF5500" onclick="color(this)"></div>
    <div class="rounded l110 t35" style="background:#E61B1B;" id="#E61B1B" onclick="color(this)"></div>
    <div class="rounded l145 t35" style="background:#B31564;" id="#B31564" onclick="color(this)"></div>
    <div class="rounded l5 t70" style="background:#A2E61B;" id="#A2E61B" onclick="color(this)"></div>
    <div class="rounded l40 t70" style="background:#26E600;" id="#26E600" onclick="color(this)"></div>
    <div class="rounded l75 t70" style="background:#008055;" id="#008055" onclick="color(this)"></div>
    <div class="rounded l110 t70" style="background:#58595B;" id="#58595B" onclick="color(this)"></div>
    <div class="rounded l145 t70" style="background:#613D30;" id="#613D30" onclick="color(this)"></div>
    </div>

    <!div>
    <!Erasear>
    <!div style="position:absolute;top:187px;left: 5px;"><!Eraser <i id="EraserIcon" class="icon fa-eraser"><!/i><!/div>
    <!div class="rounded" style="position:absolute;top:185px;left: 80px;width:31px;height:31px;background:white;border:3px solid;" id="white" onclick="color(this)"><!/div>
    <!/div>

    <!Adjust width of pen with Range>
    <canvas id="toolCan" width="60" height="35" style="position: absolute;top:185px;right: 5px;"></canvas>
    <input type="range" id="colorWidth" min="1" max="30" value="25" oninput="range(this)" style="position: absolute;top:191px;right:70px;width:105px;">

    <!Change Drawing mode>
    <button class="btn btn-secondary" id="selObj" onclick="selectObject()" style="position: absolute;top:220px;right:5px;width:170px;">Enter drawing mode</button>
   
  <!Add delete predefine object>
  <select style="position: absolute;top:260px;right:44px;width:133px;" class="custom-select" id="paintOption">
      <option value="rectangle">Rectangle</option>
      <option value="triangle">Triangle</option>
      <option value="circle">Circle</option>
      <option value="line">Line</option>
      <option value="text">Textbox</option>
  </select>
  <button class="btn btn-primary" onclick="add()" value="add" id="add" style="position:absolute;top:260px;right:42px;"><i id="AddIcon" class="icon fa-plus"></i></button>
  <button class="btn btn-danger" onclick="deleteObjects()" value="delete" id="delete" style="position:absolute;top:260px;right:5px;"><i id="DeleteIcon" class="icon fa-times"></i></button>

    <!Search friend>
<form method="post">
    <input type="search" id="searchFrn" placeholder="Search your friend" style="position: absolute;top:300px;right:5px;width:170px;">
    <input type="submit" name="msg" id="frnBtn" style="display: none;">
    <div id="frnList" style="position: absolute;top:330px;right:5px;width:170px;height:190px;overflow:auto;"></div>
</form>

<form method="post">
    <!Attach message>
    <div style="position: absolute;top:532px;right:15px;">Attach your message <i id="SzIcon" class="icon fa-arrow-left"></i></div>
    <input type="text" name="atchMsg" id="atchMsg" onblur="lesswidth()" onclick="morewidth()" class="form-control" style="position: absolute;top:555px;right:5px;width:170px;" required>

    <!Save erase button>
    <button class="btn btn-secondary" value="Save" id="savBtn" size="23" style="position:absolute;top:598px;right:98px;"><i id="SendIcon" class="icon fa-send"></i> Send</button>
</form>
    <button class="btn btn-danger" value="Clear" id="clr" size="23" onclick="cleanUp()" style="position:absolute;top:598px;right:10px;"><i id="ClearIcon" class="icon fa-times"></i> Clear</button>

<script>
    $(document).ready(function(){
    $("#selObj").click(function(){
        if ($("#selObj").text()=='Enter drawing mode') {
        $("#selObj").text('Cancel drawing mode');
        $("#paintOption").hide(400);
        $("#add").hide(400);
        $("#delete").hide(400);
        $("#searchFrn").animate({ top: "260px"}, 400);
        $("#frnList").animate({ top: "290px", height: "230px"}, 400);
        }
   else if ($("#selObj").text()=='Cancel drawing mode') {
        $("#selObj").text('Enter drawing mode');
        $("#paintOption").show(400);
        $("#add").show(400);
        $("#delete").show(400);
        $("#searchFrn").animate({ top: "300px"}, 400);
        $("#frnList").animate({ top: "330px", height: "190px"}, 400);
    }
  });
});

    var x = "#A7A9AC",
        y = 24;
        tcan = document.getElementById('toolCan');
        tctx = tcan.getContext("2d");
        tctx.clearRect(0, 0, 60, 35);
        tctx.beginPath();               
        tctx.moveTo(12, 35/2);               
        tctx.lineTo(48,35/2); 
        tctx.strokeStyle = document.getElementById('colorPen').style.color;              
        tctx.lineWidth = 24; 
        tctx.lineCap = 'round';              
        tctx.stroke();                      

    function color(obj) {
        x=obj.id
        y=document.getElementById('colorWidth').value;
        document.getElementById('colorPen').style.color = x;
        document.getElementById('colorWidth').style.display = "inline";

        canvas.freeDrawingBrush.color = x;
        var checkObj = canvas.getActiveObject();
        if (checkObj) 
            {
                if (checkObj.get('type')!='path') checkObj.set("fill", x);
                checkObj.set("stroke", x);
                canvas.renderAll();
            }

        tctx.clearRect(0, 0, 60, 35);
        tctx.beginPath();               
        tctx.moveTo(y/2, 35/2);               
        tctx.lineTo(60-y/2,35/2); 
        tctx.strokeStyle = x;              
        tctx.lineWidth = y;  
        tctx.lineCap = 'round';             
        tctx.stroke();
    }

        // create a wrapper around native canvas element (with id="c")

function add() {
    var paintOpt = $("#paintOption").val();

    switch(paintOpt) {
    case 'rectangle':
        var rectangle = new fabric.Rect({
        width: 100, 
        height: 70, 
        fill: x, 
        left: 50, 
        top: 50
        });
        canvas.add(rectangle);
        break;
    case 'triangle':
        var triangle = new fabric.Triangle({
        width: 100, 
        height: 75, 
        fill: x, 
        left: 250, 
        top: 50
        });
        canvas.add(triangle);
        break;
    case 'circle':
        var circle = new fabric.Circle({
        radius: 50,  
        fill: x, 
        left: 450, 
        top: 50
        });
        canvas.add(circle);
        break;
    case 'line':
        var line = new fabric.Line([50, 100, 200, 100], {
        left: 650, 
        top: 75,
        stroke: x,
        strokeWidth: 8
        });
        canvas.add(line);
        break;
    case 'text':
        var addtext = new fabric.Textbox('Edit this text', {
        left: 400,
        top: 200,
        fill: x,
        strokeWidth: 2,
        fontFamily: 'Arial'
          });
        canvas.add(addtext);
        break;
    default:
        alert('No');
}
}

  function selectObject() {
    canvas.isDrawingMode = !canvas.isDrawingMode;
  }
function deleteObjects(){
    var active = canvas.getActiveObjects();
 if (active) {
    canvas.discardActiveObject();
    canvas.remove(...active);
    }
}

var canvas = this.__canvas = new fabric.Canvas('c');

    if (canvas.freeDrawingBrush) {
      canvas.freeDrawingBrush.color = x;
      canvas.freeDrawingBrush.width = y;
    }

 

    function range(tobj) {
        y=tobj.value;
        tctx.clearRect(0, 0, 60, 35);
        tctx.beginPath();               
        tctx.moveTo(y/2, 35/2);               
        tctx.lineTo(60-y/2,35/2);               
        tctx.lineWidth = y; 
        tctx.lineCap = 'round';              
        tctx.stroke();
        canvas.freeDrawingBrush.width = y;
    }

</script>
</body>
</html>