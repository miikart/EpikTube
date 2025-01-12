<div class="tableSubTitle">EpikTube 2006 Site Management</div>


		<table width="180" align="left" cellpadding="0" cellspacing="0" border="0" bgcolor="#EEEEDD">
			<tbody><tr>
				<td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
				<td width="170">
				
				<div style="padding: 2px 5px 10px 5px;">
				<div style="font-size: 14px; font-weight: bold; margin-bottom: 8px; color: #666633;">How is EpikTube doing?</div>
<div style="font-weight: bold; margin-bottom: 5px;">We have:</div>
				<div style="margin-bottom: 4px;"><img src="/img/icon_vid.gif" alt="Videos" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> <strong><?= number_format($hikt['vids']) ?></strong> uploaded videos</div>
                <div style="margin-bottom: 4px;"><img src="/img/icon_vid.gif" alt="Views" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> <strong><?= number_format($hikt['views']) ?></strong> total watches</div>
                <div style="margin-bottom: 4px;"><img src="/img/icon_vid.gif" alt="Playlists" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> <strong><?php echo number_format($hikt['playlist']) ?></strong> playlists</div>
                <div style="margin-bottom: 4px;"><img src="/img/mail.gif" style="margin-bottom: 2px;" alt="Messages" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> <strong><?= number_format($hikt['msg']) ?></strong> private messages</div>
<div style="margin-bottom: 4px;"><img src="/img/mail.gif" style="margin-bottom: 2px;" alt="Messages" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> <strong><?= number_format($hikt['cmt']) ?></strong> comments</div>
				<div style="margin-bottom: 4px;"><img src="/img/icon_fav.gif" alt="Favorites" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"><strong><?= number_format($hikt['fav']) ?></strong> favorites</div>
