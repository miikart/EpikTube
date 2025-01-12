<?php 
require "needed/scripts.php";
if(isset($_SESSION['uid']) && $_SESSION['uid'] != null) { 
	redirect("index");
}
 	
$captchaid = generateId2(32);
if($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST['current_form'] == "signupForm") {
 $param_ip = $enduser_ip;
if($_REQUEST['response'] != $_SESSION['captcha']) {
$captcha_error = " Incorrect or expired captcha answer.";  
}
if(empty(trim($_POST["username"]))){
$username_err = "Please enter a username.";
} else if(!preg_match('/^[a-zA-Z0-9]+$/', trim($_POST["username"]))){
$username_err = "Sorry, that user name contains special characters.";
} else if (strlen(trim($_POST["username"])) > 20) {
$username_err = "Sorry, that user name is too long.";
} else {
$dauser = trim($_POST["username"]);
$stmt = $conn->prepare("SELECT uid FROM users WHERE username = :username");
$stmt->bindParam(':username', $dauser, PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount() > 0){
$username_err = "Sorry, that user name has already been taken.";
}
}
if(empty(trim($_POST["password1"]))){
$password_err = "Please enter a password.";     
} elseif(strlen(trim($_POST["password1"])) < 3){
$password_err = "Your password is too short.";
} else {
$password = trim($_POST["password1"]);
}
if(empty(trim($_POST["password2"]))){
$confirm_password_err = "Please confirm password.";     
} else {
$confirm_password = trim($_POST["password2"]);
if(empty($password_err) && ($password != $confirm_password)){
$confirm_password_err = "Your passwords didn't match; try retyping them.";
}
}
if (substr($_POST['email'], -strlen("epiktube.com")) === "epiktube.com") {
$email_err = "Sorry, this email is invalid.";
}
if(empty(trim($_POST['email']))) {
$email_err = "Please enter an email.";
} elseif(!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
$email_err = "Sorry, this email is invalid.";
} else {
$param_email = trim($_POST['email']);
$email_in_use = $conn->prepare("SELECT uid FROM users WHERE email = :em");
$email_in_use->bindParam(":em", $param_email, PDO::PARAM_STR);
$email_in_use->execute();
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
if (!array_key_exists($_POST['country'],$_COUNTRIES) || $_POST['country'] == "") {
$countryerr = 'Not a country.';
}
if($_POST['birthday_mon'] != '---' && $_POST['birthday_day'] != '---' && $_POST['birthday_yr'] != '---') {
$birthday_mon = $_POST['birthday_mon'];
$birthday_day = $_POST['birthday_day'];
$birthday_yr = $_POST['birthday_yr'];
$currentDate = new DateTime();
$birthday = $birthday_yr . '-' . $birthday_mon . '-' . $birthday_day;
$dateTime = DateTime::createFromFormat('Y-m-d', $birthday);
$errors = DateTime::getLastErrors();
if ($dateTime === false || $errors['warning_count'] > 0 || $errors['error_count'] > 0) {
    // Date format is invalid
   $birthday_error = "Invalid age.";
}
$diff = $currentDate->diff($dateTime);
if ($diff->y < 13) {
exit(header("Location: /signup_copa"));
if ($diff->y > 123) {
    $birthday_error = "Invalid age.";
}
}
} else {
$birthday_error = "Pick a birthday.";
}
if($_REQUEST['gender'] != "m" && $_REQUEST['gender'] != "f") {
$gendererr = "Pick a gender.";
} 
if(empty($gendererr)) {
if ($_REQUEST['gender'] == "m") {
$gender = 1;
} else {
$gender = 2;
}
}
if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($captcha_error) && empty($countryerr) && empty($birthday_error) && empty($gendererr)){ 
$param_id = generateId();
$param_password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
$uselessassshit = isset($_POST['weekly_tube']) ? 1 : 0;
$stmt = $conn->prepare("INSERT IGNORE INTO users (uid, username, password, email, emailprefs_wklytape, ip, country, gender, birthday) VALUES (:uid, :username, :password, :email, :emailprefs_wklytape, :ip, :country, :gender, :birthday)");
$stmt->bindParam(':uid', $param_id);
$stmt->bindParam(':username', $dauser);
$stmt->bindParam(':password', $param_password);
$stmt->bindParam(':email', $param_email);
$stmt->bindParam(':emailprefs_wklytape', $uselessassshit);
$stmt->bindParam(':ip', $param_ip);
$stmt->bindParam(':country', $_REQUEST['country']);
$stmt->bindParam(':gender', $gender);
$stmt->bindParam(':birthday', $birthday);
$stmt->execute();
$_SESSION['uid'] = $param_id;
$location = "/signup_invite.php";
if(!empty($_POST['v'])) {
$location = '/watch.php?v='.$_POST['v'];
}
redirect($location);
}
} elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST['current_form'] == "loginForm") {
 	if(isset($_POST['username']) && isset($_POST['password'])) {
		$member = $conn->prepare("SELECT uid, username, password, old_pass, termination FROM users WHERE username LIKE :username");
		$member->execute([":username" => trim($_POST['username'])]);
		if($member->rowCount() > 0) {
			$member = $member->fetch(PDO::FETCH_ASSOC);
            if($member['termination'] == 1 || $member['username'] == "flowerz") {
             exit("<img width='875px' src='https://media.istockphoto.com/id/533837393/photo/clown.jpg?s=612x612&w=0&k=20&c=2uitATXPXAq-nNzSYgT1heMsuep3_nSRZqviBAbmhbE='>");
            }
            if($member['termination'] !== 1) {
			if(password_verify(trim($_POST['password']), $member['password']) || password_verify(trim($_POST['password']), $member['old_pass'])) {
				$_SESSION['uid'] = $member['uid'];
               
				$lastlogin = $conn->prepare("UPDATE users SET lastlogin = CURRENT_TIMESTAMP WHERE uid = ?");
				$lastlogin->execute([$member['uid']]);
                if(password_verify(trim($_POST['password']), $member['password'])) {
                $fuckover = $conn->prepare("UPDATE users SET old_pass = NULL WHERE uid = ?");
				$fuckover->execute([$member['uid']]);
                if (isset($_REQUEST['next']) && $_REQUEST['next'] != null) {
                header("Location: " . trim(htmlspecialchars($_REQUEST['next'])));
                exit;
                } else {
                header("Location: index.php");
                exit;
                }
                }
			} else {
				alert("Sorry, your login is incorrect.", "error");
                $lastfail = $conn->prepare("UPDATE users SET failed_login = CURRENT_TIMESTAMP WHERE uid = ?");
				$lastfail->execute([$member['uid']]);
			}
            }
		} else {
			alert("That user doesn't exist!", "error");
		}
	}   
}
?>
<?php 
if(!empty($username_err) || !empty($password_err) || !empty($confirm_password_err) || !empty($email_err) || !empty($captcha_error) || !empty($countryerr) || !empty($birthday_error) || !empty($gendererr)){ 
if(!empty($email_err)) { alert(htmlspecialchars($email_err), "error"); }
if(!empty($username_err)) { alert(htmlspecialchars($username_err), "error"); }
if(!empty($password_err)) { alert(htmlspecialchars($password_err), "error"); }
if(!empty($confirm_password_err)) { alert(htmlspecialchars($confirm_password_err), "error"); }
if(!empty($countryerr)) { alert(htmlspecialchars($countryerr), "error"); }
if(!empty($gendererr)) { alert(htmlspecialchars($gendererr), "error"); }
if(!empty($birthday_error)) { alert(htmlspecialchars($birthday_error), "error"); }
if(!empty($captcha_error)) { alert(htmlspecialchars($captcha_error), "error"); }
   
} 
$_PAGE["Page"] = "signup";
require_once "_templates/_structures/main.php";
?>