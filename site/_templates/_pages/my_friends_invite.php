<h1 class="tableSubTitle">Invite Your Friends</h1>
<div class="tableSubTitleIntro">EpikTube is more fun with friends!</h1>
        <br>Have family members that you wish to share baby or
        event videos with? Invite them to join! <br>
        <br>

        <form method="post">

        <table cellspacing="5" cellpadding="0" border="0" id="table5">

        <tbody>

        <tr>

          <td align="right"><span class="label"><nobr>Email Address:</nobr>

          </span></td>

          <td><input type="hidden" name="type" value="Family">
			<input maxlength="60" size="30" name="friends_email1">

          <span class="label" style="MARGIN-LEFT: 3em"><nobr>First Name:</nobr>            </span>
          <input maxlength="30" name="friends_fname1" size="20"></td></tr>

        <tr>

          <td align="right"><span class="label"><nobr>Email Address:</nobr>

          </span></td>

          <td><input type="hidden" name="type" value="Family">
			<input maxlength="60" size="30" name="friends_email2">

          <span class="label" style="MARGIN-LEFT: 3em"><nobr>First Name:</nobr>            </span>
          <input maxlength="30" name="friends_fname2" size="20"></td></tr>

        <tr>

          <td align="right"><span class="label"><nobr>Email Address:</nobr>

          </span></td>

          <td><input type="hidden" name="type" value="Family">
			<input maxlength="60" size="30" name="friends_email3">

          <span class="label" style="MARGIN-LEFT: 3em"><nobr>First Name:</nobr>            </span>
          <input maxlength="30" name="friends_fname3" size="20"></td></tr>

        <tr>

          <td align="right"><span class="label"><nobr>Email Address:</nobr>

          </span></td>

          <td><input type="hidden" name="type" value="Family">
			<input maxlength="60" size="30" name="friends_email4">

          <span class="label" style="MARGIN-LEFT: 3em"><nobr>First Name:</nobr>            </span>
          <input maxlength="30" name="friends_fname4" size="20"></td></tr>

        <tr>

          <td colspan="2">&nbsp;</td></tr>

        <tr>

          <td colspan="2">Have co-workers and friends you want to
            share funny videos with? Invite them to join!</td>
        </tr>

        <tr>

          <td align="right" colspan="2">&nbsp;</td></tr>

        <tr>

          <td align="right"><span class="label"><nobr>Email Address:</nobr>

          </span></td>

          <td><input type="hidden" name="type" value="Friends">
			<input maxlength="60" size="30" name="friends_email5">

          <span class="label" style="MARGIN-LEFT: 3em"><nobr>First Name:</nobr>

            </span><input maxlength="30" name="friends_fname5" size="20"></td></tr>

        <tr>

          <td align="right"><span class="label"><nobr>Email Address:</nobr>

          </span></td>

          <td><input type="hidden" name="type" value="Friends">
			<input maxlength="60" size="30" name="friends_email6">

          <span class="label" style="MARGIN-LEFT: 3em"><nobr>First Name:</nobr>

            </span><input maxlength="30" name="friends_fname6" size="20"></td></tr>

        <tr>

          <td align="right"><span class="label"><nobr>Email Address:</nobr>

          </span></td>

          <td><input type="hidden" name="type" value="Friends">
			<input maxlength="60" size="30" name="friends_email7">

          <span class="label" style="MARGIN-LEFT: 3em"><nobr>First Name:</nobr>

            </span><input maxlength="30" name="friends_fname7" size="20"></td></tr>

        <tr>

          <td align="right"><span class="label"><nobr>Email Address:</nobr>

          </span></td>

          <td><input type="hidden" name="type" value="Friends"><input maxlength="60" size="30" name="friends_email">

          <span class="label" style="MARGIN-LEFT: 3em"><nobr>First Name:</nobr>

            </span><input maxlength="30" name="friends_fname"></td></tr>

        <tr>

          <td style="FONT-SIZE: 1px" colspan="2">&nbsp;</td></tr>

        <tr valign="top">

          <td align="right"><span class="label">Your Message:</span></td>

          <td>

            <div class="formHighlight">Hello, <br><br>EpikTube is a
            great site for sharing and hosting personal videos. I have been
            <br>using EpikTube to share videos with my friends and family. I
            would like to add <br>you to the list of people I may share videos
            with. <br><br>Your personal message:  <br>
              <br>

            <textarea name="message" rows="5" cols="45">Have you heard about EpikTube? I love this site.</textarea>

            <br><br>
            	Thanks, <br>
            <?php echo htmlspecialchars($session['username']); ?> <br><br></div></td></tr>

        <tr>

          <td>&nbsp;</td>

          <td><input type="submit" value="Send Invites" name="invite_signup">

          </td>

        </tr>

        </tbody>

        </table>

        </form>

		
		</td>
	</tr>
</tbody></table>