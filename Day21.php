<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mbox_home  =   getenv('mbox_home',true) ? getenv('mbox_home', true) : '.';
require     $mbox_home . '/vendor/autoload.php';

/*
 * Email properties
 * 
 */

if($argc < 2) {
	echo "usage: php Day21.php sample.ini\n";
	exit(-1);
}

$props	 = parse_ini_file($mbox_home . "/" . $argv[1] ); 

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

$Day0		= $props['Day0'];
$Day0 		= strtotime($Day0);
$DayN		= strtotime(date("Y-m-d"));
$N		= ($DayN - $Day0)/60/60/24;

if($N <0 or $N > 21) {
	echo "Not started or finished! \n";
	echo "Day # is " . $N . " \n";
	exit();
}

$DaySubject	= "<h2><string>Day " . $N . " - " . date("l, j F Y") . "</strong></h2>";

$urls = array();
foreach ($props['urls']  as $url) { 
	array_push($urls, $url);
}

/*
 * Email Subject and Body
 * 
 *
 */
$url = ".";
if($N == 0) {
	$url 	= "<img src='" .$urls[$N] . "'/>" ;
} else {
	$url                    = "<a href='" . $urls[$N] . "'>" . $urls[$N] . "</a>"  ;
}

/* $daycont                = file_get_contents($mbox_home . "/cont1/Day".$N.".htm"); */
$daycont                = file_get_contents("http://ez-hub.club/cont1/Day".$N.".htm");
$Subject                = "Day " . $N . " for " . $props['Name'];
$Body                   = $daycont . "<br><br>" . $url; 

$mail->Subject =  	$Subject;
$mail->Body =        	$Body;
$mail->send();
?>
