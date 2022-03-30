<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
		session_start();
        $username=$_SESSION['username'];
        
        $sql="SELECT wallet FROM user_details WHERE phone='".$username."' OR email='".$username."'";
	$result=mysqli_query($db,$sql);
  $row=mysqli_fetch_row($result);
  $disp=$row[0];

		$amount=0;
    if($username=='')
{
  header("Location:../Home/home.html");
        exit(); 
}
    if(isset($_POST['signout']))
    {
      session_destroy();
    header("Location:../Login/login.php");
          exit();
    }
			if(isset($_POST['submit_btn']))
			{
                $amount=$_POST['amount'];
				if($amount)
				{
          $sql="SELECT primary_card FROM user_details WHERE phone='".$username."' OR email='".$username."'";
                $result=mysqli_query($db,$sql);
                $row=mysqli_fetch_row($result);
                $cardnum=$row[0];
				$sql="SELECT amount FROM bank_details WHERE phone='".$username."' AND card_number='".$cardnum."'";
                $result=mysqli_query($db,$sql);
                $row=mysqli_fetch_row($result);
                $bankamount=$row[0];

                $sql="SELECT wallet FROM user_details WHERE phone='".$username."' OR email='".$username."'";
                $result=mysqli_query($db,$sql);
                $row=mysqli_fetch_row($result);
                $walletamount=$row[0];
                echo $walletamount;

				if($bankamount>$amount)
				{
				
				$addamount=$walletamount+$amount;
                $leftamount=$bankamount-$amount;
				$sql="UPDATE user_details SET wallet='".$addamount."' WHERE phone='".$username."' OR email='".$username."'";
				$result=mysqli_query($db,$sql);
                $sql="UPDATE bank_details SET amount='".$leftamount."' WHERE phone='".$username."' AND card_number='".$cardnum."'";
				$result=mysqli_query($db,$sql);

				header("Location:../Transaction/success.php");
        		exit();
                
				}
			}
				else{
					$_SESSION['username']=$username;
					header("Location:../Transaction/error.php");
        		exit();
                
				}
			}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recharge</title>
    <meta charset="utf-8">
    
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">



  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Template Main CSS File -->
  <link href="recharge.css" rel="stylesheet">
  <link rel="icon" href="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" type="image/icon type">
</head>
<body style="background-image: url('https://www.sykes.com/wp-content/uploads/2020/10/100820-feature-image-gen-z-mobile-digital-blog-scaled.jpg');background-size: cover;height: 100%;font-family: 'Numans', sans-serif;">
<header id="header" style="margin-top: -22px;" class="fixed-top ">
          
          <section>
            <span class="full-text" >
              <nav id="navbar" class="navbar" style="margin-top: 0%;">
                <ul>
                <li><h1 class="logo me-auto" ><a href="../Userhome/userhome.php"><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                  <ul style="margin-left: 50%;">
                  <li><a class="nav-link scrollto" href="../Profile/manageprofile.php">Manage Profile</a></li>                   
                    <li><a class="nav-link scrollto active" href="../Userhome/recharge.php">Recharge</a></li>
                    <li><a class="nav-link scrollto" href="../Userhome/remove_money.php">Remove Money</a></li>
                    <li><a class="nav-link scrollto" href="../Profile/password_reset.php">Reset Password</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <li><form method="post" action="#"><input type="submit" style=" width: 120px;
                        border-radius: 20px;
                        height: 40px;
                        border-color: white;
                        background-color: #892883;
                        color: white;
                        font-size: 18px;"  value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
                  </ul>
                </ul>
              </nav>
              <?php
              print'
              <marquee style="color:#F8B74E"><h4>Wallet amount: '.$disp.'</h4></marquee>';
              ?>
              <br>
              <!-- .navbar --> 
            </span>

            <span class="short-text">
              <nav id="navbar" class="navbar">
                <ul>
                <li><h1 class="logo me-auto" ><a href="../Userhome/userhome.php"><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                  
                </ul>
              </nav>
              <br>
              <nav id="navbar" class="navbar">
              <ul style="margin-left: 0%;">
              <li><a class="nav-link scrollto" href="../Profile/manageprofile.php">Manage Profile</a></li>                   
                    <li><a class="nav-link scrollto active" href="../Userhome/recharge.php">Recharge</a></li>
                    <li><a class="nav-link scrollto" href="../Userhome/remove_money.php">Remove Money</a></li>
                    <li><a class="nav-link scrollto" href="../Profile/password_reset.php">Reset Password</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <li><form method="post" action="#"><input type="submit" style=" width: 120px;
                        border-radius: 20px;
                        height: 40px;
                        border-color: white;
                        background-color: #892883;
                        color: white;
                        font-size: 18px;" value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
              </ul>
              </nav>
              <?php
              print'
              <marquee style="color:#F8B74E"><h4>Wallet amount: '.$disp.'</h4></marquee>';
              ?>
              <!-- .navbar -->
            </span>
          </section>
    
      </header>
      <!-- End Header -->

<br>

<div class="container2">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardregister" style="margin-top: 180px">
           
			<div class="card-header">
				<h3 class="register">Recharge</h3>				
			</div>

			<div class="card-body">
				<form method="post" action="#">

                    <div class="form-group">
                        <label for="amount" class="textregister">Enter amount: </label><label for="amount" class="starregister"> * </label>
                        <input type="number" id="amount" name="amount" class="form-control" style="width: 300px;">
                    </div> 

                                    

					<div class="form-group">
						<input type="submit" value="Submit" class="btn float-right login_btn" name="submit_btn" id="submit_btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<br><br>




</body>

</html>
