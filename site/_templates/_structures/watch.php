<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

<html>
<head>
	
		<?php if(!isset($session) || ($session['branding'] != 2)) { ?>
	<title>EpikTube - Broadcast Yourself.</title>
	  
	<link rel="stylesheet" href="/styles" type="text/css">
	<link rel="stylesheet" href="/base.css" type="text/css">
    
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	

	<link rel="alternate" title="EpikTube - [RSS]" href="/rssls">
	
	<?php } ?>
	
	
	
<?php if(isset($session) && ($session['branding'] != 1)) { ?>

	
	<title>YouTube - Broadcast Yourself.</title>

	<link rel="stylesheet" href="/styles-YT.css" type="text/css">
	<link rel="stylesheet" href="/base-YT.css" type="text/css">

	<link rel="icon" href="/tube.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/tube.ico" type="image/x-icon">
	

	<link rel="alternate" title="YouTube - [RSS]" href="/rssls">
	
	<?php } ?>
	
	
    <meta name="title" content="<?php echo htmlspecialchars($video['title']) ?>">
    <meta name="description" content="<?php echo htmlspecialchars($video['description']); ?>">
	<meta name="keywords" content="<?php $tags = explode(" ", $video['tags']); $thelast = end($tags); foreach ($tags as $tag) {echo htmlspecialchars($tag); if ($tag !== $thelast) { echo ', '; } } ?>">

	<link rel="alternate" title="EpikTube - [RSS]" href="/rssls">
	
	<script language="javascript" type="text/javascript">
		onLoadFunctionList = new Array();
		function performOnLoadFunctions()
		{
			for (var i in onLoadFunctionList)
			{
				onLoadFunctionList[i]();
			}
		}
	</script>

 	        <script type="text/javascript" src="/flashobject.js"></script>
	    <script type="text/javascript" src="/js/components.js"></script>
	    <script type="text/javascript" src="/js/AJAX.js"></script>
	    <script type="text/javascript" src="/js/ui.js"></script>
	    <script type="text/javascript" src="/js/comments.js"></script>
	    <script type="text/javascript" src="/ruffle/ruffle.js"></script>
        
        <script language="javascript" type="text/javascript">
		function dropdown_jumpto(x)
		{
			if (document.share_dropdown.jumpmenu.value != "null")
			{
				document.location.href = x;
			}
		}
		
			onLoadFunctionList.push(function() { printCommentReplyForm('main_comment', '', true) } );
		side_imgs_loaded = false;

		

		</script>
        
           
</head>

<body onLoad="performOnLoadFunctions();">
	
	

<div id="baseDiv">

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/_templates/_layout/header.php"; ?>
<?php require_once "error_message.php"; ?>
<?php if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/_templates/_pages/".$_PAGE["Page"].".php")) { } require_once $_SERVER['DOCUMENT_ROOT'] . "/_templates/_pages/".$_PAGE["Page"].".php"; ?>
</div> <!-- end baseDiv -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/_templates/_layout/footer.php"; ?> 
</body>
</html>
