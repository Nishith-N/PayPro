<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');

session_start();
$username=$_SESSION['username'];
echo $username;
$otp=1234;

if(isset($_POST['submit_btn']))
{
	$phno=$_POST['phno'];
	$amount=$_POST['amount'];


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
			$_SESSION['otp']=$otp;

			header("Location:../Transaction/otp.php");
        exit();

		}
	}


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
	<link rel="stylesheet" type="text/css" href="formstyle.css">   
	<link rel="icon" href="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" type="image/icon type">
</head>
<body>
    
<div class="container">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardregister">
           
			<div class="card-header">
				<h3 class="register">Transaction</h3>				
			</div>

			<div class="card-body">
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