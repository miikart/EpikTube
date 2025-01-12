<?php
require_once __DIR__ . '/../needed/scripts.php';

if(!isset($session['staff']) || $session['staff'] != 1) {
	redirect("Location: /index.php"); 
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logo'])) {
    $logo = $_POST['logo'];

    
    if ($logo !== 'placeholder_logo') {
   
$stmt = $conn->prepare("UPDATE `settings` SET `logo` = :logo WHERE `settings`.`id` = 1; '");
$stmt->bindParam(':logo', $logo, PDO::PARAM_STR);
$stmt->execute();
$done = true;
        if ($done) {
         header("Location: /index.php");
         alert("Logo Changed.", "success");
         exit;
        } else {
            echo "GRAAAAAAAAAAA " . $conn->error;
        }
    } else {
        echo "fart.";
    }
}
?>
<?php
$_PAGE["Page"] = "/logo";
require_once "../_templates/_structures/main_admin.php";
?>
