<?php  
if(!empty(invokethConfig("notice"))) { alert("Notice: ".invokethConfig("notice")); } 
if (isset($_COOKIE['downtiefuckingsucks']) && invokethConfig("maintenance") == 1){
echo alert("The website is currently in maintenance.", "error", false);
}
if (isset($_GET['etsession'])) {
require_once "needed/phpickle/phpickle.php";
try {
$base64urltobase64 = strtr($_GET['etsession'], '-_', '+/');
$base64string = base64_decode($base64urltobase64);
if ($base64string === false) {
throw new Exception;
}
$string = phpickle::loads($base64string);
if (is_array($string['messages']) && implode(" ", $string['messages']) != NULL) {
$type = "success";
$message = $string['messages'][0]; 
} elseif (is_array($string['errors']) && implode(" ", $string['errors']) != NULL) {
$type = "error";
$message = $string['errors'][0]; 
}
alert(htmlspecialchars($message), htmlspecialchars($type));
} catch (Exception $e) {
echo alert("Something went wrong.", "error", false);
}
}
if (isset($_SESSION["alerts"]) && !empty($_SESSION["alerts"])) { 
foreach ($_SESSION["alerts"] as $alert) { 
echo alert($alert["message"], $alert["type"]); 
} 
unset($_SESSION["alerts"]); 
}
?>