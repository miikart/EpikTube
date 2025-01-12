<?php 
require_once("needed/scripts.php");
if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(empty(trim($_POST['contact_email']))) {
		$contact_error = "Please enter an email.";
	} elseif(!filter_var(trim($_POST['contact_email']), FILTER_VALIDATE_EMAIL)) {
		$contact_error = "Please enter a valid email.";
    }
    if($_POST['contact_subject'] > 8 || $_POST['contact_subject'] < 1) {$contact_error = "What is this about?"; }
    $word_count = unique_word_count($_POST['contact_message']);
    if ($word_count < 8) {
    $contact_error = "Please provide enough details so we can properly process your e-mail";
    }
    if ($word_count > 620) {
    $contact_error = "Too much words.";
    }
    $cooldown = $conn->prepare(
			"SELECT * FROM tickets
			WHERE sender = ? AND submitted > DATE_SUB(NOW(), INTERVAL 3 HOUR)
			ORDER BY submitted DESC"
		);
        $cooldown->execute([$_POST['contact_email']]);
		if($cooldown->rowCount() > 2) {
		$contact_error = "Are you sure you meant to send that 2 times?";
		}
    if(!empty($contact_error)){
    alert($contact_error, "error");
    }
    
    if(empty($contact_error)){
    $sql = "INSERT IGNORE INTO tickets (sender, subject, message) VALUES (:email, :subject, :message)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $_POST['contact_email']);
    $stmt->bindParam(":subject", $_POST['contact_subject']);
    $stmt->bindParam(":message", encrypt($_POST['contact_message']));
    try {
    $stmt->execute();
    session_error_index("Thank you for your message.", "success");
    } catch (PDOException $e) {
    alert("Was unable to contact.", "error");
    }
    }

    }
$_PAGE["Page"] = "contact";
require_once("_templates/_structures/main.php") ?>