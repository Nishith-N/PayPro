<?php

$key1 = "efdasocr7";
$key2 = "xqsrmessi";

function encrypt_string(string $str1){
  global $key1,$key2;
  $numbers = array("0","1","2","3","4","5","6","7","8","9");
  $alphabet = array("a","b","c","d","e","f","g",
  "h","i","j","k","l","m","n","o","p","q","r","s","t","u","v",
  "w","x","y","z","A","B","C","D","E","F","G","H","I","J",
  "K","L","M","N","O","P","Q","R","S","T","U","V","W","X",
  "Y","Z","0","1","2","3","4","5","6","7","8","9"," ","@",".",
  "#","$","%","^","&","*");
  $len = strlen($str1);
  $alphabet_count = count($alphabet);
  $count=0;
  $encrypt_val='';
  for ($i = 0; $i < $len; $i++){
    $value = array_search($str1[$i],$alphabet);
    $value1 = array_search($key1[$count % strlen($key1)],$alphabet);
    $value2 = array_search($key2[$count % strlen($key2)],$alphabet);
    $encrypt_val .= ($alphabet[(($value * $value1) + $value2) % $alphabet_count]);
    $count = $count+1;
  } 
  return $encrypt_val;
}

function decrypt_string(string $str1){
  global $key1,$key2;
  $numbers = array("0","1","2","3","4","5","6","7","8","9");
  $alphabet = array("a","b","c","d","e","f","g",
  "h","i","j","k","l","m","n","o","p","q","r","s","t","u","v",
  "w","x","y","z","A","B","C","D","E","F","G","H","I","J",
  "K","L","M","N","O","P","Q","R","S","T","U","V","W","X",
  "Y","Z","0","1","2","3","4","5","6","7","8","9"," ","@",".",
  "#","$","%","^","&","*");
  $len = strlen($str1);
  
  $alphabet_count = count($alphabet);
  $count=0;
  $decrypt_val = "";
  for ($i = 0; $i < $len; $i++){
    $value = array_search($str1[$i],$alphabet);
    $value1 = array_search($key1[$count % strlen($key1)],$alphabet);
    $value2 = array_search($key2[$count % strlen($key2)],$alphabet);
    $count1 = 0;
    $x=10;
    while($x == 10){
      $inverse = $count1;
      if((($value1 * $inverse) % $alphabet_count)==1){
        $x = 11;
      }
      $count1 = $count1+1;
    } 
    $value3 = (($value - $value2) * $inverse) % $alphabet_count;
    if($value3 < 0){
      $value3 = $alphabet_count + $value3;
    }
    $decrypt_val .= ($alphabet[$value3]);
    $count = $count+1;
  }
  return $decrypt_val;
}



$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
session_start();
$errmsg='';
$att_1=1;
$sql="DELETE FROM trans_hist WHERE dates < now() - interval 30 DAY";
$result=mysqli_query($db,$sql);
if(isset($_POST['uid']) && isset($_POST['pwd']))
{
	$username=$_POST['uid'];
	$pwd=$_POST['pwd'];


	if(empty($username))
	{
		$errmsg.=" Enter your username";
	}
	else if(empty($pwd))
	{
		$errmsg.=" \nEnter your password";
	}
	else
	{

		if(preg_match("/^[0-9]+$/",$username))
	{
		$pass1 = encrypt_string($pwd);
		$sql="SELECT * FROM user_details WHERE phone='".$username."' AND password1='".$pass1."' limit 1";
	}
	else{
		$pass1 = encrypt_string($pwd);
		$sql="SELECT * FROM user_details WHERE email='".$username."' AND password1='".$pass1."' limit 1";
	}

	

	$result=mysqli_query($db,$sql);

	
	if(mysqli_num_rows($result)==1)
    {
		

		$sql = "SELECT pay_id FROM user_details WHERE phone='".$username."' AND password1='".$pwd."' limit 1";
		$result=mysqli_query($db,$sql);
		$row=mysqli_fetch_row($result);
		$sql = "SELECT block1 FROM user_details WHERE phone='".$username."' OR email='".$username."'";
		$result1=mysqli_query($db,$sql);
		$fecth1=mysqli_fetch_row($result1);
		$block_check=$fecth1[0];
		if($block_check==0)
		{
		$_SESSION['varname'] = $username;
		$sql="UPDATE login_attempt SET attempt=1 WHERE phone='".$username."' OR email='".$username."'";
		$result=mysqli_query($db,$sql);
        header("Location:../Userhome/userhome.php");
        exit();
		}
		else{
			header("Location:../Login/login.php");
        	exit();
		}
    }
    else{
		
		$sql = "SELECT attempt FROM login_attempt WHERE phone='".$username."' OR email='".$username."'";
		$att=mysqli_query($db,$sql);
		if(mysqli_num_rows($att))
      	{
          $row1=mysqli_fetch_row($att);
	        $att_1=$row1[0];
        }
		if($att_1==3){
			$sql="UPDATE login_attempt SET attempt=1 WHERE phone='".$username."' OR email='".$username."'";
			$result=mysqli_query($db,$sql);
			header("Location:../Login/login_err.php");
        	exit();
		}
        $errmsg= "Wrong password! Attempts remaining:";
		$errmsg.= strval(3-$att_1);
		$sql="UPDATE login_attempt SET attempt=attempt+1 WHERE phone='".$username."' OR email='".$username."'";
		$result=mysqli_query($db,$sql);
    }
}

	}

	






?>





<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	
   
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>PayPro-Login</title>
	<link rel="icon" href="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" type="image/icon type">
    
</head>

<body>
	<div class="container-fluid mainhead">
    <br><br>
	
    <center>
        <div><img src="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" class="logo"></div>
    </center>
    
<div class="container">
    
	<div class="d-flex justify-content-center h-100">
       

		<div class="card">
           
			<div class="card-header">
				<h3>Sign In</h3>
				
			</div>
			<div class="card-body">
				<form action="#" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" id="uid" name="uid">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" id="pwd" name="pwd">
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
				<span style="color: #ffcccb"><?php echo $errmsg ?></span>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="../Register/register.php" id="reg" name="reg">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center links">
					<a href="../Register/forgotpwd_username.php" id="forgot_pwd">Forgot your password?</a>
				</div>
				<div class="d-flex justify-content-center links">
					<a href="../Admin/adminlogin.php" id="forgot_pwd">Login as Admin</a>
				</div>
			</div>
		</div>
	</div>
</div>
	</div>
</body>
</html>