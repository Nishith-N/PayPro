<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
session_start();
$username=$_SESSION['varname'];
if($username=='')
{
  header("Location:../Home/home.html");
        exit(); 
}
$_SESSION['username']=$username;

$sql="SELECT pay_id FROM user_details WHERE phone='".$username."' OR email='".$username."'";
$result=mysqli_query($db,$sql);

if(mysqli_num_rows($result)==1)
    {
		$row=mysqli_fetch_row($result);
		$_SESSION['pay_id'] = $row[0];
        
    }

    if(isset($_POST['signout']))
    {
      session_destroy();
      header("Location:../Home/home.html");
        exit();

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPro-Home</title>
    <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Arsha Bootstrap Template - Index</title>
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

  <!-- Template Main CSS File -->
  <link href="style.css" rel="stylesheet">
  <link rel="icon" href="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" type="image/icon type">
</head>
<body>
    <header id="header" style="margin-top: -22px;" class="fixed-top ">
        <div class="container d-flex align-items-center">  
          <section>
            <span class="full-text" >
              <nav id="navbar" class="navbar" style="margin-top: 0%;">
                <ul>
                <?php print '<li><h1 class="logo me-auto" ><a href=""><i style="font-size: 35px;"><strong>PayPro,Hi '.$username.'</strong></i></a></h1></li>'?>
                  <ul style="margin-left: 23%;">
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="../Cards/cards.php">Cards</a></li>
                    <li><a class="nav-link scrollto" href="../Transaction/form.php">Transaction</a></li>
                    <li><a class="nav-link scrollto" href="../Contacts/list_contact.php">Contact</a></li>
                    <li><a class="nav-link scrollto" href="../Profile/profilehome.php">Profile</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <li><form method="post" action="#"><input type="submit"  style=" width: 120px;
        border-radius: 20px;
        height: 40px;
        border-color: white;
        background-color: #892883;
        color: white;
        font-size: 18px;" value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
                  </ul>
                </ul>
              </nav>
              <br>
              <!-- .navbar --> 
            </span>

            <span class="short-text">
              <nav id="navbar" class="navbar">
                <ul>
                <?php print '<li><h1 class="logo me-auto" ><a href=""><i style="font-size: 35px;"><strong>PayPro,Hi '.$username.'</strong></i></a></h1></li>'?>
                  
                </ul>
              </nav>
              <br>
              <nav id="navbar" class="navbar">
              <ul style="margin-left: 0%;">
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="../Cards/cards.php">Cards</a></li>
                    <li><a class="nav-link scrollto" href="../Transaction/form.php">Transaction</a></li>
                    <li><a class="nav-link scrollto" href="../Contacts/list_contact.php">Contact</a></li>
                    <li><a class="nav-link scrollto" href="../Profile/profilehome.php">Profile</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
        </div>
      </header>
      <!-- End Header -->
    
      <!-- ======= Hero Section ======= -->
      <section id="hero" style="margin-top: -55px;" class="d-flex align-items-center" >
    
        <div class="container">
          <class="row">
            <table width="100%">
              <col style="width:50%">
	            <col style="width:50%">
              <tr>
                <td>
                  <div>
                    <h1 style="color: #F8B84E;margin-left: 10%;margin-top: -60px;">Begining of new era for <br>MONEY management</h1><br><br>
                    <h2 style="color: #F8B84E;margin-left: 10%;">Manage your MONEY more quickly</h2>     
                  </div>
                </td>
                <td>
                <div style="margin-right: 100px; ">
                   <img src="home.png" class="img-fluid animated home_img" alt="">
                 </div>
                </td>
              </tr>
            </table>
          </div>       
    
      </section><!-- End Hero -->
      <br>
    
      <main id="main">       
        
        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
          <div class="container" data-aos="fade-up" style="background-color: #E9C3EF; margin-left: 2%; margin-right: 2%;border-radius: 25px;">
    
            <div class="section-title">
              <h2>About Us</h2>
            </div>
    
            <div class="row content" style="margin-top: -2%;">
              <div class="col-lg-6" style="font-family: sans-serif;font-size: 20px;">                
                <p style="margin-left: 2%; font-family: sans-serif;">
                  Many wallets today are cluttered with several cards, cash and more.  
                  Keeping track of all these items can be difficult.  
                  The payment wallet<br> (eWallet) will provide all of the functions of today’s wallet on one 
                  convenient smart card eliminating the need for several cards.  
                  The payment wallet will also<br> provide numerous security features not available to regular wallet carriers.  
                </p>
                
                <ul>
                  <li><i class="ri-check-double-line"></i> Identification is required for every credit card transaction and the card is equipped with a disabling device if the card should be tampered with.</li>
                  <li><i class="ri-check-double-line"></i>The main objective of our project is to provide the users 
                    with a simple software that will enable easy,
                     secure payment available on their devices<br> and 
                     therefore facilitate a new technology-driven means by virtue of which, 
                     everyone can do away with the burden of having to
                      worry about carrying<br> cash around places for various needs.</li><br>                  
                </ul>
              </div>             
            </div>    
          </div>
        </section>
        <!-- End About Us Section -->


        <!-- ======= Accept payments online ======= -->
        <section id="payment online" class="team section-bg">
          <div class="section-title">
            <h2>Accept payments online with ease</h2>
          </div>
        <div class="html1">
        <div class="row">

          <div class="column1">
            <div class="card1">              
              <div class="container1">
                <div class="card-body" id="cardfont1">
                <center>
                  <h2 class="card-title">Industry Best Success Rates</h2>
                </center> 
                  </div>
                <div id="cardfont2">
                  <center>
                    With PayPro intelligent routing & direct bank integrations, we ensure that your customers payments go through every time 
                    <br>                 
                  </center>
                </div>                                
              </div>
            </div>
          </div>

          <div class="column1">
            <div class="card1">              
              <div class="container1">
                <div class="card-body" id="cardfont1">
                <center>
                  <h2 class="card-title">India's Most Widely Used Checkout</h2>
                </center> 
                  </div>
                <div id="cardfont2">
                  <center>
                    Over 330 million Indians prefer the PayPro Checkout & you can now give your customers the checkout experience they love 
                    <br>                 
                  </center>
                </div>                                
              </div>
            </div>
          </div>

          <div class="column1">
            <div class="card1">              
              <div class="container1">
                <div class="card-body" id="cardfont1">
                <center>
                  <h2 class="card-title">Dedicated Support for Customers</h2>
                </center> 
                  </div>
                <div id="cardfont2">
                  <center>
                    All online merchants and payment gateway users on PayPro get dedicated support via a toll-free number and email
                    <br>                 
                  </center>
                </div>                                
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
    </section>             
        <!-- Accept payments online -->


        <!-- ======= PayPro UPI Transfer ======= -->
        <section id="upi" class="upi">
          <div class="container" data-aos="fade-up" style="background-color: #E9C3EF; margin-left: 2%; margin-right: 2%;border-radius: 25px;">
    
            <div class="section-title">
              <h2>PayPro UPI Transfer</h2>
            </div>
    
            <div class="row content" style="margin-top: -2%;">
              <div class="col-lg-6" style="font-family: sans-serif;font-size: 20px;">              
                
                  <table style="width: 100%;padding-left: 3%;">
                    <tr>
                      <td style="width: 30%;">
                        Pay anyone directly from your bank account. 
                      </td>
                      <td rowspan="2">
                        <img src="bhimupi.png" style="width: 90%;height: 40%;"> 
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Pay anyone, everywhere. Make contactless and secure payments in-stores or online using PayPro Wallet or Directly from your 
                        Bank Account. Plus, send & receive money from anyone.  
                      </td>
                    </tr>
                  </table>
                <br>
              </div>             
            </div>    
          </div>
        </section>
        <!-- PayPro UPI Transfer -->



    <!-- Footer Section -->
        <section>
          <span class="full-text">
            <table  style="width: 100%;background-color: #E9C3EF;" id="tab">
        
              <col style="width:40%">
              <col style="width:30%">
              <col style="width:30%">
              <tr >
                <th>
                  <h1>PAYPRO</h1>
                </th>
                <th>
                  Quick Links
                </th>
                <th>
                  Find Us
                </th>
              </tr>
        
              <tr>
                <td>
                  Begining of new era for MONEY management
                </td>
                <td>
                  <a class="nav-link scrollto active" href="#hero" style="color: black;">Home</a>
                </td>
                <td>
                  <i class="fa fa-home" style="color: black;font-size:24px"></i>&emsp; 200, Main Street, Coimbatore, TamilNadu, India
                </td>
              </tr>
        
              <tr>
                <td>
                  Manage your MONEY more quickly
                </td>
                <td>
                  <a class="nav-link scrollto active" href="../Cards/cards.php" style="color: black;">Cards</a>
                </td>
                <td>
                  <i class="fa fa-envelope" style="color: black;font-size:20px"></i>&emsp; enquiries@paypro.com
                </td>
              </tr>
        
              <tr>
                <td>
                </td>
                <td>
                  <a class="nav-link scrollto active" href="../Transaction/form.php" style="color: black;">Transaction</a>
                </td>
                <td>
                  <i class="fa fa-phone" style="color: black;font-size:24px"></i>&emsp; +91 90817 24356
                </td>
              </tr>
        
              <tr>
                <td>
                </td>
                <td>
                  <a class="nav-link scrollto active" href="../Contacts/list_contact.php" style="color: black;">Contact</a>
                </td>
                <td>
                  <i class="fa fa-fax" style="color: black;font-size:20px"></i>&emsp; +91 90817 24356
                </td>
              </tr>
        
              <tr>
                <td>
                </td>
                <td>
                  <a class="getstarted scrollto" href="../Profile/profilehome.php" style="color: black;">Profile  </a>
                </td>
                <td>
                </td>
              </tr>
              <tr style="height: 60px" >
                <th colspan="3" style="padding-top: 30px; text-align: center;">
                  Follow us on
                </th>
              </tr>
              <tr >
                <td colspan="3" style="text-align: center;">
                  <a href="#" class="fa fa-twitter fa-2x"></a>
                  <a href="#" class="fa fa-facebook fa-2x"></a>
                  <a href="#" class="fa fa-instagram fa-2x"></a>
                  <a href="#" class="fa fa-linkedin fa-2x"></a>
                </td>
              </tr>
              <tr style="height: 10px"></tr>
              <tr style="height: 60px" >
                <td colspan="3" style="text-align: center;background-color: purple;color: white;">
                  © 2022 Copyright:
                  <a class="text-white" href="../Home/home.html"
                     >PayPro.com</a
                    >
                </td>
              </tr>
            </table>
        
          </span>
        
          <span class="short-text">
              <table id="tab1" style="width: 400%;" >
                <tr>
                  <th><h1>PAYPRO</h1></th>                    
                </tr>
                  <tr>
                    <td>Begining of new era for MONEY management<br></td>                    
                  </tr>
                  <tr>
                    <td>Manage your MONEY more quickly <br></td>                    
                  </tr>
                <tr>
                  <th><h3>Quick Links</h3> </th>                                           
                </tr>
                  <tr>
                    <td><a class="nav-link scrollto active" href="#hero" style="color: black;">Home</a> <br></td>                    
                  </tr>
                  <tr>
                    <td><a class="nav-link scrollto active" href="../Cards/cards.php" style="color: black;">Cards</a> <br></td>                    
                  </tr>
                  <tr>
                    <td><a class="nav-link scrollto active" href="../Transaction/form.php" style="color: black;">Transaction</a> <br></td>                    
                  </tr>
                  <tr>
                    <td><a class="nav-link scrollto active" href="../Contacts/list_contact.php" style="color: black;">Contact</a> <br></td>                    
                  </tr>
                  <tr>
                    <td><a class="getstarted scrollto" href="../Profile/profilehome.php" style="color: black;">Profile  </a> <br></td>                    
                  </tr>
                <tr>
                  <th><h3>Find Us</h3></th>                                
                </tr>
                  <tr>
                    <td><i class="fa fa-home" style="color: black;font-size:24px"></i>&emsp; 200, Main Street, Coimbatore, TamilNadu, India <br> </td>                                     
                  </tr>
                  <tr>
                    <td><i class="fa fa-envelope" style="color: black;font-size:20px"></i>&emsp; enquiries@paypro.com <br></td>                    
                  </tr>
                  <tr>
                    <td><i class="fa fa-phone" style="color: black;font-size:24px"></i>&emsp; +91 90817 24356 <br></td>                    
                  </tr>
                  <tr>
                    <td><i class="fa fa-fax" style="color: black;font-size:24px"></i>&emsp; +91 90817 24356 <br></td>
                    
                  </tr> 
                  <tr style="height: 60px" >
                    <th colspan="3" style="padding-top: 30px;padding-left: 50px;">
                      Follow us on
                    </th>
                  </tr>
                  <tr >
                    <td colspan="3">
                      <a href="#" class="fa fa-twitter fa-2x"></a>&emsp;
                      <a href="#" class="fa fa-facebook fa-2x"></a>&emsp;
                      <a href="#" class="fa fa-instagram fa-2x"></a>&emsp;
                      <a href="#" class="fa fa-linkedin fa-2x"></a>&emsp;
                    </td>
                  </tr>   
                  <tr style="height: 10px"></tr>
              <tr style="height: 60px;padding-left: 0px;" >
                <td colspan="3" >
                  © 2022 Copyright:
                  <a class="text-white" href="../Home/home.html"
                     >PayPro.com</a
                    >
                </td>
              </tr>         
              </table>
              
          </span>        
          </section>        
          <!-- End Footer Section -->

        <button onclick="topFunction()" id="topBtn" title="Go to top">Top</button>    

        <script>
          var mybutton = document.getElementById("topBtn");
          window.onscroll = function() {scrollFunction()};      
          function scrollFunction() {
            if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
              mybutton.style.display = "block";
            } else {
              mybutton.style.display = "none";
            }
          }
          function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
          }
          </script>
              
</body>

</html>
