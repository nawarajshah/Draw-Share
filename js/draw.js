    var canvas, ctx, flag = false,
        prevX = 0,
        currX = 0,
        prevY = 0,
        currY = 0,
        dot_flag = false;
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
        
    var x = "#A7A9AC",
        y = 24;
    
    function init() {
        canvas = document.getElementById('can');
        ctx = canvas.getContext("2d");
        w = canvas.width;
        h = canvas.height;
    
        canvas.addEventListener("mousemove", function (e) {
            findxy('move', e)
        }, false);
        canvas.addEventListener("mousedown", function (e) {
            findxy('down', e)
        }, false);
        canvas.addEventListener("mouseup", function (e) {
            findxy('up', e)
        }, false);
        canvas.addEventListener("mouseout", function (e) {
            findxy('out', e)
        }, false);
        canvas.addEventListener("mousein", function (e) {
            findxy('in', e)
        }, false);
    }
    
    function range(tobj) {
        t=tobj.value;
        y=t;
        tctx.clearRect(0, 0, 60, 35);
        tctx.beginPath();               
        tctx.moveTo(t/2, 35/2);               
        tctx.lineTo(60-t/2,35/2);               
        tctx.lineWidth = t; 
        tctx.lineCap = 'round';              
        tctx.stroke();
    }

    function color(obj) {
        x=obj.id
        if (x == "white") {
         y = 48;
         document.getElementById('EraserIcon').style.color = "#007bff";
         document.getElementById('colorPen').style.color = "black";
         document.getElementById('colorWidth').style.display = "none";
         tctx.clearRect(0, 0, 60, 35);
        }
        else {
            y=document.getElementById('colorWidth').value;
         document.getElementById('colorPen').style.color = x;
         document.getElementById('EraserIcon').style.color = "black";
         document.getElementById('colorWidth').style.display = "inline";

        tctx.clearRect(0, 0, 60, 35);
        tctx.beginPath();               
        tctx.moveTo(y/2, 35/2);               
        tctx.lineTo(60-y/2,35/2); 
        tctx.strokeStyle = x;              
        tctx.lineWidth = y;  
        tctx.lineCap = 'round';             
        tctx.stroke();
        }
    }
    
    function draw() {              
     ctx.beginPath();               
     ctx.moveTo(prevX,prevY);               
     ctx.lineTo(currX,currY);               
     ctx.lineWidth = y; 
     ctx.lineCap = 'round';              
     ctx.stroke();  
    }
    
    function erase() {
        var m = confirm("Want to clear");
        if (m) {
            ctx.clearRect(0, 0, w, h);
            document.getElementById("canvasimg").style.display = "none";
        }
    }
    
    function save() {
        document.getElementById("canvasimg").style.border = "2px solid";
        var dataURL = canvas.toDataURL();
        document.getElementById("canvasimg").src = dataURL;
        document.getElementById("canvasimg").style.display = "inline";
    }
    
    function findxy(res, e) {
        if (res == 'down') {
            prevX = currX;
            prevY = currY;
            currX = e.clientX - canvas.offsetLeft;
            currY = e.clientY - canvas.offsetTop;
    
            flag = true;
            dot_flag = true;
            if (dot_flag) {
                ctx.beginPath();
                ctx.arc(currX, currY, y/4, 0, 2*Math.PI);
                ctx.strokeStyle = x;
                ctx.lineWidth = y/2;
                ctx.stroke();
                dot_flag = false;
            }
        }
        if (res == 'up' || res == 'out') {
            flag = false;
        }
        if (res == 'in') {
            flag = true;
        }
        if (res == 'move' && flag) {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas.offsetLeft;
                currY = e.clientY - canvas.offsetTop;
                draw();
        }
    }
