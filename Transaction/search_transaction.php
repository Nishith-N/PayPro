<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');

session_start();
$username=$_SESSION['username'];
$sql="SELECT wallet FROM user_details WHERE phone='".$username."' OR email='".$username."'";
	$result=mysqli_query($db,$sql);
  $row=mysqli_fetch_row($result);
  $sql="DELETE FROM trans_hist WHERE dates < now() - interval 30 DAY";
$result=mysqli_query($db,$sql);
  $disp=$row[0];
$day='';
$month='';
$f_amount=0;
$t_amount=0;
$year='';
if($username=='')
{
  header("Location:../Home/home.html");
        exit(); 
}



if(isset($_POST['submit_btn']))
{
  $f_amount=0;
  $search_date='';
  $day='';
  $month='';
  $year='';
	$day=$_POST['date'];
  echo $day;
  $month=$_POST['month'];
  $year=$_POST['year'];
  $f_amount=$_POST['f_amount'];
  $t_amount=$_POST['t_amount'];

  $search_date=$year."-".$month."-".$day;
  if($day=='' || $month=='' || $year=='')
  {
    if($f_amount==0 && $t_amount==0)
    {
    header("Location:../Transaction/error.php");
        exit();
    }
    if($t_amount==0)
    {
      $sql="SELECT pay_id FROM trans_hist WHERE amount = '".$f_amount."'";
	$result=mysqli_query($db,$sql);
  $num=mysqli_num_rows($result);
  if($num!=0)
  {
    
    $flag=1;
    $_SESSION['f_amount']=$f_amount;
    $_SESSION['flag']=$flag;

    header("Location:../Transaction/form.php");
        exit(); 
  }
    }
    if($t_amount!=0 && $f_amount!=0)
    {
      $sql="SELECT pay_id FROM trans_hist WHERE amount >= '".$f_amount."' AND amount <= '".$t_amount."'";
	$result=mysqli_query($db,$sql);
  $num=mysqli_num_rows($result);
  if($num!=0)
  {
    $flag=1;
    $_SESSION['search_date']='';
    $_SESSION['f_amount']=$f_amount;
    $_SESSION['t_amount']=$t_amount;
    $_SESSION['flag']=$flag;

    header("Location:../Transaction/form.php");
        exit(); 
  }
    }
  }
  else if($day!='' && $month!='' && $year!='' && $t_amount!=0 && $f_amount!=0)
  {
    $sql="SELECT pay_id FROM trans_hist WHERE dates < '".$search_date."' AND  amount BETWEEN '".$f_amount."' AND '".$t_amount."'";
	$result=mysqli_query($db,$sql);
  $num=mysqli_num_rows($result);
  if($num!=0)
  {
    $flag=2;
    $_SESSION['search_date']=$search_date;
    $_SESSION['f_amount']=$f_amount;
    $_SESSION['t_amount']=$t_amount;
    $_SESSION['flag']=$flag;

    header("Location:../Transaction/form.php");
        exit(); 
  }
  }
  else if($day!='' && $month!='' && $year!='' && $t_amount==0 && $f_amount!=0)
  {
    $sql="SELECT pay_id FROM trans_hist WHERE dates < '".$search_date."' AND  amount='".$f_amount."'";
	$result=mysqli_query($db,$sql);
  $num=mysqli_num_rows($result);
  
    $flag=2;
    $_SESSION['search_date']=$search_date;
    $_SESSION['f_amount']=$f_amount;
    $_SESSION['t_amount']=0;
    $_SESSION['flag']=$flag;

    header("Location:../Transaction/form.php");
        exit(); 
  
  }
  else
  {
  
  $sql="SELECT pay_id FROM trans_hist WHERE dates < '".$search_date."'";
	$result=mysqli_query($db,$sql);
  $num=mysqli_num_rows($result);
  if($num!=0)
  {
    $flag=1;
    $_SESSION['f_amount']=0;
    $_SESSION['t_amount']=0;
    $_SESSION['search_date']=$search_date;
    $_SESSION['flag']=$flag;

    header("Location:../Transaction/form.php");
        exit(); 
  }
}




}

if(isset($_POST['signout']))
{
  session_destroy();
    header("Location:../Login/login.php");
          exit();
}




?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>
<head>
	<title>Search Transaction</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="search_transaction_style.css">   
	<link rel="icon" href="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" type="image/icon type">
</head>
<body>

