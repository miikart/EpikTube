<?php


    // Geniune page starts here!
    require "needed/start.php";
    if($_SESSION['uid'] != NULL) {
	header("Location: index.php");
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['field_login_email']) && !empty($_POST['field_login_email'])) {
    $real_user = $conn->prepare("SELECT * FROM users WHERE users.email = ?");
    $real_user->execute([$_POST['field_login_email']]);

    if($real_user->rowCount() == 0) {
	$bad_shit = "This email address isn't associated with any accounts.";
    } else {
	$real_user = $real_user->fetch(PDO::FETCH_ASSOC);
    }
    if(!empty($bad_shit)) { alert($bad_shit, "error"); }
    if(empty($bad_shit)) {
    $mail = new PHPMailer(true);                              
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $config["host"];                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $config["email"];                // SMTP username
    $mail->Password = $config["epassword"];
    $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 587
    $mail->Port = $config["emport"];                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($config["email"], 'EpikTube Service');
    $mail->addAddress($real_user['email']);     // Add a recipient  

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Your EpikTube username';
    //$mail->Body    = '<link href="http://www.EpikTube.com/styles.css" rel="stylesheet" type="text/css"><img src="http://www.EpikTube.com/img/logo.gif" width="147" height="50" hspace="12" vspace="12" alt="EpikTube"><br>Hello '.$real_user['username'].',<p>Here is your user name and login password:<br>User: '.$real_user['username'].'<br>Password: '.$new_password.'<p>You can log back into your account with these details.<p>Thank you for using EpikTube,<br>EpikTube Team<p><i>EpikTube - '. invokethConfig("slogan") .'</i><br><br><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright © '. retroDate(date("Y"), "Y") .' EpikTube, LLC';
    $mail->Body    = '<img src="http://www.epiktube.xyz/img/logo_rm2.png"   vspace="12" alt="EpikTube"><br>Hello '.$real_user['username'].',<p>Here is your user name<br>User: '.$real_user['username'].'<p>You can log back into your account with these details.<p>Thank you for using EpikTube,<br>EpikTube Team<p><i>EpikTube - '. invokethConfig("slogan") .'</i><br><br><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright &copy; '. retroDate(date("Y"), "Y") .' EpikTube, LLC';
    $mail->AltBody = 'Hello '.$real_user['username'].',

Here is your user name and login password:
User: '.$real_user['username'].'

You can log back into your account with these details.

Thank you for using EpikTube,
EpikTube Team';

    $mail->addReplyTo($config["email"], 'EpikTube Service');
    $mail->send();
} catch (Exception $e) {
   
}

    alert("Successfully sent your username! Check your inbox.");
    }
}
?>
<div class="tableSubTitle">Forgot Username</div>

<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr valign="top">
		<td style="padding-right: 15px;">
		<span class="highlight">Forgot your Username? No problem!</span>
		
		<br><br>

	

		Simply fill out the email address you signed up with and we'll email you your username. 

		

		</td>
		<td width="280">
		
		<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#E5ECF9">
			<tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td align="center">
				
		<table width="100%" cellpadding="5" cellspacing="0" border="0">
			<form method="post" action="forgot_username.php">
			<input type="hidden" name="field_command" value="forgot_submit">
				<tr>
					<td align="right"><span class="label">Email Address:</span></td>
					<td><input type="text" size="20" name="field_login_email" value=""></td>
				</tr>
				<tr>
					<td align="right"><span class="label">&nbsp;</span></td>
					<td><input type="submit" value="Get my username!"><br><br></td>
				</tr>
			</form>
			</table>
			
				</td>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</table>
			
		</td>
	</tr>
</table>

		</div>
		</td>
	</tr>
</table>
<? require "needed/end.php"; ?>