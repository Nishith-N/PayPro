<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
session_start();
$username=$_SESSION['username'];
$pay_id=$_SESSION['pay_id'];
if($username=='')
{
  header("Location:../Home/home.html");
        exit(); 
}


$card_number=0;

$sql="SELECT card_number FROM card_details WHERE pay_id='".$pay_id."'";
$result=mysqli_query($db,$sql);
$num=mysqli_num_rows($result);

if(isset($_POST['add_cards']))
{
  $_SESSION['pay_id']=$pay_id;
  header("Location:../Cards/new_card.php");
        exit();
}

if(isset($_POST['delete_cards']))
{
  $_SESSION['pay_id']=$pay_id;
  header("Location:../Cards/delete_card.php");
        exit();
}
if(isset($_POST['primary_card']))
{
  $_SESSION['pay_id']=$pay_id;
  header("Location:../Cards/primary_card.php");
        exit();
}

if(isset($_POST['signout']))
{
  session_destroy();
    header("Location:../Login/login.php");
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
    <title>Cards</title>
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
<body style="background-image: url('https://www.sykes.com/wp-content/uploads/2020/10/100820-feature-image-gen-z-mobile-digital-blog-scaled.jpg');background-size: cover;height: 100%;font-family: 'Numans', sans-serif;">
<header id="header" style="margin-top: -22px;" class="fixed-top ">
        <div class="container d-flex align-items-center">  
          <section>
            <span class="full-text" >
              <nav id="navbar" class="navbar" style="margin-top: 0%;">
                <ul>
                <li><h1 class="logo me-auto" ><a href="../Userhome/userhome.php"><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                  <ul style="margin-left: 43%;">
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
                <li><h1 class="logo me-auto" ><a href="../Userhome/userhome.php"><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                  
                </ul>
              </nav>
              <br>
              <nav id="navbar" class="navbar">
              <ul style="margin-left: 0%;">
                <li><a class="nav-link scrollto ctive" href="../Userhome/userhome.php">Home</a></li>
                    <li><a class="nav-link scrollto active" href="../Cards/new_card.php">Cards</a></li>
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

<br>

<form method="post" action="#">
  <input type="submit" style="margin-left: 50px" value="ADD CARDS" name="add_cards" id="add_cards" class="addcards_btn" >
</form>
<br>
<form method="post" action="#">
  <input type="submit" style="margin-left: 50px" value="DELETE CARDS" name="delete_cards" id="delete_cards" class="delete_cards_btn" >
</form>
<br>
<form method="post" action="#">
  <input type="submit" style="margin-left: 50px" value="PRIMARY CARD" name="primary_card" id="primary_card" class="delete_cards_btn" >
</form>
     
<?php
      
      if($num==0)
      {
        echo $pay_id;
        print '
        <center>
        
          <div>
          
          <h3>"No cards"</h3>
          </div>
        </center>
        
        ';
        
      }
      else
      {
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

          $sql4="SELECT primary_card FROM user_details WHERE pay_id='".$pay_id."'";
          $result4=mysqli_query($db,$sql4);
          if(mysqli_num_rows($result4))
          {
            $row4=mysqli_fetch_row($result4);
            $testcardnum=$row4[0];
          }
  
          $i++;
  
        print '<center><div class="flip-card"';
        if($testcardnum==$card_number)
        {
       print  ' style="box-shadow: 1px 5px 1px 20px #F8B84E; box-shadow-bottom-right-radius: 5px;
       box-shadow-bottom-left-radius: 20px;
       box-shadow-top-right-radius: 20px;
       box-shadow-top-left-radius: 20px;">
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
        </div><br>';
        }
        else
        {
          print '>';
          print'
  
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
        </div></center><br><br>';
  
        }
      }
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