<img src="/img/icon_friends.gif" alt="Friends" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"><strong><?= number_format($hikt['usr']) ?></strong> users

				<p></p><div style="font-weight: bold; margin-bottom: 5px;">Isn't that cool?</div></div>

				</td>
				<td><img src="/img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="/img/pixel.gif" width="1" height="5"></td>
				<td><img src="/img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</tbody></table>
   <table width="<?php echo htmlspecialchars($width); ?>" align="left" style="margin-left: 13px;" cellpadding="0" cellspacing="0" border="0" bgcolor="#EEEEDD">
        <tr>
            <td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
            <td><img src="/img/pixel.gif" width="1" height="5"></td>
            <td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
        </tr>
        <tr>
            <td><img src="/img/pixel.gif" width="5" height="1"></td>
            <td width="<?php echo htmlspecialchars($width - 10); ?>">

                <div style="padding: 2px 5px 10px 5px;">
                    <div style="font-size: 14px; font-weight: bold; margin-bottom: 8px; color: #666633;">Last 20 users online</div>
                    <?php foreach ($lastonline as $user) {
                        // Separate fetching additional data for each user
                        $user['vids'] = $GLOBALS['conn']->prepare("SELECT COUNT(vid) FROM videos WHERE uid = ? AND converted = 1");
                        $user['vids']->execute([$user['uid']]);
                        $user['vids'] = $user['vids']->fetchColumn();

                        $user['favs'] = $GLOBALS['conn']->prepare("SELECT COUNT(fid) FROM favorites WHERE uid = ?");
                        $user['favs']->execute([$user['uid']]);
                        $user['favs'] = $user['favs']->fetchColumn();
                        ?>
                        <div style="font-size: 12px; font-weight: bold; margin-bottom: 5px;">
                            <a href="manage_account.php?user=<?php echo htmlspecialchars($user['username']); ?>" <?php if (strlen($user['username']) > 14) { ?> title="<?= htmlspecialchars($user['username']) ?>" <?php } ?>>
                                <?php echo shorten($user['username'], 14); ?>
                            </a>
                        </div>

                        <div style="font-size: 12px; margin-bottom: 8px; padding-bottom: 10px; border-bottom: 1px dashed #CCCC66;">
                            <a href="/profile_videos.php?user=<?php echo htmlspecialchars($user['username']); ?>"><img src="/img/icon_vid.gif" alt="Videos" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a>
                            (<a href="/profile_videos.php?user=<?php echo htmlspecialchars($user['username']); ?>"><?php echo getpublicvideos($user['uid']) ?></a>)
                            | <a href="/profile_favorites.php?user=<?php echo htmlspecialchars($user['username']); ?>"><img src="/img/icon_fav.gif" alt="Favorites" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a>
                            (<a href="/profile_favorites.php?user=<?php echo htmlspecialchars($user['username']); ?>"><?php echo getfavoritecount($user['uid']) ?></a>)
                            | <a href="/profile_friends.php?user=<?php echo htmlspecialchars($user['username']); ?>"><img src="/img/icon_friends.gif" alt="Friends" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a>
                            (<a href="/profile_friends.php?user=<?php echo htmlspecialchars($user['username']); ?>"><?php echo getfriendcount($user['uid']) ?></a>)
                        </div>
                    <?php } ?>

                    <div style="font-weight: bold; margin-bottom: 5px;">Icon Key:</div>
                    <div style="margin-bottom: 4px;"><img src="/img/icon_vid.gif" alt="Videos" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> - Videos</div>
                    <div style="margin-bottom: 4px;"><img src="/img/icon_fav.gif" alt="Favorites" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> - Favorites</div>
                    <img src="/img/icon_friends.gif" alt="Friends" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> - Friends

                </div>

            </td>
            <td><img src="/img/pixel.gif" width="5" height="1"></td>
        </tr>
        <tr>
            <td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
            <td><img src="/img/pixel.gif" width="1" height="5"></td>
            <td><img src="/img/box_login_br.gif" width="5" height="5"></td>
        </tr>
    </table>
    <table width="<?php echo htmlspecialchars($width); ?>" align="left" style="margin-left: 13px;" cellpadding="0" cellspacing="0" border="0" bgcolor="#EEEEDD">
        <tr>
            <td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
            <td><img src="/img/pixel.gif" width="1" height="5"></td>
            <td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
        </tr>
        <tr>
            <td><img src="/img/pixel.gif" width="5" height="1"></td>
            <td width="<?php echo htmlspecialchars($width - 10); ?>">

                <div style="padding: 2px 5px 10px 5px;">
                    <div style="font-size: 14px; font-weight: bold; margin-bottom: 8px; color: #666633;">Last 20 created accounts</div>
                    <?php foreach ($lastsign as $user) {
                        // Separate fetching additional data for each user
                        $user['vids'] = $GLOBALS['conn']->prepare("SELECT COUNT(vid) FROM videos WHERE uid = ? AND converted = 1");
                        $user['vids']->execute([$user['uid']]);
                        $user['vids'] = $user['vids']->fetchColumn();

                        $user['favs'] = $GLOBALS['conn']->prepare("SELECT COUNT(fid) FROM favorites WHERE uid = ?");
                        $user['favs']->execute([$user['uid']]);
                        $user['favs'] = $user['favs']->fetchColumn();
                        ?>
                        <div style="font-size: 12px; font-weight: bold; margin-bottom: 5px;">
                            <a href="manage_account.php?user=<?php echo htmlspecialchars($user['username']); ?>" <?php if (strlen($user['username']) > 14) { ?> title="<?= htmlspecialchars($user['username']) ?>" <?php } ?>>
                                <?php echo shorten($user['username'], 14); ?>
                            </a>
                        </div>

                        <div style="font-size: 12px; margin-bottom: 8px; padding-bottom: 10px; border-bottom: 1px dashed #CCCC66;">
                            <a href="/profile_videos.php?user=<?php echo htmlspecialchars($user['username']); ?>"><img src="/img/icon_vid.gif" alt="Videos" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a>
                            (<a href="/profile_videos.php?user=<?php echo htmlspecialchars($user['username']); ?>"><?php echo getpublicvideos($user['uid']) ?></a>)
                            | <a href="/profile_favorites.php?user=<?php echo htmlspecialchars($user['username']); ?>"><img src="/img/icon_fav.gif" alt="Favorites" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a>
                            (<a href="/profile_favorites.php?user=<?php echo htmlspecialchars($user['username']); ?>"><?php echo getfavoritecount($user['uid']) ?></a>)
                            | <a href="/profile_friends.php?user=<?php echo htmlspecialchars($user['username']); ?>"><img src="/img/icon_friends.gif" alt="Friends" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a>
                            (<a href="/profile_friends.php?user=<?php echo htmlspecialchars($user['username']); ?>"><?php echo getfriendcount($user['uid']) ?></a>)
                        </div>
                    <?php } ?>

                    <div style="font-weight: bold; margin-bottom: 5px;">Icon Key:</div>
                    <div style="margin-bottom: 4px;"><img src="/img/icon_vid.gif" alt="Videos" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> - Videos</div>
                    <div style="margin-bottom: 4px;"><img src="/img/icon_fav.gif" alt="Favorites" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> - Favorites</div>
                    <img src="/img/icon_friends.gif" alt="Friends" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"> - Friends

                </div>

            </td>
            <td><img src="/img/pixel.gif" width="5" height="1"></td>
        </tr>
        <tr>
            <td><img src="/img/box_login_bl.gif" width="5" height="5"></td>
            <td><img src="/img/pixel.gif" width="1" height="5"></td>
            <td><img src="/img/box_login_br.gif" width="5" height="5"></td>
        </tr>
    </table>

    <table width="<?php echo htmlspecialchars($width); ?>" align="left" style="margin-left: 13px;" cellpadding="0" cellspacing="0" border="0" bgcolor="#EEEEDD">
        <tr>
            <td><img src="/img/box_login_tl.gif" width="5" height="5"></td>
            <td><img src="/img/pixel.gif" width="1" height="5"></td>
            <td><img src="/img/box_login_tr.gif" width="5" height="5"></td>
        </tr>
        <tr>
            <td><img src="/img/pixel.gif" width="5" height="1"></td>
            <td width="<?php echo htmlspecialchars($width - 10); ?>">

                <div style="padding: 2px 5px 10px 5px;">
                    <div style="font-size: 14px; font-weight: bold; margin-bottom: 8px; color: #666633;">Recent Uploads</div>
                    <?php foreach ($lastupload as $video) {
               
				
                        ?>
                        <div style="font-size: 12px; font-weight: bold; margin-bottom: 5px;"><a href="/watch.php?v=<?= htmlspecialchars($video['vid']) ?>"><img src="/get_still.php?video_id=<?= htmlspecialchars($video['vid']) ?>" width="78" height="65" class="moduleFeaturedThumb"></a><br>
                            <a href="manage_video?video_id=<?= htmlspecialchars($video['vid']) ?>" <?php if (strlen($video['title']) > 30) { ?> title="<?= htmlspecialchars($video['title']) ?>" <?php } ?>>
                                <?php echo shorten($video['title'], 30); ?>
                            </a>
                        </div>
                
                        <div style="font-size: 12px; margin-bottom: 8px; padding-bottom: 10px; border-bottom: 1px dashed #CCCC66;">
                        <a href="manage_account.php?user=<?= htmlspecialchars($video['username']) ?>" class="bold"<?php if (strlen($video['username']) > 14) { ?> title="<?= htmlspecialchars($video['username']) ?>" <?php } ?>>
                                <?php echo shorten($video['username'], 14); ?>
                            </a> <strong>//</strong>
                            <img src="/img/icon_vid.gif" alt="Views" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a> 
                            <?php echo $video['views']; ?>
                            | <img src="/img/icon_fav.gif" alt="Favorites" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a>
                            <?php echo getfavoritecount($video['vid']); ?>
                            | <img src="/img/icon_mail_off.gif" alt="Commments"   border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a>
                            <?php echo getcommentcount($video['vid']); ?>
                        </div>
                    <?php } ?>

                    <div style="font-weight: bold; margin-bottom: 5px;">Letter Key:</div>
                   <img src="/img/icon_vid.gif" alt="Views" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a> - Views<br>
                    <img src="/img/icon_fav.gif" alt="Favorites" width="14" height="14" border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a>- Favorites<br>
                    <img src="/img/icon_mail_off.gif" alt="Commments"   border="0" style="vertical-align: text-bottom; padding-left: 2px; padding-right: 1px;"></a>- Comments<br>
                    </div>

                </div>

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