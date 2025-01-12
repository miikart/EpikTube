<?php 
if(!isset($session['staff']) || $session['staff'] != 1) {
	redirect("Location: /index.php"); 
    exit;
}
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<table>
<table cellspacing="0" align="center"><tbody>
<tr>
<td style="background: #96ff88; font-weight: bold; padding: 9px; text-align: center;">epik panel</td>
<td style="background: #96ff88;; font-weight: bold; padding: 9px; text-align: center;"><?= retroDate("now", "l") ?></td>
<td style="background: #96ff88; font-weight: bold; padding: 9px; text-align: center;"><?= retroDate("now", "F j, Y") ?></td>
<td style="background: #96ff88; font-weight: bold; padding: 9px; text-align: center;"><?= retroDate("now", "h:i:s") ?> <?= retroDate("now", 'I') ? 'CST' : 'CDT'; ?></td>
<td style="background: #96ff88; font-weight: bold; padding: 9px; text-align: center;">Users: <?php echo number_format($getusers) ?></td>
<td style="background: #96ff88; font-weight: bold; padding: 9px; text-align: center;">Banned Users: <?php echo number_format($getusersterm) ?> (<a href="terminated_users.php">See all</a>)</td>
</tr>
</tbody>
</table>
<table align="center" style="margin-top:-1px;padding-bottom:10px;">
<tr>
    <td style="width: 113px; height: 44px; background: #fff; font-size: 20px; font-weight: bold; padding: 1px 12px; text-align: center; border: 1px dashed #339950;  vertical-align: middle;">
        <a style="text-decoration: none;" href="index.php">Home</a>
    </td>
    <td style="width: 113px; height: 44px; background: #fff; font-size: 20px; font-weight: bold; padding: 1px 12px; text-align: center; border: 1px dashed #339950; border-left: none; vertical-align: middle;">
        <a style="text-decoration: none;" href="uploads.php">Uploads</a>
        
    </td>
     <td style="width: 113px; height: 44px; background: #fff; font-size: 20px; font-weight: bold; padding: 1px 12px; text-align: center; border: 1px dashed #339950; border-left: none; vertical-align: middle;">
        <a style="text-decoration: none;" href="Logo.php">Logo</a>
        
    </td>
    <td style="width: 113px; height: 44px; background: #FFF; font-size: 20px; font-weight: bold; padding: 1px 12px; text-align: center; border: 1px dashed #339950; border-left: none; vertical-align: middle;">
        <a style="text-decoration: none;" href="settings.php">Settings</a>
    </td>
    </td>
	</tr>
    </table>