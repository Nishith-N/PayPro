<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
		session_start();
        $username=$_SESSION['username'];
        echo $username;

			if(isset($_POST['submit_btn']))
			{
                $amount=$_POST['amount'];
				$sql="SELECT amount FROM bank_details WHERE phone='".$username."'";
                $result=mysqli_query($db,$sql);
                $row=mysqli_fetch_row($result);
                $bankamount=$row[0];

                $sql="SELECT wallet FROM user_details WHERE phone='".$username."' OR email='".$username."'";
                $result=mysqli_query($db,$sql);
                $row=mysqli_fetch_row($result);
                $walletamount=$row[0];
                echo $walletamount;

				
				if($walletamount>$amount)
				{
				$removeamount=$walletamount-$amount;
                $addamount=$bankamount+$amount;
				$sql="UPDATE user_details SET wallet='".$removeamount."' WHERE phone='".$username."' OR email='".$username."'";
				$result=mysqli_query($db,$sql);
                $sql="UPDATE bank_details SET amount='".$addamount."' WHERE phone='".$username."'";
				$result=mysqli_query($db,$sql);
                }
/*
				header("Location:../Userhome/userhome.php");
        		exit();
                */
				
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
	<link rel="stylesheet" type="text/css" href="wallet_remove_style.css">   
</head>
<body>
    
<div class="container">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardregister">
           
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
