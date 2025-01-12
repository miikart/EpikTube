<?php
require "needed/start.php";

// Make sure the user is logged in.
force_login();



$profile = $conn->prepare("SELECT * FROM users WHERE users.uid = ?");
$profile->execute([$_GET['friend_id']]);
if($profile->rowCount() == 0) {
	redirect("index.php");
} else {
	$profile = $profile->fetch(PDO::FETCH_ASSOC);
    if($profile['termination'] == 1) {
    redirect("index.php");
    }
}
if($profile['uid'] != $_SESSION['uid']) {
    $alreadyrelated = $conn->prepare("SELECT * FROM relationships WHERE sender = :member_id AND respondent = :him AND accepted = 1");
    $alreadyrelated->execute([
	":member_id" => $session['uid'],
    ":him" => $profile['uid']
    ]);
  $alreadyrelated = $alreadyrelated->rowCount();

    if($alreadyrelated > 0) {
	$friendswith = 1;
    }

    $newrelated = $conn->prepare("SELECT * FROM relationships WHERE sender = :him AND respondent = :member_id AND accepted = 1");
    $newrelated->execute([
	":member_id" => $session['uid'],
    ":him" => $profile['uid']
    ]);
$newrelated = $newrelated->rowCount();
    if($newrelated > 0) {
	$friendswith = 1;
    }  
 $sentv1 = $conn->prepare("SELECT * FROM relationships WHERE sender = :member_id AND respondent = :him AND accepted = 0");
    $sentv1->execute([
	":member_id" => $session['uid'],
    ":him" => $profile['uid']
    ]);
  $sentv1 = $sentv1->rowCount();
  if($sentv1 > 0) {
 session_error_index("You've already sent an invitation to this user.", "error");
    exit;
      
  } 
$sent = $conn->prepare("SELECT * FROM relationships WHERE sender = :him AND respondent = :member_id AND accepted = 0");
    $sent->execute([
	":member_id" => $session['uid'],
    ":him" => $profile['uid']
    ]);
$sent = $sent->rowCount();
    if($sent > 0) {
 session_error_index("You've already sent an invitation to this user.", "error");
    exit;
        
    } 
    
    
   
    if($friendswith > 0) {
    session_error_index("You're already friends with this user.", "error");
    die();
    }
    

if ($_POST['t'] == 2) { $closness = 2; } else { $closness = 1; }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['t'])) {
// Add it to favorites!
$relate = $conn->prepare("INSERT IGNORE INTO relationships (relationship, sender, respondent, status) VALUES (:relationship, :member_id, :respondent, :closness)");
$relate->execute([
    ":relationship" => generateId(),
	":member_id" => $session['uid'],
	":respondent" => $profile['uid'],
    ":closness" => $closness
]);
    session_error_index("Your request has been sent!", "success");
} } else {
      session_error_index("You can't add yourself as a friend.", "error");

}
?>
<div class="tableSubTitle">Friend Invitation</div>
<div class="tableSubTitleIntro"><p>Send an invitation if you know this user wish to share private videos with each other.</p></div>
<table width="100%" cellpadding="5" cellspacing="0" border="0">
	<form method="post">
	<input type="hidden" name="field_command" value="friend_add">
	<tbody><tr>
		<td width="200" align="right" valign="top"><span class="label">User Name:</span></td>
		<td><a href="/user/<? echo htmlspecialchars($profile['uid']); ?>"><? echo htmlspecialchars($profile['username']); ?></a><br><br></td>
	</tr>
	<tr>
		<td align="right" valign="top"><span class="label">Add As:</span></td>

		
		<td><select name="t">
			<option value="1">Friends</option>
            <option value="2">Family</option>
			</select>
            <br><div class="formFieldInfo">They will be able to see the private videos you share with these groups in addition to your public videos.</div>
            </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><br><input type="submit" value="Send Invite"></td></form>
	</tr>
</tbody></table>
<? require "needed/end.php"; ?>