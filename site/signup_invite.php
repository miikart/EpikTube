<?php // since this is doing the exact same thing for bunches of post forms, this script will probably look like total dogshit 
// TODO: rewrite with post arrays.... now there is no excuse for this hideous code
require "needed/scripts.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
force_login();
if($session['em_confirmation'] == 'false' && $_SERVER['HTTP_REFERER'] == 'signup.php' || $_SERVER['HTTP_REFERER'] == 'signup' || $_SERVER['HTTP_REFERER'] == 'signup_login.php') {
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
    $mail->Subject = 'Welcome to EpikTube';
    $mail->Body    = '<center><img src="http://www.epiktube.xyz/img/logo_rm2.png" vspace="12" alt="EpikTube"></center><br><h1>Thank You for Signing Up!</h1>
You\'ve taken the next step in becoming part of the EpikTube community. Now that you\'re a 
member, you can rate videos, leave comments*, and upload your own videos to the site.
Please take a look at the <a href="http://www.epiktube.xyz/terms.php">Terms of Use</a> before uploading so that you understand what\'s allowed on the site.<p>
You will need to confirm your email address before uploading or commenting on a video.
Go to the <a href="http://www.epiktube.xyz/my_videos_upload.php">Upload</a> tab, enter your email address, and you will receive a new email with the link where you can confirm.<p>
To get you started, here are some of the fun things you can do with EpikTube:
<p><ul>
<li><a href="http://www.epiktube.xyz/my_videos_upload.php">Upload</a>* and share your videos worldwide</li>
<li><a href="http://www.epiktube.xyz/browse.php">Browse</a> millions of original videos uploaded by community members</li>
<li>Customize your experience with playlists and subscriptions</li>
<li>Integrate EpikTube with your website using video embeds or<a href="http://www.epiktube.xyz/developers">APIs</a></li>
</ul>
There\'s a lot more to explore, and more features are always in the works. Thanks for signing up, and we hope you enjoy the site!<p>
-- The EpikTube Team';

    $mail->send();
    } catch (Exception $e) {
    }
}
if($_SERVER['REQUEST_METHOD'] == "POST") {
if (!empty($_POST['friends_email1']) && empty($_POST['friends_fname1'])) { $send_err = "You've forgotten their names!"; }
if (!empty($_POST['friends_email2']) && empty($_POST['friends_fname2'])) { $send_err = "You've forgotten their names!"; }
if (!empty($_POST['friends_email3']) && empty($_POST['friends_fname3'])) { $send_err = "You've forgotten their names!"; }
if (!empty($_POST['friends_email4']) && empty($_POST['friends_fname4'])) { $send_err = "You've forgotten their names!"; }
if (!empty($_POST['friends_email5']) && empty($_POST['friends_fname5'])) { $send_err = "You've forgotten their names!"; }
if (!empty($_POST['friends_email6']) && empty($_POST['friends_fname6'])) { $send_err = "You've forgotten their names!"; }
if (!empty($_POST['friends_email7']) && empty($_POST['friends_fname7'])) { $send_err = "You've forgotten their names!"; }
if (!empty($_POST['friends_email']) && empty($_POST['friends_fname'])) { $send_err = "You've forgotten their names!"; }
// now 4 emails -- nobody is left behind!
if (empty($_POST['friends_email1']) && !empty($_POST['friends_fname1'])) { $send_err = "How will we send without an e-mail?"; }
if (empty($_POST['friends_email2']) && !empty($_POST['friends_fname2'])) { $send_err = "How will we send without an e-mail?"; }
if (empty($_POST['friends_email3']) && !empty($_POST['friends_fname3'])) { $send_err = "How will we send without an e-mail?"; }
if (empty($_POST['friends_email4']) && !empty($_POST['friends_fname4'])) { $send_err = "How will we send without an e-mail?"; }
if (empty($_POST['friends_email5']) && !empty($_POST['friends_fname5'])) { $send_err = "How will we send without an e-mail?"; }
if (empty($_POST['friends_email6']) && !empty($_POST['friends_fname6'])) { $send_err = "How will we send without an e-mail?"; }
if (empty($_POST['friends_email7']) && !empty($_POST['friends_fname7'])) { $send_err = "How will we send without an e-mail?"; }
if (empty($_POST['friends_email']) && !empty($_POST['friends_fname'])) { $send_err = "How will we send without an e-mail?"; }
// we don't want people sending emails to addresses like "jake"
if (!filter_var($_POST['friends_email1'], FILTER_VALIDATE_EMAIL) && !empty($_POST['friends_email1'])) { $send_err = "This is not a real e-mail address!"; }
if (!filter_var($_POST['friends_email2'], FILTER_VALIDATE_EMAIL) && !empty($_POST['friends_email2'])) { $send_err = "This is not a real e-mail address!"; }
if (!filter_var($_POST['friends_email3'], FILTER_VALIDATE_EMAIL) && !empty($_POST['friends_email3'])) { $send_err = "This is not a real e-mail address!"; }
if (!filter_var($_POST['friends_email4'], FILTER_VALIDATE_EMAIL) && !empty($_POST['friends_email4'])) { $send_err = "This is not a real e-mail address!"; }
if (!filter_var($_POST['friends_email5'], FILTER_VALIDATE_EMAIL) && !empty($_POST['friends_email5'])) { $send_err = "This is not a real e-mail address!"; }
if (!filter_var($_POST['friends_email6'], FILTER_VALIDATE_EMAIL) && !empty($_POST['friends_email6'])) { $send_err = "This is not a real e-mail address!"; }
if (!filter_var($_POST['friends_email7'], FILTER_VALIDATE_EMAIL) && !empty($_POST['friends_email7'])) { $send_err = "This is not a real e-mail address!"; }
if (!filter_var($_POST['friends_email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['friends_email'])) { $send_err = "This is not a real e-mail address!"; }
// AHAHAHAH! I WAS RIGHT! THIS LOOKS LIKE CATSHIT ON A PLATE!
}
// seperate email sending and error checking
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($send_err)) {
    alert($send_err, "error");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($send_err)) {


if (!empty($_POST['friends_email1'])) {
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
    $mail->setFrom($config["email"], 'EpikTube');
    $mail->addAddress($_POST['friends_email1'], $_POST['friends_fname1']);  

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $session['username'].' has invited you to join EpikTube';
    $mail->Body    = '<img src="http://www.epiktube.xyz/img/logo_rm2.png" vspace="12" alt="EpikTube"><br>
            EpikTube is a
            great site for sharing and hosting personal videos. I have been
            <br>using EpikTube to share videos with my friends and family. I
            would like to add <br>you to the list of people I may share videos
            with. <br><a href="http://www.epiktube.xyz/invite_signup.php?u='. htmlspecialchars($session['username']) .'">'. htmlspecialchars($_POST['message']) .'</a><p><i>EpikTube - '. invokethConfig("slogan") .'</i><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright © '. retroDate(date("Y"), "Y") .' EpikTube, LLC';

    $mail->send();
    session_error_index("Your invitations have been sent!", "success");
} catch (Exception $e) {
    alert("We were unable to send the email.", "error");
}
}
if (!empty($_POST['friends_email2'])) {
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
    $mail->setFrom($config["email"], 'EpikTube');
    $mail->addAddress($_POST['friends_email2'], $_POST['friends_fname2']);  

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $session['username'].' has invited you to join EpikTube';
    $mail->Body    = '<img src="http://www.epiktube.xyz/img/logo_rm2.png" vspace="12" alt="EpikTube"><br>
            EpikTube is a
            great site for sharing and hosting personal videos. I have been
            <br>using EpikTube to share videos with my friends and family. I
            would like to add <br>you to the list of people I may share videos
            with. <br><a href="http://www.epiktube.xyz/invite_signup.php?u='. htmlspecialchars($session['username']) .'">'. htmlspecialchars($_POST['message']) .'</a><p><i>EpikTube - '. invokethConfig("slogan") .'</i><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright © '. retroDate(date("Y"), "Y") .' EpikTube, LLC';

    $mail->send();
    session_error_index("Your invitations have been sent!", "success");
} catch (Exception $e) {
    alert("We were unable to send the email.", "error");
}
}

if (!empty($_POST['friends_email3'])) {
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
    $mail->setFrom($config["email"], 'EpikTube');
    $mail->addAddress($_POST['friends_email3'], $_POST['friends_fname3']);  

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $session['username'].' has invited you to join EpikTube';
    $mail->Body    = '<img src="http://www.epiktube.xyz/img/logo_rm2.png" vspace="12" alt="EpikTube"><br>
            EpikTube is a
            great site for sharing and hosting personal videos. I have been
            <br>using EpikTube to share videos with my friends and family. I
            would like to add <br>you to the list of people I may share videos
            with. <br><a href="http://www.epiktube.xyz/invite_signup.php?u='. htmlspecialchars($session['username']) .'">'. htmlspecialchars($_POST['message']) .'</a><p><i>EpikTube - '. invokethConfig("slogan") .'</i><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright © '. retroDate(date("Y"), "Y") .' EpikTube, LLC';

    $mail->send();
    session_error_index("Your invitations have been sent!", "success");
} catch (Exception $e) {
    alert("We were unable to send the email.", "error");
}
}

