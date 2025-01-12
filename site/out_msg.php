<?php
require "needed/scripts.php";

force_login();

$msg = $conn->prepare("SELECT * FROM messages LEFT JOIN users ON users.uid = messages.receiver WHERE pmid = ?");
$msg->execute([$_GET['id']]);

if($msg->rowCount() == 0) {
	header("Location: /my_messages.php");
	die();
} else {
	$msg = $msg->fetch(PDO::FETCH_ASSOC);
}
if ($msg['sender'] != $session['uid']) {
    header("Location: outbox.php");
}
	$surf = $conn->prepare("
    SELECT * 
    FROM messages 
    WHERE sender = ? 
    ORDER BY created DESC 
    LIMIT 1000
");

$surf->execute([$session['uid']]);
$surf = $surf->fetchAll(PDO::FETCH_ASSOC);
 $schedulla = array_column($surf, 'pmid');
$schedex = array_search($_GET['id'], $schedulla);
$play_schedule = [];
$read_schedule['next'] = ($schedex > 0) ? $schedulla[$schedex - 1] : null;
$read_schedule['before'] = ($schedex < count($schedulla) - 1) ? $schedulla[$schedex + 1] : null;
$_PAGE["Page"] = "out_msg";
require_once "_templates/_structures/main.php";
?>