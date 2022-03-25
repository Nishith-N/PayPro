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
    <title>Document</title>
    <link href="error_style.css" rel="stylesheet">
    <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <header id="header" style="margin-top: -22px;" class="fixed-top ">
        <div class="container d-flex align-items-center">  
          <section>
            <span class="full-text" >
              <nav id="navbar" class="navbar" style="margin-top: 0%;">
                <ul>
                    <br>
                  <li><h1 class="logo me-auto" ><a href="../Userhome/userhome.php"><i style="font-size: 35px;margin-top: 20px;"><strong>PayPro</strong></i></a></h1></li>                  
                </ul>
              </nav>
              <br>
              <!-- .navbar --> 
            </span>
          </section>
        </div>
      </header>
    <center>
    <table style="padding-top: 150px;">
        <tr>
            <td>
                <div class="error alert">
                    <div class="alert-body">
                      Error !
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 90px;padding-top: 20px;">
                <form method="post" action="#">
                    <input type="submit"  value="Go To Home" id="gotohome_btn" name="gotohome_btn" class="home" >
                </form>
            </td>
        </tr>
    </table>
</center>
    

    
    

    
    
</body>
</html>