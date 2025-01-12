<?php require_once "needed/start.php"; 
if(isset($_SESSION['uid']) && $session['staff'] == 1) {
if(isset($_REQUEST['restrict'])) {
$thing = $conn->prepare("UPDATE videos SET agerestrict = 1 WHERE vid = :id");
$thing->bindParam(":id", $_GET['v']);
$thing->execute();
} else {
 $thing = $conn->prepare("UPDATE videos SET agerestrict = 0 WHERE vid = :id");
$thing->bindParam(":id", $_GET['v']);
$thing->execute();   
}
redirect("watch?v=". $_GET['v']);   
}
?>
