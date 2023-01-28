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
    <script src="js/fabric.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        //UpDate table with new dateTime every minutes
        setInterval(() => { fetch('checkOnline/active.php?user_id=' + <?php echo $session_id ?>)}, 60000);
        
        $(function() {// For saving data on database
            $("#savBtn").click(function() {
                var dataURL = canvas.toDataURL();
                // var dataMsg = document.getElementById('atchMsg').value;
                var frnSelect = $(".frnSelect:checked").val();
                if (frnSelect=='') {
                    alert("Please select friend");
                }
                else
                {
                    $.ajax({
                    type: "POST",
                    url: "img/imgInsert.php",
                    data: {dataImg: dataURL, dataFrn: frnSelect},
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
                        $("#frnList").css("display", "block");
                        }  
                    });
                }
                return false;
            });
        });

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
    <link rel="stylesheet" href="draw.css">
</head>
<body>

    <!Menu Heading>
    <?php include 'menuHead.php'; ?>

    <canvas id="c" width="1075" height="580"></canvas>
    
    <div class="sidePanel bg-light">

        <!-- New panel -->
        <div class="dark">Tools</div>

        <div id="drawingOption">
            <div id="drawingOption1">
                <i 
                    onclick="switchDrawing('pointer')" 
                    class="icon fa-mouse-pointer doIcon"
                    data-toggle="tooltip" 
                    title="Select element"
                >
                </i>
                <i 
                    class="icon fa-pencil-square-o doIcon"
                    onclick="switchDrawing('pen')" 
                    data-toggle="tooltip" 
                    title="Pen for drawing"
                ></i>
                <i 
                    class="icon fa-file-text doIcon"
                    onclick="switchDrawing('text')" 
                    data-toggle="tooltip" 
                    title="Write some text"
                ></i>
                <i 
                    class="icon fa-eraser doIcon"
                    onclick="switchDrawing('eraser')" 
                    data-toggle="tooltip" 
                    title="Eraser"
                ></i>
            </div>
            <div id="drawingOption2">
                <i 
                    onclick="switchDrawing('rectangle')" 
                    class="icon fa-square doIcon"
                    data-toggle="tooltip" 
                    title="Square shape"
                ></i>
                <i  
                    class="icon fa-circle doIcon"
                    onclick="switchDrawing('circle')" 
                    data-toggle="tooltip" 
                    title="Circle shape"
                ></i>
                <span 
                    class="selectAll doIcon"
                    onclick="selectAll()"
                    data-toggle="tooltip" 
                    title="Select all"
                >
                    S.A.
                </span>
                <i  
                    class="icon fa-trash doIcon"
                    onclick="deleteObjects()" 
                    data-toggle="tooltip" 
                    title="Delete selected items"
                ></i>
            </div>
        </div>

        <!Collection of colors>
        <div class="dark">Choose Colors</div>

        <div id="colorCollection"
            data-toggle="tooltip" 
            title="Select item and change color">
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

        <!Adjust width of pen with Range>
        <div id="penRange"
            data-toggle="tooltip" 
            title="Manage pen width">
            <input type="range" id="colorWidth" min="1" max="30" value="25" oninput="range(this)">
            <canvas id="toolCan" width="60" height="35"></canvas>
        </div>

        <!Search friend>
        <form method="post">
            <input 
                type="search" 
                id="searchFrn" 
                placeholder="Search your friend"
                data-toggle="tooltip" 
                title="Type your firend name and hit enter"
                >
            <input 
                type="submit" 
                name="msg" 
                id="frnBtn" 
                style="display: none;">
            <div id="frnList"></div>
        </form>

        <!Save erase button>
        <button 
            class="btn btn-secondary" 
            value="Save" 
            id="savBtn" 
            size="23"
            data-toggle="tooltip" 
            title="Click here to send your message"
            >
            <i id="SendIcon" class="icon fa-send"></i>
            Send
        </button>

    </div>
    
    <script>
        var currentActiveDrawingOption = "";
        
        var x = "#A7A9AC", y = 24;
            tcan = document.getElementById('toolCan');
            tctx = tcan.getContext("2d");
            tctx.clearRect(0, 0, 60, 35);
            tctx.beginPath();               
            tctx.moveTo(12, 35/2);               
            tctx.lineTo(48,35/2); 
            tctx.strokeStyle = '#A7A9AC';              
            tctx.lineWidth = 24; 
            tctx.lineCap = 'round';              
            tctx.stroke(); 

        function color(obj) {
            x=obj.id
            y=document.getElementById('colorWidth').value;
            // document.getElementById('colorPen').style.color = x;
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

        function switchDrawing(sd) {
            switch(sd) {
                case 'pointer':
                    canvas.isDrawingMode = false;
                    break;
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
                case 'pen':
                    canvas.isDrawingMode = true;
                    break;
                case 'eraser':
                    console.log('text')
                    canvas.freeDrawingBrush = new fabric.EraserBrush(canvas);
                    canvas.freeDrawingBrush.width = 30;
                    canvas.isDrawingMode = true;
                    break;
                default:
                    console.log("no");
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

        $('body').keydown(function(event){

            if(event.keyCode == 46)
                deleteObjects()
        
        })

        $(document).bind('keypress', function(event) {
            if( event.which === 65 && event.shiftKey ) 
                selectAll()
        });

        selectAll = () => {
            canvas.discardActiveObject();
            var sel = new fabric.ActiveSelection(canvas.getObjects(), {
            canvas: canvas,
            });
            canvas.setActiveObject(sel);
            canvas.requestRenderAll();
        }

    </script>
</body>
</html>