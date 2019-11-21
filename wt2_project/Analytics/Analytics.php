<?php 
session_start();
$session_user_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<head>
<title>HOME</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="reminder-carousel.css" />
<script src="reminder-carousel.js"></script>
<link rel="stylesheet" type="text/css" href="../navbar.css">

<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript">

function loadChart(data){
	console.log(data["result_got"][0].Category);

	var chartdata = new Array();
	for(var i =0;i<data["result_got"].length;i++){
		var obj = {y : data["result_got"][i].Amount, label:data["result_got"][i].Category};
		console.log(obj)
		chartdata[i] = obj;
	}

	console.log(chartdata);

var options = {
	title: {
		text: "Your Monthly Expenditure "
	},
	subtitles: [{
		text: "As of November, 2017"
	}],
	animationEnabled: true,
	data: [{
		type: "pie",
		startAngle: 40,
		toolTipContent: "<b>{label}</b>: Rs.{y}",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - Rs.{y}",
		dataPoints: chartdata
	}]
};
$("#chartContainer").CanvasJSChart(options);
}



function loadExpenseVsSavingsChart(data){


	console.log(data["result_got"]);
	var SavingArray = new Array();
	var ExpenseArray = new Array();

	for(var i=0;i<data["result_got"].length;i++){
		var obj1 = {y: data["result_got"][i].Savings, label:data["result_got"][i].MonthID};
		var obj2 = {y: data["result_got"][i].CurrentExpense, label:data["result_got"][i].MonthID};
		SavingArray[i] = obj1;
		ExpenseArray[i] = obj2;
	}


	var options = {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Savings v/s Expense"
	},
	axisY2:{
		prefix: "Rs. ",
		lineThickness: 0				
	},
	toolTip: {
		shared: true
	},
	legend:{
		verticalAlign: "top",
		horizontalAlign: "center"
	},
	data: [
	{     
		type: "stackedBar",
		showInLegend: true,
		name: "Savings",
		axisYType: "secondary",
		color: "#7E8F74",
		dataPoints: SavingArray
	},
	{
		type: "stackedBar",
		showInLegend: true,
		name: "Expense",
		axisYType: "secondary",
		color: "#F0D6A7",
		dataPoints: ExpenseArray
	},
	]
};

$("#BarchartContainer").CanvasJSChart(options);
}


function getdata(){	



	var userid = "<?php echo $session_user_id;?>";
	console.log(userid);
	var userobj={
    UserID:userid
	};


console.log(userobj);
	$.ajax({
            url: 'http://localhost:8081/wt2_project/Analytics/Piechart',
            type: 'post',
            dataType: 'json',
            contentType: 'application/json',
            success: function (data) {
             
             
               loadChart(data);
               // loadExpenseVsSavingsChart(data);

            },
            error:function(data){
                alert("error fetching categories");
                console.log(data.error);
            },
            data: JSON.stringify({UserID : userid})
        });


	$.ajax({
            url: 'http://localhost:8081/wt2_project/Analytics/BarChart',
            type: 'post',
            dataType: 'json',
            contentType: 'application/json',
            success: function (data) {
             
             
               // loadChart(data);
               loadExpenseVsSavingsChart(data);

            },
            error:function(data){
                alert("error fetching categories");
                console.log(data.error);
            },
            data: JSON.stringify({UserID : userid})
        });




}

window.onload = function () {
		getdata();



}


</script>

</head>
<body>
	<nav class="navbar fixed-top navbar-expand-md flex-nowrap navbar-new-top">
            <a href="../index.php" class="navbar-brand">Expensio</a>
            <ul class="nav navbar-nav mr-auto"></ul>
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link px-2" href="Analytics/Analytics.php">Analytics</a>
                </li>
                <li class="nav-item">
                    <button type="button"  class="header-btn"><a href="../../WEBTECH2/logout.php" style="color: red">Logout</a></button>
                </li>
            </ul>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbar2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>

<h1 class="text-center" style="position: absolute;margin-top: 10%;margin-left: 40%;">STATISTICS</h1>
<br>


<div id="chartContainer" style="height: 300px; width: 550px; position: absolute;margin-top: 200px;"></div>
<div id="BarchartContainer" style="height: 300px; width: 500px;position: absolute;margin-left: 650px;margin-top: 200px"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
</body>

</html>