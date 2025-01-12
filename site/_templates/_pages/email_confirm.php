<?php  
  if (!empty($email_err)) {
    alert($email_err, "error");
  }
if(!empty($captcha_err)) {
    alert($captcha_err, "error");    
    } ?> 
<form method="post" name="theForm" id="theForm">
<h3>Please Confirm Your Email</h3>

Before you can upload, we need to verify your email address. Please enter it below and click on send email, then check your email and click on the link provided to confirm your account. If you do not receive the confirmation email within a few minutes, please check your spam folder. If you do not verify the email within 24 hours, the code will become invalid.

<table width="100%" cellpadding="5" cellspacing="0" border="0">
	<form method="post">
		<tr>
			<td width="200" align="right"><span class="label">Send confirmation email to:</span></td>
			<td><input type="text" size="30" maxlength="60" name="field_verify_email" value="<?php echo (!empty($session['email'])) ? htmlspecialchars($session['email']) : ""; ?>"></td>
		</tr>
		<tr>
			<td align="right" valign="top"><span class="label">Captcha:</span></td>
			<td><img src="cimg.php?c=hwa823k" alt="Visual Captcha" ><br><input type="text" size="20" maxlength="6" name="field_verify_captcha" value=""></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="Send Email" name="submit"></td>
		</tr>
	</form>
</table>


		</div>
		</td>
	</tr>
</table>
</form>