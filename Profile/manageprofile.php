<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
session_start();
$username=$_SESSION['username'];
if($username=='')
{
  header("Location:../Home/home.html");
        exit(); 
}
echo $username;

$sql="SELECT * FROM user_details WHERE PHONE='".$username."' OR EMAIL='".$username."'";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_row($result);

$flag=1;
$fnameerr='';
$lnameerr='';
$addresserr='';
$pwderr='';
$cityerr='';
$stateerr='';
$ziperr='';
$emailerr='';
$phoneerr='';
 $ifname='';
  $ilname='';
  $iaddress1='';
  $iaddress2='';
  $iaddress=$iaddress1.$iaddress2;
  $icity='';
  $istate='';
  $izip=0;

$email=$row[2];
$fname=$row[3];
$lname=$row[4];
$city=$row[5];
$zip=$row[6];
$state=$row[7];
$phone=$row[1];
$email=$row[2];
$address=$row[9];
$password=$row[12];
if(isset($_POST['submit_btn']))
{

$ifname=$_POST['fname'];
  $ilname=$_POST['lname'];
  $iaddress1=$_POST['address1'];
  $iaddress2=$_POST['address2'];
  $iaddress=$iaddress1.$iaddress2;
  $icity=$_POST['city'];
  $istate=$_POST['state'];
  $izip=$_POST['zip'];

  

  if(empty($ifname))
  {
    $fnameerr = "First Name is required"; 
    $flag=0;
  }
  else if (!preg_match("/^[a-zA-Z ]*$/",$ifname)) {  
    $fnameerr = "Only alphabets and white space are allowed";  
    $flag=0;
  }
  if(empty($ilname))
  {
    $lnameerr = "Last Name is required"; 
    $flag=0;
  }
  else if (!preg_match("/^[a-zA-Z ]*$/",$ilname)) {  
    $lnameerr = "Only alphabets and white space are allowed";  
    $flag=0;
  }
  if(empty($iaddress1))
  {
    $addresserr = "Address is required"; 
    $flag=0;
  }
  
  if(empty($icity))
  {
    $cityerr = "City is required"; 
    $flag=0;
  }
  else if (!preg_match("/^[a-zA-Z ]*$/",$icity)) {  
    $cityerr = "Only alphabets and white space are allowed";  
    $flag=0;
  }
  if(empty($istate))
  {
    $stateerr = "State is required"; 
    $flag=0;
  }
  if(empty($izip))
  {
    $ziperr = "Zip is required"; 
    $flag=0;
  }
 
  if($flag==1)
  {
    $sql="UPDATE user_details SET fname='".$ifname."',lname='".$ilname."',city='".$icity."',zip='".$izip."',state1='".$istate."',addresss='".$iaddress."' WHERE email='".$username."' OR phone='".$username."'";
    $result=mysqli_query($db,$sql);
    session_destroy();
    header("Location:../Login/login.php");
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
	<title>Register</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="manageprofile_style.css">   
</head>
<body>
    
<div class="container">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardregister">
           
			<div class="card-header">
				<h3 class="register">Profile</h3>				
			</div>

			<div class="card-body">
                <?php
                print'
				<form action="#" method="post">
                    <div class="form-group">
                        <label for="fname" class="textregister">First Name </label><label for="fname" class="starregister"> * </label>
                        <input type="text" id="fname" name="fname" class="form-control" style="width: 300px;" value="'.$fname.'">
                        <span class="error">';echo $fnameerr;  print'</span>
                    </div>

                    <div class="form-group">
                        <label for="lname" class="textregister">Last Name </label><label for="lname" class="starregister"> * </label>
                        <input type="text" id="lname" name="lname" class="form-control" style="width: 300px;" value="'.$lname.'">
                    </div>
                    
                   

                    <div class="form-group">
                        <label for="address1" class="textregister">Address 1</label><label for="address1" class="starregister"> * </label>
                        <input type="text" id="address1" name="address1" class="form-control" style="width: 300px;" value="'.$address.'">
                    </div>

                    <div class="form-group">
                        <label for="address2" class="textregister">Address 2</label>
                        <input type="text" id="address2" name="address2" class="form-control" style="width: 300px;">
                    </div>                    
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="city" class="textregister">City</label><label for="city" class="starregister"> * </label>
                          <input type="text" id="city" name="city" class="form-control" value="'.$city.'">
                        </div>

                        <div class="form-group col-md-4">
                          <label for="state" class="textregister">State</label><label for="state" class="starregister"> * </label>
                          <select id="state" class="form-control" name="state">
                            
                            <option value="TamilNadu">TamilNadu</option>
                            <option value="Telengana">Telengana</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Maharashtra">Maharashtra</option>
                          </select>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="zip" class="textregister">Zip</label><label for="state" class="starregister"> * </label>
                          <input type="text" class="form-control" id="zip" name="zip" value="'.$zip.'">
                        </div>
                    </div> 

                    <div class="form-group">
                        <label for="phno" class="textregister">Phone Number </label>
                        <input type="number" id="phno" name="phno" class="form-control" style="width: 300px;" value="'.$phone.'" readonly>
                    </div> 

                    <div class="form-group">
                        <label for="email" class="textregister">Email </label>
                        <input type="email" id="email" name="email" class="form-control" style="width: 300px;" value="'.$email.'"  readonly> 
                    </div>                  

					<div class="form-group">
						<input type="submit" value="Submit" class="btn float-right login_btn" id="submit_btn" name="submit_btn">
					</div>
				</form>'
                ?>
			</div>
		</div>
	</div>
</div>
<br><br>
</body>
</html>