<?php
session_start();
$session_user_id=$_SESSION['id'];
header("Content-type:text/event-stream");
  ob_start();
  ob_flush();
  flush();



// Create connection
$conn = new mysqli('localhost', 'root', '', 'Expensio');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$Today = date("Y-m-d");
echo $Today;
$sql = "SELECT * FROM `Reminders` WHERE ReminderDate=CURRENT_DATE() and UserID = ".$session_user_id."";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    // $reminder_array = array();
    while($row = $result->fetch_assoc()) {
      // echo "<br>";
     //    echo "userID : ".$row["UserID"]." id: " . $row["ReminderID"]. " - Name: " . $row["ReminderName"]. "  - \nMessage : " . $row["ReminderMessage"]." Amount :  ".$row["ReminderAmount"] ."<br>";

        $Reminder->userID = $row["UserID"];
        $Reminder->ReminderID = $row["ReminderID"];
        $Reminder->ReminderName = $row["ReminderName"];
        $Reminder->ReminderMessage = $row["ReminderMessage"];
        $Reminder->ReminderAmount = $row["ReminderAmount"];
        $myJSON = json_encode($Reminder);
        // echo $myJSON;
        // array_push($reminder_array, $myJSON);
        echo "event:message\n";
    echo "data:$myJSON\n\n";
    ob_flush();
    flush();
    $flag=0;

    }
    // echo $reminder_array;
    //     echo "event:message\n";
    //     echo "data:$reminder_array\n\n";
    //     ob_flush();
    //     flush();
    //     $flag=0;
} else {
    echo "0 results";
}



// $user_id = $_SESSION['id'];
// $Today = date("Y-m-d");
// echo $Today;
// list($y, $m, $d) = explode('-', $Today);
// echo "\n";
// echo $m.$y;
// $monthid = $m.$y;


// $sql1 = "SELECT MonthID, Verified FROM `UserDetails` WHERE UserID = ".$user_id." AND MonthID = ".$monthid;

// if($d==19){


                                                  

//   $result = $conn->query($sql1);
//   if ($result->num_rows > 0){
//     while($row = $result->fetch_assoc()) {
      
      

//         echo "Already Present";
  
//         if($row["Verified"] == 0){
//         echo "event:updatemonth\n";
//         echo "data:Please Add Monthly Details\n\n";
//     ob_flush();
//     flush();
//     $flag=0;
//   }

//     }
//   }
//   else{
//     $insertsql = "INSERT INTO `UserDetails` VALUES (".$user_id.",".$monthid.",0,0,0,0,0)";
//     $result = $conn->query($insertsql);
//   }
// }
// else{
//   echo "else";

// }


$conn->close();


?>