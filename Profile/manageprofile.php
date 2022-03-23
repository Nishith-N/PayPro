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
				<form>
                    <div class="form-group">
                        <label for="fname" class="textregister">First Name </label><label for="fname" class="starregister"> * </label>
                        <input type="text" id="fname" name="fname" class="form-control" style="width: 300px;">
                    </div>

                    <div class="form-group">
                        <label for="lname" class="textregister">Last Name </label><label for="lname" class="starregister"> * </label>
                        <input type="text" id="lname" name="lname" class="form-control" style="width: 300px;">
                    </div>
                    
                    <div class="form-group">
                        <label for="gender" class="textregister">Gender </label><label for="gender" class="starregister"> * </label><br>
                            <input type="radio" id="male" name="gender" value="male" style="accent-color: orange;">
                        <label for="male" style="color: white;">Male</label>
                            <input type="radio" id="female" name="gender" value="female" style="accent-color: orange;">
                        <label for="female" style="color: white;">Female</label>
                            <input type="radio" id="others" name="gender" value="others" style="accent-color: orange;">
                        <label for="others" style="color: white;">Others</label>
                    </div>

                    <div class="form-group">
                        <label for="address1" class="textregister">Address 1</label><label for="address1" class="starregister"> * </label>
                        <input type="text" id="address1" name="address1" class="form-control" style="width: 300px;">
                    </div>

                    <div class="form-group">
                        <label for="address2" class="textregister">Address 2</label>
                        <input type="text" id="address2" name="address2" class="form-control" style="width: 300px;">
                    </div>                    
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="city" class="textregister">City</label><label for="city" class="starregister"> * </label>
                          <input type="text" id="city" name="city" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                          <label for="state" class="textregister">State</label><label for="state" class="starregister"> * </label>
                          <select id="state" class="form-control">
                            <option selected>Choose...</option>
                            <option>TamilNadu</option>
                            <option>Telengana</option>
                            <option>Karnataka</option>
                            <option>Kerala</option>
                            <option>Maharashtra</option>
                          </select>
                        </div>

                        <div class="form-group col-md-4">
                          <label for="zip" class="textregister">Zip</label><label for="state" class="starregister"> * </label>
                          <input type="text" class="form-control" id="zip" name="zip">
                        </div>
                    </div> 

                    <div class="form-group">
                        <label for="phno" class="textregister">Phone Number </label>
                        <input type="number" id="phno" name="phno" class="form-control" style="width: 300px;" readonly>
                    </div> 

                    <div class="form-group">
                        <label for="email" class="textregister">Email </label>
                        <input type="email" id="email" name="email" class="form-control" style="width: 300px;" readonly> 
                    </div>                  

					<div class="form-group">
						<input type="submit" value="Submit" class="btn float-right login_btn">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<br><br>
</body>
</html>