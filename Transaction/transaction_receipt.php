<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
		session_start();
    $username=$_SESSION['username'];
    $phno=$_SESSION['pay_uname'];
    $amount=$_SESSION['amount'];
    $_SESSION['varname'] = $username;
    $cashback=$_SESSION['cashback'];
    $dates=$_SESSION['dates'];
    $reason=$_SESSION['reason'];
    $payee_name=$_SESSION['name'];
    $sql="DELETE FROM trans_hist WHERE dates < now() - interval 30 DAY";
$result=mysqli_query($db,$sql);
$sql="SELECT fname from user_details WHERE phone='".$username."'";
				$result=mysqli_query($db,$sql);
				$row=mysqli_fetch_row($result);
				$fname=$row[0];
				$sql="SELECT lname from user_details WHERE phone='".$username."'";
				$result=mysqli_query($db,$sql);
				$row=mysqli_fetch_row($result);
				$lname=$row[0];
				$payer_name=$fname." ".$lname;

    if(isset($_POST['gotohome_btn']))
    {
      header("Location:../Userhome/userhome.php");
        		exit();
    }


    ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="transaction_receipt_style.css">   
    <link rel="icon" href="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" type="image/icon type">
</head>
<body>

	  
<div class="container-fluid mainhead">
		
<div class="container" style="margin-top: 45px;">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardnewcontact">
           
			<div class="card-header">
                <center>
				<div><img src="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" class="logo"></div>
                <h1>Payment Receipt</h1>
                </center>				
			</div>
<?php print '
			<div class="card-body" >
				<table  style="width: 100%;border-spacing: 20px;color:black">
                    <tr>
                        <td style="padding-bottom: 3px;">Payer Information</td>
                    </tr>
                    <tr >
                        <td style="padding-left: 20px;padding-bottom: 3px;">'.$payer_name.'</td>
                    </tr>
                    
                    <tr >
                        <td style="padding-left: 20px;padding-bottom: 9px;">'.$username.'</td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 3px;">Payee Information</td>
                    </tr>
                    <tr >
                        <td style="padding-left: 20px;padding-bottom: 3px;">'.$payee_name.'</td>
                    </tr>
                   
                    <tr >
                        <td style="padding-left: 20px;padding-bottom: 20px;">'.$phno.'</td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 3px;">Date: '.$dates.'</td>
                    </tr>
                   
                    <tr>
                        <td style="padding-bottom: 3px;">Amount: ₹ '.$amount.'</td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 3px;">Reason: '.$reason.'</td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 3px;">CashBack: ₹ '.$cashback.'</td>
                    </tr>
                </table>
			</div>';
            ?>
         
		</div>
	</div>
</div>
<br><br>
</div>
</body>
</html>