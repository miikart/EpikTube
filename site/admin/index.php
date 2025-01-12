<?php
require_once __DIR__ . '/../needed/scripts.php';
$hikt['vids'] = $conn->query("SELECT COUNT(v.vid) FROM videos v INNER JOIN users u ON v.uid = u.uid WHERE v.converted = 1 AND u.termination = 0");
$hikt['vids'] = $hikt['vids']->fetchColumn();

$hikt['usr'] = $conn->query("SELECT COUNT(uid) FROM users WHERE termination = 0");
$hikt['usr'] = $hikt['usr']->fetchColumn();

$hikt['fav'] = $conn->query("SELECT COUNT(f.fid) FROM favorites f INNER JOIN users u ON f.uid = u.uid WHERE u.termination = 0");
$hikt['fav'] = $hikt['fav']->fetchColumn();

$hikt['msg'] = $conn->query("SELECT COUNT(m.pmid) FROM messages m INNER JOIN users u ON m.sender = u.uid WHERE u.termination = 0");
$hikt['msg'] = $hikt['msg']->fetchColumn();
$hikt['views'] = $conn->query("SELECT COUNT(vw.view_id) 
                               FROM views vw 
                               INNER JOIN videos v ON vw.vid = v.vid 
                               INNER JOIN users u ON v.uid = u.uid 
                               WHERE u.termination = 0");
$hikt['views'] = $hikt['views']->fetchColumn();

$hikt['cmt'] = $conn->query("SELECT COUNT(c.cid) FROM comments c INNER JOIN users u ON c.uid = u.uid WHERE u.termination = 0");
$hikt['cmt'] = $hikt['cmt']->fetchColumn();
$hikt['playlist'] = $conn->query("SELECT COUNT(p.pid) FROM playlists p INNER JOIN users u ON p.uid = u.uid WHERE p.action = 'create' AND u.termination = 0");
$hikt['playlist'] = $hikt['playlist']->fetchColumn();


$lastsign = $conn->query("SELECT * FROM users WHERE termination = 0 ORDER BY users.joined DESC LIMIT 20");
$lastonline = $conn->query("SELECT * FROM users WHERE termination = 0 ORDER BY users.last_act DESC LIMIT 20");
$lastupload = $conn->query("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.converted = 1 AND videos.privacy = 1 AND users.termination = 0) ORDER BY uploaded DESC LIMIT 8");
$_PAGE["Page"] = "/index";
require_once "../_templates/_structures/main_admin.php";
?>