if (!empty($_POST['friends_email4'])) {
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
    $mail->setFrom($config["email"], 'EpikTube');
    $mail->addAddress($_POST['friends_email4'], $_POST['friends_fname4']);  

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $session['username'].' has invited you to join EpikTube';
    $mail->Body    = '<img src="http://www.epiktube.xyz/img/logo_rm2.png" vspace="12" alt="EpikTube"><br>
            EpikTube is a
            great site for sharing and hosting personal videos. I have been
            <br>using EpikTube to share videos with my friends and family. I
            would like to add <br>you to the list of people I may share videos
            with. <br><a href="http://www.epiktube.xyz/invite_signup.php?u='. htmlspecialchars($session['username']) .'">'. htmlspecialchars($_POST['message']) .'</a><p><i>EpikTube - '. invokethConfig("slogan") .'</i><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright © '. retroDate(date("Y"), "Y") .' EpikTube, LLC';

    $mail->send();
    session_error_index("Your invitations have been sent!", "success");
} catch (Exception $e) {
    alert("We were unable to send the email.", "error");
}
}

if (!empty($_POST['friends_email5'])) {
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
    $mail->setFrom($config["email"], 'EpikTube');
    $mail->addAddress($_POST['friends_email5'], $_POST['friends_fname5']);  

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $session['username'].' has invited you to join EpikTube';
    $mail->Body    = '<img src="http://www.epiktube.xyz/img/logo_rm2.png" vspace="12" alt="EpikTube"><br>
            EpikTube is a
            great site for sharing and hosting personal videos. I have been
            <br>using EpikTube to share videos with my friends and family. I
            would like to add <br>you to the list of people I may share videos
            with. <br><a href="http://www.epiktube.xyz/invite_signup.php?u='. htmlspecialchars($session['username']) .'">'. htmlspecialchars($_POST['message']) .'</a><p><i>EpikTube - '. invokethConfig("slogan") .'</i><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright © '. retroDate(date("Y"), "Y") .' EpikTube, LLC';

    $mail->send();
    session_error_index("Your invitations have been sent!", "success");
} catch (Exception $e) {
    alert("We were unable to send the email.", "error");
}
}

