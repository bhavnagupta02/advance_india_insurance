<?php
/*$to = "gupta.bhavna612@gmail.com";
$subject = "Email Test";
$txt = "Hello world!";
$headers = "From: webmaster@example.com" . "\r\n" .
"CC: somebodyelse@example.com";

//mail($to,$subject,$txt,$headers);
if(mail($to,$subject,$txt)){
    echo "Success..";
}
else{
    echo "Failed..";
}*/


$to = "gupta.bhavna612@gmail.com, advins.ind@yopmail.com, seosattisingh@gmail.com";
$subject = "This is subject - Advance India Insurance";

$message = "<b>This is HTML message.</b>";
$message .= "<h1>This is headline.</h1>";

$header = "From:no-reply@posadvanceinsurance.com \r\n";
$retval = mail($to,$subject,$message,$header);
if(isset($retval))//change
{
    echo "Message sent successfully...";
}
else
{
    echo "Message could not be sent...";
}
?>