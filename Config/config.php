<?php

/**
 * raccolta di configurazioni
 */


//////////// EMAIL
// $mail = new PHPMailer;

// //Enable SMTP debugging. 
// $mail->SMTPDebug = 3;                               
// //Set PHPMailer to use SMTP.
// $mail->isSMTP();            
// //Set SMTP host name                          
// $mail->Host = "smtp.gmail.com";
// //Set this to true if SMTP host requires authentication to send email
// $mail->SMTPAuth = true;                          
// //Provide username and password     
// $mail->Username = "test.foowd@gmail.com";                 
// $mail->Password = "casellaDiTest";                           
// //If SMTP requires TLS encryption then set it
// $mail->SMTPSecure = "tls";                           
// //Set TCP port to connect to 
// $mail->Port = 587;                                   

// $mail->From = "test.foowd@gmail.com";
// $mail->FromName = "Sito Foowd";

// $mail->addAddress("nuclear.quantum@gmail.com", "Recepient Name");

// $mail->isHTML(true);

// $mail->Subject = "Subject Text";
// $mail->Body = "<i>Mail body in HTML</i>";
// $mail->AltBody = "This is the plain text version of the email content";


// if(!$mail->send()) 
// {
//     \Fprint::r("Mailer Error: " . $mail->ErrorInfo);
// } 
// else 
// {
//     \Fprint::r( "Message has been sent successfully");
// }


$mailer = new stdClass();
