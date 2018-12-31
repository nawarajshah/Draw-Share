<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script>
    //setInterval(updateScroll,5000); // Scroll to bottom every 0.5 sec
    var lastChat, lastPM;
// Load first time when open message page
$(document).ready(function() {  
        $.get('msg/MsgChat.php', function (data) {
        $('#Chat').html(data);
        $("#Chat").stop().animate({ scrollTop: $("#Chat")[0].scrollHeight}, 1000);
        //Get value of last message from Chat
        lastChat = $(".lastChat:last").val();
        });
    });
$(document).ready(function() {  
        $.get('msg/MsgPM.php', function (data) {
        $('#PM').html(data);
        //Get value of last message from PM
        lastPM = $(".lastPM:last").val();
        });
    });

// Change the value of message box
		$(document).ready(function(){
$("#chatBtn").click(function(){
		$("#msgBtn").val("chat");
});
$("#pmBtn").click(function(){
		$("#msgBtn").val("pm");
		$("#PM").stop().animate({ scrollTop: $("#PM")[0].scrollHeight}, 1000);
});
});

// Use to insert data from input
$(function() {
$("#msgBtn").click(function() {
var textcontent = $("#msgInput").val();
var msgValue = $("#msgBtn").val();
var msgString = 'msgType='+ msgValue;
var frnSelect = $(".frnSelect:checked").val();
if(textcontent=='')
{
alert("Enter some text..");
$("#msgInput").focus();
}
else
{
$.ajax({
type: "POST",
url: "msg/MsgInsert.php",
data: {content: textcontent, msgType: msgValue, frnId: frnSelect},
cache: true,
success: function(response){
document.getElementById('msgInput').value='';
$("#msgInput").focus();
}  
});
}
return false;
});
});

//Scroll function
function updateScroll(){
    $("#Chat").stop().animate({ scrollTop: $("#Chat")[0].scrollHeight}, 1000);
    $("#PM").stop().animate({ scrollTop: $("#PM")[0].scrollHeight}, 1000);
}

// Get data from database every five second
jQuery(function($){
  setInterval(function(){
  	if ($("#msgBtn").val()=="chat") {
    $.get( 'msg/MsgChat.php', function(newRowCount){
      $('#Chat').html( newRowCount );
    });
    $("#Chat").stop().animate({ scrollTop: $("#Chat")[0].scrollHeight}, 1000);
    }
    else if ($("#msgBtn").val()=="pm") {
    	$.get( 'msg/MsgPM.php', function(newRowCount){
      $('#PM').html( newRowCount );
    });
    	$("#PM").stop().animate({ scrollTop: $("#PM")[0].scrollHeight}, 1000);
    }
// Write a code here to get only new message for PM    
  },5000); // 5000ms == 5 seconds
});
/*jQuery(function($){
  setInterval(function(){
    $.get( 'msg/MsgPM.php', function(newRowCount){
      $('#PM').html( newRowCount );
    });
// Write a code here to get only new message for PM
  },5000); // 5000ms == 5 seconds
});*/
	</script>
</head>
<body>

<div class="bg-white rounded">
	<div class="w3-bar w3-blue-grey">
		<button class="w3-bar-item w3-button tablink w3-grey" id="chatBtn" onclick="openMsg(event,'Chat')">Chat</button>
		<button class="w3-bar-item w3-button tablink" id="rule" onclick="openMsg(event,'Rules')">Rules</button>
	</div>
	
	<div id="Chat" class="msg" style="height: 460px;overflow: auto;">
        <p>Message will appear soon</p> 
	</div>

	<div id="Rules" class="msg" style="display:none;height: 460px;overflow: auto;">
		<ul>
    <li>You are not allowed to send bad word to other user.</li>
    <li>Please follow the folloing steps for sending a message.</li>
    <ol>
      <li>Search your friend on search bar.</li>
      <li>Type a message and send.</li>
    </ol>
    <li><i>Those user, who go against our rule. There account will either suspended or permanently deleted from our system and listed in a black list</i></li>  
    </ul> 
	</div>

<form action="MsgInsert.php" id="frmBox" name="msgSend" method="POST" onsubmit="return formSubmit();">
		<div class="input-group">
			<input type="text" class="form-control" name="msgBox" id="msgInput" title="Enter your message" placeholder="Type your message here ..." required>
			<div class="input-group-btn">
				<button type="submit" id="msgBtn" class="btn btn-secondary" value="chat">Send Message</button>
			</div>
		</div>
	</form>
</div>

<script>
function openMsg(evt, msgType) {
	var i, x, tablinks;
	x = document.getElementsByClassName("msg");

	for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablink");
	for (i = 0; i < x.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" w3-grey", "");
	}
	document.getElementById(msgType).style.display = "block";
	evt.currentTarget.className += " w3-grey";
}
</script>

</body>
</html>