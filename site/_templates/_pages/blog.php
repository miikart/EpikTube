<br><br>
<?php
$previous = "";

foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $id = $row['id'];
    $title = $row['title'];
    $content = $row['content'];
    $date = $row['posted'];
    $author = $row['author'];
    $content = preg_replace('/(?<!\\\\)\^/', '<li>', $content);
    $content = str_replace('\\^', '^', $content);

    $raah = date("F, Y", strtotime($date));
    if ($raah !== $previous) {
        echo '
        <div style="padding: 0px 0px 5px 0px;border-bottom: 1px solid #CCC;margin-bottom: 10px;font-size: 14px;font-weight: bold;color: #CC6633;">' . $raah .'</div>
    ';
        $previous = $raah; 
    }
    ?>

    <div id="http://www.epiktube.xyz/blog?entry=<?php echo $row['id'] ?>">
        <?php if (!empty($title)) { ?>
            <h4><?php echo htmlspecialchars($title); ?></h4>
            <i><?php echo date("F j, Y", strtotime($date)); ?></i>
        <?php } ?>

        <?php echo nl2br($content); ?>
        <?php if (isset($_SESSION['uid']) && $_SESSION['uid'] != null) { ?>
            <?php if ($session['staff'] == 1) { ?>
                <p>(<a href="/blog?stuff_todelte=<?= $id ?>">Delete?</a>)</p>
            <?php } ?>
        <?php } ?>
        
        
        <a href="/blog?entry=<?php echo $row['id'] ?>">Permalink</a>: http://www.epiktube.xyz/blog?entry=<?php echo $row['id'] ?><br />
    </div>
    <br /><br /><hr /><br /><br />

<?php } ?>


<?php if(isset($_SESSION['uid']) && $_SESSION['uid'] != null) { ?>
<?php if($session['staff'] == 1) { ?>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let TypedContent = document.getElementsByName('field_blog_content')[0];

    let previewDiv = document.getElementById('preview_blog_text');

    TypedContent.addEventListener('input', function () {
        let content = TypedContent.value;
        content = content.replace(/(?<!\\)\^/, '<li>');
        content = content.replace(/\\(\^)/, '^');
        content = content.replace(/\n/g, '<br>');
        content = marked.parse(content);
        if(!content) {
        content = 'As you type into the textbox, the update will appear here.';
        }
        previewDiv.innerHTML = content;
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let inputField = document.getElementsByName('field_blog')[0];
    let previewDiv = document.getElementById('preview_blog_title');
    inputField.addEventListener('input', function () {
        let title = inputField.value;
        previewDiv.innerText = title;
    });
});
</script>
   <div class="tableSubTitle">Update</div>
   <div class="pageTable">
    <table width="100%" cellpadding="5" cellspacing="0" border="0">
    <strong>Tips:</strong>
    <li>Blog posts use Markdown (for webhook compatibility.)</li>
    <li>However, to create a list bullet, you should put in a <a href="https://en.wikipedia.org/wiki/Caret?useskin=monobook">caret</a> (<strong>^</strong>).</li>
    <li>To escape the bullet like in ":^)", just put a backslash before the caret.</li>
    <li>Then :\^) will turn into :^) when the blog is published.</li>
    <li>As you type, the "Preview Blog Post" box below will show your blog post exactly how it will be upon publication on the website.</li>
    <li>Save discord the trouble and if you really have to use js and html, encase them in &lt;no_hook&gt; tags :P</li>
    <p>
    <div class="codeArea">
    <div class="highlight">Preview Blog Post
    </div>
    <p><strong><span id='preview_blog_title'></span></strong>
    <div id="preview_blog_text">As you type into the textbox, this box will show how your update will look after being published on the site.</div></div>
	<form method="post">
	<tbody>
    <tr>
		<td width="200" align="right"><span class="label">Title:</span></td>
		<td><input type="text" size="30" maxlength="60" name="field_blog" placeholder="What's popping?"></td>
	</tr>
	<tr>
		<td align="right" valign="top"><span class="label"><span style="color:#f22b33;">*</span>&ensp;Content:</span></td>
		<td><textarea name="field_blog_content" cols="40" rows="4" placeholder="Tell us what's new."></textarea></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Post Blog"></td>
	</tr>
    </form>
</tbody></table>

</div>
    </div>
  <?php } ?>	 <?php } ?>		