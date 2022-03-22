<?php

use PHPMailer\PHPMailer\PHPMailer;

$name='nishith';
$email='nishithnkutty@gmail.com';
$subject='Hello';
$bosy='THis is body'


require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

$mail=new PHPMailer();

$mail->isSMTP();
$mail->Host="smtp.gmail.com";
$mail->SMTPAuth=true;
$mail->Username="nishithnkutty@gmail.com";
$mail->Password="nishith1314";
$mail->Port=465;
$mail->SMTPSecure="ssl";

$mail->isHTML(true);
$mail->setfrom($email,$name);
$mail->addAddress("nishithnkutty@gmail.com");
$mail->Subject=("$email($subject)");
$mail->Body=$body;

if($mail->send())
{
    $status="success";
    $response="Email is sent!";
}
else
{
    $status="failed";
    $response="Someting is wrong: <br>" .$mail->Errorinfo;
}

exit(json_encode(array("status"=>$status,"response"=>$response)));

?>
