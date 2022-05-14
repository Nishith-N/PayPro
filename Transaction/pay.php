<?php
$mywallet=0;
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');

session_start();
$username=$_SESSION['username'];
$sql="SELECT wallet FROM user_details WHERE phone='".$username."' OR email='".$username."'";
	$result=mysqli_query($db,$sql);
  $row=mysqli_fetch_row($result);
  $disp=$row[0];
  $sql="DELETE FROM trans_hist WHERE dates < now() - interval 30 DAY";
$result=mysqli_query($db,$sql);
if($username=='')
{
  header("Location:../Home/home.html");
        exit(); 
}



if(isset($_POST['submit_btn']))
{
	$phno=$_POST['phno'];
	$amount=$_POST['amount'];
  $reason=$_POST['reason'];
  
  $sql="SELECT block1 FROM user_details WHERE phone='".$phno."'";
  $result=mysqli_query($db,$sql);
  $row=mysqli_fetch_row($result);
  if($row[0]==1)
  {
    header("Location:../Transaction/error.php");
        exit(); 
  }

  $otp = rand(1111,9999);

  $no = $username;
  
  $fields = array(
  "variables_values" => "$otp",
  "route" => "otp",
  "numbers" => "$no",
  );

  $curl = curl_init();
  
  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => array(
  "authorization: a1mYvJTkBdoeW9EyMbi74PLnuhFtpsQCKgVl5IXzHOrUAZq68DQiJDj4NOA3C5mhLM2KcXyRxuZa6kY8",
  "accept: */*",
  "cache-control: no-cache",
  "content-type: application/json"
  ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  
  curl_close($curl);
  
 

  $sql="UPDATE user_details SET otp='".$otp."' WHERE phone='".$username."' OR email='".$username."'";
  $result=mysqli_query($db,$sql);


  $sql="SELECT limits FROM user_details WHERE phone='".$username."' OR email='".$username."'";
	$result=mysqli_query($db,$sql);
  $row1=mysqli_fetch_row($result);
  if($row1<$amount)
  {
    header("Location:../Transaction/error.php");
    exit();
  }
  
	$sql="SELECT wallet FROM user_details WHERE phone='".$username."' OR email='".$username."'";
	$result=mysqli_query($db,$sql);
	if(mysqli_num_rows($result)==1)
	{
		$row=mysqli_fetch_row($result);
		$mywallet=$row[0];
	}

	$sql="SELECT wallet FROM user_details WHERE phone='".$phno."'";
	$result=mysqli_query($db,$sql);
	if(mysqli_num_rows($result)==1)
	{
		$row=mysqli_fetch_row($result);
		$recv_wallet=$row[0];
		if($mywallet>$amount)
		{
			
			$_SESSION['phno']=$phno;
			$_SESSION['amount']=$amount;
			$_SESSION['username']=$username;
			$_SESSION['mywallet']=$mywallet;
			$_SESSION['recv_wallet']=$recv_wallet;
      $_SESSION['reason']=$reason;
      


			header("Location:../Transaction/otp.php");
        exit();

		}
    else
    {
      $_SESSION['username']=$username;
			header("Location:../Transaction/error.php");
      exit();


    }
    
	}
  else
    {
      $_SESSION['username']=$username;
			header("Location:../Transaction/error.php");
      exit();


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
	<title>Transaction</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="pay_style.css">   
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
              <!-- .navbar --> 
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
              <!-- .navbar --> 
            </span>
          </section>
        </div>
      </header>
      <!-- End Header -->
    
<div class="container" >
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardregister" style="margin-top: 180px;">
           
			<div class="card-header">
				<h3 class="register">Transaction</h3>				
			</div>

			<div class="card-body" >
				<form action="#" method="post">

                    <div class="form-group">
                        <label for="phno" class="textregister">Phone Number </label><label for="phno" class="starregister"> * </label>
                        <input type="number" id="phno" name="phno" class="form-control" style="width: 300px;">
                    </div> 

                    <div class="form-group">
                        <label for="amount" class="textregister">Amount </label><label for="amount" class="starregister"> * </label>
                        <input type="number" id="amount" name="amount" class="form-control" style="width: 300px;"> 
                    </div>  
                    
                    <div class="form-group">
                        <label for="reason" class="textregister">Reason </label><label for="reason" class="starregister"> * </label>
                        <input type="text" id="reason" name="reason" class="form-control" style="width: 300px;"> 
                    </div> 

					<div class="form-group">
						<input type="submit" value="Submit" class="btn float-right login_btn" name="submit_btn" id="submit_btn"><br><br>
						
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<br><br>
</body>
</html>
