<?php
require "needed/scripts.php";
if(isset($_SESSION['uid'])) {
	header("Location: index");
    exit;
}
if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION['uid']) && trim($_REQUEST['action_login'] = "Log In")) {
	if(isset($_POST['username']) && isset($_POST['password'])) {
		$member = $conn->prepare("SELECT uid, username, password, old_pass, termination FROM users WHERE username LIKE :username");
		$member->execute([":username" => trim($_POST['username'])]);
        
		if($member->rowCount() > 0) {
			$member = $member->fetch(PDO::FETCH_ASSOC);
            if($member['termination'] == 1) {
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
$_PAGE["Page"] = "login";  
require_once "_templates/_structures/main.php";
?>
