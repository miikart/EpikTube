<?php
require "needed/scripts.php";
$profile = $session;
force_login();
function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array, SORT_STRING | SORT_FLAG_CASE);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

//$friends = $conn->prepare("SELECT * FROM relationships WHERE (sender = ? OR respondent = ?) AND accepted = 1");
//$friends->execute([$profile['uid'], $profile['uid']]);
$friends = $conn->prepare("SELECT * FROM relationships LEFT JOIN users ON users.uid = relationships.respondent WHERE relationships.sender = ? AND relationships.accepted = 1 AND users.termination = 0");
$friends->execute([$profile['uid']]);
$friends = $friends->fetchAll(PDO::FETCH_ASSOC);

$friends2 = $conn->prepare("SELECT * FROM relationships LEFT JOIN users ON users.uid = relationships.sender WHERE relationships.respondent = ? AND relationships.accepted = 1 AND users.termination = 0");
$friends2->execute([$profile['uid']]);
$friends2 = $friends2->fetchAll(PDO::FETCH_ASSOC);
$friends = array_merge($friends, $friends2);

$friends = array_sort($friends, "username", SORT_ASC);
$popular = $conn->prepare(
	"SELECT * FROM videos WHERE uid = ? AND converted = 1 AND privacy = 1"
);
$popular->execute([$profile['uid']]);
$popular = $popular->rowCount(); 

?>

	
<?php
$_PAGE["Page"] = "my_friends";
require_once "_templates/_structures/main.php";
?>
?>