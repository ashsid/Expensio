<?php
$session_user_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
	<head>
		<style>
		</style>
		<script>
			var ev;
			var data;
		var obj={
		
			monitor:function(){
				ev=new EventSource("ReminderNotify.php");
				ev.addEventListener("message",this.show,false);
				ev.onerror=this.err;

			
			
			},
			show:function(e){
			    console.log(e.data);
			    // for(var i=0;i<e.data.length;i++){
			    // 	console.log(e.data[i]);
			    // }
			    var obj = JSON.parse(e.data);
			    data = obj;
			    console.log(obj);
			    console.log('<?php echo $session_user_id; ?>')
				ev.close();	
			},
			err:function(){
				console.log("error");
				ev.close();	
			}
		
		}


function notifyMe() {
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }
  else if (Notification.permission === "granted") {
  		// console.log('<?php echo $_SESSION["id"]; ?>')
        var options = {
                body: data.ReminderMessage,
                title: data.ReminderName,
                dir : "ltr"
             };
          var notification = new Notification(data.ReminderName,options);
  }
  else if (Notification.permission !== 'denied') {
    Notification.requestPermission(function (permission) {
      if (!('permission' in Notification)) {
        Notification.permission = permission;
      }
    
      if (permission === "granted") {
        var options = {
              body: "This is the body of the notification",
              icon: "icon.jpg",
              dir : "ltr"
          };
        var notification = new Notification(data.ReminderName,options);
      }
    });
  }
}
</script>
		
		
	</head>
	<body onload="obj.monitor()">

		

		<!-- <input id="id1" type="text" name="Name" onchange="obj.monitor()"> -->

		<button onclick="notifyMe()">Notify me!</button>



	</body>
</html>