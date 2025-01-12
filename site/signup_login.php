<?php
if (isset($_REQUEST['next'])) {
    $next = htmlspecialchars($_REQUEST['next']);
    header("Location: login.php?next=" . urlencode($next));
} else {
    header("Location: login.php");
}
exit;
?>
