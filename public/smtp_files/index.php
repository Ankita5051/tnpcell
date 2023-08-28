<?php
$to=$_POST['email'];
echo $to;

include "../include/connection.php";
$sql="SELECT  * from admin where email=$to";
$res=mysqli_query($con,$sql);
	echo $res;
if(!$res){
	$em="not registered email";
	if(!isset($_SESSION['user'])){
		header("location:../index.php?error=$em");
		 }
		 else{
			header("location:../adminPanel.php?error=$em");
		 }
	

}



$digits = 4;
$otp=rand(pow(10, $digits-1), pow(10, $digits)-1);
include('smtp/PHPMailerAutoload.php');
$msg='Dear user your otp is '.$otp;
echo smtp_mailer($to,'subject',$msg);
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->SMTPDebug  = 3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls';
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "annu50512@gmail.com";
	$mail->Password = "fomvjrlgyhnumerv";
	$mail->SetFrom("annu50512@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
}

header("location:../include/matchotp.php?otp=$otp");
?>