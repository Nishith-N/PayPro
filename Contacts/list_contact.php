<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');
session_start();
$pay_id=$_SESSION['pay_id'];
$username=$_SESSION['username'];
echo $username;

$sql="SELECT username FROM contact_details WHERE pay_id='".$pay_id."'";
$result=mysqli_query($db,$sql);

if(isset($_POST['add_btn']))
{
  $_SESSION['pay_id']=$pay_id;
  header("Location:../Contacts/new_contact.php");
        exit();
}

if(isset($_POST['pay_btn']))
{
  
  $_SESSION['username']=$username;
  header("Location:../Transaction/form.php");
        exit();
}
/*
if(isset($_POST['delete_btn']))
{
  $sql="DELETE FROM contact_details WHERE pay_id='".$pay_id."' AND username='".$pay_username."'";
  $result=mysqli_query($db,$sql);
  header("Location:../Contacts/new_contact.php");
        exit();
}

$pay_id=$_SESSION['pay_id'];

$sql="SELECT pay_name FROM contact_details WHERE pay_id='".$pay_id."' OR email='".$username."'";
$result=mysqli_query($db,$sql);
*/

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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  

  <!-- Template Main CSS File -->
  <link href="list_contact_style.css" rel="stylesheet">
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
                    <li><a class="getstarted scrollto" href="Login/login.html">Login/Sign Up  </a></li>
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
                    <li><a class="getstarted scrollto" href="Login/login.html">Login/Sign Up  </a></li>
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
  <input type="submit" value="ADD CONTACTS" name="add_btn" id="add_btn" class="addcontacts_btn" >
</form>
<?php
 while($row=mysqli_fetch_row($result))
 {
  $i=0;
  $pay_username=$row[$i];
  $sql1="SELECT pay_name FROM contact_details WHERE username='".$pay_username."' AND pay_id='".$pay_id."'";
  $result1=mysqli_query($db,$sql1);
  if(mysqli_num_rows($result1))
  {
    $row1=mysqli_fetch_row($result1);
    $pay_name=$row1[0];
  }
  $sql2="SELECT nickname FROM contact_details WHERE username='".$pay_username."' AND pay_id='".$pay_id."'";
  $result2=mysqli_query($db,$sql2);
  if(mysqli_num_rows($result2))
  {
    $row2=mysqli_fetch_row($result2);
    $nickname=$row2[0];
  }

print '<center>
<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <table style="width: 100%;height: 100%;">
        <tr>
          <td rowspan="2" style="width: 15%;"><i class="fa fa-user" style="font-size: 30px;"></i></td>
          <td style="text-align:left;">'.$pay_name.'</td>
        </tr>
        <tr>
          <td style="text-align:left;">'.$nickname.'</td>
        </tr>
      </table>
      
    </div>
    <div class="flip-card-back">
      <table style="width: 100%;">
        <tr>
          <td rowspan="2" style="width: 80%;"><h3>'.$pay_username.'</h3></td>
          <td style="width: 20%;text-align: center;"><form method="post" action="#"><input type="submit"  value="Pay" id="pay_btn" name="pay_btn" style="width: 90%;border-radius: 10px;"></form></td>
        </tr>
        <tr>
          <td style="width: 20%;text-align: center;"><form method="post" action="#"><input type="submit"  value="Delete" id="delete_btn" name="delete_btn" style="width: 90%;border-radius: 10px;"></form></td>
        </tr>
      </table>
            
    </div>
  </div>
</div>
</center>';
$i++;
 }
?>


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