<header id="header" style="margin-top: -22px;" class="fixed-top ">
        <div class="container d-flex align-items-center">  
          <section>
            <span class="full-text" >
              <nav id="navbar" class="navbar" style="margin-top: 0%;">
                <ul style="padding-top: 20px;">
                  <li><h1 class="logo me-auto" style="margin-left: -200px;"><a href="../Userhome/userhome.php"><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                  <ul style="margin-left: 650px;">
                  <li><a class="nav-link scrollto " href="../Userhome/userhome.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="../Cards/cards.php">Cards</a></li>
                    <li><a class="nav-link scrollto active" href="../Transaction/form.php">Transaction</a></li>
                    <li><a class="nav-link scrollto" href="../Contacts/list_contact.php">Contact</a></li>&nbsp;&nbsp;
                
                    <li><a class="nav-link scrollto" href="../Profile/profilehome.php">Profile</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <li><form method="post" action="#"><input type="submit"  value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
  
                  </ul>
                </ul>
              </nav>
              <br>
              <?php
              print'
              <marquee style="color:#F8B74E"><h4>Wallet amount: '.$disp.'</h4></marquee>';
              ?>
               
            </span>

            <span class="short-text">
              <nav id="navbar" class="navbar">
                <ul>
                  <li><h1 class="logo me-auto" style="padding-top: 24px;margin-left: -70px;"><a href="../Userhome/userhome.php"><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                  
                </ul>
              </nav>
              <br>
              <nav id="navbar" class="navbar">
              <ul style="margin-left: -24px;">
                <li><li><a class="nav-link scrollto " href="../Userhome/userhome.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="../Cards/cards.php">Cards</a></li>
                    <li><a class="nav-link scrollto active" href="../Transaction/form.php">Transaction</a></li>
                    <li><a class="nav-link scrollto" href="../Contacts/list_contact.php">Contact</a></li>
                    <li><a class="nav-link scrollto" href="../Profile/profilehome.php">Profile</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <li><form method="post" action="#"><input type="submit"  value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
              </ul>
              </nav>
              <?php
              print'
              <marquee style="color:#F8B74E"><h4>Wallet amount: '.$disp.'</h4></marquee>';
              ?>
            
            </span>
          </section>
        </div>
      </header> 
    
<div class="container" >
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardregister" style="margin-top: 180px;">
           
			<div class="card-header">
				<h3 class="register">Search Transaction</h3>				
			</div>

			<div class="card-body" >
				<form action="#" method="post">
                    <div class="form-row">
                    <div class="form-group col-md">
                        <label for="cno" class="textregister">Amount (From) </label><label for="cno" class="starregister"> * </label>
                        <input type="text" id="cno" name="f_amount" class="form-control" style="width: 100px;">
                    </div>
                    
                    <div class="form-group col-md">
                      <label for="reason" class="textregister">Amount (To) </label><label for="reason" class="starregister"> * </label>
                      <input type="text" id="reason" name="t_amount" class="form-control" style="width: 100px;">
                    </div> 
                    </div>
                    <label for="date" class="textregister">From</label><label for="date" class="starregister"> * </label>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                          <label for="date" class="textregister">Date</label>
                          <select id="date" class="form-control" name="date">
                            <option selected value=""></option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>                            
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="month" class="textregister">Month</label>
                          <select id="month" class="form-control" name="month">
                            <option selected value=""></option>
                            <option value="01">Jan</option>
                            <option value="02">Feb</option>
                            <option value="03">Mar</option>
                            <option value="04">Apr</option>
                            <option value="05">May</option>
                            <option value="06">Jun</option>
                            <option value="07">Jul</option>
                            <option value="08">Aug</option>
                            <option value="09">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                          </select>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="year" class="textregister">Year</label>
                          <input type="text" class="form-control" id="year" name="year">
                        </div>
                    </div>      
                    <label for="date" class="textregister">To</label><label for="date" class="starregister"> * </label>
                    <div class="form-row">                        
                        <div class="form-group col-md-3">
                          <label for="date" class="textregister">Date</label>
                          <select id="todate" class="form-control" name="todate">
                            <option selected value="">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>                            
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="month" class="textregister">Month</label>
                          <select id="month" class="form-control" name="tomonth">
                            <option selected value="">Jan</option>
                            <option value="Feb">Feb</option>
                            <option value="Mar">Mar</option>
                            <option value="Apr">Apr</option>
                            <option value="May">May</option>
                            <option value="Jun">Jun</option>
                            <option value="Jul">Jul</option>
                            <option value="Aug">Aug</option>
                            <option value="Sep">Sep</option>
                            <option value="Oct">Oct</option>
                            <option value="Nov">Nov</option>
                            <option value="Dec">Dec</option>
                          </select>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="toyear" class="textregister">Year</label>
                          <input type="text" class="form-control" id="toyear" name="toyear">
                        </div>
                    </div>

					<div class="form-group">
						<input type="submit" value="Search" class="btn float-right login_btn" name="submit_btn" id="submit_btn"><br><br>						
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<br><br>
</body>
</html>
