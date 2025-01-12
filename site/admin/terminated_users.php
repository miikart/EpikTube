<?php
require "admin_head.php";
$terminated_users = $conn->query("SELECT * FROM users WHERE termination = 1");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 try {
        $q = $conn->prepare("UPDATE users SET termination = 0 WHERE username = :username");
        $q->bindParam(':username', $_POST['user'], PDO::PARAM_STR);
        $q->execute();
        if ($q->rowCount() > 0) {
            alert("done", "success");
        } else {
            alert("user doesnt exist or isnt terminated", "error");
        }
    } catch (PDOException $e) {
        alert("failed to unterminate please contact the site owner " . htmlspecialchars($e->getMessage()), "error");
    }
 
} 
$terminated_users = $conn->query("SELECT * FROM users WHERE termination = 1"); ?>
   <table class="roundedTable" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#cccccc" align="left">
			<tbody><tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td width="100%">
				<div class="moduleTitleBar">
		<div class="moduleTitle">
			Terminated Users
			
			</div>
				</div>
		
				
   

    <table width="100%" cellpadding="5" cellspacing="0" border="0" bgcolor="#EEEEDD">
      
        <?php foreach ($terminated_users->fetchAll() as $user) { ?>
            <tr>
                <td style="text-align: center;"><?= $user['username'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="user" value="<?= $user['username'] ?>">
                        <button type="submit">Unterminate</button>
                    </form>
                </td>
            </tr>
        <?php } ?>

				</td>
						</tr>
					</tbody></table>
					</div>
					
									
				</td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</tbody></table>

		<?php require_once("../needed/end.php"); ?>