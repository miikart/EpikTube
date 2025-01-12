<?php
// I stole this from https://gist.github.com/tylerhall/521810
// Generates a strong password of N length containing at least one lower case letter,
// one uppercase letter, one digit, and one special character. The remaining characters
// in the password are chosen at random from those four sets.
//
// The available characters in each set are user friendly - there are no ambiguous
// characters such as i, l, 1, o, 0, etc. This, coupled with the $add_dashes option,
// makes it much easier for users to manually type or speak their passwords.
//
// Note: the $add_dashes option will increase the length of the password by
// floor(sqrt(N)) characters.

function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
{
	$sets = array();
	if(strpos($available_sets, 'l') !== false)
		$sets[] = 'abcdefghjkmnpqrstuvwxyz';
	if(strpos($available_sets, 'u') !== false)
		$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
	if(strpos($available_sets, 'd') !== false)
		$sets[] = '23456789';
	if(strpos($available_sets, 's') !== false)
		$sets[] = '!@#$%&*?';

	$all = '';
	$password = '';
	foreach($sets as $set)
	{
		$password .= $set[array_rand(str_split($set))];
		$all .= $set;
	}

	$all = str_split($all);
	for($i = 0; $i < $length - count($sets); $i++)
		$password .= $all[array_rand($all)];

	$password = str_shuffle($password);

	if(!$add_dashes)
		return $password;

	$dash_len = floor(sqrt($length));
	$dash_str = '';
	while(strlen($password) > $dash_len)
	{
		$dash_str .= substr($password, 0, $dash_len) . '-';
		$password = substr($password, $dash_len);
	}
	$dash_str .= $password;
	return $dash_str;
}

    // Geniune page starts here!
    require "needed/scripts.php";
    if($_SESSION['uid'] != NULL) {
	header("Location: index.php");
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $new_password = generateStrongPassword(rand(12, 28));
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['field_login_username']) && !empty($_POST['field_login_username'])) {
    $real_user = $conn->prepare("SELECT * FROM users WHERE users.username = ?");
    $real_user->execute([$_POST['field_login_username']]);

    if($real_user->rowCount() == 0) {
	$bad_shit = "That user does not exist.";
    } else {
	$real_user = $real_user->fetch(PDO::FETCH_ASSOC);
    }
    if(!empty($bad_shit)) { alert($bad_shit, "error"); }
    if(empty($bad_shit)) {
    $bcrypt_new = password_hash($new_password, PASSWORD_DEFAULT);
    $reset_pass = $conn->prepare("UPDATE users SET old_pass = ? WHERE uid = ?");
	$reset_pass->execute([$real_user['password'], $real_user['uid']]);

    $reset_pass = $conn->prepare("UPDATE users SET password = ? WHERE uid = ?");
	$reset_pass->execute([$bcrypt_new, $real_user['uid']]);
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
    $mail->Subject = 'Your EpikTube account details';
    //$mail->Body    = '<link href="http://www.EpikTube.com/styles.css" rel="stylesheet" type="text/css"><img src="http://www.EpikTube.com/img/logo.gif" width="147" height="50" hspace="12" vspace="12" alt="EpikTube"><br>Hello '.$real_user['username'].',<p>Here is your user name and login password:<br>User: '.$real_user['username'].'<br>Password: '.$new_password.'<p>You can log back into your account with these details.<p>Thank you for using EpikTube,<br>EpikTube Team<p><i>EpikTube - '. invokethConfig("slogan") .'</i><br><br><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright © '. retroDate(date("Y"), "Y") .' EpikTube, LLC';
    $mail->Body    = '<img src="http://www.epiktube.xyz/img/logo_rm2.png"   vspace="12" alt="EpikTube"><br>Hello '.$real_user['username'].',<p>Here is your user name and login password:<br>User: '.$real_user['username'].'<br>Password: '.$new_password.'<p>You can log back into your account with these details.<p>Thank you for using EpikTube,<br>EpikTube Team<p><i>EpikTube - '. invokethConfig("slogan") .'</i><br><br><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright &copy; '. retroDate(date("Y"), "Y") .' EpikTube, LLC';
    $mail->AltBody = 'Hello '.$real_user['username'].',

Here is your user name and login password:
User: '.$real_user['username'].'
Password: '.$new_password.'

You can log back into your account with these details.

Thank you for using EpikTube,
EpikTube Team';

    $mail->addReplyTo($config["email"], 'EpikTube Service');
    $mail->send();
} catch (Exception $e) {
   
}

    alert("Successfully sent your password! Check your inbox.");
    }
}
$_PAGE["Page"] = "forgot";
require_once "_templates/_structures/main.php"; ?>