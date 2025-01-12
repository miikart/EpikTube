<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "needed/scripts.php";
force_login();
if($session['em_confirmation'] != "false") { redirect("index"); }
if(isset($_POST['submit'])) {
    $param_email = $_POST['field_verify_email'];
    if (substr($_POST['field_verify_email'], -strlen("www.epiktube.xyz")) === "www.epiktube.xyz") {
    $email_err = "Sorry, this email is invalid.";
    }
	if(empty(trim($_POST['field_verify_email']))) {
		$email_err = "Please enter an email.";
	} elseif(!filter_var(trim($_POST['field_verify_email']), FILTER_VALIDATE_EMAIL)) {
		$email_err = "Sorry, this email is invalid.";
	} else {
		$param_email = trim($_POST['field_verify_email']);
		
		// Prepare a select statement and bind variables to the prepared statement as parameters
		$email_in_use = $conn->prepare("SELECT uid FROM users WHERE email = ? AND uid <> ?");
		$email_in_use->execute([$param_email, $session['uid']]);
		if($email_in_use->rowCount() > 0) {
			$email_err = "Sorry, somebody is already using this e mail.";
		}
	}
    $emailValidator = new \enricodias\EmailValidator\EmailValidator();
    $validate = $emailValidator->validate($param_email);
    if ($validate) {
    if ($emailValidator->isDisposable()) {
       $email_err = "Sorry, somebody is already using this e mail.";
    }
    } else {
    $email_err = "Sorry, somebody is already using this e mail.";
    }
    if($_POST['field_verify_captcha'] != $_SESSION['captcha']) {
        $captcha_err = "Incorrect captcha answer!";
    }
    
   
  
   if(empty($email_err) && empty($captcha_err)) {
    $confirmation_email = generateId2();
    $datetime = new DateTime('+24hour');
    $tomorrow = $datetime->format('Y-m-d H:i:s');
    $verify = $conn->prepare("UPDATE users SET confirm_expire = ?, confirm_id = ?, email = ? WHERE uid = ?");
    $verify->execute([$tomorrow, $confirmation_email, $param_email, $session['uid']]);
    $protocol = "http://";
    if(!empty($_GET['next'])) {
    $construct_url = $protocol."www.epiktube.xyz/confirm_email?cid=".$confirmation_email."&next=".htmlspecialchars($_GET['next']);
    } else {
    $construct_url = $protocol."www.epiktube.xyz/confirm_email?cid=".$confirmation_email;    
    }
    $mail = new PHPMailer(true);                              
    try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $config["host"];                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $config["email"];                // SMTP username
    $mail->Password = $config["epassword"];
    $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port $config["emport"]
    $mail->Port = $config["emport"];                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($config["email"], 'EpikTube Service');
    $mail->addAddress($param_email);     // Add a recipient  

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'EpikTube email confirmation';
    $mail->Body    = '
<div id="baseDiv" style="width:57%; font-family: Arial, Helvetica, sans-serif; font-size: 12px; background-color: #FFFFFF; color: #222222;">
    <img src="http://www.epiktube.xyz/img/logo_rm2.png" width="120" height="48" alt="EpikTube" style="border: 0;">&nbsp;&nbsp;&nbsp;&nbsp;
    <img src="http://www.epiktube.xyz/img/tagline-20pt.gif" alt="Broadcast Yourself" style="border: 0;">
    
    <div id="dottedLine" style="margin-top: 10px; border: none; border-top: 2px dotted #666666; color: #ffffff; background-color: #ffffff; height: 1px;"></div>
    
    <div style="padding: 0px 10px;">
        <p>Hi '.htmlspecialchars($session['username']).',</p>
        <p>Please <a href="'. $construct_url.'" style="color: #0033CC;">click here</a> to confirm your email. Once you confirm that this is your email address, you\'ll be able to upload videos to EpikTube. If the "click here" link isn\'t supported by your email program, click this link or paste it into your web browser:</p>
        <p>'. $construct_url.'</p>
        <p>See you back on EpikTube!</p>
        <p>- The <a href="http://www.epiktube.xyz/t/about">EpikTube Team</a></p>
        
        <div id="graytext" style="color: gray; font-size: 10px;">
            <p>To change or cancel your email notifications go to <a href="http://www.epiktube.xyz/my_profile_email" style="color: #0033CC;">your email options</a></p>
        </div>
    </div>
    
    <div style="margin-top: 20px; border: none; border-top: 2px dotted #666666; color: #ffffff; background-color: #ffffff; height: 1px;"></div>
    
    <div style="color: gray; font-size: 12px;">
        <p>Copyright © 2024 copy.ashx.</p>
    </div>
</div>

';

    $mail->send();
    } catch (Exception $e) {
    }
    alert("A confirmation email has been sent to your email address. Please check your email and click on the link provided to confirm your account. 
    If you do not receive the confirmation message within a few minutes, please check your bulk or spam folders.");
    
    }


}
$_PAGE["Page"] = "email_confirm";
require_once "_templates/_structures/main.php"; ?>