<?php
require_once __DIR__ . '/../needed/scripts.php';

if(!isset($session['staff']) || $session['staff'] != 1) {
	redirect("Location: /index.php"); 
    exit;
}
$lastupload = $conn->query("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (users.termination = 0) ORDER BY uploaded DESC LIMIT 20")->fetchAll();
force_login(); 

$flagged = $conn->query("SELECT r.*, v.*, u1.*
FROM reports r
JOIN videos v ON v.vid = r.what
JOIN users u1 ON u1.uid = v.uid
WHERE v.converted = 1
AND u1.termination = 0;")

?>


<?php
$_PAGE["Page"] = "/uploads";
require_once "../_templates/_structures/main_admin.php";
?>
