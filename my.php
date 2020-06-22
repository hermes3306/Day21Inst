<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mbox_home  =   getenv('mbox_home',true) ? getenv('mbox_home', true) : '.';
require     $mbox_home . '/vendor/autoload.php';

/*
 * Email properties
 * 
 */

$props	 = parse_ini_file($mbox_home . '/my.ini'); 

$mail 	= new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPDebug 	= 	0;
$mail->ContentType	= 	"text/html";  
$mail->CharSet		=	"UTF-8"; 
$mail->Encoding 	=	"base64";

$mail->Host 		=  	$props['Host'];
$mail->Port 		= 	$props['Port'];
$mail->SMTPSecure 	=  	$props['SMTPSecure'];
$mail->SMTPAuth 	=  	$props['SMTPAuth'];
$mail->Username 	=  	$props['Username'];
$mail->Password 	=  	$props['Password'];

$mail->setFrom        	($props['setFrom']);
$mail->isHTML          	($props['isHtml']);

foreach ($props['To']  as $addr) { $mail->addAddress($addr); }
foreach ($props['Cc']  as $addr) { $mail->addCC($addr); }
foreach ($props['Bcc'] as $addr) { $mail->addBCC($addr); }
foreach ($props['Attach'] as $attach) { $mail->addAttachment($attach); }
/*
 * Email Subject and Body
 * 
 *
 */
$Subject                = $props['Subject'];
$Body                   = $props['Body'];

$mail->Subject =  	$Subject;
$mail->Body =        	$Body;
$mail->send();
?>
