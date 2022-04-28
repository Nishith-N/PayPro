<?php
$db = mysqli_connect('localhost','root','','payprodb')
or die('Error connecting to MySQL server.');

session_start();
$flag=0;
$num=0;
$search_date='';
$username=$_SESSION['username'];
$f_amount=$_SESSION['f_amount'];
$t_amount=$_SESSION['t_amount'];
$pay_id=$_SESSION['pay_id'];
$flag=$_SESSION['flag'];
$search_date=$_SESSION['search_date'];
$sql="DELETE FROM trans_hist WHERE dates < now() - interval 30 DAY";
$result=mysqli_query($db,$sql);
$sql="SELECT wallet FROM user_details WHERE phone='".$username."' OR email='".$username."'";
	$result=mysqli_query($db,$sql);
  $row=mysqli_fetch_row($result);
  $disp=$row[0];
$otp=1234;
if(isset($_POST['submit_btn']))
{
  $flag=3;
  
  $search=$_POST['search2'];
  echo $search;
  $sql="SELECT tr_id FROM trans_hist WHERE pay_name LIKE '%".$search."%' AND pay_id='".$pay_id."'";
  $result=mysqli_query($db,$sql);
  $num=mysqli_num_rows($result);
  if($num==0)
  {
    $sql="SELECT tr_id FROM trans_hist WHERE pay_username='".$search."' AND pay_id='".$pay_id."'";
  $result=mysqli_query($db,$sql);
  $num=mysqli_num_rows($result);
  }
}
if($flag==0)
{
$sql="SELECT tr_id FROM trans_hist WHERE pay_id='".$pay_id."'";
$result=mysqli_query($db,$sql);
if($result==FALSE)
{
  $num=0;
}
else
{
$num=mysqli_num_rows($result);
}
}

if($username=='')
{
  header("Location:../Home/home.html");
        exit(); 
}
if($flag==1)
{
  if($f_amount!=0)
  {
    $sql="SELECT tr_id FROM trans_hist WHERE pay_id='".$pay_id."' AND amount = '".$f_amount."'";
$result=mysqli_query($db,$sql);
$num=mysqli_num_rows($result);
  }
  if($f_amount!=0 && $t_amount!=0)
  {
    $sql="SELECT tr_id FROM trans_hist WHERE pay_id='".$pay_id."' AND amount BETWEEN '".$f_amount."' AND '".$t_amount."'";
$result=mysqli_query($db,$sql);
$num=mysqli_num_rows($result);
echo $f_amount;
  }
  if($search_date!='')
  {
  $sql="SELECT tr_id FROM trans_hist WHERE pay_id='".$pay_id."' AND dates < '".$search_date."'";
$result=mysqli_query($db,$sql);
$num=mysqli_num_rows($result);
echo $search_date;
  }
}
if($flag==2)
{
  if($f_amount!=0 && $t_amount!=0)
  {
  echo $f_amount;
  $sql="SELECT tr_id FROM trans_hist WHERE dates < '".$search_date."' AND  amount BETWEEN '".$f_amount."' AND '".$t_amount."'";
	$result=mysqli_query($db,$sql);
  $num=mysqli_num_rows($result);
  }
  if($t_amount==0)
  {
    $sql="SELECT tr_id FROM trans_hist WHERE dates < '".$search_date."' AND  amount='".$f_amount."'";
	$result=mysqli_query($db,$sql);
  $num=mysqli_num_rows($result);
  }
}
if(isset($_POST['pay'])){
$_SESSION['username']=$username;
			header("Location:../Transaction/pay.php");
      exit();
}
if(isset($_POST['search'])){
  $_SESSION['username']=$username;
        header("Location:../Transaction/search_transaction.php");
        exit();
  }




if(isset($_POST['signout']))
{
  session_destroy();
    header("Location:../Login/login.php");
          exit();
}




?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>
<head>
	<title>Transaction</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="formstyle.css">   
	<link rel="icon" href="https://is2-ssl.mzstatic.com/image/thumb/Purple118/v4/46/d1/61/46d16165-c305-5c6f-7626-1a60208042f3/source/512x512bb.jpg" type="image/icon type">
</head>
<body>

