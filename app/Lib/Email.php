<?php

namespace App\Lib;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require base_path("vendor/autoload.php");
trait Email {
    public function email($name,$email,$link) {

                $mail = new PHPMailer;
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "aman.zestgeek@gmail.com";
                $mail->Password = "gjzewjdysyfalcab";
                $mail->Port = 587;
                $mail->From = "ravinder.zestgeek@gmail.com";
                $mail->FromName = "Full Name";
                $mail->smtpConnect(
                array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                )
            );

          $mail->addAddress($email, $name);

          $mail->isHTML(true);

          $mail->Subject = "Confirmation";
          $mail->Body = "Please go to this link ".$link;
          $mail->AltBody = "This is the plain text version of the email content";

          if(!$mail->send())
          {
              echo "Mailer Error: " . $mail->ErrorInfo;
          }
          else
          {
              echo "Message has been sent successfully";
          }
    }
}