if (!empty($_POST['friends_email6'])) {
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
    $mail->setFrom($config["email"], 'EpikTube');
    $mail->addAddress($_POST['friends_email6'], $_POST['friends_fname6']);  

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $session['username'].' has invited you to join EpikTube';
    $mail->Body    = '<img src="http://www.epiktube.xyz/img/logo_rm2.png" vspace="12" alt="EpikTube"><br>
            EpikTube is a
            great site for sharing and hosting personal videos. I have been
            <br>using EpikTube to share videos with my friends and family. I
            would like to add <br>you to the list of people I may share videos
            with. <br><a href="http://www.epiktube.xyz/invite_signup.php?u='. htmlspecialchars($session['username']) .'">'. htmlspecialchars($_POST['message']) .'</a><p><i>EpikTube - '. invokethConfig("slogan") .'</i><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright © '. retroDate(date("Y"), "Y") .' EpikTube, LLC';

    $mail->send();
    session_error_index("Your invitations have been sent!", "success");
} catch (Exception $e) {
    alert("We were unable to send the email.", "error");
}
}

if (!empty($_POST['friends_email7'])) {
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
    $mail->setFrom($config["email"], 'EpikTube');
    $mail->addAddress($_POST['friends_email7'], $_POST['friends_fname7']);  

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $session['username'].' has invited you to join EpikTube';
    $mail->Body    = '<img src="http://www.epiktube.xyz/img/logo_rm2.png" vspace="12" alt="EpikTube"><br>
            EpikTube is a
            great site for sharing and hosting personal videos. I have been
            <br>using EpikTube to share videos with my friends and family. I
            would like to add <br>you to the list of people I may share videos
            with. <br><a href="http://www.epiktube.xyz/invite_signup.php?u='. htmlspecialchars($session['username']) .'">'. htmlspecialchars($_POST['message']) .'</a><p><i>EpikTube - '. invokethConfig("slogan") .'</i><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright © '. retroDate(date("Y"), "Y") .' EpikTube, LLC';

    $mail->send();
    session_error_index("Your invitations have been sent!", "success");
} catch (Exception $e) {
    alert("We were unable to send the email.", "error");
}
}

if (!empty($_POST['friends_email'])) {
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
    $mail->setFrom($config["email"], 'EpikTube');
    $mail->addAddress($_POST['friends_email'], $_POST['friends_fname']);  

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $session['username'].' has invited you to join EpikTube';
    $mail->Body    = '<img src="http://www.epiktube.xyz/img/logo_rm2.png" vspace="12" alt="EpikTube"><br>
            EpikTube is a
            great site for sharing and hosting personal videos. I have been
            <br>using EpikTube to share videos with my friends and family. I
            would like to add <br>you to the list of people I may share videos
            with. <br><a href="http://www.epiktube.xyz/invite_signup.php?u='. htmlspecialchars($session['username']) .'">'. htmlspecialchars($_POST['message']) .'</a><p><i>EpikTube - '. invokethConfig("slogan") .'</i><br><br><center><div style="padding: 2px; padding-left: 7px; padding-top: 0px; margin-top: 10px; background-color: #E5ECF9; border-top: 1px dashed #3366CC; font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold;">&nbsp;</div><br>Copyright © '. retroDate(date("Y"), "Y") .' EpikTube, LLC';

    $mail->send();
    session_error_index("Your invitations have been sent!", "success");
} catch (Exception $e) {
    alert("We were unable to send the email.", "error");
}
}

// HOLY SHIT. R.I.P ME IF ANY BUG EVER HAPPENS WITH THESE.

}

$_PAGE["Page"] = "signup_invite";
require_once "_templates/_structures/watch.php";
?>