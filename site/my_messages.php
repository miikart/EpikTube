<?php
require "needed/scripts.php";

force_login();
$msgcount = $conn->prepare("SELECT * FROM messages WHERE receiver = ? ORDER BY created DESC");
$msgcount->execute([$session['uid']]);
$msgcount = $msgcount->rowCount();
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$ppv = 35;
$offs = ($page - 1) * $ppv;
$inbox = $conn->prepare("SELECT * FROM messages LEFT JOIN users ON users.uid = messages.sender WHERE receiver = ? ORDER BY created DESC LIMIT $ppv OFFSET $offs");
$inbox->execute([$session['uid']]);
$_PAGE["Page"] = "my_messages";
require_once "_templates/_structures/main.php";
?>