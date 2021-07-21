<?php

namespace App\Lib;
use App\Models\Org_setting;
use DB;
use Illuminate\Support\Facades\Config;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use App\Http\Controllers\OrganizationController;
use App\Models\MasterOrganisation;
require base_path("vendor/autoload.php");
trait Email {
    public function getDb($org_id)
    {
      Config::set("database.connections.mysql", [
                  'driver' => 'mysql',
                  "host" => "localhost",
                  "database" => getenv("DB_DATABASE"),
                  "username" => "root",
                  "password" => getenv("DB_PASSWORD"),
                  'charset' => 'utf8',
                  'prefix' => '',
                  'prefix_indexes' => true,
                  'schema' => 'public',
                  'sslmode' => 'prefer',
              ]);
      DB::purge('mysql');
      $db=MasterOrganisation::where('id','=',$org_id)->get();
      $databaseName=$org_id.'_'.$db[0]->org_db_name;
      return $databaseName;

    }
    public function getSmtp($db)
    {
      $obj=new OrganizationController();
      $connection=$obj->org_connection($db);
      $data=Org_setting::get();
      return $data;
    }
    public function email($name,$email,$link,$org_id) {

                $db=$this->getDb($org_id);
                $smtp=$this->getSmtp($db);
                $mail = new PHPMailer;
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = ($smtp[0]->smtp_host!="")?$smtp[0]->smtp_host:"smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = ($smtp[0]->smtp_username!="")?$smtp[0]->smtp_username:"aman.zestgeek@gmail.com";
                $mail->Password = ($smtp[0]->smtp_password!="")?$smtp[0]->smtp_password:"gjzewjdysyfalcab";
                $mail->Port = 587;
                $mail->From = ($smtp[0]->smtp_email!="")?$smtp[0]->smtp_email:"aman.zestgeek@gmail.com";;
                $mail->FromName = "Sanad";
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
