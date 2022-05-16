<?php

$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
$sql="DELETE FROM trans_hist WHERE dates < now() - interval 30 DAY";
$result=mysqli_query($db,$sql);
$phnoerr='';
  $cnoerr='';
  $accnoerr='';
if(isset($_POST['submit_btn']))
{
  
  $accno=$_POST['accno'];
  $cno=$_POST['cno'];
  $bname=$_POST['bname'];
  $amt=$_POST['amt'];
  $phno=$_POST['phno'];
  $cvv=$_POST['cvv'];
  $phnol = strlen((string)$phno);
  $cnol = strlen((string)$cno);
  $accnol = strlen((string)$accno);
  $flag=1;

  if($phnol!=10)
  {
    $phnoerr = "Phone No is not valid"; 
    $flag=0;
  }
  if($cnol<15)
  {
    $cnoerr = "Card number is not valid"; 
    $flag=0;
  }
  if($accnol<15)
  {
    $accnoerr = "Account number is not valid"; 
    $flag=0;
  }
  if($flag==1)
  {
    $sql="INSERT INTO bank_details (acc_number, card_number, bank_name, amount, phone, cvv) VALUES ('$accno', '$cno', '$bname', '$amt', '$phno', '$cvv')";
    $result=mysqli_query($db,$sql);
  }
  




}

?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html>
<head>
	<title>Bank Details</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="bank_details_style.css">   
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
                  <ul style="margin-left: 35%;">
                  <li><a class="nav-link scrollto active" href="../Admin/adminhome.php">Home</a></li>
                    <li><a class="nav-link scrollto active" href="../Admin/bank_details.php">Bank Details</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/block_users.php">Block Users</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/unblock_users.php">Unblock Users</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/remove_users.php">Remove Users</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/coupons.php">Coupons</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li><form method="post" action="../Home/home.html"><input type="submit"  value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
                  </ul>
                </ul>
              </nav>
              <br>
             
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
              <li><a class="nav-link scrollto active" href="../Admin/adminhome.php">Home</a></li>
                    <li><a class="nav-link scrollto active" href="../Admin/bank_details.php">Bank Details</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/block_users.php">Block Users</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/unblock_users.php">Unblock Users</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/remove_users.php">Remove Users</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/coupons.php">Coupons</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li><form method="post" action="../Home/home.html"><input type="submit"  value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
              </ul>
              </nav>
               
            </span>
          </section>
        </div> 
      </header> 

	  
<div class="container-fluid mainhead">
		
<div class="container" style="margin-top: 45px;">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardnewcontact">
           
			<div class="card-header">
				<h3 class="addcontact">Bank Details</h3>				
			</div>

			<div class="card-body" >
				<form method="post" action="#">
                    <div class="form-group">
                        <label for="accno" class="textaddcontact">Account Number</label><label for="accno" class="starregister"> * </label>
                        <input type="text" id="accno" name="accno" class="form-control" style="width: 300px;"> <span class="error"><?php echo $accnoerr; ?> </span>
                    </div>

                    <div class="form-group">
                        <label for="cno" class="textaddcontact">Card Number</label><label for="cno" class="starregister"> * </label>
                        <input type="text" id="cno" name="cno" class="form-control" style="width: 300px;" required> <span class="error"><?php echo $cnoerr; ?> </span>
                    </div>

                    <div class="form-group">
                        <label for="bname" class="textaddcontact">Bank Name</label><label for="bname" class="starregister"> * </label>
                        <input type="text" id="bname" name="bname" class="form-control" style="width: 300px;" required>
                    </div>

                    <div class="form-group">
                        <label for="amt" class="textaddcontact">Amount</label><label for="amt" class="starregister"> * </label>
                        <input type="text" id="amt" name="amt" class="form-control" style="width: 300px;" required>
                    </div>

                    <div class="form-group">
                        <label for="phno" class="textaddcontact">Phone Number</label><label for="phno" class="starregister"> * </label>
                        <input type="text" id="phno" name="phno" class="form-control" style="width: 300px;" required> <span class="error"><?php echo $phnoerr; ?> </span>
                    </div>
                    <div class="form-group">
                        <label for="cvv" class="textaddcontact">CVV</label><label for="cvv" class="starregister"> * </label>
                        <input type="text" id="cvv" name="cvv" class="form-control" style="width: 300px;" required>
                    </div>                   

					<div class="form-group">
						<input type="submit" value="Add" class="btn float-right add_contact_btn" id="submit_btn" name="submit_btn">
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<br><br><br><br>
</div>
</body>
</html>