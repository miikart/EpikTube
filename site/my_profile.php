<?php
require "needed/scripts.php";
force_login();
$member = $conn->prepare("SELECT * FROM users WHERE uid = ?");
$member->execute([$session['uid']]);
$member = $member->fetch(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == "POST") {
	if(isset($_POST['birthday'])) {
	$_POST['birthday'] = date("Y-m-d", strtotime($_POST['birthday']));
	}
    if ($_POST['website'] != NULL){
   if (filter_var($_POST['website'], FILTER_VALIDATE_URL) === FALSE) {
    $profile_err = "This URL doesn't look right.";
}
    }
    if ($_POST['email'] == NULL){
    $profile_err = "Please enter an email, and then try again.";
    } else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === FALSE) {
    $profile_err = "This email doesn't look right.";
    }
if (!empty(trim($_POST['country'])) && !array_key_exists(trim($_POST['country']),$_COUNTRIES)) {
    $profile_err = 'Not a country.';
}
if($_POST['birthday_mon'] != '---' && $_POST['birthday_day'] != '---' && $_POST['birthday_yr'] != '---') {
    $birthday_mon = $_POST['birthday_mon'];
$birthday_day = $_POST['birthday_day'];
$birthday_yr = $_POST['birthday_yr'];
$currentDate = new DateTime();
$birthday = $birthday_yr . '-' . $birthday_mon . '-' . $birthday_day;
$dateTime = DateTime::createFromFormat('Y-m-d', $birthday);
$errors = DateTime::getLastErrors();

if ($dateTime === false || (isset($errors['warning_count']) && $errors['warning_count'] > 0) || (isset($errors['error_count']) && $errors['error_count'] > 0)) {
    $profile_err = "Invalid age.";
}

$diff = $currentDate->diff($dateTime);

if ($diff->y < 13) {
    $profile_err = "Invalid age.";
}
if ($diff->y > 123) {
    $profile_err = "Invalid age.";
}
}
if(strlen($_POST['about']) > 500) {
    $profile_err = "Please shorten some of your entered information and try again.";
}
if(strlen($_POST['website']) > 500) {
    $profile_err = "Please shorten some of your entered information and try again.";
}
if(strlen($_POST['name']) > 500) {
    $profile_err = "Please shorten some of your entered information and try again.";
}
if(strlen($_POST['hometown']) > 500) {
    $profile_err = "Please shorten some of your entered information and try again.";
}
if(strlen($_POST['city']) > 500) {
    $profile_err = "Please shorten some of your entered information and try again.";
}
if(strlen($_POST['occupations']) > 500) {
    $profile_err = "Please shorten some of your entered information and try again.";
}
if(strlen($_POST['companies']) > 500) {
    $profile_err = "Please shorten some of your entered information and try again.";
}
if(strlen($_POST['schools']) > 500) {
    $profile_err = "Please shorten some of your entered information and try again.";
}
if(strlen($_POST['hobbies']) > 500) {
    $profile_err = "Please shorten some of your entered information and try again.";
}
if(strlen($_POST['fav_media']) > 500) {
    $profile_err = "Please shorten some of your entered information and try again.";
}
if(strlen($_POST['music']) > 500) {
    $profile_err = "Please shorten some of your entered information and try again.";
}
if(strlen($_POST['books']) > 500) {
    $profile_err = "Please shorten some of your entered information and try again.";
}
if($_POST['profile_theme'] != "classic" && $_POST['profile_theme'] !=  "red" && $_POST['profile_theme'] !=  "blue" && $_POST['profile_theme'] !=  "purple" && $_POST['profile_theme'] !=  "orange" && $_POST['profile_theme'] !=  "gray" && $_POST['profile_theme'] !=  "cyan" && $_POST['profile_theme'] !=  "green"&& $_POST['profile_theme'] !=  "pink") {
    $profile_err = "Invaild Profile theme.";
}
 if(isset($member['profile_icon']) && $member['profile_icon'] != 0 && $member['profile_icon'] != 1) { 
 $profile_err = "Invaild profile picture setting";
 }
if (!empty($profile_err)) {
   alert($profile_err, "error");
}

	if (empty($profile_err)) {
	if($_POST['birthday_mon'] === '---' && $_POST['birthday_day'] === '---' && $_POST['birthday_yr'] === '---') {
		$update_video = $conn->prepare("UPDATE users SET name = ?, email = ?, birthday = NULL, gender = ?, relationship = ?, about = ?, website = ?, hometown = ?, city = ?, country = ?, occupations = ?, companies = ?, schools = ?, hobbies = ?, fav_media = ?, music = ?, books = ?, profileColor = ? ,profilePictureSetting = ? WHERE uid = ?");
		$update_video->execute([
			trim($_POST['name']),
            trim($_POST['email']),
			trim($_POST['gender']),
			trim($_POST['relationship']),
			trim($_POST['about']),
			trim($_POST['website']),
			trim($_POST['hometown']),
			trim($_POST['city']),
			trim($_POST['country']),
			trim($_POST['occupations']),
			trim($_POST['companies']),
			trim($_POST['schools']),
			trim($_POST['hobbies']),
			trim($_POST['fav_media']),
			trim($_POST['music']),
			trim($_POST['books']),
	trim($_POST['profile_theme']),
		trim($_POST['profile_icon']),
			$session['uid']
		]);
       $member = $conn->prepare("SELECT * FROM users WHERE uid = ?");
$member->execute([$session['uid']]);
$member = $member->fetch(PDO::FETCH_ASSOC);
        alert("Profile has been successfully updated.");
	} else {
		$update_video = $conn->prepare("UPDATE users SET name = ?, email = ?, birthday = ?, gender = ?, relationship = ?, about = ?, website = ?, hometown = ?, city = ?, country = ?, occupations = ?, companies = ?, schools = ?, hobbies = ?, fav_media = ?, music = ?, books = ?, profileColor = ? ,profilePictureSetting = ? WHERE uid = ?");
		$update_video->execute([
			trim($_POST['name']),
            trim($_POST['email']),
			trim($birthday),
			trim($_POST['gender']),
			trim($_POST['relationship']),
			trim($_POST['about']),
			trim($_POST['website']),
			trim($_POST['hometown']),
			trim($_POST['city']),
			trim($_POST['country']),
			trim($_POST['occupations']),
			trim($_POST['companies']),
			trim($_POST['schools']),
			trim($_POST['hobbies']),
			trim($_POST['fav_media']),
			trim($_POST['music']),
			trim($_POST['books']),
				trim($_POST['profile_theme']),
			trim($_POST['profile_icon']),
			$session['uid']
		]);
       $member = $conn->prepare("SELECT * FROM users WHERE uid = ?");
$member->execute([$session['uid']]);
$member = $member->fetch(PDO::FETCH_ASSOC);
        alert("Profile has been successfully updated.");
	}
    }
}
$_PAGE["Page"] = "my_profile";
require_once "_templates/_structures/main.php";
?>