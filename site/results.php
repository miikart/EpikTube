<?php
require_once "needed/scripts.php";
// not proud of tis code but it works and its the best i could come up with
// yes i could have used 1 template but i suck and im too lazy and it'd be messy asf
if(isset($_GET['search_type']) && $_GET['search_type'] == "search_users") {
    $_PAGE["Page"] = "misc/userResults";
    $user = true;
    } elseif(isset($_GET['search_type']) && $_GET['search_type'] == "search_playlists") {
    $playlist = true;
    $_PAGE["Page"] = "misc/playlistResults";
    }
    $related_tags = [];
    $start_time = microtime(true);
    if (isset($_GET['related']) && !isset($playlist) && !isset($user)) {
    $res_title = "Tag";
    $res_rlted = "Related results";
    $search = trim($_GET['related']); 
    $search = str_replace("+", " ", $search); 
    $search = str_replace(" ", "|", $search); 
    $search = htmlspecialchars($search); 
    $real_search = htmlspecialchars(trim($_GET['related']));
    $_PAGE["Page"] = "results";
    } else {
    $res_title = "Search";
    $res_rlted = "Results";
    $search = trim($_GET['search']); 
    $search = str_replace("+", " ", $search); 
    $search = str_replace(" ", "|", $search); 
    $search = htmlspecialchars($search); 
    $real_search = htmlspecialchars(trim($_GET['search'])); 
    if(!isset($playlist) && !isset($user)) {
    $_PAGE["Page"] = "results";
    }
    } 
    if (empty($search)) {
    $search = null; 
    }
    if($res_title != "Tag") {

    if(isset($playlist) && $playlist == true) {
     $vidocount = $conn->prepare("
    SELECT * 
    FROM playlists 
    LEFT JOIN users ON users.uid = playlists.uid 
    WHERE 
        (playlists.title REGEXP ?)
        AND users.termination = 0  
        AND playlists.action = 'create' 
    ORDER BY (INSTR(LOWER(playlists.title), LOWER(?))) DESC 
    ");
    $vidocount->execute([$search, $search]);
    } elseif(isset($user) && $user == true) {
       $vidocount = $conn->prepare("SELECT * FROM users WHERE (username REGEXP ?) AND termination = 0 ORDER BY (INSTR(LOWER(username), LOWER(?)) > 0) DESC");
    $vidocount->execute([$search,$search]);   
    } else {
   $vidocount = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.title REGEXP ?) AND videos.privacy = 1 AND videos.converted = 1 AND users.termination = 0 AND videos.rejected = 0 ORDER BY (INSTR(LOWER(title), LOWER(?)) > 0) DESC");
    $vidocount->execute([$search, $search]);
    }
        } else {
    $vidocount = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.tags REGEXP ?) AND videos.privacy = 1 AND videos.converted = 1 AND users.termination = 0 AND videos.rejected = 0   ORDER BY (INSTR(LOWER(tags), LOWER(?)) > 0) DESC");
    $vidocount->execute([$search, $search]);
        }
    $vidocount = $vidocount->rowCount();
    $ppv = 10;
    $totalPages = ceil($vidocount / $ppv);
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    if($totalPages != 0) {
    if($page > $totalPages) {
    $page = $totalPages;
    }
    } else {
    $totalPages = 1;
    }
    $offs = ($page - 1) * $ppv;
   
    if(!isset($user) && !isset($playlist)) {
    if($res_title != "Tag") {
    $relatedt = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.title REGEXP ?) AND videos.privacy = 1 AND videos.converted = 1 AND users.termination = 0 AND videos.rejected = 0 ORDER BY (INSTR(LOWER(title), LOWER(?)) > 0) DESC");
    $relatedt->execute([$search, $search]);
    } else {
    $relatedt = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.tags REGEXP ?) AND videos.privacy = 1 AND videos.converted = 1 AND users.termination = 0 AND videos.rejected = 0   ORDER BY (INSTR(LOWER(tags), LOWER(?)) > 0) DESC");
    $relatedt->execute([$search, $search]);    
    }
    foreach($relatedt as $newtag) {
    $related_tags = array_merge($related_tags, explode(" ", $newtag['tags']));
    }
    } 
    if($res_title != "Tag") {
    if(isset($playlist) && $playlist == true) {
    $videos = $conn->prepare("
    SELECT * 
    FROM playlists 
    LEFT JOIN users ON users.uid = playlists.uid 
    WHERE 
        (playlists.title REGEXP ?)
        AND users.termination = 0  
        AND playlists.action = 'create' 
    ORDER BY (INSTR(LOWER(playlists.title), LOWER(?))) DESC 
    LIMIT {$ppv} OFFSET {$offs}
    ");
    $videos->execute([$search, $search]);      
    } elseif(isset($user) && $user == true) {
    $videos = $conn->prepare("SELECT * FROM users WHERE (username REGEXP ?) AND termination = 0 ORDER BY (INSTR(LOWER(username), LOWER(?)) > 0) DESC LIMIT $ppv OFFSET $offs");
    $videos->execute([$search,$search]);   
    } else {
    $videos = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.title REGEXP ?) AND videos.privacy = 1 AND videos.converted = 1 AND users.termination = 0 AND videos.rejected = 0 ORDER BY (INSTR(LOWER(title), LOWER(?)) > 0) DESC LIMIT $ppv OFFSET $offs");
    $videos->execute([$search, $search]);
    }
    } else { 
    $videos = $conn->prepare("SELECT * FROM videos LEFT JOIN users ON users.uid = videos.uid WHERE (videos.tags REGEXP ?) AND videos.privacy = 1 AND videos.converted = 1 AND users.termination = 0 AND videos.rejected = 0   ORDER BY (INSTR(LOWER(tags), LOWER(?)) > 0) DESC LIMIT $ppv OFFSET $offs");
    $videos->execute([$search, $search]);
    }

require_once "_templates/_structures/main.php"; 
?>

