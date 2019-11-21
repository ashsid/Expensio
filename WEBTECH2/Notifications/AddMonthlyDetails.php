<?php 
session_start();
header("Content-type:text/event-stream");
	ob_start();
	ob_flush();
	flush();


$user_id = $_SESSION['id'];
$Today = date("Y-m-d");
echo $Today;
list($y, $m, $d) = explode('-', $Today);
echo "\n";
echo $m.$y;
$monthid = $m.$y;

$conn = new mysqli('localhost', 'root', '', 'Expensio');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT MonthID, Verified FROM `UserDetails` WHERE UserID = ".$user_id." AND MonthID = ".$monthid;

if($d==18){


																									

	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()) {
    	
      

        echo "Already Present";
 	
        if($row["Verified"] == 0){
        echo "event:updateMonthlyExpence\n";
		echo "data:PleaseAddMonthlyDetails\n\n";
		ob_flush();
		flush();
		$flag=0;
	}

    }
	}
	else{
		$insertsql = "INSERT INTO `UserDetails` VALUES (".$user_id.",".$monthid.",0,0,0,0,0)";
		$result = $conn->query($insertsql);
	}
}
else{

}

?>