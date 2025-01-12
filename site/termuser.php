<?php require_once("needed/scripts.php"); 
if($session['staff'] == 1 && $_REQUEST['user'] != $session['username']) {
    $q = $conn->prepare("UPDATE users SET termination = 1 WHERE username = :username");
    $q->bindParam(":username", $_REQUEST['user']);
    $q->execute();
    session_error_index("terminated user", "success");
} else {
  session_error_index("die", "error");
}

require_once "_templates/_structures/main.php";
?>
