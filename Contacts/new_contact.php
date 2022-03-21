<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
$payid=0;

if(isset($_POST['submit_btn']))
{
	$sql="CREATE TABLE IF NOT EXISTS contact_details ( username VARCHAR(25) NOT NULL , pay_name VARCHAR(25) NOT NULL , nickname VARCHAR(25) NOT NULL , pay_id INT NOT NULL , PRIMARY KEY (username), FOREIGN KEY (pay_id) REFERENCES user_details(pay_id))";
	$result=mysqli_query($db,$sql);

	$cname=$_POST['contact_name'];
	$nickname=$_POST['nick_name'];
	$uname=$_POST['uname'];

	$sql="SELECT pay_id FROM user_details WHERE email='".$uname."' OR phone='".$uname."'";
	$result=mysqli_query($db,$sql);

	$row=mysqli_fetch_row($result);
	if(mysqli_num_rows($result)==1)
	{
	$payid=$row[0];
	}
	if($payid)
	{
		$sql="INSERT INTO contact_details VALUES ('$uname','$cname','$nickname','$payid')";
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
	<title>PayPro-New Contact</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">   
    <link rel="icon" href="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" type="image/icon type">
</head>
<body>
    <div class="container-fluid mainhead">
		
<div class="container">
    
	<div class="d-flex justify-content-center h-100">      

		<div class="cardnewcontact">
           
			<div class="card-header">
				<h3 class="addcontact">Add Contact</h3>				
			</div>

			<div class="card-body">
				<form method="post" action="#">
                    <div class="form-group">
                        <label for="contact_name" class="textaddcontact">Contact Name</label><label for="contact_name" class="starregister"> * </label>
                        <input type="text" id="contact_name" name="contact_name" class="form-control" style="width: 300px;">
                    </div>                   
                    

                    <div class="form-group">
                        <label for="uname" class="textaddcontact">Email / Phone </label><label for="uname" class="starregister"> * </label>
                        <input type="text" id="uname" name="uname" class="form-control" style="width: 300px;">
                    </div> 
  
                    
                    <div class="form-group">
                        <label for="nick_name" class="textaddcontact">Nick Name </label>
                        <input type="text" id="nick_name" name="nick_name" class="form-control" style="width: 300px;" >
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