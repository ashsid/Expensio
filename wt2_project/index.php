<?php include '../WEBTECH2/controllers/authController.php'?>
<?php
// redirect user to login page if they're not logged in
if (empty($_SESSION['id'])) {
    header('location: ../WEBTECH2/login.php');
}
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="main.css">


<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="reminder-carousel.css" />
<script src="reminder-carousel.js"></script>
<link rel="stylesheet" type="text/css" href="navbar.css">
<link rel="stylesheet" type="text/css" href="expenseadd-modal.css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="index.js"></script>
<script type="text/javascript">

</script>
    



<style type="text/css">
	.mb-60 {
    margin-bottom: 60px;
}
.services-inner {
    border: 2px solid black;
    margin-left: 35px;
    transition: .3s;
}
.our-services-img {
    float: left;
    margin-left: -36px;
    margin-right: 22px;
    margin-top: 28px;
}
.our-services-text {
    padding-right: 10px;
}
.our-services-text {
    overflow: hidden;
    padding: 28px 0 25px;
}
.our-services-text h4 {
    color: #222222;
    font-size: 18px;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 8px;
    padding-bottom: 10px;
    position: relative;
    text-transform: uppercase;
}
.our-services-text h4::before {
    background: #ec6d48 none repeat scroll 0 0;
    bottom: 0;
    content: "";
    height: 1px;
    position: absolute;
    width: 35px;
}
.our-services-wrapper:hover .services-inner {
    background: #fff none repeat scroll 0 0;
    border: 2px solid transparent;
    box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.2);
}
.our-services-text p {
    margin-bottom: 0;
}
p {
    font-size: 14px;
    font-weight: 400;
    line-height: 26px;
    color: #666;
    margin-bottom: 15px;
}
.navbar-brand{
	font-family: 'Roboto Condensed', sans-serif;
}
.mon{
	font-size: 20px;
	font-family: 'Roboto Condensed', sans-serif;
}
.black{
	color:black;
}
.pad15{
	border: solid black 2px;
}

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
</style>
</head>
<body onload="set()">
	<nav class="navbar fixed-top navbar-expand-md flex-nowrap navbar-new-top">
            <a href="index.php" class="navbar-brand">Expensio</a>
            <ul class="nav navbar-nav mr-auto"></ul>
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link px-2" href="Analytics/Analytics.php">Analytics</a>
                </li>
                <li class="nav-item">
                    <button type="button"  class="header-btn"><a href="../WEBTECH2/logout.php" style="color: red">Logout</a></button>
                </li>
            </ul>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbar2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
 <br>
 <br>
 <br>

<div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 home-wrapper">

        <!-- Display messages -->
        <?php if (isset($_SESSION['message'])): ?>
        <div class="alert <?php echo $_SESSION['type'] ?>">
          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            unset($_SESSION['type']);
          ?>
        </div>
        <?php endif;?>

        <h4 style="position: absolute;margin-left: 650px">Welcome, <?php echo $_SESSION['username']; ?></h4>




        <!-- <a href="../WEBTECH2/logout.php" style="color: red">Logout</a> -->
        <?php if (!$_SESSION['verified']): ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            You need to verify your email address!
            Sign into your email account and click
            on the verification link we just emailed you
            at
            <strong><?php echo $_SESSION['email']; ?></strong>
          </div>
        <?php else: ?>
          <!-- <button class="btn btn-lg btn-primary btn-block">I'm verified!!!</button> -->
        <?php endif;?>
      </div>
    </div>
  </div>

<div class="container">
    <h2 class="text-center">OVERVIEW</h2><br>
    <div class="row" id="mondet">
              <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12">
              <label>Income</label>
              <input type="number" class="form-control" id="moninc" placeholder="Enter Monthly Income" required>
              </div>
              <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12">
              <label>Monthly Limit</label>
              <input type="number" class="form-control" id="monlim" placeholder="Enter Monthly Limit" required>
              </div>
              <br>
              <button class="btn btn-success" onclick="add_monthly_details()" style="width:5%;height: 30%;margin-top: 2.6%;">Add</button>
    </div>
	<div class="row">
		<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
						<div class="our-services-wrapper mb-60">
							<div class="services-inner">
								<div class="our-services-img">
								<img src="mr.png" width="68px" alt="">
								</div>
								<div class="our-services-text">
									<h4>Money Spent</h4>
									<p class="mon"><i class="fa fa-inr" style="font-size:24px"></i><span id="ms"></span></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
						<div class="our-services-wrapper mb-60">
							<div class="services-inner">
								<div class="our-services-img">
								<img src="coin.png" width="68px" alt="">
								</div>
								<div class="our-services-text">
									<h4>Remaining Balance</h4>
									<p class="mon"><i class="fa fa-inr" style="font-size:24px"></i><span id="rb"></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
						<div class="our-services-wrapper mb-60">
							<div class="services-inner">
								<div class="our-services-img">
								<img src="hand.png" width="68px" alt="">
								</div>
								<div class="our-services-text">
									<h4>Monthly Limit</h4>
									<p class="mon"><i class="fa fa-inr" style="font-size:24px"></i><span id="ml"></p>
								</div>
							</div>
						</div>
					</div>
	</div>
