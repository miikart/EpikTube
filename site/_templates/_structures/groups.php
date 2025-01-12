<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

<html>
<head>
	
	<title>EpikTube - Broadcast Yourself.</title>
	  
	<link rel="stylesheet" href="/styles" type="text/css">
	<link rel="stylesheet" href="/base.css" type="text/css">
    
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	
    <meta name="description" content="Share your videos with friends and family">
	<meta name="keywords" content="video,sharing,camera phone,video phone">

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

	<script type="text/javascript" src="/js/video_bar.js"></script>
	

	<script language="JavaScript">
			<?php if(getgroupmembers($group['gid']) > 0) { ?>
			onLoadFunctionList.push(function() { imagesInit_group_members();} );

		function imagesInit_group_members() {
			imageBrowsers['group_members'] = new ImageBrowser(5, 1, "group_members");
				<?php foreach($recentmembers as $members) { ?>
				imageBrowsers['group_members'].addImage(new etImage("<?php echo getlatestvideo($members['uid']) ?>", 
													  "/profile?user=<?php echo htmlspecialchars($members['username']) ?>",
													  "<?php echo htmlspecialchars($members['username']) ?>", 
													  "/profile?user=<?php echo htmlspecialchars($members['username']) ?>",
													  "",
													  "",
													  false) );
<?php } ?>
			imageBrowsers['group_members'].initDisplay();
			imageBrowsers['group_members'].showImages();
			images_loaded = true;
		}
<?php } ?>
	
	
	
	function checkAll(formObj, is_checked) 
	{
		for (var i=0;i < formObj.length;i++) {
			fldObj = formObj.elements[i];
			if (fldObj.type == 'checkbox') {
				fldObj.checked = is_checked;
			}
		}
	}
	function resetCheckAllValue(formObj, is_checked) {
		if(!is_checked) {
			main_checkbox = document.getElementById("checkall_checkbox");
			main_checkbox.checked = false;
		}
	}
	function confirmSubmit()
	{
		var agree=confirm("Are you sure you wish to continue?");
		if (agree)
			return true ;
		else
			return false ;
	}

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