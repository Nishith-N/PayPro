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

$username=$_SESSION['username'];

if(isset($_POST['submit_btn']))
{
	$pwd=$_POST['pwd'];
	$rpwd=$_POST['rpwd'];

	if($pwd==$rpwd)
	{
		$pass1 = encrypt_string($pwd);
		$sql = "UPDATE user_details SET password1='".$pass1."' WHERE phone='".$username."'";
		$result=mysqli_query($db,$sql);
		header("Location:../Login/login.php");
        	exit();
	}
	else
	{
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
	<title>Re-Enter Password</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="forgotpwd_reset_style.css">   
</head>
<body>
    
<div class="container">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardregister" style="margin-top: 220px;">
           
			<div class="card-header">
				<h3 class="register">Re-Enter Password</h3>				
			</div>

			<div class="card-body">
				<form method="post" action="#">

                    <div class="form-group">
                        <label for="pwd" class="textregister">Enter Password: </label><label for="pwd" class="starregister"> * </label>
                        <input type="text" id="pwd" name="pwd" class="form-control" style="width: 300px;">
                    </div> 

                    <div class="form-group">
                      <label for="rpwd" class="textregister">Re-Enter Password: </label><label for="rpwd" class="starregister"> * </label>
                      <input type="text" id="rpwd" name="rpwd" class="form-control" style="width: 300px;">
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
