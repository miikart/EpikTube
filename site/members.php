<?php
require "needed/scripts.php";
$videos = $conn->prepare("SELECT * FROM users  WHERE termination = 0 ORDER BY joined DESC LIMIT 25");
$videos->execute();
$_PAGE["Page"] = "members"; 
require_once "_templates/_structures/main.php";
?>