<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
$pay_id=0;
$phone=0;

if(isset($_POST['submit_btn']))
{
	$sql="CREATE TABLE IF NOT EXISTS card_details ( card_number BIGINT NOT NULL , cvv INT NOT NULL , pay_id INT NOT NULL , PRIMARY KEY (card_number), FOREIGN KEY (pay_id) REFERENCES user_details(pay_id))";
	$result=mysqli_query($db,$sql);

	$card_num=$_POST['card_num'];
	$cvv=$_POST['cvv'];
	$pay_id=1;

	$sql="SELECT phone FROM bank_details WHERE card_number='".$card_num."'";
	$result=mysqli_query($db,$sql);

	$row=mysqli_fetch_row($result);
	if(mysqli_num_rows($result)==1)
	{
		$phone=$row[0];
    
	}

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
}





?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html>
<head>
	<title>PayPro-New Card</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="new_card_style.css">   
    <link rel="icon" href="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" type="image/icon type">
</head>
<body>
    <div class="container-fluid mainhead">
		
<div class="container">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardnewcontact">
           
			<div class="card-header">
				<h3 class="addcontact">Add Card</h3>				
			</div>

			<div class="card-body">
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
						<input type="submit" value="Add" class="btn float-right add_contact_btn" id="submit_btn" name="submit_btn">
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