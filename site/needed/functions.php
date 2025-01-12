<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/vendor/autoload.php");
ob_start();
// has to be hardcoded
ini_set('session.cookie_path', '/');
ini_set('session.cookie_domain', '.' . $_SERVER['HTTP_HOST']);
session_set_cookie_params(3600 * 24 * 7); 
session_start(); 
$config = [
    'host' => 'youshouldknow',
    'email' => 'youshouldknow',
    'epassword' => 'youshouldknow',
    'emport' => 'youshouldknow',
    'ffmpeg' => 'ffmpeg',
    'ffprobe' => 'ffprobe',
    'aeskey' => 'youshouldknow'
];
function decrypt($encryptedData) {
    global $config;
    $encryptedData = base64_decode($encryptedData);
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($encryptedData, 0, $ivSize);
    $encrypted = substr($encryptedData, $ivSize);
    $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $config["aeskey"], OPENSSL_RAW_DATA, $iv);
    if ($decrypted === false) {
        $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', "", OPENSSL_RAW_DATA, $iv);
        if ($decrypted === false) {
            return 'couldnt decrypt the message please contact copy.floppy.';
        }
    }
    $decrypted = htmlspecialchars($decrypted);
    $decrypted = nl2br($decrypted);
    return $decrypted;
}
function encrypt($data) {
     global $config;
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($ivSize);
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $config["aeskey"], OPENSSL_RAW_DATA, $iv);
    $encryptedData = base64_encode($iv . $encrypted);
    return $encryptedData;
}
register_shutdown_function(function () {
    global $config;
    $theerror = error_get_last();
    if ($theerror && in_array($theerror['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        http_response_code(500);
        $the500error = encrypt($theerror['message'] . " in file " . $theerror['file'] . " on line " . $theerror['line']);
        $the500errorsplit = chunk_split($the500error, 64, "\n");
        exit(require_once $_SERVER["DOCUMENT_ROOT"] . "/_templates/_errors/500.php");
    }
});
function session_error_index($message, $type = "error", $location = "index") {
	if ($type == "success") {
	$picklestart = hex2bin("80027d710128550c6572726f725f6669656c64737102635f5f6275696c74696e5f5f0a7365740a71035d8552710455066572726f727371055d710655086d6573736167657371075d710855");
	$pickleend = hex2bin("710961752e");
	} elseif ($type == "error") {
	$picklestart = hex2bin("80027d710128550c6572726f725f6669656c64737102635f5f6275696c74696e5f5f0a7365740a71035d8552710455066572726f727371055d710655");
	$pickleend = hex2bin("71076155086d6573736167657371085d7109752e");
	}
	$picklenum = hex2bin(dec2hex(strlen($message)));
    $error_base64 = strtr(base64_encode($picklestart.$picklenum.$message.$pickleend), '+/', '-_');
    redirect("/index?etsession=".$error_base64);
}
if(isset($_SESSION['uid'])) {
    $session = $conn->prepare("SELECT * FROM users WHERE uid = :id");
    $session->bindParam(":id", $_SESSION['uid']);
    $session->execute();
    if(!$session->rowCount()) {
        session_start();
        session_destroy(); 
        session_error_index("Your account has been permanently disabled.");
    } else {
        $session = $session->fetch(PDO::FETCH_ASSOC);
        $lastlogin = $conn->prepare("UPDATE users SET last_act = CURRENT_TIMESTAMP WHERE uid = ?");
        $lastlogin->execute([$session['uid']]);
        if ($session['termination'] == 1) {
        session_start();
        session_destroy(); 
        session_error_index("Your account has been permanently disabled.", "error");
        }
 
$inboxcount = $conn->prepare("SELECT * FROM messages WHERE receiver = ? AND isRead = 0 ORDER BY created DESC");
$inboxcount->execute([$session['uid']]);
$inboxcount = $inboxcount->rowCount();
        
    }
} else {
    $session = null;
}

$getbannedbozo = $conn->prepare("SELECT ip FROM ip_bans WHERE ip = :ip");
$getbannedbozo->bindParam(':ip', $_SERVER['REMOTE_ADDR']);
$getbannedbozo->execute();
if($getbannedbozo->rowCount() != 0) {
exit(header("HTTP/1.1 418 I'm a teapot"));
}
try {
$websitestuff = $conn->prepare('SELECT * FROM settings');
$websitestuff->execute();
} catch (Exception $e) {    
die("This instance is missing the \"settings\" table. so it cannot continue.");
}
if($websitestuff->rowCount() == 0) {
exit("The \"settings\" table exists but there aren't any settings defined.");
} else {
$websitestuff = $websitestuff->fetch(PDO::FETCH_ASSOC);
}
function invokethConfig($where) {
    global $websitestuff;
    if (array_key_exists($where, $websitestuff)) {
        return htmlspecialchars($websitestuff[$where]);
    } else {
        return null;
    }
}
try {
$_VCHANE = $conn->query("SELECT * from channels WHERE id != 22 ORDER BY orderid ASC")->fetchAll(); 
} catch (Exception $e) {    
exit("This instance is missing the \"channels\" table. so it cannot continue.");
}
function array_has_dupes($array) {
   return count($array) !== count(array_unique($array));
}
try {
$channelgroup = $conn->query("SELECT * from channels ORDER BY id ASC")->fetchAll(); 
} catch (Exception $e) {    
exit("This instance is missing the \"channels\" table. so groups wouldnt function.");
}
function getStillUrl($vid, $still_id = 2) {
    if($still_id == 2) {
    $url = '//www.epiktube.xyz/get_still?video_id='.$vid;
    } else {
    $url = '//www.epiktube.xyz/get_still?video_id='.$vid.'&still_id='.$still_id;
    }
    return $url;
}
function getgroupcountchannel($channel) {
    global $conn;
$channel = $conn->query("SELECT * FROM `groups` g 
                         JOIN users u ON g.uid = u.uid
                         WHERE (g.ch1 = '$channel' OR g.ch2 = '$channel' OR g.ch3 = '$channel') 
                         AND u.termination = 0 
                         ")->rowCount();
return number_format($channel);
}
function getgroupmembers($whatgroup) {
    global $conn;
$channel = $conn->query("SELECT * FROM group_members g 
                         JOIN users u ON g.uid = u.uid
                         WHERE gid = '$whatgroup'
                         AND u.termination = 0 
                         ")->rowCount();
return number_format($channel);
}
function alert($alerterr, $type = "success", $normal = true, $echo = false) {
    $alerterr = str_replace(PHP_EOL, '<br><br>', $alerterr);
    if($normal) {
    if (!isset($_SESSION["alerts"])) {
        $_SESSION["alerts"] = [];
    }
    $_SESSION["alerts"][] = [
        "type" => $type,
        "message" => $alerterr
    ];
    }
  if ($type == "success") {
    if (!$echo) {
        return '<table width="100%" align="center" bgcolor="#07872d" cellpadding="6" cellspacing="3" border="0">
            <tbody><tr>
                <td align="center" bgcolor="#FFFFFF"><span class="success">' . $alerterr . '</span></td>
            </tr>
        </tbody></table></br>';
    } else {
        echo '<table width="100%" align="center" bgcolor="#346e45" cellpadding="6" cellspacing="3" border="0">
            <tbody><tr>
                <td align="center" bgcolor="#FFFFFF"><span class="success">' . $alerterr . '</span></td>
            </tr>
        </tbody></table></br>';
    }
} else if ($type == "error") {
    if (!$echo) {
        return '<table width="100%" align="center" bgcolor="#FF0000" cellpadding="6" cellspacing="3" border="0">
            <tbody><tr>
                <td align="center" bgcolor="#FFFFFF"><span class="error">' . $alerterr . '</span></td>
            </tr>
        </tbody></table></br>';
    }
    } else if ($type == "info") {
    if (!$echo) {
        return '<table width="100%" align="center" bgcolor="#666666" cellpadding="6" cellspacing="3" border="0">
            <tbody><tr>
                <td align="center" bgcolor="#FFFFFF"><span class="success">' . $alerterr . '</span></td>
            </tr>
        </tbody></table></br>';
    } else {
        echo '<table width="100%" align="center" bgcolor="#FF0000" cellpadding="6" cellspacing="3" border="0">
            <tbody><tr>
                <td align="center" bgcolor="#FFFFFF"><span class="error">' . $alerterr . '</span></td>
            </tr>
        </tbody></table></br>';
    }
} else if ($type == "process") {
    if (!$echo) {
        return '<table width="100%" align="center" bgcolor="#d86c2f" cellpadding="6" cellspacing="3" border="0">
            <tbody><tr>
                <td align="center" bgcolor="#FFFFFF"><span class="error" style="color: #d86c2f;">' . $alerterr . '</span></td>
            </tr>
        </tbody></table></br>';
    } else {
        echo '<table width="100%" align="center" bgcolor="#d86c2f" cellpadding="6" cellspacing="3" border="0">
            <tbody><tr>
                <td align="center" bgcolor="#FFFFFF"><span class="error" style="color: #d86c2f;">' . $alerterr . '</span></td>
            </tr>
        </tbody></table></br>';
    }
} elseif($type == "profileerr") {
echo '<table width="875" cellspacing="3" cellpadding="6" border="0" bgcolor="#666666" align="center">
	<tbody><tr>
		<td bgcolor="#FFFFFF" align="center">
			<p class="highlight">
			' . $alerterr . '	
			</p>
		</td>
	</tr>
</tbody></table>';
}

}

function unique_word_count($string) {
    $string = explode(' ', strtolower($string));
    $words = array_unique($string);
    return count($words);
}

function retroDate($date, $format = "F j, Y") {
  if ($date === "now") {
    $dateTime = new DateTime();
    } else {
    $dateTime = new DateTime($date);
    }
  return $dateTime->format($format);
} 

function pluralize($number, $singular, $plural) {
    if ($number === 1) {
        return $number . ' ' . $singular;
    } else {
        return $number . ' ' . $plural;
    }
}
function AutoLinkUrls($str,$popup = FALSE){
    if (preg_match_all("#(^|\s|\()((http(s?)://)|(www\.))(\w+[^\s\)\<]+)#i", $str, $matches)){
        $pop = ($popup == TRUE) ? " target=\"_blank\" " : "";
        for ($i = 0; $i < count($matches['0']); $i++){
            $period = '';
            if (preg_match("|\.$|", $matches['6'][$i])){
                $period = '.';
                $matches['6'][$i] = substr($matches['6'][$i], 0, -1);
            }
            $str = str_replace($matches['0'][$i],
                    $matches['1'][$i].'<a href="http'.
                    $matches['4'][$i].'://'.
                    $matches['5'][$i].
                    $matches['6'][$i].'"'.$pop.'>http'.
                    $matches['4'][$i].'://'.
                    $matches['5'][$i].
                    $matches['6'][$i].'</a>'.
                    $period, $str);
        }//end for
    }//end if
    return $str;
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}
function error() {
    header("Location: /error.html");
    exit();
}

function force_login() {
if($_SESSION['uid'] == NULL) {
header("Location: login?next=". $_SERVER['REQUEST_URI']);
exit;
}
}
function getvidfavcount($what) {
global $conn;
  $thefavoritecount = $conn->prepare(
	"SELECT * FROM favorites
	LEFT JOIN videos ON favorites.vid = videos.vid
	LEFT JOIN users ON users.uid = videos.uid
	WHERE favorites.vid = ? AND videos.converted = 1
	ORDER BY favorites.fid DESC"
);
$thefavoritecount->execute([$what]);
$thefavoritecount = $thefavoritecount->rowCount();
return number_format($thefavoritecount);
}

function videosinplaylist($playlsit) {
global $conn;
$aaa = $conn->prepare(
	"SELECT v.*, u.* 
    FROM videos v
    JOIN playlists p ON v.vid = p.vid
    JOIN users u ON v.uid = u.uid  
    WHERE p.pid = ?
      AND v.converted = 1
      AND u.termination = 0
    AND p.action = 'add'
ORDER BY p.created_at DESC
"
);
$aaa->execute([$playlsit]);
$aaa = $aaa->rowCount();
return number_format($aaa);
}
function getfavoritecount($who) {
 global $conn;
  $thefavoritecount = $conn->prepare(
	"SELECT * FROM favorites
	LEFT JOIN videos ON favorites.vid = videos.vid
	LEFT JOIN users ON users.uid = videos.uid
	WHERE favorites.uid = ? AND videos.converted = 1 AND users.termination = 0
	ORDER BY favorites.fid DESC"
);
$thefavoritecount->execute([$who]);
$thefavoritecount = $thefavoritecount->rowCount();
return number_format($thefavoritecount);
}
function getfriendcount($who) {
  global $conn;
  $dafriendcount = $conn->prepare(
	"SELECT DISTINCT users.uid FROM relationships 
    LEFT JOIN users ON users.uid = CASE 
        WHEN relationships.sender = ? THEN relationships.respondent 
        WHEN relationships.respondent = ? THEN relationships.sender 
    END
    WHERE (relationships.sender = ? OR relationships.respondent = ?) 
    AND relationships.accepted = 1 AND users.termination = 0
    ORDER BY relationships.sent DESC"
);
$dafriendcount->execute([$who,$who,$who,$who]);
$dafriendcount = $dafriendcount->rowCount();
return number_format($dafriendcount);
}
function getpublicvideos($who) {
 global $conn;
  $dapubvidcount = $conn->prepare(
	"SELECT * FROM videos WHERE uid = ? AND converted = 1 AND privacy = 1"
);
$dapubvidcount->execute([$who]);
$dapubvidcount = $dapubvidcount->rowCount();
return number_format($dapubvidcount);
}
function getprivatevideos($who) {
global $conn;
  $daprivvidcount = $conn->prepare(
	"SELECT * FROM videos WHERE uid = ? AND converted = 1 AND privacy = 0"
);
$daprivvidcount->execute([$who]);
$daprivvidcount = $daprivvidcount->rowCount();
return number_format($daprivvidcount);
}

function getlatestVideo($who) {
  global $conn;
   $theuser = $conn->prepare("SELECT * FROM users WHERE uid = :id AND termination = 0");
   $theuser->bindParam(':id', $who, PDO::PARAM_STR);
   $theuser->execute();
   $theuser = $theuser->fetch(PDO::FETCH_OBJ);
   if($theuser->profilePictureSetting == 0)  {
    $video = $conn->prepare(
        "SELECT * FROM videos
        LEFT JOIN users ON users.uid = videos.uid
        WHERE videos.uid = ? AND videos.converted = 1 AND videos.privacy = 1
        GROUP BY videos.vid
        ORDER BY videos.uploaded DESC LIMIT 1"
    );
    $video->execute([$who]);    
    $video = $video->fetch(PDO::FETCH_OBJ);

    if ($video) {
        return "/get_still?video_id=" . $video->vid;    
    } else {
        return "/img/no_videos_140.jpg";    
    }
} else {
  $video = $conn->prepare(
      "SELECT users.profilePicture 
     FROM users
     JOIN videos ON users.uid = videos.uid
     WHERE users.uid = ? 
       AND videos.vid = users.profilePicture
       AND videos.uid = users.uid
       AND videos.converted = 1
     LIMIT 1"
);
$video->execute([$who]);    
$video = $video->fetch(PDO::FETCH_OBJ);
if($video->profilePicture != "necl4z3-Bto" && $video->uid != "XVJ20P_zxzE") {
    if($video) {
    return "/get_still?video_id=" . $video->profilePicture; 
    } else {
    return "/img/no_videos_140.jpg";       
    }
    } else {
    return "/get_still?video_id=necl4z3-Bto&still_id=3";     
    }
}
       
}
function getcommentcount($who) {
global $conn;
$replys = $conn->prepare("SELECT * FROM comments LEFT JOIN users ON users.uid = comments.uid WHERE vidon = :id AND users.termination = 0 AND is_reply = 0 ORDER BY post_date DESC");
$replys->bindParam(':id', $who);
$replys->execute();
$replyc = $replys->rowCount();
return number_format($replyc);
}
function getlinkedvideocount($what, $whatrefeer) {
global $conn;
    $wharitgot = $conn->prepare("SELECT referer FROM views WHERE vid = :id AND referer = :referer ORDER BY viewed DESC");
					$wharitgot->bindParam(':id', $what);
	                    $wharitgot->bindParam(':referer', $whatrefeer);
						$wharitgot->execute();
				$wharitgot = $wharitgot->rowCount();
return number_format($wharitgot);
    
}
function whos_online($limit = 4, $padding = true) { 
global $conn;
 $lastonline = $conn->query("SELECT * FROM users WHERE termination = 0 AND em_confirmation = 'true' AND last_act >= NOW() - INTERVAL 1 DAY ORDER BY last_act DESC LIMIT $limit;");

   
   ?>

			<div <?php if($padding) { ?>style="padding-top: 10px;"<?php } ?>>
						<table class="roundedTable" width="180" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#eeeedd">
			<tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td width="170">
					<div style="font-size: 14px; font-weight: bold; margin-bottom: 8px; color:#666633;">
						Last <?php echo $limit ?> users online...
					</div>
									<?php foreach($lastonline as $user) { 
          
             $q = $conn->query("SELECT * FROM videos WHERE uid = '" . $user['uid'] . "' AND privacy = 1 AND converted = 1");

  $qq = $q->rowCount();                 
                    /*$user['vids'] = $conn->prepare("SELECT COUNT(vid) FROM videos WHERE uid = ? AND converted = 1");
				    $user['vids']->execute([$user['uid']]);
				    $user['vids'] = $user['vids']->fetchColumn();

                    $user['favs'] = $conn->prepare("SELECT COUNT(fid) FROM favorites WHERE uid = ?");
				    $user['favs']->execute([$user['uid']]);
				    $user['favs'] = $user['favs']->fetchColumn();

                    $user['friends'] = $conn->prepare("SELECT COUNT(relationship) FROM relationships WHERE (sender = ? OR respondent = ?) AND accepted = 1");
				    $user['friends']->execute([$user['uid'], $user['uid']]);
				    $user['friends'] = $user['friends']->fetchColumn();*/
                    ?>
				
					<div style="font-size: 12px; font-weight: bold; margin-bottom: 5px;"><a href="profile?user=<?php echo htmlspecialchars($user['username']); ?>" title="<?= htmlspecialchars($user['username']) ?>"><?php echo htmlspecialchars($user['username']); ?></a></div>

					<div style="font-size: 12px; margin-bottom: 8px; padding-bottom: 10px; border-bottom: 1px dashed #CCCC66;"><a href="profile_videos?user=<?php echo htmlspecialchars($user['username']); ?>"><img src="img/icon_vid.gif" alt="Videos" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a> (<a href="profile_videos?user=<?php echo htmlspecialchars($user['username']); ?>"><?php echo getpublicvideos($user['uid']) ?></a>)
					 | <a href="profile_favorites?user=<?php echo htmlspecialchars($user['username']); ?>"><img src="img/icon_fav.gif" alt="Favorites" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a> (<a href="profile_favorites?user=<?php echo htmlspecialchars($user['username']); ?>"><?php echo getfavoritecount($user['uid']) ?></a>) | <a href="profile_friends?user=<?php echo htmlspecialchars($user['username']); ?>"><img src="img/icon_friends.gif" alt="Friends" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a> (<a href="profile_friends?user=<?php echo htmlspecialchars($user['username']); ?>"><?php echo getfriendcount($user['uid']) ?></a>)</div>
					  </div><? } ?>

				
				<div style="font-weight: bold; margin-bottom: 5px;">Icon Key:</div>
				<div style="margin-bottom: 4px;"><img src="/img/icon_vid.gif" alt="Videos" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> - Videos</div>
				<div style="margin-bottom: 4px;"><img src="/img/icon_fav.gif" alt="Favorites" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> - Favorites</div>
								<img src="/img/icon_friends.gif" alt="Friends" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> - Friends
				

				</td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</table>

			</div>
			
		</td>
	</tr>
</table>


        <?php
}
function shorten($text, $number, $symbols = '...') {
    $text = $text;
    $new = (strlen($text) > $number) ? substr($text, 0, $number) . $symbols : $text;
    return htmlspecialchars($new);
}

function timeAgo($date) { 
  $dateObj = new DateTime($date);

  $now = new DateTime();
  $diff = $now->getTimestamp() - $dateObj->getTimestamp();

  $periods = array(
    "year",
    "month",
    "week",
    "day",
    "hour",
    "minute",
    "second"
  );
  $lengths = array(
    31556926,
    2629743,
    604800,
    86400,
    3600,
    60,
    1
  );

  $difference = "";
  

  for ($i = 0; $i < count($lengths); $i++) {
    if ($diff >= $lengths[$i]) {
      $number = floor($diff / $lengths[$i]);
      $difference .= $number . " " . $periods[$i];
      
      if ($number != 1) {
        $difference .= "s";
      }
      $difference .= " ago";
      break;
    }
  }

  return $difference;
} 


function base64url_encode($data)
{
  // First of all you should encode $data to Base64 string
  $b64 = base64_encode($data);

  // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
  if ($b64 === false) {
    return false;
  }

  // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
  $url = strtr($b64, '+/', '-_');

  // Remove padding character from the end of line and return the Base64URL result
  return rtrim($url, '=');
}

/**
 * Decode data from Base64URL
 * @param string $data
 * @param boolean $strict
 * @return boolean|string
 */
function base64url_decode($data, $strict = false)
{
  // Convert Base64URL to Base64 by replacing “-” with “+” and “_” with “/”
  $b64 = strtr($data, '-_', '+/');

  // Decode Base64 string and return the original data
  return base64_decode($b64, $strict);
}

function generateId($length = 11) {
    global $conn;
    // Takes 8 (or whatever equivalent for the length entered) randomized bytes and then encodes it in base64url
    // Usage: Most IDs, see generateId2
    $needed_bytes = floor($length * 0.75);
    $needed_bytes = random_bytes($needed_bytes);
    $needed_bytes = base64url_encode($needed_bytes);
    $video = $conn->prepare("SELECT vid FROM videos WHERE vid = ?");
    $video->execute([$needed_bytes]);
    if($video->rowCount() > 0) {
        $IdGenned = true;
    } else {
      $IdGenned = false;  
    }
    $video = $conn->prepare("SELECT uid FROM users WHERE uid = ?");
    $video->execute([$needed_bytes]);
    if($video->rowCount() > 0) {
        $IdGenned = true;
    } else {
        $IdGenned = false;  
    }
    if($IdGenned != true) {
    return $needed_bytes;
    } else {
    generateId($length);
    }
}

function getsubcount($who) {
  global $conn;
  $subs = $conn->prepare(" SELECT u.*
    FROM subscriptions s
    JOIN users u ON u.uid = s.subscriber
    WHERE s.subscribed_to = ? 
      AND s.subscribed_type = 'user_uploads'
      AND u.termination = 0 ORDER BY subscribed DESC");
      $subs->execute([$who]);  
$subs = $subs->rowCount();
return number_format($subs);
    
}
function generateId2($length = 11) {
    // Hex representation of a decoded generateId
    // Usage: Email confirmation URLs, playlist IDs, not as used as generateId
	$funny_ids = base64url_decode(generateId($length));
    return strtoupper(bin2hex($funny_ids));
}



 // You'd think this took a good while... It didn't. I can finally make an accurate country dropdown without any hassle thanks to this: http://code-cocktail.in/tools/convert-selectbox-to-array/#
      $_COUNTRIES = [
  NULL => '---',
  'US' => 'United States',
  'AF' => 'Afghanistan',
  'AL' => 'Albania',
  'DZ' => 'Algeria',
  'AS' => 'American Samoa',
  'AD' => 'Andorra',
  'AO' => 'Angola',
  'AI' => 'Anguilla',
  'AG' => 'Antigua and Barbuda',
  'AR' => 'Argentina',
  'AM' => 'Armenia',
  'AW' => 'Aruba',
  'AU' => 'Australia',
  'AT' => 'Austria',
  'AZ' => 'Azerbaijan',
  'BS' => 'Bahamas',
  'BH' => 'Bahrain',
  'BD' => 'Bangladesh',
  'BB' => 'Barbados',
  'BY' => 'Belarus',
  'BE' => 'Belgium',
  'BZ' => 'Belize',
  'BJ' => 'Benin',
  'BM' => 'Bermuda',
  'BT' => 'Bhutan',
  'BO' => 'Bolivia',
  'BA' => 'Bosnia and Herzegovina',
  'BW' => 'Botswana',
  'BV' => 'Bouvet Island',
  'BR' => 'Brazil',
  'IO' => 'British Indian Ocean Territory',
  'VG' => 'British Virgin Islands',
  'BN' => 'Brunei',
  'BG' => 'Bulgaria',
  'BF' => 'Burkina Faso',
  'BI' => 'Burundi',
  'KH' => 'Cambodia',
  'CM' => 'Cameroon',
  'CA' => 'Canada',
  'CV' => 'Cape Verde',
  'KY' => 'Cayman Islands',
  'CF' => 'Central African Republic',
  'TD' => 'Chad',
  'CL' => 'Chile',
  'CN' => 'China',
  'CX' => 'Christmas Island',
  'CC' => 'Cocos (Keeling) Islands',
  'CO' => 'Colombia',
  'KM' => 'Comoros',
  'CG' => 'Congo',
  'CD' => 'Congo - Democratic Republic of',
  'CK' => 'Cook Islands',
  'CR' => 'Costa Rica',
  'CI' => 'Cote d\'Ivoire',
  'HR' => 'Croatia',
  'CU' => 'Cuba',
  'CY' => 'Cyprus',
  'CZ' => 'Czech Republic',
  'DK' => 'Denmark',
  'DJ' => 'Djibouti',
  'DM' => 'Dominica',
  'DO' => 'Dominican Republic',
  'TP' => 'East Timor',
  'EC' => 'Ecuador',
  'EG' => 'Egypt',
  'SV' => 'El Salvador',
  'GQ' => 'Equitorial Guinea',
  'ER' => 'Eritrea',
  'EE' => 'Estonia',
  'ET' => 'Ethiopia',
  'FK' => 'Falkland Islands (Islas Malvinas)',
  'FO' => 'Faroe Islands',
  'FJ' => 'Fiji',
  'FI' => 'Finland',
  'FR' => 'France',
  'GF' => 'French Guyana',
  'PF' => 'French Polynesia',
  'TF' => 'French Southern and Antarctic Lands',
  'GA' => 'Gabon',
  'GM' => 'Gambia',
  'GZ' => 'Gaza Strip',
  'GE' => 'Georgia',
  'DE' => 'Germany',
  'GH' => 'Ghana',
  'GI' => 'Gibraltar',
  'GR' => 'Greece',
  'GL' => 'Greenland',
  'GD' => 'Grenada',
  'GP' => 'Guadeloupe',
  'GU' => 'Guam',
  'GT' => 'Guatemala',
  'GN' => 'Guinea',
  'GW' => 'Guinea-Bissau',
  'GY' => 'Guyana',
  'HT' => 'Haiti',
  'HM' => 'Heard Island and McDonald Islands',
  'VA' => 'Holy See (Vatican City)',
  'HN' => 'Honduras',
  'HK' => 'Hong Kong',
  'HU' => 'Hungary',
  'IS' => 'Iceland',
  'IN' => 'India',
  'ID' => 'Indonesia',
  'IR' => 'Iran',
  'IQ' => 'Iraq',
  'IE' => 'Ireland',
  'IL' => 'Israel',
  'IT' => 'Italy',
  'JM' => 'Jamaica',
  'JP' => 'Japan',
  'JO' => 'Jordan',
  'KZ' => 'Kazakhstan',
  'KE' => 'Kenya',
  'KI' => 'Kiribati',
  'KW' => 'Kuwait',
  'KG' => 'Kyrgyzstan',
  'LA' => 'Laos',
  'LV' => 'Latvia',
  'LB' => 'Lebanon',
  'LS' => 'Lesotho',
  'LR' => 'Liberia',
  'LY' => 'Libya',
  'LI' => 'Liechtenstein',
  'LT' => 'Lithuania',
  'LU' => 'Luxembourg',
  'MO' => 'Macau',
  'MK' => 'Macedonia - The Former Yugoslav Republic of',
  'MG' => 'Madagascar',
  'MW' => 'Malawi',
  'MY' => 'Malaysia',
  'MV' => 'Maldives',
  'ML' => 'Mali',
  'MT' => 'Malta',
  'MH' => 'Marshall Islands',
  'MQ' => 'Martinique',
  'MR' => 'Mauritania',
  'MU' => 'Mauritius',
  'YT' => 'Mayotte',
  'MX' => 'Mexico',
  'FM' => 'Micronesia - Federated States of',
  'MD' => 'Moldova',
  'MC' => 'Monaco',
  'MN' => 'Mongolia',
  'MS' => 'Montserrat',
  'MA' => 'Morocco',
  'MZ' => 'Mozambique',
  'MM' => 'Myanmar',
  'NA' => 'Namibia',
  'NR' => 'Naura',
  'NP' => 'Nepal',
  'NL' => 'Netherlands',
  'AN' => 'Netherlands Antilles',
  'NC' => 'New Caledonia',
  'NZ' => 'New Zealand',
  'NI' => 'Nicaragua',
  'NE' => 'Niger',
  'NG' => 'Nigeria',
  'NU' => 'Niue',
  'NF' => 'Norfolk Island',
  'KP' => 'North Korea',
  'MP' => 'Northern Mariana Islands',
  'NO' => 'Norway',
  'OM' => 'Oman',
  'PK' => 'Pakistan',
  'PW' => 'Palau',
  'PA' => 'Panama',
  'PG' => 'Papua New Guinea',
  'PY' => 'Paraguay',
  'PE' => 'Peru',
  'PH' => 'Philippines',
  'PN' => 'Pitcairn Islands',
  'PL' => 'Poland',
  'PT' => 'Portugal',
  'PR' => 'Puerto Rico',
  'QA' => 'Qatar',
  'RE' => 'Reunion',
  'RO' => 'Romania',
  'RU' => 'Russia',
  'RW' => 'Rwanda',
  'KN' => 'Saint Kitts and Nevis',
  'LC' => 'Saint Lucia',
  'VC' => 'Saint Vincent and the Grenadines',
  'WS' => 'Samoa',
  'SM' => 'San Marino',
  'ST' => 'Sao Tome and Principe',
  'SA' => 'Saudi Arabia',
  'SN' => 'Senegal',
  'CS' => 'Serbia and Montenegro',
  'SC' => 'Seychelles',
  'SL' => 'Sierra Leone',
  'SG' => 'Singapore',
  'SK' => 'Slovakia',
  'SI' => 'Slovenia',
  'SB' => 'Solomon Islands',
  'SO' => 'Somalia',
  'ZA' => 'South Africa',
  'GS' => 'South Georgia and the South Sandwich Islands',
  'KR' => 'South Korea',
  'ES' => 'Spain',
  'LK' => 'Sri Lanka',
  'SH' => 'St. Helena',
  'PM' => 'St. Pierre and Miquelon',
  'SD' => 'Sudan',
  'SR' => 'Suriname',
  'SJ' => 'Svalbard',
  'SZ' => 'Swaziland',
  'SE' => 'Sweden',
  'CH' => 'Switzerland',
  'SY' => 'Syria',
  'TW' => 'Taiwan',
  'TJ' => 'Tajikistan',
  'TZ' => 'Tanzania',
  'TH' => 'Thailand',
  'TG' => 'Togo',
  'TK' => 'Tokelau',
  'TO' => 'Tonga',
  'TT' => 'Trinidad and Tobago',
  'TN' => 'Tunisia',
  'TR' => 'Turkey',
  'TM' => 'Turkmenistan',
  'TC' => 'Turks and Caicos Islands',
  'TV' => 'Tuvalu',
  'UG' => 'Uganda',
  'UA' => 'Ukraine',
  'AE' => 'United Arab Emirates',
  'GB' => 'United Kingdom',
  'VI' => 'United States Virgin Islands',
  'UY' => 'Uruguay',
  'UZ' => 'Uzbekistan',
  'VU' => 'Vanuatu',
  'VE' => 'Venezuela',
  'VN' => 'Vietnam',
  'WF' => 'Wallis and Futuna',
  'PS' => 'West Bank',
  'EH' => 'Western Sahara',
  'YE' => 'Yemen',
  'ZM' => 'Zambia',
  'ZW' => 'Zimbabwe',
   ]; function getCountryName($isoCode) {
       // What I did earlier was really fuxxing newby, here's a better version
      global $_COUNTRIES;
    if (isset($_COUNTRIES[$isoCode])) {
        return $_COUNTRIES[$isoCode];
    } else {
        return '???';
    }
}


// Here's a better online detector. Basically I couldn't find any efficent code for making an accurate online detector in this type of codebase, so this is currently the best we got.

function showChannels($vid, $include_char = ',') {
global $conn;
$video2chan= $conn->prepare("SELECT * FROM videos WHERE vid = ? AND converted = 1");
$video2chan->execute([$vid]);

if($video2chan->rowCount() == 0) {
 echo "No channels!";
} else {
	$video2chan = $video2chan->fetch(PDO::FETCH_ASSOC);
    $ch1 = $video2chan['ch1'];
    $ch2 = $video2chan['ch2'];
    $ch3 = $video2chan['ch3'];
    // hope i can make this better someday
    $q = $conn->prepare("SELECT * FROM channels WHERE id = :ch1");
    $q->bindParam(':ch1', $ch1, PDO::PARAM_INT);
    $q->execute();
    $ch1 = $q->fetch(PDO::FETCH_ASSOC);
    $q = $conn->prepare("SELECT * FROM channels WHERE id = :ch1");
    $q->bindParam(':ch1', $ch2, PDO::PARAM_INT);
    $q->execute();
    $ch2 = $q->fetch(PDO::FETCH_ASSOC);
    $q = $conn->prepare("SELECT * FROM channels WHERE id = :ch1");
    $q->bindParam(':ch1', $ch3, PDO::PARAM_INT);
    $q->execute();
    $ch3 = $q->fetch(PDO::FETCH_ASSOC);
    if ($ch1 != NULL && $ch2 != NULL) {
     echo '<a href="channels?c='.$ch1['id'].'">'.$ch1['name'].'</a>'.$include_char.' ';
    } elseif ($ch1 != NULL && $ch2 == NULL && $ch3 == NULL) {
     echo '<a href="channels?c='.$ch1['id'].'">'.$ch1['name'].'</a>

						';
    }
    if ($ch2 != NULL && $ch3 != NULL) {
     echo '<a href="channels?c='.$ch2['id'].'">'.$ch2['name'].'</a>'.$include_char.' ';
    } elseif ($ch2 != NULL && $ch3 == NULL) {
     echo '<a href="channels?c='.$ch2['id'].'">'.$ch2['name'].'</a>';
    }
    if ($ch3 != NULL) {
     echo '<a href="channels?c='.$ch3['id'].'">'.$ch3['name'].'</a>';
    }
  }
}
function showGroupChannels($vid, $include_char = ':') {
global $conn;
$video2chan= $conn->prepare("SELECT * FROM groups WHERE url = ?");
$video2chan->execute([$vid]);

if($video2chan->rowCount() == 0) {
 echo "No channels!";
} else {
	$video2chan = $video2chan->fetch(PDO::FETCH_ASSOC);
    $ch1 = $video2chan['ch1'];
    $ch2 = $video2chan['ch2'];
    $ch3 = $video2chan['ch3'];
    // hope i can make this better someday
    $q = $conn->prepare("SELECT * FROM channels WHERE id = :ch1");
    $q->bindParam(':ch1', $ch1, PDO::PARAM_INT);
    $q->execute();
    $ch1 = $q->fetch(PDO::FETCH_ASSOC);
    $q = $conn->prepare("SELECT * FROM channels WHERE id = :ch1");
    $q->bindParam(':ch1', $ch2, PDO::PARAM_INT);
    $q->execute();
    $ch2 = $q->fetch(PDO::FETCH_ASSOC);
    $q = $conn->prepare("SELECT * FROM channels WHERE id = :ch1");
    $q->bindParam(':ch1', $ch3, PDO::PARAM_INT);
    $q->execute();
    $ch3 = $q->fetch(PDO::FETCH_ASSOC);
    if ($ch1 != NULL && $ch2 != NULL) {
     echo '<a href="groups_main?c='.$ch1['id'].'">'.$ch1['name'].'</a> '.$include_char.' ';
    } elseif ($ch1 != NULL && $ch2 == NULL && $ch3 == NULL) {
     echo '<a href="groups_main?c='.$ch1['id'].'">'.$ch1['name'].'</a>

						';
    }
    if ($ch2 != NULL && $ch3 != NULL) {
     echo '<a href="groups_main?c='.$ch2['id'].'">'.$ch2['name'].'</a> '.$include_char.' ';
    } elseif ($ch2 != NULL && $ch3 == NULL) {
     echo '<a href="groups_main?c='.$ch2['id'].'">'.$ch2['name'].'</a>';
    }
    if ($ch3 != NULL) {
     echo '<a href="groups_main?c='.$ch3['id'].'">'.$ch3['name'].'</a>';
    }
  }
}
function get_ip_address(){
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
        if (array_key_exists($key, $_SERVER) === true){
            foreach (explode(',', $_SERVER[$key]) as $ip){
                $ip = trim($ip); // just to be safe

                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                    return $ip;
                }
            }
        }
    }
}
$enduser_ip = get_ip_address();

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

function getRatingCount($vid) {
global $conn;
$ratingscount = $conn->prepare("SELECT COUNT(r.rating) FROM ratings r JOIN users u ON r.user = u.uid WHERE r.video = ? AND u.termination = 0");
    $ratingscount->execute([$vid]);
    $ratingscount = $ratingscount->fetchColumn();
    return number_format($ratingscount);    
}
function grabRatings($vid, $size = "SM", $show_count = 1) {
   global $conn;
    $avg = $conn->prepare("SELECT AVG(r.rating) FROM ratings r JOIN users u ON r.user = u.uid WHERE r.video = ? AND u.termination = 0");
    $avg->execute([$vid]);
    $average = $avg->fetchColumn();
    $rating = $average;
    if($average != 0) {
    if ($size == "L") { // Use == for comparison
        $star_half_icon = "star_half.gif";
        $star_none_icon = "star_bg.gif";
        $star_full_icon = "star.gif";
    }

    if ($size == "SM") { // Use == for comparison
        $star_half_icon = "star_sm_half.gif";
        $star_none_icon = "star_sm_bg.gif";
        $star_full_icon = "star_sm.gif";  
    }

    if(fmod($rating, 1) !== 0.00){
        $rating_half = true;
    } else {
        $rating_half = false;
    }
    
    $star_rating_draw = ''; // Initialize the variable
    for ($i = 1; $i <= 5; $i++) {
        if ($rating >= $i) {
            $star_rating_draw .= '
            <img class="rating" src="/img/' . $star_full_icon . '">';
        } elseif ($rating_half && $rating > ($i - 1) && $rating < $i) {
            $star_rating_draw .= '
            <img class="rating" src="/img/' . $star_half_icon . '">';
        } else {
            $star_rating_draw .= '
            <img class="rating" src="/img/' . $star_none_icon . '">';
        }
    }
echo '
<!--Begin Rated Section-->

<nobr>';
    echo $star_rating_draw;
   echo '
   </nobr>


<!--End Rated Section-->
   ';
    if($show_count == 1 && $average != 0) {
    if(getRatingCount($vid) != 1) {
    echo '
    <span class="rating">('. getRatingCount($vid) .' ratings)</span>';
    } else {
        echo '
        <span class="rating">('. getRatingCount($vid) .' rating)</span>';   
}}
}
}

function gmailStyleTime($datetime) {

if ((date('d', strtotime($datetime)) != date('d')) && (date('Y', strtotime($datetime)) == date('Y'))) { 
  return date("M d", strtotime($datetime));
}
else if(date('Y', strtotime($datetime)) != date('Y'))
{
  return date("m-d-y h:i", strtotime($datetime. ' - 18 years'));
}
else 
{
  return date("h:i a", strtotime($datetime));
}}

function dec2hex($int) {
  $hex = dechex($int);
  if (strlen($hex)%2 != 0) {
    $hex = str_pad($hex, strlen($hex) + 1, '0', STR_PAD_LEFT);
  }
  return $hex;
}


function htmlspecialsomechars($input, $allowedTags = array()) {
    $allowedTags = array_map('strtolower', $allowedTags);
    $output = preg_replace_callback('/<[^>]*>.*?<\/\s*([^\s>]+)\s*>|<[^>]*>/', function($match) use ($allowedTags) {
        $tag = $match[0];
        preg_match('/<\s*([^\s>\/]+)/', $tag, $tagMatch);
        $tagName = strtolower($tagMatch[1]);
        if (in_array($tagName, $allowedTags) || $tag[strlen($tag) - 2] == '/') {
            return $tag;
        } else {
            return htmlspecialchars($tag);
        }
    }, $input);

    return $output;
}

if(!isset($session) || ($session['branding'] != 2)) {
    $SiteBranding = "EpikTube";
}

elseif(isset($session) && ($session['branding'] != 1)) {
    $SiteBranding = "YouTube";
}
function getReplies($reply_to = 0, $video_id = 0, $uploaderuid = "blah", $level = 0, $recent = false) {
    global $conn;
    $result = $conn->prepare("SELECT * FROM comments LEFT JOIN users ON users.uid = comments.uid WHERE is_reply = ? AND reply_to = ? AND users.termination = 0 ORDER BY post_date ASC");
	$result->execute([1, $reply_to]);
    if (!$result || !$result->rowCount()) {
        return;
    }

    foreach($result->fetchAll(PDO::FETCH_ASSOC) as $reply) {

       $marginnum = 20;
        for ($i = 0; $i < $level; $i++) {
            $marginnum = $marginnum + 20;
        }
		?>

			<a name="<? echo htmlspecialchars($reply['cid']); ?>"/>
					<table class="childrenSection" id="comment_<? echo htmlspecialchars($reply['cid']); ?>" width="100%" style="margin-left: <? echo htmlspecialchars($marginnum); ?>px">
					<tr valign="top"><? if ($reply['removed'] == 1) { echo '<td>----- Reply deleted by user -----'; } else { ?>
<? if($reply['vid'] != NULL) { ?>
						<td width="60">
							<a href="/watch.php?v=<? echo htmlspecialchars($reply['vid']); ?>"><img src="/get_still.php?video_id=<? echo htmlspecialchars($reply['vid']); ?>" class="commentsThumb" width="60" height="45"></a>
							<div class="commentSpecifics">
								<a href="/watch.php?v=<? echo htmlspecialchars($reply['vid']); ?>">Related Video</a>
							</div>
						</td>

<? } ?>
						<td>
		<?= nl2br(htmlspecialsomechars($reply['body'], ['b', 'i', 'big'])) ?>
			<div class="userStats">
				<? if($reply['termination'] != 1) {?><a href="profile?user=<?php echo htmlspecialchars($reply['username']); ?>"><?php echo htmlspecialchars($reply['username']); ?></a> // <a href="profile_videos.php?user=<?php echo htmlspecialchars($reply['username']); ?>">Videos</a> (<?php echo getpublicvideos($reply['uid']); ?>) | <a href="profile_favorites.php?user=<?php echo htmlspecialchars($reply['username']); ?>">Favorites</a> (<?php echo getfavoritecount($reply['uid']) ?>) | <a href="profile_friends.php?user=<?php echo htmlspecialchars($reply['username']); ?>">Friends</a> (<?php echo getfriendcount($reply['uid']) ?>)<? } ?>
								 - (<?= timeAgo($reply['post_date']); ?>)
			</div>
		<?php if($recent != true) { ?>		
	<div class="userStats" id="container_comment_form_id_<? echo htmlspecialchars($reply['cid']); ?>" style="display: none"></div>
    <div class="userStats" id="reply_comment_form_id_<? echo htmlspecialchars($reply['cid']); ?>">
				  (<a href="javascript:showCommentReplyForm('comment_form_id_<? echo htmlspecialchars($reply['cid']); ?>', '<? echo htmlspecialchars($reply['cid']); ?>', false);">Reply to this</a>) &nbsp; 
				  (<a href="javascript:showCommentReplyForm('comment_form_id_<? echo htmlspecialchars($reply['cid']); ?>', '<?php echo htmlspecialchars($reply['master_comment']); ?>');">Reply to parent</a>) &nbsp; 
				  (<a href="javascript:showCommentReplyForm('comment_form_id_<? echo htmlspecialchars($reply['cid']); ?>', '');">Create new thread</a>) &nbsp; 
		
			  <?php $check = $conn->prepare("SELECT * from videos WHERE vid = :vid");
			  $check->bindParam(':vid', $reply['vidon']);
			  $check->execute();
			  $check = $check->fetch();
			  ?>
		
			  <?php if (isset($GLOBALS['session']['uid']) && $check['uid'] == $GLOBALS['session']['uid'] || isset($GLOBALS['session']['uid']) && $GLOBALS['session']['staff'] == 1 && $reply['uid'] != NULL) { ?>
				<input type="button" name="remove_button_<?php echo htmlspecialchars($comment['cid']); ?>" id="remove_button_<?php echo htmlspecialchars($reply['cid']); ?>" value="Remove Comment" onclick="removeComment(document.getElementById('remove_comment_form_id_<?php echo htmlspecialchars($reply['cid']); ?>'));"> &nbsp; 
	<form name="remove_comment_form" id="remove_comment_form_id_<?php echo htmlspecialchars($reply['cid']); ?>">
		<input type="hidden" name="deleter_user_id" value="<?php echo htmlspecialchars($GLOBALS['session']['uid']); ?>">
		<input type="hidden" name="remove_comment" value="">
			<input type="hidden" name="comment_id" value="<?php echo htmlspecialchars($reply['cid']); ?>">
		<input type="hidden" name="comment_type" value="V">
	</form>
	<? } ?>
					</div>
				 <div id="div_comment_form_id_<?php echo htmlspecialchars($reply['cid']); ?>"></div>

<? } ?>
<?php } ?>

							</td>
					</tr>
				</table>
<?
           getReplies($reply['cid'], $video_id, $uploaderuid, $level + 1, $recent);   
    }
}
function getfavoriting($who) {
    global $conn;

   $favorting = $conn->prepare(
    "SELECT users.username FROM favorites
    LEFT JOIN users ON users.uid = favorites.uid
    LEFT JOIN videos ON favorites.vid = videos.vid
    WHERE favorites.vid = ? AND videos.converted = 1 AND users.termination = 0
    ORDER BY favorites.fid DESC"
);

    $favorting->execute([$who]);
    $favorites = $favorting->fetchAll();

    if (!$favorites) {
        return ''; 
    }

    $links = [];
    foreach ($favorites as $favorite) {
        $links[] = '<a href="profile?user=' . htmlspecialchars($favorite['username']) . '">' . 
                   htmlspecialchars($favorite['username']) . 
                   '</a>';
    }

  
    return implode(', ', $links);
}

$tabs = [
    "home" => [
        "index", "my_profile", "signup", "login", "forgot", "forgot_username", 
        "my_messages", "outbox", "my_favorites", "my_videos", "dev", 
        "dev_api_ref", "dev_error_codes", "help", "dev_intro", "dev_rest", 
        "dev_xmlrpc", "api_v1", "subscription_center", "my_subscribers", 
        "jobs", "contact", "view_play_list", "pl_manager", "about", "pr", 
        "about_news", "terms", "privacy", "safety", "explore_epiktube", "explore_commune", "explore_create", "explore_collect", "my_settings", "my_profile_email"
    ],
    "videos" => ["browse", "watch"],
    "channels" => ["channels", "channels_portal"],
    "groups" => ["groups_main", "groups_create", "groups_layout"],
    "members" => [
        "members", "results", "profile", "profile_videos", "profile_friends", 
        "my_friends", "my_friends_accept", "profile_videos_private", 
        "profile_favorites", "my_friends_invite", "profile_play_list", 
        "profile_comments", "bulletin_all"
    ],
    "upload" => ["my_videos_upload", "my_videos_upload_2"],
    "my_friends" => ["my_friends", "my_friends_accept", "my_friends_iy"],
    "memberbutton" => ["members", "results", "profile", "profile_videos", "profile_friends", 
       "profile_videos_private", 
        "profile_favorites", "profile_play_list", 
        "profile_comments", "bulletin_all"]
];
function activetab($current_page, $pages) {
    return in_array($current_page, $pages);
}


 