<?php
require "needed/scripts.php";

if(empty($_SESSION)) {
	header("Location: index.php");
}
$msg = $conn->prepare("SELECT * FROM messages LEFT JOIN users ON users.uid = messages.sender WHERE pmid = ?");
$msg->execute([$_GET['id']]);


if($msg->rowCount() == 0) {
	header("Location: /my_messages.php");
	die();
} else {
	$msg = $msg->fetch(PDO::FETCH_ASSOC);
}
if ($msg['receiver'] != $session['uid']) {
   header("Location: my_messages.php");
}
$read_detect = $conn->prepare("UPDATE messages SET isRead = 1 WHERE pmid = ?");
	$read_detect->execute([
		trim($msg['pmid'])
	]);

$surf = $conn->prepare("
    SELECT * 
    FROM messages 
    WHERE receiver = ? 
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


$_PAGE["Page"] = "read_msg";
require_once "_templates/_structures/main.php";
?>