<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
		session_start();
        $username=$_SESSION['username'];
        echo $username;

			if(isset($_POST['submit_btn']))
			{
                $pwd=$_POST['pwd'];
				$oldpwd=$_POST['oldpwd'];
				
				$sql="SELECT pay_id FROM user_details WHERE password1='".$oldpwd."'";
				$result=mysqli_query($db,$sql);
				$row=mysqli_num_rows($result);
				if($row && $oldpwd!='' && $pwd!='')
				{

                $sql="UPDATE user_details SET password1='".$pwd."' WHERE phone='".$username."' OR email='".$username."'";
                $result=mysqli_query($db,$sql);
				
				
				header("Location:../Home/home.html");
        		exit();
				}
				else
				{
					$_SESSION['username']=$username;
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
	<title>Transaction</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="reset_password_style.css">   
</head>
<body>
    
<div class="container">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardregister" style="height:305px">
           
			<div class="card-header">
				<h3 class="register">Reset Password</h3>				
			</div>

			<div class="card-body">
				<form method="post" action="#">
				<div class="form-group">
                        <label for="pwd" class="textregister">Enter old password: </label><label for="pwd" class="starregister"> * </label>
                        <input type="text" id="oldpwd" name="oldpwd" class="form-control" style="width: 300px;">
                    </div> 
                    <div class="form-group">
                        <label for="pwd" class="textregister">Enter new password: </label><label for="pwd" class="starregister"> * </label>
                        <input type="text" id="pwd" name="pwd" class="form-control" style="width: 300px;">
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
