<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
session_start();
$pay_id=$_SESSION['pay_id'];
echo $pay_id;
$pay_id=1;
$card_number=0;

$sql="SELECT card_number FROM card_details WHERE pay_id='".$pay_id."'";
$result=mysqli_query($db,$sql);

if(isset($_POST['add_cards']))
{
  $_SESSION['pay_id']=$pay_id;
  header("Location:../Cards/new_card.php");
        exit();
}

/*if(mysqli_num_rows($result)!=0)
	{
	$card_number=$row[0];
  }*/


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
                  <li><h1 class="logo me-auto" ><a href=""><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                  <ul style="margin-left: 45%;">
                    <li><a class="nav-link scrollto " href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#">Cards</a></li>
                    <li><a class="nav-link scrollto" href="#">Transaction</a></li>
                    <li><a class="nav-link scrollto" href="#">Contact</a></li>
                    <li><a class="getstarted scrollto" href="../Login/login.php">Login/Sign Up  </a></li>
                  </ul>
                </ul>
              </nav>
              
              <!-- .navbar --> 
            </span>

            <span class="short-text">
              <nav id="navbar" class="navbar">
                <ul>
                  <li><h1 class="logo me-auto" ><a href=""><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                  
                </ul>
              </nav>
              
              <nav id="navbar" class="navbar">
              <ul style="margin-left: 0%;">
                <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#">Cards</a></li>
                    <li><a class="nav-link scrollto" href="#">Transaction</a></li>
                    <li><a class="nav-link scrollto" href="#">Contact</a></li>
                    <li><a class="getstarted scrollto" href="../Login/login.php">Login/Sign Up  </a></li>
              </ul>
              </nav>
              <!-- .navbar --> 
            </span>
          </section>
        </div>
      </header>
      <!-- End Header -->

<br>

<form method="post" action="#">
  <input type="submit" value="ADD CARDS" name="add_cards" id="add_cards" class="addcards_btn" >
</form>
     
      <?php

      while($row=mysqli_fetch_row($result))
      { $i=0;
        $cvv=0;
        $card_number=$row[$i];
        $sql1="SELECT cvv FROM card_details WHERE card_number='".$card_number."'";
        $result1=mysqli_query($db,$sql1);
        if(mysqli_num_rows($result1))
      	{
          $row1=mysqli_fetch_row($result1);
	        $cvv=$row1[0];
        }
        $sql2="SELECT card_name FROM card_details WHERE card_number='".$card_number."'";
        $result2=mysqli_query($db,$sql2);
        if(mysqli_num_rows($result2))
      	{
          $row2=mysqli_fetch_row($result2);
	        $card_name=$row2[0];
        }
        $sql3="SELECT validto FROM card_details WHERE card_number='".$card_number."'";
        $result3=mysqli_query($db,$sql3);
        if(mysqli_num_rows($result3))
      	{
          $row3=mysqli_fetch_row($result3);
	        $validto=$row3[0];
        }

        $i++;

      print '<div class="flip-card">

        <div class="flip-card-inner">
          <div class="flip-card-front">
            <div class="card-container">
              <div class="card-name">Credit Card</div>
              <div class="chip">
                <img src="chip.png">
              </div>
              <div class="card-data">
                <div class="card-no">'.$card_number.'</div>
                <div class="expire-data">
                  <div class="expire-date">
                    <div class="date-label">MONTH/YEAR</div>
                    <div class="date" title="01/17">'.$validto.'</div>
                  </div>
                </div>
                <div>'.$card_name.'</div>
              </div>
            </div>
          </div>
    
          <div class="flip-card-back">
            <br><br>
            <div class="card-stripe"></div>
            <div class="card-signature">
              <span class="card-cvv">CVV</span>
              <span class="card-cvv-number">'.$cvv.'</span>
            </div>
            <p class="card-info">Using this card to purchase goods and services
              whenever you see the MASTERCARD symbol.
            </p>        
          </div>
        </div>
      </div>';

      }
      ?>
    
      <br><br>
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
