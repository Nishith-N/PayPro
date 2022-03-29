<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
session_start();
$pay_id=$_SESSION['pay_id'];
$usernametest=$_SESSION['username'];

$phone=0;
if($usernametest=='')
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
  
	

	$card_num=$_POST['card_num'];
	$cvv=$_POST['cvv'];
  $sql="SELECT pay_id FROM user_details WHERE pay_id='".$pay_id."' AND primary_card='".$card_num."'";
  $result=mysqli_query($db,$sql);
  if(mysqli_num_rows($result)==0)
  {
		$sql="DELETE FROM card_details WHERE card_number='".$card_num."' AND pay_id='".$pay_id."'";
		$result=mysqli_query($db,$sql);
		$_SESSION['pay_id'] = $pay_id;
		header("Location:../Cards/cards.php");
        exit();
  }
  else{
    header("Location:../Transaction/error.php");
        exit();
  }
    
	}
	/*

    $sql="SELECT pay_id FROM user_details WHERE phone='".$phone."'";
	$result=mysqli_query($db,$sql);
    $row=mysqli_fetch_row($result);

    if(mysqli_num_rows($result)==1)
	{
	$pay_id=$row[0];
    
	}
	
	if($pay_id)
	{
		$sql="INSERT INTO card_details VALUES ('$card_num','$cvv','$pay_id')";
		$result=mysqli_query($db,$sql);
	}
	*/






?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html>
<head>
	<title>Delete Card</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="delete_card_style.css">   
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
                  <ul style="margin-left: 99%;">
                  <li><a class="nav-link scrollto " href="../Userhome/userhome.php">Home</a></li>
                    <li><a class="nav-link scrollto active" href="../Cards/cards.php">Cards</a></li>
                    <li><a class="nav-link scrollto" href="../Transaction/form.php">Transaction</a></li>
                    <li><a class="nav-link scrollto" href="../Contacts/list_contact.php">Contact</a></li>
                    <li><a class="nav-link scrollto" href="../Profile/profilehome.php">Profile</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <li><form method="post" action="#"><input type="submit"  value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
                  </ul>
                </ul>
              </nav>
              <br>
              <!-- .navbar --> 
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
                <li><li><a class="nav-link scrollto " href="../Userhome/userhome.php">Home</a></li>
                    <li><a class="nav-link scrollto active" href="../Cards/cards.php">Cards</a></li>
                    <li><a class="nav-link scrollto" href="../Transaction/form.php">Transaction</a></li>
                    <li><a class="nav-link scrollto" href="../Contacts/list_contact.php">Contact</a></li>
                    <li><a class="nav-link scrollto" href="../Profile/profilehome.php">Profile</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <li><form method="post" action="#"><input type="submit"  value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
              </ul>
              </nav>
              <!-- .navbar --> 
            </span>
          </section>
        </div>
      </header>
      <!-- End Header -->

	  
<div class="container-fluid mainhead">
		
<div class="container" style="padding-top: 100px;">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardnewcontact">
           
			<div class="card-header">
				<h3 class="addcontact">Delete Card</h3>				
			</div>

      <?php/*  echo $pay_id;
     */ ?>
			<div class="card-body" >
				<form method="post" action="#">
                    <div class="form-group">
                        <label for="card_num" class="textaddcontact">Card Number</label><label for="card_num" class="starregister"> * </label>
                        <input type="number" id="card_num" name="card_num" class="form-control" style="width: 300px;">
                    </div>                   
                    

                    <div class="form-group">
                        <label for="cvv" class="textaddcontact">CVV </label><label for="cvv" class="starregister"> * </label>
                        <input type="number" id="cvv" name="cvv" class="form-control" style="width: 300px;">
                    </div> 
					                   
                   

					<div class="form-group">
						<input type="submit" value="Delete" class="btn float-right add_contact_btn" id="submit_btn" name="submit_btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<br><br>
	</div>
</body>
</html>