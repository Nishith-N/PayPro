<?php

$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
$fnameerr='';
$flag=1;

if(isset($_POST['submit_btn']))
{
  $sql="CREATE TABLE IF NOT EXISTS bank_details ( acc_number BIGINT NOT NULL , card_number BIGINT NOT NULL , bank_name VARCHAR(25) NOT NULL , amount BIGINT NOT NULL , phone BIGINT NOT NULL , cvv INT NOT NULL , PRIMARY KEY (acc_number, card_number)) ENGINE = MyISAM";
  $result=mysqli_query($db,$sql);
  $sql="INSERT INTO bank_details (acc_number, card_number, bank_name, amount, phone, cvv) VALUES ('130401000011843', '4722124577342143', 'IOB', '300000', '9994712098', '245')";
  $result=mysqli_query($db,$sql);
  

$sql="CREATE TABLE IF NOT EXISTS user_details ( pay_id INT NOT NULL AUTO_INCREMENT , phone BIGINT NOT NULL , email VARCHAR(25) NOT NULL , fname VARCHAR(25) NOT NULL , lname VARCHAR(25) NOT NULL , city VARCHAR(25) NOT NULL, zip BIGINT NOT NULL , state1 VARCHAR(25) NOT NULL , block1 INT NOT NULL , addresss VARCHAR(50) NOT NULL , primary_card BIGINT NOT NULL , wallet INT NOT NULL, password1 VARCHAR(50) NOT NULL , PRIMARY KEY (pay_id)) ENGINE = MyISAM";
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
if($flag==1)
{
  $sql="INSERT INTO user_details (pay_id, phone, email, fname, lname, city, zip, state1, block1, addresss, primary_card, wallet,password1) VALUES (NULL,$phone,'$email','$fname','$lname','$city',$zip,'$state',$block,'$address',$primary_card,$wallet,'$pwd')";
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
                        <label for="fname" class="textregister">First Name </label><label for="fname" class="starregister"> * </label> <span class="error"><?php echo $fnameerr; ?> </span>  
                        <input type="text" id="fname" name="fname" class="form-control" style="width: 300px;">
                    </div>

                    <div class="form-group">
                        <label for="lname" class="textregister">Last Name </label><label for="lname" class="starregister"> * </label>
                        <input type="text" id="lname" name="lname" class="form-control" style="width: 300px;">
                    </div>

                    <div class="form-group">
                        <label for="address1" class="textregister">Address 1</label><label for="address1" class="starregister"> * </label>
                        <input type="text" id="address1" name="address1" class="form-control" style="width: 300px;">
                    </div>

                    <div class="form-group">
                        <label for="address2" class="textregister">Address 2</label>
                        <input type="text" id="address2" name="address2" class="form-control" style="width: 300px;">
                    </div>
                    <div class="form-group">
                        <label for="pwd" class="textregister">Password</label><label for="address1" class="starregister"> * </label>
                        <input type="text" id="pwd" name="pwd" class="form-control" style="width: 300px;">
                    </div>                    
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="city" class="textregister">City</label><label for="city" class="starregister"> * </label>
                          <input type="text" id="city" name="city" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                          <label for="state" class="textregister">State</label><label for="state" class="starregister"> * </label>
                          <select id="state" class="form-control" name="state">
                            <option selected>Choose...</option>
                            <option value="TamilNadu">TamilNadu</option>
                            <option value="Telengana">Telengana</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Maharashtra">Maharashtra</option>
                          </select>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="zip" class="textregister">Zip</label><label for="state" class="starregister"> * </label>
                          <input type="number" class="form-control" id="zip" name="zip">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="email" class="textregister">Email</label><label for="email" class="starregister"> * </label>
                          <input type="text" id="email" name="email" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                          <label for="phone" class="textregister">Phone</label><label for="phone" class="starregister"> * </label>
                          <input type="number" id="phone" name="phone" class="form-control">
                        </div>

                      
                    </div>
                                

					<div class="form-group">
						<input type="submit" value="Submit" class="btn float-right register_btn" id="submit_btn" name="submit_btn">
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