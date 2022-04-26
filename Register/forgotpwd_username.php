<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
session_start();
if(isset($_POST['submit_btn']))
{
$no=$_POST['uname'];	

$sql = "SELECT pay_id FROM user_details WHERE phone='".$no."' limit 1";
$result=mysqli_query($db,$sql);
$row=mysqli_num_rows($result);
if($row!=0)
{
	$otp = rand(1111,9999);

  
  
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
  $sql="UPDATE user_details SET otp='".$otp."' WHERE phone='".$no."' OR email='".$no."'";
  $result=mysqli_query($db,$sql);
  curl_close($curl);
	$_SESSION['username'] = $no;
	header("Location:../Register/forgotpwd_otp.php");
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
	<title>Forgot Password</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="forgotpwd_username_style.css">   
</head>
<body>
    
<div class="container">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardregister" style="margin-top: 250px;">
           
			<div class="card-header">
				<h3 class="register">Forgot Password</h3>				
			</div>

			<div class="card-body">
				<form method="post" action="#">

                    <div class="form-group">
                        <label for="uname" class="textregister">Enter Username: </label><label for="uname" class="starregister"> * </label>
                        <input type="text" id="uname" name="uname" class="form-control" style="width: 300px;">
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
