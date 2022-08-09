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
$sql="DELETE FROM trans_hist WHERE dates < now() - interval 30 DAY";
$result=mysqli_query($db,$sql);
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

if(isset($_POST['back_btn']))
{
  header("Location:../Login/login.php");
        exit();
}

if(isset($_POST['submit_btn']))
{
  $sql="CREATE TABLE IF NOT EXISTS bank_details ( acc_number BIGINT NOT NULL , card_number BIGINT NOT NULL , bank_name VARCHAR(25) NOT NULL , amount BIGINT NOT NULL , phone BIGINT NOT NULL , cvv INT NOT NULL , PRIMARY KEY (acc_number, card_number)) ENGINE = MyISAM";
  $result=mysqli_query($db,$sql);
  $sql="INSERT INTO bank_details (acc_number, card_number, bank_name, amount, phone, cvv) VALUES ('110401000011843', '1722124577342143', 'IOB', '300000', '9994712098', '245')";
  $result=mysqli_query($db,$sql);
$sql="INSERT INTO bank_details (acc_number, card_number, bank_name, amount, phone, cvv) VALUES ('120401000011843', '2722124577342143', 'KVB', '300000', '6380076653', '132')";
  $result=mysqli_query($db,$sql);
$sql="INSERT INTO bank_details (acc_number, card_number, bank_name, amount, phone, cvv) VALUES ('130401000011843', '3722124577342143', 'BOI', '300000', '9791798018', '143')";
  $result=mysqli_query($db,$sql);
$sql="INSERT INTO bank_details (acc_number, card_number, bank_name, amount, phone, cvv) VALUES ('140401000011843', '4722124577342143', 'IOB', '300000', '9952122792', '444')";
  $result=mysqli_query($db,$sql);
$sql="INSERT INTO bank_details (acc_number, card_number, bank_name, amount, phone, cvv) VALUES ('150401000011843', '5722124577342143', 'IOB', '300000', '9994712098', '231')";
  $result=mysqli_query($db,$sql);
$sql="INSERT INTO bank_details (acc_number, card_number, bank_name, amount, phone, cvv) VALUES ('160401000011843', '6722124577342143', 'ICIC', '300000', '9791798018', '205')";
  $result=mysqli_query($db,$sql);
$sql="INSERT INTO bank_details (acc_number, card_number, bank_name, amount, phone, cvv) VALUES ('170401000011843', '7722124577342143', 'ICIC', '300000', '6380076653', '105')";
  $result=mysqli_query($db,$sql);

  $sql="CREATE TABLE IF NOT EXISTS card_details ( card_number BIGINT NOT NULL , cvv INT NOT NULL, card_name VARCHAR(25) NOT NULL, validto VARCHAR(25) NOT NULL , pay_id INT NOT NULL , PRIMARY KEY (card_number), FOREIGN KEY (pay_id) REFERENCES user_details(pay_id))";
	$result=mysqli_query($db,$sql);
  $sql="CREATE TABLE IF NOT EXISTS contact_details ( username VARCHAR(25) NOT NULL , pay_name VARCHAR(25) NOT NULL , nickname VARCHAR(25) NOT NULL , pay_id INT NOT NULL , PRIMARY KEY (username,pay_id))";
	$result=mysqli_query($db,$sql);
  $sql="CREATE TABLE IF NOT EXISTS login_attempt ( phone BIGINT NOT NULL ,email VARCHAR(25) NOT NULL,attempt INT NOT NULL , PRIMARY KEY (phone, email)) ENGINE = MyISAM";
  $result=mysqli_query($db,$sql);
  

$sql="CREATE TABLE IF NOT EXISTS user_details ( pay_id INT NOT NULL AUTO_INCREMENT , phone BIGINT NOT NULL , email VARCHAR(50) NOT NULL , fname VARCHAR(25) NOT NULL , lname VARCHAR(25) NOT NULL , city VARCHAR(25) NOT NULL, zip BIGINT NOT NULL , state1 VARCHAR(25) NOT NULL , block1 INT NOT NULL , addresss VARCHAR(80) NOT NULL , primary_card BIGINT NOT NULL , wallet INT NOT NULL, password1 VARCHAR(50) NOT NULL,limits BIGINT DEFAULT 80000,otp INT DEFAULT 0, PRIMARY KEY (pay_id)) ENGINE = MyISAM";
	$result=mysqli_query($db,$sql);
  

  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $address1=$_POST['address1'];
  $address2=$_POST['address2'];
  $address=$address1.$address2;
  $city=$_POST['city'];
  $state=$_POST['state'];
  $zip=$_POST['zip'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $pwd=$_POST['pwd'];
  $numlength = strlen((string)$phone);
  $block=0;
  
  $primary_card=0;
  $wallet=0;
  if(empty($fname))
  {
    $fnameerr = "First Name is required"; 
    $flag=0;
  }
  else if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {  
    $fnameerr = "Only alphabets and white space are allowed";  
    $flag=0;
  }
  if(empty($lname))
  {
    $lnameerr = "Last Name is required"; 
    $flag=0;
  }
  else if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {  
    $lnameerr = "Only alphabets and white space are allowed";  
    $flag=0;
  }
  if(empty($address1))
  {
    $addresserr = "Address is required"; 
    $flag=0;
  }
  if(empty($pwd))
  {
    $pwderr = "Password is required"; 
    $flag=0;
  }
  if(empty($city))
  {
    $cityerr = "City is required"; 
    $flag=0;
  }
  else if (!preg_match("/^[a-zA-Z ]*$/",$city)) {  
    $cityerr = "Only alphabets and white space are allowed";  
    $flag=0;
  }
  if(empty($state))
  {
    $stateerr = "State is required"; 
    $flag=0;
  }
  if(empty($zip))
  {
    $ziperr = "Zip is required"; 
    $flag=0;
  }
  if(empty($email))
  {
    $emailerr = "Email is required"; 
    $flag=0;
  }
  else if (!preg_match("/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/",$email)) {  
    $emailerr = "enter your email correctly";  
    $flag=0;
  }
  if(empty($phone))
  {
    $phoneerr = "Phone is required"; 
    $flag=0;
  }
  if($numlength!=10)
  {
    $phoneerr = "Phone No is not valid"; 
    $flag=0;
  }
  

  
if($flag==1)
{
  $pass1 = encrypt_string($pwd);
  $sql="INSERT INTO user_details (pay_id, phone, email, fname, lname, city, zip, state1, block1, addresss, primary_card, wallet,password1) VALUES (NULL,$phone,'$email','$fname','$lname','$city',$zip,'$state',$block,'$address',$primary_card,$wallet,'$pass1')";
  $result=mysqli_query($db,$sql);
  $sql="INSERT INTO login_attempt (phone, email, attempt) VALUES ($phone, '$email','1')";
  $result=mysqli_query($db,$sql);
  header("Location:../Login/login.php");
        exit();

}

}


?>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html>
<head>
	<title>PayPro-Register</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">   
    <link rel="icon" href="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" type="image/icon type">
</head>

<div class="container-fluid  mainhead">
<body>
    
    
    
    
<div class="container">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardregister">
           
			<div class="card-header">
				<h3 class="register">Register</h3>				
			</div>

			<div class="card-body">
				<form method="POST" action="#">
                    <div class="form-group">
                        <label for="fname" class="textregister">First Name </label><label for="fname" class="starregister"> * </label>   
                        <input type="text" id="fname" name="fname" class="form-control" style="width: 300px;"> <span class="error"><?php echo $fnameerr; ?> </span>
                    </div>

                    <div class="form-group">
                        <label for="lname" class="textregister">Last Name </label><label for="lname" class="starregister"> * </label> 
                        <input type="text" id="lname" name="lname" class="form-control" style="width: 300px;"> <span class="error"><?php echo $lnameerr; ?> </span>
                    </div>


                    <div class="form-group">
                        <label for="address1" class="textregister">Address 1</label><label for="address1" class="starregister"> * </label> 
                        <input type="text" id="address1" name="address1" class="form-control" style="width: 300px;"> <span class="error"><?php echo $addresserr; ?> </span>
                    </div>

                    <div class="form-group">
                        <label for="address2" class="textregister">Address 2</label>
                        <input type="text" id="address2" name="address2" class="form-control" style="width: 300px;">
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="textregister">Password</label><label for="address1" class="starregister"> * </label>
                        <input type="text" id="pwd" name="pwd" class="form-control" style="width: 300px;">  <span class="error"><?php echo $pwderr; ?> </span>
                    </div>                    
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="city" class="textregister">City</label><label for="city" class="starregister"> * </label> 
                          <input type="text" id="city" name="city" class="form-control"> <span class="error"><?php echo $cityerr; ?> </span>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="state" class="textregister">State</label><label for="state" class="starregister"> * </label> 
                          <select id="state" class="form-control" name="state">
                            <option selected>Choose...</option>                                
                            <option value="Andhra Pradesh">	Andhra Pradesh</option>                            
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">	Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">	Mizoram</option>
                            <option value="Nagaland">	Nagaland</option>
                            <option value="Orissa">	Orissa</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="TamilNadu">TamilNadu</option>
                            <option value="Telengana">Telengana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">	Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">	West Bengal</option>
                          </select> <span class="error"><?php echo $stateerr; ?> </span>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="zip" class="textregister">Zip</label><label for="state" class="starregister"> * </label> 
                          <input type="number" class="form-control" id="zip" name="zip"> <span class="error"><?php echo $ziperr; ?> </span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="email" class="textregister">Email</label><label for="email" class="starregister"> * </label> 
                          <input type="text" id="email" name="email" class="form-control"> <span class="error"><?php echo $emailerr; ?> </span>
                        </div>

                        <div class="form-group col-md-6">
                          <label for="phone" class="textregister">Phone</label><label for="phone" class="starregister"> * </label> 
                          <input type="number" id="phone" name="phone" class="form-control"> <span class="error"><?php echo $phoneerr; ?> </span>
                        </div>              
                    </div>
                                

					<div class="form-group">
						<input type="submit" value="Submit" class="btn float-right register_btn" id="submit_btn" name="submit_btn">
					</div>
          <div class="form-group">
						<input type="submit" value="Back" style="margin-top:10px;margin-left:170px;" class="btn float-right register_btn" id="back_btn" name="back_btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<br><br>

</body>
</div>
</html>