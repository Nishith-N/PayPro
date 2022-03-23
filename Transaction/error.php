<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link href="error_style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<header id="header" style="margin-top: -22px;" class="fixed-top ">
        <div class="container d-flex align-items-center">  
          <section>
            <span class="full-text" >
              <nav id="navbar" class="navbar" style="margin-top: 0%;">
                
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
              
              </nav>
              <!-- .navbar --> 
            </span>
          </section>
        </div>
      </header>
      <!-- End Header -->
    <center>
    <table style="padding-top: 250px;">
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
                <form method="post" action="error.html">
                    <input type="submit"  value="Go To Home" id="gotohome_btn" name="gotohome_btn" class="home" >
                </form>
            </td>
        </tr>
    </table>
</center>     
</body>
</html>