<header id="header" style="margin-top: -22px;" class="fixed-top ">
        <div class="container d-flex align-items-center">  
          <section>
            <span class="full-text" >
              <nav id="navbar" class="navbar" style="margin-top: 0%;">
                <ul style="padding-top: 20px;">
                  <li><h1 class="logo me-auto" style="margin-left: -200px;"><a href="../Userhome/userhome.php"><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                  <ul style="margin-left: 650px;">
                  <li><a class="nav-link scrollto " href="../Userhome/userhome.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="../Cards/cards.php">Cards</a></li>
                    <li><a class="nav-link scrollto active" href="../Transaction/form.php">Transaction</a></li>
                    <li><a class="nav-link scrollto" href="../Contacts/list_contact.php">Contact</a></li>&nbsp;&nbsp;
                
                    <li><a class="nav-link scrollto" href="../Profile/profilehome.php">Profile</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <li><form method="post" action="#"><input type="submit"  value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
  
                  </ul>
                </ul>
              </nav>
              <br>
              <?php
              print'
              <marquee style="color:#F8B74E"><h4>Wallet amount: '.$disp.'</h4></marquee>';
              ?>
              
            </span>

            <span class="short-text">
              <nav id="navbar" class="navbar">
                <ul>
                  <li><h1 class="logo me-auto" style="padding-top: 24px;margin-left: -70px;"><a href="../Userhome/userhome.php"><i style="font-size: 35px;"><strong>PayPro</strong></i></a></h1></li>
                  
                </ul>
              </nav>
              <br>
              <nav id="navbar" class="navbar">
              <ul style="margin-left: -24px;">
                <li><li><a class="nav-link scrollto " href="../Userhome/userhome.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="../Cards/cards.php">Cards</a></li>
                    <li><a class="nav-link scrollto active" href="../Transaction/form.php">Transaction</a></li>
                    <li><a class="nav-link scrollto" href="../Contacts/list_contact.php">Contact</a></li>
                    <li><a class="nav-link scrollto" href="../Profile/profilehome.php">Profile</a></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <li><form method="post" action="#"><input type="submit"  value="SignOut" id="signout" name="signout" class="signout_btn"></form></li>
              </ul>
              </nav>
              <?php
              
              
              print'
              <marquee style="color:#F8B74E"><h4>Wallet amount: '.$disp.'</h4></marquee>';
              ?>
       
            </span>
          </section>
        </div>
      </header> 
    

      <form method="post" action="#">
        <input type="submit" style="margin-left: 500px;margin-top: 180px;" value="PAY" name="pay" id="pay" class="pay_btn" >
      </form>
      <br>
      <form method="post" action="#">
        <input type="submit" style="margin-left: 950px;margin-top: -80px;" value="SEARCH" name="search" id="search" class="search_btn" >
      </form>
      <br>
      <form class="form-group" action="#" style="margin:auto;max-width:300px;max-height: 30px;" method="post">
        <input type="text" placeholder="Search.." name="search2">
        <input type="submit" name="submit_btn" class="btn float-right add_contact_btn" id="submit_btn">
      </form>
      <br><br>
      <?php
      
     
      if($num==0)
      {
        
        print '
        <center>
        
          <div>
          
          <h3>No History</h3>
          </div>
        </center>
        
        ';
        
      }
      else{
        while($row=mysqli_fetch_row($result))
        {
          $i=0;
          $tr_id=$row[$i];
          
          $sql1="SELECT pay_username FROM trans_hist WHERE tr_id='".$tr_id."'";
          $result1=mysqli_query($db,$sql1);
          if(mysqli_num_rows($result1))
          {
            $row1=mysqli_fetch_row($result1);
            $pay_username=$row1[0];
          }
          $sql2="SELECT amount FROM trans_hist WHERE tr_id='".$tr_id."'";
          $result2=mysqli_query($db,$sql2);
          if(mysqli_num_rows($result2))
          {
            $row2=mysqli_fetch_row($result2);
            $sent_amount=$row2[0];
          }
          $sql3="SELECT reasons FROM trans_hist WHERE tr_id='".$tr_id."'";
          $result3=mysqli_query($db,$sql3);
          if(mysqli_num_rows($result3))
          {
            $row3=mysqli_fetch_row($result3);
            $reasons=$row3[0];
          }

          
      print '
      <center>
        <div class="flip-card">
          <div class="flip-card-inner">
            <div class="flip-card-front">
              <table style="width: 100%;height: 100%;">
                <tr>
                  <td rowspan="3" style="width: 15%;"><i class="fa fa-user" style="font-size: 30px;"></i></td>
                  <td style="text-align:left;">'.$pay_username.'</td>                  
                </tr>
               
                <tr>
                  <td style="text-align:left;">'.$sent_amount.'</td>
                </tr>
              </table>
              
            </div>
            <div class="flip-card-back">
              <table style="width: 100%;">
                <tr>
                  <td rowspan="2" style="width: 80%;"><h3>'.$reasons.'</h3></td>
                  
                </tr>
                <tr>
                  
                </tr>
              </table>
                    
            </div>
          </div>
        </div>
        </center>';
        }
      }
        ?>
        <br>
<br><br>
</body>
</html>
