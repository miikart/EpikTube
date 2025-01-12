<?php
require "needed/scripts.php";
force_login();
//subscriptions

$q = "
 SELECT u.*
    FROM subscriptions s
    JOIN users u ON u.uid = s.subscribed_to
    WHERE s.subscriber = ? 
      AND s.subscribed_type = 'user_uploads'
      AND u.termination = 0 ORDER by subscribed DESC
";
$subscriptions = $conn->prepare($q);
$subscriptions->execute([$session['uid']]);
$sub_check = $subscriptions->fetchAll(PDO::FETCH_ASSOC);
$subscriptions = $conn->prepare("
    SELECT *
    FROM subscriptions s
    JOIN videos v ON v.uid = s.subscribed_to
    JOIN users u ON u.uid = v.uid
    WHERE s.subscriber = ? 
    AND s.subscribed_type = 'user_uploads'
    AND v.converted = 1 AND privacy = 1
    AND u.termination = 0 ORDER BY v.uploaded DESC
");
$subscriptions->execute([$session['uid']]);
$sub_check2 = $subscriptions->fetchAll(PDO::FETCH_ASSOC);
// What The Fuck
if(isset($_GET['add_user']) && isset($_GET['remove_user'])) {
alert("What the fuck?", "error");
$d0_not_ececute = 1;
}
// Ass User Upload Subscription
if(isset($_GET['add_user']) && $d0_not_ececute !== 1) {
$profile = $conn->prepare("SELECT * FROM users WHERE users.username = ?");
$profile->execute([$_GET['add_user']]);

if($profile->rowCount() == 0) {
	alert("Channel doesn't exist!", "error");
} else {
	$profile = $profile->fetch(PDO::FETCH_ASSOC);
	// Check if the user has already subscribed to this channel.
    $subscribed = $conn->prepare("SELECT subscription_id FROM subscriptions WHERE subscriber = ? AND subscribed_to = ? AND subscribed_type = 'user_uploads' ");
    $subscribed->execute([
	$session['uid'],
	$profile['uid']
    ]);
    
    // Deny subscription if already added
    if($subscribed->rowCount() > 0) {
	    alert("You're already subscribed to this channel!", "error");
	    $already_subscribed = 1;
    }
    if($profile['uid'] == $session['uid']) {
        alert("You cannot subscribe to yourself!", "error");
	    $already_subscribed = 1;
    }
    if ($already_subscribed != 1) {
    // Now, subscribe.
    $subscription_add = $conn->prepare("INSERT INTO subscriptions (subscription_id, subscriber, subscribed_to, subscribed_type) VALUES (?, ?, ?, 'user_uploads')");
    $subscription_add->execute([
        generateId(),
	    $session['uid'],
	    $profile['uid']
    ]);
    $add_subscribers_cnt = $conn->prepare("UPDATE users SET subscribers = subscribers + 1 WHERE uid = ?");
	$add_subscribers_cnt->execute([$profile['uid']]);
	
	$add_subscriptions_cnt = $conn->prepare("UPDATE users SET subscriptions = subscriptions + 1 WHERE uid = ?");
	$add_subscriptions_cnt->execute([$session['uid']]);
	
$q = "
 SELECT u.*
    FROM subscriptions s
    JOIN users u ON u.uid = s.subscribed_to
    WHERE s.subscriber = ? 
      AND s.subscribed_type = 'user_uploads'
      AND u.termination = 0 ORDER by subscribed DESC
";
$subscriptions = $conn->prepare($q);
$subscriptions->execute([$session['uid']]);
$sub_check = $subscriptions->fetchAll(PDO::FETCH_ASSOC);
$subscriptions = $conn->prepare("
    SELECT *
    FROM subscriptions s
    JOIN videos v ON v.uid = s.subscribed_to
    JOIN users u ON u.uid = v.uid
    WHERE s.subscriber = ? 
    AND s.subscribed_type = 'user_uploads'
    AND v.converted = 1 AND privacy = 1
    AND u.termination = 0 ORDER BY v.uploaded DESC
");
$subscriptions->execute([$session['uid']]);
$sub_check2 = $subscriptions->fetchAll(PDO::FETCH_ASSOC);
     alert("Your subscription to ".$profile['username']." has been added.", "success");
    }
}
}

// Remove User Upload Subscription
if(isset($_GET['cancel']) && $d0_not_ececute !== 1) {
$profile = $conn->prepare("SELECT * FROM users WHERE users.username = ?");
$profile->execute([$_GET['cancel']]);

if($profile->rowCount() == 0) {
	alert("Channel doesn't exist!", "error");
} else {
	$profile = $profile->fetch(PDO::FETCH_ASSOC);
	// Check if the user has already subscribed to this channel.
    $subscribed = $conn->prepare("SELECT subscription_id FROM subscriptions WHERE subscriber = ? AND subscribed_to = ? AND subscribed_type = 'user_uploads' ");
    $subscribed->execute([
	$session['uid'],
	$profile['uid']
    ]);
    
    // Deny subscription if already added
    if($subscribed->rowCount() < 1) {
	    alert("You're not subscribed to this channel!", "error");
	    $not_subscribed = 1;
    } else {
    $subscribed = $subscribed->fetch(PDO::FETCH_ASSOC);
    }
    
    if($profile['uid'] == $session['uid']) {
        alert("You cannot subscribe to yourself!", "error");
	    $not_subscribed = 1;
    }
    
    if ($not_subscribed != 1) {
    // Now, unsubscribe.
    $subscription_add = $conn->prepare("DELETE FROM subscriptions WHERE subscription_id = ?");
    $subscription_add->execute([
        $subscribed['subscription_id']
    ]);
    $add_subscribers_cnt = $conn->prepare("UPDATE users SET subscribers = subscribers - 1 WHERE uid = ?");
	$add_subscribers_cnt->execute([$profile['uid']]);
	
	$add_subscriptions_cnt = $conn->prepare("UPDATE users SET subscriptions = subscriptions - 1 WHERE uid = ?");
	$add_subscriptions_cnt->execute([$session['uid']]);
	
$q = "
 SELECT u.*
    FROM subscriptions s
    JOIN users u ON u.uid = s.subscribed_to
    WHERE s.subscriber = ? 
      AND s.subscribed_type = 'user_uploads'
      AND u.termination = 0 ORDER by subscribed DESC
";
$subscriptions = $conn->prepare($q);
$subscriptions->execute([$session['uid']]);
$sub_check = $subscriptions->fetchAll(PDO::FETCH_ASSOC);
$subscriptions = $conn->prepare("
    SELECT *
    FROM subscriptions s
    JOIN videos v ON v.uid = s.subscribed_to
    JOIN users u ON u.uid = v.uid
    WHERE s.subscriber = ? 
    AND s.subscribed_type = 'user_uploads'
    AND v.converted = 1 AND privacy = 1
    AND u.termination = 0 ORDER BY v.uploaded DESC
");
$subscriptions->execute([$session['uid']]);
$sub_check2 = $subscriptions->fetchAll(PDO::FETCH_ASSOC);
     alert("Your subscription to ".$profile['username']." has been removed.", "success");
    }
}
}
$_PAGE["Page"] = "subscription_center";
require_once "_templates/_structures/main.php"; ?>
