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