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
  <link href="adminhome_style.css" rel="stylesheet">
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
                  <ul style="margin-left: 23%;">
                    <li><a class="nav-link scrollto active" href="../Admin/adminhome.php">Home</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/bank_details.php">Bank Details</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/block_users.php">Block Users</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/unblock_users.php">Unblock Users</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/remove_users.php">Remove Users</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/coupons.php">Coupons</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li><form method="post" action="../Admin/adminhome.php"><input type="submit"  value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
                  </ul>
                </ul>
              </nav>
              <br>
              <!-- .navbar --> 
            </span>

            <span class="short-text">
              <nav id="navbar" class="navbar">
                <ul>
                <li><h1 class="logo me-auto" ><a href=""><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                  
                </ul>
              </nav>
              <br>
              <nav id="navbar" class="navbar">
              <ul style="margin-left: 0%;">
                <li><a class="nav-link scrollto active" href="../Admin/adminhome.php">Home</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/bank_details.php">Bank Details</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/block_users.php">Block Users</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/unblock_users.php">Unblock Users</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/remove_users.php">Remove Users</a></li>
                    <li><a class="nav-link scrollto " href="../Admin/coupons.php">Coupons</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li><form method="post" action="../Admin/adminhome.php"><input type="submit"  value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
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
                    <div style="padding-left: 200px;">
                    <a href="../Admin/exp_user.php" style="text-decoration:none;"><button type="submit" id="export_data" name='export_data' value="Export to excel" class="home">User Details</button><br><br></a>                    
                      <a href="../Admin/exp_card.php" style="text-decoration:none;"><button type="submit" id="export_data" name='export_data' value="Export to excel" class="home">Card Details</button><br><br></a>
                      <a href="../Admin/exp_trans.php" style="text-decoration:none;"><button type="submit" id="export_data" name='export_data' value="Export to excel" class="home">Transaction Details</button><br><br></a>
                  </div>
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
