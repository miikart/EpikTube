<?php
require "needed/scripts.php";
force_login();
$friends = $conn->prepare("SELECT * FROM relationships LEFT JOIN users ON users.uid = relationships.sender WHERE respondent = ? AND accepted = 0 AND users.termination = 0 ORDER BY sent DESC LIMIT 30");
$friends->execute([$session['uid']]);
if(isset($_GET['user'])) {
    $acceptant = $conn->prepare("SELECT uid FROM users WHERE users.username = ?");
    $acceptant->execute([$_GET['user']]);
    $acceptant = $acceptant->fetch();
    $stmt = $conn->prepare('UPDATE relationships SET accepted = 1 WHERE respondent = :respondent AND sender = :sender');
	$stmt->execute([
        ':respondent' => $session['uid'], ':sender' => $acceptant['uid']
        ]);
$friends = $conn->prepare("SELECT * FROM relationships LEFT JOIN users ON users.uid = relationships.sender WHERE respondent = ? AND accepted = 0 AND users.termination = 0 ORDER BY sent DESC LIMIT 30");
$friends->execute([$session['uid']]);
    alert("Accepted the friend request.");
}
?>

<?php
$_PAGE["Page"] = "my_friends_accept";
require_once "_templates/_structures/main.php";
?>