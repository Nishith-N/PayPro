
<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
		session_start();
    $username=$_SESSION['username'];
    $_SESSION['varname'] = $username;

    if(isset($_POST['gotohome_btn']))
    {
      header("Location:../Userhome/userhome.php");
        		exit();
    }


    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="success_style.css" rel="stylesheet">
    <link rel="icon" href="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" type="image/icon type">

    <title>Success</title>
</head>

<body>  
  <nav id="navbar" class="navbar" style="margin-top: 0%;">                
    <h1 class="logo me-auto" ><a href="../Userhome/userhome.php" style="text-decoration: none;padding-bottom: 10px;"><i style="font-size: 35px;margin-top: 20px;"><strong>PAYPRO</strong></i></a></h1>
  </nav>
  
  <br>
  <div class="body1">
    <div class="wrapperAlert">
      <div class="contentAlert">      
        <div class="topHalf">      
          <p><svg viewBox="0 0 512 512" width="100" title="check-circle">
            <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z" />
            </svg></p>
          <h1>Congratulations,</h1>
          <br>
          <h1>Transaction Successful</h1>           
          <br>
         <ul class="bg-bubbles">
           <li></li>
           <li></li>
           <li></li>
           <li></li>
           <li></li>
           <li></li>
           <li></li>
           <li></li>
           <li></li>
           <li></li>
         </ul>
        </div>
      </div>                
    </div>
    
      <form method="post" action="#" style="margin-top: 500px;margin-left: -300px;">
        <input type="submit"  value="Go To Home" id="gotohome_btn" name="gotohome_btn" class="home" >
      </form> 
    </div>   
</body>
</html>