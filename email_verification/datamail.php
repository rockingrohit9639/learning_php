<?php 
$html='<h2>Hello Rohit</h2>';
echo smtp_mailer('rohitsaini.codes@gmail.com','Hello Rohit',$html);
function smtp_mailer($to,$subject, $msg){
	require_once("smtp/class.phpmailer.php");
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPDebug = 1; 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'TLS'; 
	$mail->Host = "smtp.sendgrid.net";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "rohitbhatwara1@gmail.com";
	$mail->Password = "khushihaimerikhushi";
	$mail->SetFrom("rohitbhatwara1@gmail.com");
	// $mail->addAttachment("dummy.pdf");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	if(!$mail->Send()){
		return 0;
	}else{
		return 1;
	}
}

?>

