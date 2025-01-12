<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "needed/scripts.php";

force_login();
    $favorites_of_you = $conn->prepare(
	"SELECT * FROM favorites
	LEFT JOIN videos ON favorites.vid = videos.vid
	LEFT JOIN users ON users.uid = videos.uid
	WHERE favorites.uid = ? AND videos.converted = 1 AND videos.privacy = 1
	ORDER BY favorites.fid DESC"
);
$favorites_of_you->execute([$session['uid']]);

$videos_of_you = $conn->prepare(
	"SELECT * FROM videos
	LEFT JOIN users ON users.uid = videos.uid
	WHERE videos.uid = ? AND videos.converted = 1 AND videos.privacy = 1
	ORDER BY videos.uploaded DESC"
);
$videos_of_you->execute([$session['uid']]);

if (empty($_GET['user'])) {
    if (isset($_GET['thanks'])){
    alert("Message has been sent.");
    }
    $msgcount = $conn->prepare("SELECT * FROM messages WHERE sender = ? ORDER BY created DESC");
    $msgcount->execute([$session['uid']]);
    $msgcount = $msgcount->rowCount();
    $nocompose = 'yes';
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $ppv = 35;
    $offs = ($page - 1) * $ppv;
    $inbox = $conn->prepare("SELECT * FROM messages LEFT JOIN users ON users.uid = messages.receiver WHERE sender = ? ORDER BY created DESC LIMIT $ppv OFFSET $offs");
$inbox->execute([$session['uid']]);
} else {
    $nocompose = 'no';
    $profile = $conn->prepare("SELECT * FROM users WHERE users.username = ?");
    $profile->execute([$_GET['user']]);
    if ($profile->rowCount() == 0) {
        header("Location: outbox.php");
    } else {
        $profile = $profile->fetch(PDO::FETCH_ASSOC);
    }
     if ($session['username'] == $profile['username']) {
        header("Location: my_messages.php");
        die();
     }
     // uh
   if ((isset($_POST['title']) || isset($_POST['comment'])) && strlen($_POST['title']) < 75 && strlen($_POST['comment']) < 50000 && strlen($_POST['title']) > 2 && strlen($_POST['comment']) > 2) {
       $pmid = generateId();
$message = $conn->prepare("INSERT IGNORE INTO messages (pmid, subject, attached, sender, receiver, body) VALUES (:pmid, :subject, :attached, :sender, :receiver, :body)");
$message->execute([
	":pmid" => trim($pmid),
	":subject" => encrypt($_POST['title']),
    ":attached" => trim($_POST['field_reference_video']),
	":sender" => $session['uid'],
    ":receiver" => $profile['uid'],
	":body" => encrypt($_POST['comment'])
]);
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
    $mail->addAddress($profile['email']);     // Add a recipient  

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'EpikTube Message: '.htmlspecialchars($_POST['title']);
    /*$mail->Body    = '<link href="http://www.epiktube.xyz/styles.css" rel="stylesheet" type="text/css"><img src="http://www.epiktube.xyz/img/logo.gif" width="147" height="50" hspace="12" vspace="12" alt="EpikTube"><br>EpikTube Message: '.htmlspecialchars($_POST['title']).'<p>
            <a href="http://www.epiktube.xyz/user/'.htmlspecialchars($session['username']).'">'.htmlspecialchars($session['username']).'</a> has sent you this message at <a href="http://www.epiktube.xyz">EpikTube</a>:<p>'. shorten($_POST['comment'], 350) .' <br><br><br><br>Click <a href="http://www.epiktube.xyz/read_msg.php?id='.htmlspecialchars($pmid).'&s=">here</a> to go directly to the message, or go to <a href="http://www.epiktube.xyz/my_messages.php">My Messages</a> on EpikTube to view all your messages.<p>Thank you for using EpikTube,<br>EpikTube Team<p><i>EpikTube - '. invokethConfig("slogan") .'</i><p><small>To change or cancel your email notifications, go to your <a href="http://www.epiktube.xyz/my_profile_email.php">email options</a>.</small><br><br><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright © '. retroDate(date("Y"), "Y") .' EpikTube, LLC';*/
    $mail->Body    = '<img src="http://www.epiktube.xyz/img/logo_rm2.png"   vspace="12" alt="EpikTube"><br>EpikTube Message: '.htmlspecialchars($_POST['title']).'<p>
            <a href="http://www.epiktube.xyz/user/'.htmlspecialchars($session['username']).'">'.htmlspecialchars($session['username']).'</a> has sent you this message at <a href="http://www.epiktube.xyz">EpikTube</a>:<p>'. shorten($_POST['comment'], 350) .' <br><br><br><br>Click <a href="http://www.epiktube.xyz/read_msg.php?id='.htmlspecialchars($pmid).'&s=">here</a> to go directly to the message, or go to <a href="http://www.epiktube.xyz/my_messages.php">My Messages</a> on EpikTube to view all your messages.<p>Thank you for using EpikTube,<br>EpikTube Team<p><i>EpikTube - '. invokethConfig("slogan") .'</i><p><small>To change or cancel your email notifications, go to your <a href="http://www.epiktube.xyz/my_profile_email.php">email options</a>.</small><br><br><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright &copy; '. retroDate(date("Y"), "Y") .' EpikTube, LLC';
    $mail->AltBody    = 'EpikTube Message: '.$_POST['title'].'

'.$session['username'].' has sent you this message at EpikTube:

'. shorten($_POST['comment'], 350) .' 



Click here (http://www.epiktube.xyz/read_msg.php?id='.$pmid.'&s=) to go directly to the message, or go to My Messages on EpikTube to view all your messages:
http://www.epiktube.xyz/my_messages.php

Thank you for using EpikTube,
EpikTube Team

To change or cancel your email notifications, go to your email options:
http://www.epiktube.xyz/my_profile_email.php';

    $mail->addReplyTo($config["email"], 'EpikTube Service');
    $mail->send();
} catch (Exception $e) {
   
}
header("Location: outbox.php?thanks");
    }

// uh oh

}
$_PAGE["Page"] = "outbox";
require_once "_templates/_structures/main.php";
?>
?>