</div>
<h3 class="text-center">Expenses</h3>
<div class="container">
    	    <a class="btn btn-primary btn-outline" data-toggle="modal" data-target="#squarespaceModal">Add Expense</a>
<input class="form-control" type="text" placeholder="Search" aria-label="Search" style="width:30%;float:right;" onkeyup="fetch_search_expenses()" id="srch">
            <br><br>
	<div class="row">
		<div class="span5">
            <table class="table table-striped table-condensed" id="expensetable" style="margin-left: 65%;">
                  <thead>
                  <tr>
                      <th>Expense</th>
                      <th>Date of Expense</th>
                      <th>Amount</th>
                      <th>Type</th> 
                      <th></th>                                         
                  </tr>
              </thead>   
              <tbody id="exptable">                                 
              </tbody>
            </table>
            </div>
	</div>
</div>
<br>
<h3 class="text-center">Upcoming Reminders</h3>
<div class="container">
	<a class="btn btn-primary btn-outline" data-toggle="modal" data-target="#remainder">Add Remainder</a>
		<hr/>
	<div class="row">
		<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
            <div class="MultiCarousel-inner" id="remcarousel">
            	    <div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            	<div class="item">
            		<div class="pad15"></div>
            	</div>
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
	</div>
</div>
<hr/>
<!-- <p>modal for add expense</p> -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
						<h3>Add Expense</h3>
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">X</span><span class="sr-only">Close</span></button>
		</div>
		<br>
		<div class="container">
              <div class="form-group">
                <label>Category</label>
                <select id="category">
                </select>
              </div>
              <div class="form-group">
                <label>Expense Name</label>
                <input type="text" id="expname" class="form-control" placeholder="Expense Name" required>
              </div>
              <div class="form-group">
                <label>Date</label>
                <input type="date" id="expdate" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Amount</label>
                  <input type="number" id="expamt" class="form-control" required>
              </div>
              <center><button class="btn btn-success" onclick="add_expense()">Add</button></center>
		</div>
		<br>
	</div>
  </div>
</div>
<div class="modal fade" id="remainder" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h3></i></span>Reminder</h3>
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">X</span><span class="sr-only">Close</span></button>
</div>
<br>
<div class="container">
              <div class="form-group">
                <label>Reminder Name</label>
                <input type="text" class="form-control" placeholder="Name" id="remname" required>
              </div>
              <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" id="remdate">
              </div>
              <div class="form-group">
              <label>Message</label>
              <input type="text" class="form-control" placeholder="Type Here..." id="remmsg">
              </div>
              <div class="form-group">
              <label>Amount</label>
              <input type="number" class="form-control" id="remamt" required>
              </div>
              <center><button class="btn btn-success" onclick="add_reminder()">Add</button></center>
</div>
<br>
</div>
</div>
</div>
</body>
<script type="text/javascript">
var userid="<?php echo $_SESSION['id']; ?>";
function set(){

var ev;
      var data;
    var obj={
    
      monitor:function(){
        ev=new EventSource("ReminderNotify.php");
        ev.addEventListener("message",this.show,false);
        ev.onerror=this.err;

        
      
      },
      
      show:function(e){
          // console.log(e.data);
          // console.log('<?php echo $session_user_id?>');
          var obj = JSON.parse(e.data);
          data = obj;
          // console.log("sgsgsgs");
          if(obj.userID == '<?php echo $session_user_id?>'){
            // console.log("svsgsfg");
            notifyMe();
            // ev.close();
          }         
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
check_monthly_details_display();
  categories();
	expenses();
	fetch_reminders();
  fetch_monthlylimit();
	money_spent();
  // obj.monitorMonthlyUpdate();
  obj.monitor();   
}
</script>
</html>