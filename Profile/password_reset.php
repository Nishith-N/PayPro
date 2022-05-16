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
        $_SESSION['search_date']='';
    $_SESSION['flag']=0;
    $_SESSION['f_amount']=0;
    $_SESSION['t_amount']=0;
      
        if($username=='')
        {
          header("Location:../Home/home.html");
                exit(); 
        }
            if(isset($_POST['signout']))
            {
              session_destroy();
            header("Location:../Login/login.php");
                  exit();
            }

			if(isset($_POST['submit_btn']))
			{
                $pwd=$_POST['pwd'];
				$oldpwd=$_POST['oldpwd'];
				$oldpwd1 = encrypt_string($oldpwd);
				$sql="SELECT pay_id FROM user_details WHERE password1='".$oldpwd1."'";
				$result=mysqli_query($db,$sql);
				$row=mysqli_num_rows($result);
        
				if($row && $oldpwd1!='' && $pwd!='')
				{
                $pass1 = encrypt_string($pwd);

                $sql="UPDATE user_details SET password1='".$pass1."' WHERE phone='".$username."' OR email='".$username."'";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <meta charset="utf-8">
    
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">



  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Template Main CSS File -->
  <link href="password_reset_style.css" rel="stylesheet">
  <link rel="icon" href="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" type="image/icon type">
</head>
<body style="background-image: url('https://www.sykes.com/wp-content/uploads/2020/10/100820-feature-image-gen-z-mobile-digital-blog-scaled.jpg');background-size: cover;height: 100%;font-family: 'Numans', sans-serif;">
<header id="header" style="margin-top: -22px;" class="fixed-top ">
          
          <section>
            <span class="full-text" >
              <nav id="navbar" class="navbar" style="margin-top: 0%;">
                <ul>
                <li><h1 class="logo me-auto" ><a href="../Userhome/userhome.php"><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                  <ul style="margin-left: 38%;">
                  <li><a class="nav-link scrollto" href="../Profile/manageprofile.php">Manage Profile</a></li>                   
                    <li><a class="nav-link scrollto" href="../Userhome/recharge.php">Recharge</a></li>
                    <li><a class="nav-link scrollto" href="../Userhome/remove_money.php">Remove Money</a></li>
                    <li><a class="nav-link scrollto active" href="../Profile/password_reset.php">Reset Password</a></li>
                    <li><a class="nav-link scrollto" href="../Profile/set_limit.php">Set Limit</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                    
  <li><form method="post" action="#"><input type="submit" style=" width: 120px;
                        border-radius: 20px;
                        height: 40px;
                        border-color: white;
                        background-color: #892883;
                        color: white;
                        font-size: 18px;"  value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
                  </ul>
                </ul>
              </nav>
              <br>
              <!-- .navbar --> 
            </span>

            <span class="short-text">
              <nav id="navbar" class="navbar">
                <ul>
                <li><h1 class="logo me-auto" ><a href="../Userhome/userhome.php"><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                  
                </ul>
              </nav>
              <br>
              <nav id="navbar" class="navbar">
              <ul style="margin-left: 0%;">
              <li><a class="nav-link scrollto" href="../Profile/manageprofile.php">Manage Profile</a></li>                   
                    <li><a class="nav-link scrollto" href="../Userhome/recharge.php">Recharge</a></li>
                    <li><a class="nav-link scrollto" href="../Userhome/remove_money.php">Remove Money</a></li>
                    <li><a class="nav-link scrollto active" href="../Profile/password_reset.php">Reset Password</a></li>
                    <li><a class="nav-link scrollto" href="../Profile/set_limit.php">Set Limit</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <li><form method="post" action="#"><input type="submit" style=" width: 120px;
                        border-radius: 20px;
                        height: 40px;
                        border-color: white;
                        background-color: #892883;
                        color: white;
                        font-size: 18px;" value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
              </ul>
              </nav>
              <!-- .navbar -->
            </span>
          </section>
    
      </header>
      <!-- End Header -->

<br>

<div class="container2">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardregister" style="margin-top: 150px;">
           
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
						<input type="submit" value="Reset" class="btn float-right login_btn" name="submit_btn" id="submit_btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<br><br>




</body>

</html>
