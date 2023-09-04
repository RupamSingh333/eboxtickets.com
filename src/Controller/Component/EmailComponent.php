<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Controller\Component;
use Cake\Controller\Component;
use Exception;

/**
 * The CakePHP FlashComponent provides a way for you to write a flash variable
 * to the session from your controllers, to be rendered in a view with the
 * FlashHelper.
 *
 * @method void success(string $message, array $options = []) Set a message using "success" element
 * @method void error(string $message, array $options = []) Set a message using "error" element
 */
class EmailComponent extends Component
{
//error_reporting(0);

public function send($to, $subject, $message ,$cc=null) {
$sender = "info@eboxtickets.com"; // this will be overwritten by GMail
// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
// $sender = 'rupam@doomshell.com';
$senderName = 'Eboxtickets';
$recipient = $to;
// Replace smtp_username with your Amazon SES SMTP user name.
//$usernameSmtp = 'AKIA2LYP4IEXPZ6EWYLV';
$usernameSmtp = "info@eboxtickets.com";
// Replace smtp_password with your Amazon SES SMTP password.
//$passwordSmtp = 'BInmkwVa3BmUu0ZX/5QoFOXFZ3gLg0dY2b/AVrwwhEtg';
//$passwordSmtp = "passw0rd!#"; // zoho mail
$passwordSmtp = "1nC0rrect!";

//$host = 'email-smtp.ap-south-1.amazonaws.com';
//$host = 'email-smtp.us-east-1.amazonaws.com';
$host = "smtp.gmail.com";
$port = 465;
// $port = 587;
//$host = "smtp.zoho.in";

$mail = new \PHPMailer(true);


try {
    // Specify the SMTP settings.
    $mail->isSMTP();
    $mail->setFrom($sender, $senderName);
    $mail->Username   = $usernameSmtp;
    $mail->Password   = $passwordSmtp;
    $mail->Host       = $host;
    $mail->Port       = $port;
    $mail->SMTPAuth   = true;
		// $mail->SMTPSecure = 'tls';
		$mail->SMTPSecure = 'ssl';
    //	$mail->SMTPDebug = '4';
    //$mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);
    if($cc){
      $mail->addCC($cc);
     }

    // Specify the message recipients.
    $mail->addAddress($recipient);
    // You can also add CC, BCC, and additional To recipients here.

    // Specify the content of the message.
    $mail->isHTML(true);
    $mail->Subject    = $subject;
    $mail->Body       = $message;
    $mail->AltBody    = $message;
   // $mail->addStringAttachment($ical_content,'ical.ics','base64','text/calendar');
    $mail->Send();
    $rt="1";
} catch (phpmailerException $e) {
  $rt="2"; //Catch errors from PHPMailer.
} catch (Exception $e) {
  $rt="2"; //Catch errors from Amazon SES.
}
return $rt;

  }

}
