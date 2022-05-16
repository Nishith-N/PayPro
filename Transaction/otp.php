<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
		session_start();
		$pay_id=$_SESSION['pay_id'];
		$t=time();
				$d=date("Y-m-d",$t);
				echo $d;
				$sql="DELETE FROM trans_hist WHERE dates < now() - interval 30 DAY";
$result=mysqli_query($db,$sql);
	
			$phno=$_SESSION['phno'];
			$amount=$_SESSION['amount'];
			$username=$_SESSION['username'];
			$mywallet=$_SESSION['mywallet'];
			$recv_wallet=$_SESSION['recv_wallet'];
			$reason=$_SESSION['reason'];

			if(isset($_POST['submit_btn']))
			{
				$typed_otp=$_POST['typed_otp'];
				
				$sql="SELECT otp from user_details WHERE phone='".$username."' OR email='".$username."'";
				$result=mysqli_query($db,$sql);
				$row=mysqli_fetch_row($result);
				if($typed_otp==$row[0])
				{
				$_SESSION['phno']=$phno;
				$_SESSION['amount']=$amount;
				$_SESSION['username']=$username;
				$_SESSION['mywallet']=$mywallet;
				$_SESSION['recv_wallet']=$recv_wallet;
				$t=time();
				$d=date("Y-m-d",$t);
				

				$sql="CREATE TABLE IF NOT EXISTS trans_hist (tr_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, pay_id INT NOT NULL , pay_username BIGINT NOT NULL,pay_name VARCHAR(50) NOT NULL, amount BIGINT NOT NULL,dates DATE NOT NULL,reasons LONGTEXT NOT NULL)";
				$result=mysqli_query($db,$sql);
				$sql="SELECT fname from user_details WHERE phone='".$phno."'";
				$result=mysqli_query($db,$sql);
				$row=mysqli_fetch_row($result);
				$fname=$row[0];
				$sql="SELECT lname from user_details WHERE phone='".$phno."'";
				$result=mysqli_query($db,$sql);
				$row=mysqli_fetch_row($result);
				$lname=$row[0];
				$name=$fname." ".$lname;

				if($amount<20000)
				{
					$cashback=($amount*5)/100;
				}
				if($amount>=20000)
				{
					$cashback=($amount*9)/100;
				}
				$leftamount=($mywallet-$amount)+$cashback;
				$sql="UPDATE user_details SET wallet='".$leftamount."' WHERE phone='".$username."'";
				$result=mysqli_query($db,$sql);

				$addamount=$recv_wallet+$amount;
				$sql="UPDATE user_details SET wallet='".$addamount."' WHERE phone='".$phno."'";
				$result=mysqli_query($db,$sql);
				if($result)
				{
				$sql="INSERT INTO trans_hist (pay_id, pay_username,pay_name, amount,dates,reasons) VALUES ($pay_id, $phno,'$name',$amount,'$d','$reason')";
  				$result=mysqli_query($db,$sql);
				$_SESSION['username'] = $username;
				$_SESSION['pay_uname'] = $phno;
				$_SESSION['amount'] = $amount;
				$_SESSION['cashback'] = $cashback;
				$_SESSION['dates'] = $d;
				$_SESSION['reason'] = $reason;
				$_SESSION['name'] = $name;
				header("Location:../Transaction/transaction_receipt.php");
        		exit();
				}
				
				}
				else{
					header("Location:../Transaction/error.php");
        		exit();
				}
			}


?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>
<head>
	<title>OTP</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="otpstyle.css">   
</head>
<body>
<header id="header" style="margin-top: -9px;margin-left: -469px;" class="fixed-top ">
        <div class="container d-flex align-items-center">  
          <section>
            <span class="full-text" >
              <nav id="navbar" class="navbar" style="margin-top: 0%;">
                <ul>
                  <li><h1 class="logo me-auto" ><a href="../Userhome/userhome.php"><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                </ul>
              </nav>
              <br>
              
            </span>

            <span class="short-text">
              <nav id="navbar" class="navbar">
                <ul>
                  <li><h1 class="logo me-auto" ><a href="../Userhome/userhome.php"><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>                  
                </ul>
              </nav>
              <br>
        
            </span>
          </section>
        </div>
      </header>
      <!-- End Header -->
    
<div class="container">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardregister" style="margin-top: 250px;">
           
			<div class="card-header">
				<h3 class="register">OTP</h3>				
			</div>

			<div class="card-body">
				<form method="post" action="#">

                    <div class="form-group">
                        <label for="typed_otp" class="textregister">Enter OTP: </label><label for="typed_otp" class="starregister"> * </label>
                        <input type="number" id="typed_otp" name="typed_otp" class="form-control" style="width: 300px;">
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
