<?php
$cashback=0;
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


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html>
<head>
	<title>OTP</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="otpstyle.css">   
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
                </ul>
              </nav>
              <br>
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
              
              </nav>
              <!-- .navbar --> 
            </span>
          </section>
        </div>
      </header>
      <!-- End Header -->

	  
<div class="container-fluid mainhead">
		
<div class="container" style="margin-top: 45px;">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardnewcontact">
           
			<div class="card-header">
				<h3 class="addcontact">OTP</h3>				
			</div>

			<div class="card-body" >
				<form method="post" action="#">
                    <div class="form-group">
                        <label for="typed_otp" class="textaddcontact">Enter OTP: </label><label for="typed_otp" class="starregister"> * </label>
                        <input type="number" id="typed_otp" name="typed_otp" class="form-control" style="width: 300px;">
                    </div> 

					<div class="form-group">
						<input type="submit" value="Submit" class="btn float-right add_contact_btn" name="submit_btn" id="submit_btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<br><br>
</div>
</body>
</html>