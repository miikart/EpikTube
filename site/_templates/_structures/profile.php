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

<style type="text/css">
<?php if($profile['profileColor'] == "classic") { ?>
	.userTable {
	border: 1px solid #999999;
	background-color: #F4F4F4;
	width: 300px;
	}
	
	.spaceMaker {
	padding-top: 2px;
	}
		
	tr.rows td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	tr.connectRows td{
	padding-top: 3px;
	}
	
	tr.broadcastRow td {
	padding-top: 6px;
	padding-bottom: 6px;
	}
	
	tr.connectRowsTop td {
	padding-top: 8px;
	}
	
	tr.connectRowsBottom td {
	padding-top: 3px;
	padding-bottom: 8px;
	}

	tr.rowsLine td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	border-bottom: 1px solid #999999;
	}
	
	tr.rowsLineBottom td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	.profileTitles {
	font-family:  Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #999999;
	padding-top: 4px;
	padding-bottom: 4px;
	}
	
	.profileHeaders {
	background-color: #999999;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	color: #FFFFFF;
	padding-bottom: 3px;
	padding-top: 3px;
	}
	
	.aboutTable {
	width: 560px;
	border: 1px solid #999999;
	}
	
	.aboutImg {
	width: 140px;
	height: 108px;
	border: 2px solid #999999;
	}
	
	.bordersImg {
	border: 2px solid #999999;
	}
	
	.commentPostTable {
	width: 560px;
	border: 1px solid #999999;
	border: 1px solid #999999;
	}
	
	
	.videoPostTable {
	width: 560px;
	border: 1px solid #999999;
	padding-left: 15px;
	}
	
	.videoPostImg {
	width: 154px;
	height: 124px;
	border: 1px solid #999999;
	}
	
	
	.connectTable {
	border: 1px solid #999999;	
	width: 300px;
	}
	
	.topSpace {
	padding-top: 3px;
	}	
	
	.connectImages {
	padding-left: 3px;
	}
	
	.connectImages2 {
	padding-left: 2px;
	}

	
	.connectLinks {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	}
	
	.bulletinTable {
	width: 300px;
	border: 1px solid #999999;
	}
	
	tr.bulletin td {
	background-color: #F4F4F4;
	border-right: 1px solid #FFFFFF;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-left: 3px;
	padding-right: 3px;
	border-bottom: 1px solid #FFFFFF;
	}
	
	tr.bulletinTitle td {
	padding-top: 3px;
	padding-bottom: 3px;
	border-bottom: 1px solid #999999;
	}
	
	tr.bulletinPost td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #999999;
	}
	
	tr.commentsMsg td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #999999;
	background-color: #F4F4F4;
	}
	
	td.buttonPost {
	padding-top: 4px;
	padding-bottom: 4px;
	border-top: 1px solid #999999;
	}
	
	td.bulletinTopFirstCells {
	border-right: 1px solid #999999;
	border-bottom: none;
	}
	
	td.checkBoxSection {
	background-color: #F4F4F4;
	width: 15px;
	border-right: 1px solid #999999;
	}
		
	
	.bulletinSmallImg {
	padding-left: 5px;
	}
	
	.commentsImg {
	width: 60px;
	border: 2px solid #999999;
	}
	
	tr.comments td{
	border-bottom: 1px solid #999999;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	.bulletinReadTable {
	width: 560px;
	border: 1px solid #999999;
	}
	
	td.bulletinRead {
	background-color: #F4F4F4;
	border-right: 1px solid #999999;
	border-bottom: 1px solid #999999;
	}
	
	td.bulletinReadBottom {
	background-color: #F4F4F4;
	border-right: 1px solid #999999;
	}
	
	
	td.bulletinReadLast {
	background-color: #F4F4F4;
	border-bottom: 1px solid #999999;
	}
	
	
	tr.emptyBulletin td{
	background-color: #F4F4F4;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	td.leftBg {
	background-color: #F4F4F4;
	border-right: 1px solid #999999;
	}
	

	a.edit:link {color: white; text-decoration: underline; }
	a.edit:visited {color: white; text-decoration: underline; }
	a.edit:hover {color: white; text-decoration: underline; }
	a.edit:active {color: white; text-decoration: underline; } 


	
	td.bulletinReadRight {
	border-bottom: 1px solid #999999;
	}
	
	
	td.bulletinReadRightBottom {
	border-bottom: none;
	}
	
	td.bulletinReadBottom {
	background-color: #F4F4F4;
	border-right: 1px solid #999999;
	border-bottom: none;
	}
	
	tr.bulletinCols td {
	border-bottom: 1px solid #999999;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	td.bulletinData {
	border-right: 1px solid #999999;
	padding-bottom: 5px;
	padding-right: 3px;
	padding-left: 3px;
	}
<?php } elseif($profile['profileColor'] == "blue") { ?>
	.userTable {
	border: 1px solid #6b8ab8;
	background-color: #ebeff0;
	width: 300px;
	}
	
	.spaceMaker {
	padding-top: 2px;
	}
		
	tr.rows td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	tr.connectRows td{
	padding-top: 3px;
	}
	
	tr.broadcastRow td {
	padding-top: 6px;
	padding-bottom: 6px;
	}
	
	tr.connectRowsTop td {
	padding-top: 8px;
	}
	
	tr.connectRowsBottom td {
	padding-top: 3px;
	padding-bottom: 8px;
	}

	tr.rowsLine td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	border-bottom: 1px solid #6b8ab8;
	}
	
	tr.rowsLineBottom td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	.profileTitles {
	font-family:  Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #6b8ab8;
	padding-top: 4px;
	padding-bottom: 4px;
	}
	
	.profileHeaders {
	background-color: #6b8ab8;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	color: #FFFFFF;
	padding-bottom: 3px;
	padding-top: 3px;
	}
	
	.aboutTable {
	width: 560px;
	border: 1px solid #6b8ab8;
	}
	
	.aboutImg {
	width: 140px;
	height: 108px;
	border: 2px solid #6b8ab8;
	}
	
	.bordersImg {
	border: 2px solid #6b8ab8;
	}
	
	.commentPostTable {
	width: 560px;
	border: 1px solid #6b8ab8;
	border: 1px solid #6b8ab8;
	}
	
	
	.videoPostTable {
	width: 560px;
	border: 1px solid #6b8ab8;
	padding-left: 15px;
	}
	
	.videoPostImg {
	width: 154px;
	height: 124px;
	border: 1px solid #6b8ab8;
	}
	
	
	.connectTable {
	border: 1px solid #6b8ab8;	
	width: 300px;
	}
	
	.topSpace {
	padding-top: 3px;
	}	
	
	.connectImages {
	padding-left: 3px;
	}
	
	.connectImages2 {
	padding-left: 2px;
	}

	
	.connectLinks {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	}
	
	.bulletinTable {
	width: 300px;
	border: 1px solid #6b8ab8;
	}
	
	tr.bulletin td {
	background-color: #ebeff0;
	border-right: 1px solid #FFFFFF;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-left: 3px;
	padding-right: 3px;
	border-bottom: 1px solid #FFFFFF;
	}
	
	tr.bulletinTitle td {
	padding-top: 3px;
	padding-bottom: 3px;
	border-bottom: 1px solid #6b8ab8;
	}
	
	tr.bulletinPost td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #6b8ab8;
	}
	
	tr.commentsMsg td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #6b8ab8;
	background-color: #ebeff0;
	}
	
	td.buttonPost {
	padding-top: 4px;
	padding-bottom: 4px;
	border-top: 1px solid #6b8ab8;
	}
	
	td.bulletinTopFirstCells {
	border-right: 1px solid #6b8ab8;
	border-bottom: none;
	}
	
	td.checkBoxSection {
	background-color: #ebeff0;
	width: 15px;
	border-right: 1px solid #6b8ab8;
	}
		
	
	.bulletinSmallImg {
	padding-left: 5px;
	}
	
	.commentsImg {
	width: 60px;
	border: 2px solid #6b8ab8;
	}
	
	tr.comments td{
	border-bottom: 1px solid #6b8ab8;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	.bulletinReadTable {
	width: 560px;
	border: 1px solid #6b8ab8;
	}
	
	td.bulletinRead {
	background-color: #ebeff0;
	border-right: 1px solid #6b8ab8;
	border-bottom: 1px solid #6b8ab8;
	}
	
	td.bulletinReadBottom {
	background-color: #ebeff0;
	border-right: 1px solid #6b8ab8;
	}
	
	
	td.bulletinReadLast {
	background-color: #ebeff0;
	border-bottom: 1px solid #6b8ab8;
	}
	
	
	tr.emptyBulletin td{
	background-color: #ebeff0;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	td.leftBg {
	background-color: #ebeff0;
	border-right: 1px solid #6b8ab8;
	}
	

	a.edit:link {color: white; text-decoration: underline; }
	a.edit:visited {color: white; text-decoration: underline; }
	a.edit:hover {color: white; text-decoration: underline; }
	a.edit:active {color: white; text-decoration: underline; } 


	
	td.bulletinReadRight {
	border-bottom: 1px solid #6b8ab8;
	}
	
	
	td.bulletinReadRightBottom {
	border-bottom: none;
	}
	
	td.bulletinReadBottom {
	background-color: #ebeff0;
	border-right: 1px solid #6b8ab8;
	border-bottom: none;
	}
	
	tr.bulletinCols td {
	border-bottom: 1px solid #6b8ab8;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	td.bulletinData {
	border-right: 1px solid #6b8ab8;
	padding-bottom: 5px;
	padding-right: 3px;
	padding-left: 3px;
	}
<?php } elseif($profile['profileColor'] == "cyan") { ?>
	.userTable {
	border: 1px solid #3399CC;
	background-color: #ECF4FB;
	width: 300px;
	}
	
	.spaceMaker {
	padding-top: 2px;
	}
		
	tr.rows td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	tr.connectRows td{
	padding-top: 3px;
	}
	
	tr.broadcastRow td {
	padding-top: 6px;
	padding-bottom: 6px;
	}
	
	tr.connectRowsTop td {
	padding-top: 8px;
	}
	
	tr.connectRowsBottom td {
	padding-top: 3px;
	padding-bottom: 8px;
	}

	tr.rowsLine td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	border-bottom: 1px solid #3399CC;
	}
	
	tr.rowsLineBottom td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	.profileTitles {
	font-family:  Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #69A6DC;
	padding-top: 4px;
	padding-bottom: 4px;
	}
	
	.profileHeaders {
	background-color: #3399CC;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	color: #FFFFFF;
	padding-bottom: 3px;
	padding-top: 3px;
	}
	
	.aboutTable {
	width: 560px;
	border: 1px solid #3399CC;
	}
	
	.aboutImg {
	width: 140px;
	height: 108px;
	border: 2px solid #3399CC;
	}
	
	.bordersImg {
	border: 2px solid #3399CC;
	}
	
	.commentPostTable {
	width: 560px;
	border: 1px solid #3399CC;
	border: 1px solid #3399CC;
	}
	
	
	.videoPostTable {
	width: 560px;
	border: 1px solid #3399CC;
	padding-left: 15px;
	}
	
	.videoPostImg {
	width: 154px;
	height: 124px;
	border: 1px solid #3399CC;
	}
	
	
	.connectTable {
	border: 1px solid #3399CC;	
	width: 300px;
	}
	
	.topSpace {
	padding-top: 3px;
	}	
	
	.connectImages {
	padding-left: 3px;
	}
	
	.connectImages2 {
	padding-left: 2px;
	}

	
	.connectLinks {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	}
	
	.bulletinTable {
	width: 300px;
	border: 1px solid #3399CC;
	}
	
	tr.bulletin td {
	background-color: #ECF4FB;
	border-right: 1px solid #FFFFFF;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-left: 3px;
	padding-right: 3px;
	border-bottom: 1px solid #FFFFFF;
	}
	
	tr.bulletinTitle td {
	padding-top: 3px;
	padding-bottom: 3px;
	border-bottom: 1px solid #3399CC;
	}
	
	tr.bulletinPost td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #3399CC;
	}
	
	tr.commentsMsg td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #3399CC;
	background-color: #ECF4FB;
	}
	
	td.buttonPost {
	padding-top: 4px;
	padding-bottom: 4px;
	border-top: 1px solid #3399CC;
	}
	
	td.bulletinTopFirstCells {
	border-right: 1px solid #3399CC;
	border-bottom: none;
	}
	
	td.checkBoxSection {
	background-color: #ECF4FB;
	width: 15px;
	border-right: 1px solid #3399CC;
	}
		
	
	.bulletinSmallImg {
	padding-left: 5px;
	}
	
	.commentsImg {
	width: 60px;
	border: 2px solid #3399CC;
	}
	
	tr.comments td{
	border-bottom: 1px solid #3399CC;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	.bulletinReadTable {
	width: 560px;
	border: 1px solid #3399CC;
	}
	
	td.bulletinRead {
	background-color: #ECF4FB;
	border-right: 1px solid #3399CC;
	border-bottom: 1px solid #3399CC;
	}
	
	td.bulletinReadBottom {
	background-color: #ECF4FB;
	border-right: 1px solid #3399CC;
	}
	
	
	td.bulletinReadLast {
	background-color: #ECF4FB;
	border-bottom: 1px solid #3399CC;
	}
	
	
	tr.emptyBulletin td{
	background-color: #ECF4FB;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	td.leftBg {
	background-color: #ECF4FB;
	border-right: 1px solid #3399CC;
	}
	

	a.edit:link {color: white; text-decoration: underline; }
	a.edit:visited {color: white; text-decoration: underline; }
	a.edit:hover {color: white; text-decoration: underline; }
	a.edit:active {color: white; text-decoration: underline; } 


	
	td.bulletinReadRight {
	border-bottom: 1px solid #3399CC;
	}
	
	
	td.bulletinReadRightBottom {
	border-bottom: none;
	}
	
	td.bulletinReadBottom {
	background-color: #ECF4FB;
	border-right: 1px solid #3399CC;
	border-bottom: none;
	}
	
	tr.bulletinCols td {
	border-bottom: 1px solid #3399CC;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	td.bulletinData {
	border-right: 1px solid #3399CC;
	padding-bottom: 5px;
	padding-right: 3px;
	padding-left: 3px;
	}
<?php } elseif($profile['profileColor'] == "gray") { ?>
	.userTable {
	border: 1px solid #666666;
	background-color: #999;
	width: 300px;
	}
	
	.spaceMaker {
	padding-top: 2px;
	}
		
	tr.rows td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	tr.connectRows td{
	padding-top: 3px;
	}
	
	tr.broadcastRow td {
	padding-top: 6px;
	padding-bottom: 6px;
	}
	
	tr.connectRowsTop td {
	padding-top: 8px;
	}
	
	tr.connectRowsBottom td {
	padding-top: 3px;
	padding-bottom: 8px;
	}

	tr.rowsLine td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	border-bottom: 1px solid #666666;
	}
	
	tr.rowsLineBottom td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	.profileTitles {
	font-family:  Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #666666;
	padding-top: 4px;
	padding-bottom: 4px;
	}
	
	.profileHeaders {
	background-color: #666666;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	color: #FFFFFF;
	padding-bottom: 3px;
	padding-top: 3px;
	}
	
	.aboutTable {
	width: 560px;
	border: 1px solid #666666;
	}
	
	.aboutImg {
	width: 140px;
	height: 108px;
	border: 2px solid #666666;
	}
	
	.bordersImg {
	border: 2px solid #666666;
	}
	
	.commentPostTable {
	width: 560px;
	border: 1px solid #666666;
	border: 1px solid #666666;
	}
	
	
	.videoPostTable {
	width: 560px;
	border: 1px solid #666666;
	padding-left: 15px;
	}
	
	.videoPostImg {
	width: 154px;
	height: 124px;
	border: 1px solid #666666;
	}
	
	
	.connectTable {
	border: 1px solid #666666;	
	width: 300px;
	}
	
	.topSpace {
	padding-top: 3px;
	}	
	
	.connectImages {
	padding-left: 3px;
	}
	
	.connectImages2 {
	padding-left: 2px;
	}

	
	.connectLinks {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	}
	
	.bulletinTable {
	width: 300px;
	border: 1px solid #666666;
	}
	
	tr.bulletin td {
	background-color: #999;
	border-right: 1px solid #FFFFFF;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-left: 3px;
	padding-right: 3px;
	border-bottom: 1px solid #FFFFFF;
	}
	
	tr.bulletinTitle td {
	padding-top: 3px;
	padding-bottom: 3px;
	border-bottom: 1px solid #666666;
	}
	
	tr.bulletinPost td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #666666;
	}
	
	tr.commentsMsg td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #666666;
	background-color: #999;
	}
	
	td.buttonPost {
	padding-top: 4px;
	padding-bottom: 4px;
	border-top: 1px solid #666666;
	}
	
	td.bulletinTopFirstCells {
	border-right: 1px solid #666666;
	border-bottom: none;
	}
	
	td.checkBoxSection {
	background-color: #999;
	width: 15px;
	border-right: 1px solid #666666;
	}
		
	
	.bulletinSmallImg {
	padding-left: 5px;
	}
	
	.commentsImg {
	width: 60px;
	border: 2px solid #666666;
	}
	
	tr.comments td{
	border-bottom: 1px solid #666666;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	.bulletinReadTable {
	width: 560px;
	border: 1px solid #666666;
	}
	
	td.bulletinRead {
	background-color: #999;
	border-right: 1px solid #666666;
	border-bottom: 1px solid #666666;
	}
	
	td.bulletinReadBottom {
	background-color: #999;
	border-right: 1px solid #666666;
	}
	
	
	td.bulletinReadLast {
	background-color: #999;
	border-bottom: 1px solid #666666;
	}
	
	
	tr.emptyBulletin td{
	background-color: #999;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	td.leftBg {
	background-color: #999;
	border-right: 1px solid #666666;
	}
	

	a.edit:link {color: white; text-decoration: underline; }
	a.edit:visited {color: white; text-decoration: underline; }
	a.edit:hover {color: white; text-decoration: underline; }
	a.edit:active {color: white; text-decoration: underline; } 


	
	td.bulletinReadRight {
	border-bottom: 1px solid #666666;
	}
	
	
	td.bulletinReadRightBottom {
	border-bottom: none;
	}
	
	td.bulletinReadBottom {
	background-color: #999;
	border-right: 1px solid #666666;
	border-bottom: none;
	}
	
	tr.bulletinCols td {
	border-bottom: 1px solid #666666;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	td.bulletinData {
	border-right: 1px solid #666666;
	padding-bottom: 5px;
	padding-right: 3px;
	padding-left: 3px;
	}
<?php } elseif($profile['profileColor'] == "green") { ?>
	.userTable {
	border: 1px solid #009900;
	background-color: #00CC66;
	width: 300px;
	}
	
	.spaceMaker {
	padding-top: 2px;
	}
		
	tr.rows td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	tr.connectRows td{
	padding-top: 3px;
	}
	
	tr.broadcastRow td {
	padding-top: 6px;
	padding-bottom: 6px;
	}
	
	tr.connectRowsTop td {
	padding-top: 8px;
	}
	
	tr.connectRowsBottom td {
	padding-top: 3px;
	padding-bottom: 8px;
	}

	tr.rowsLine td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	border-bottom: 1px solid #009900;
	}
	
	tr.rowsLineBottom td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	.profileTitles {
	font-family:  Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #009900;
	padding-top: 4px;
	padding-bottom: 4px;
	}
	
	.profileHeaders {
	background-color: #009900;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	color: #FFFFFF;
	padding-bottom: 3px;
	padding-top: 3px;
	}
	
	.aboutTable {
	width: 560px;
	border: 1px solid #009900;
	}
	
	.aboutImg {
	width: 140px;
	height: 108px;
	border: 2px solid #009900;
	}
	
	.bordersImg {
	border: 2px solid #009900;
	}
	
	.commentPostTable {
	width: 560px;
	border: 1px solid #009900;
	border: 1px solid #009900;
	}
	
	
	.videoPostTable {
	width: 560px;
	border: 1px solid #009900;
	padding-left: 15px;
	}
	
	.videoPostImg {
	width: 154px;
	height: 124px;
	border: 1px solid #009900;
	}
	
	
	.connectTable {
	border: 1px solid #009900;	
	width: 300px;
	}
	
	.topSpace {
	padding-top: 3px;
	}	
	
	.connectImages {
	padding-left: 3px;
	}
	
	.connectImages2 {
	padding-left: 2px;
	}

	
	.connectLinks {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	}
	
	.bulletinTable {
	width: 300px;
	border: 1px solid #009900;
	}
	
	tr.bulletin td {
	background-color: #00CC66;
	border-right: 1px solid #FFFFFF;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-left: 3px;
	padding-right: 3px;
	border-bottom: 1px solid #FFFFFF;
	}
	
	tr.bulletinTitle td {
	padding-top: 3px;
	padding-bottom: 3px;
	border-bottom: 1px solid #009900;
	}
	
	tr.bulletinPost td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #009900;
	}
	
	tr.commentsMsg td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #009900;
	background-color: #00CC66;
	}
	
	td.buttonPost {
	padding-top: 4px;
	padding-bottom: 4px;
	border-top: 1px solid #009900;
	}
	
	td.bulletinTopFirstCells {
	border-right: 1px solid #009900;
	border-bottom: none;
	}
	
	td.checkBoxSection {
	background-color: #00CC66;
	width: 15px;
	border-right: 1px solid #009900;
	}
		
	
	.bulletinSmallImg {
	padding-left: 5px;
	}
	
	.commentsImg {
	width: 60px;
	border: 2px solid #009900;
	}
	
	tr.comments td{
	border-bottom: 1px solid #009900;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	.bulletinReadTable {
	width: 560px;
	border: 1px solid #009900;
	}
	
	td.bulletinRead {
	background-color: #00CC66;
	border-right: 1px solid #009900;
	border-bottom: 1px solid #009900;
	}
	
	td.bulletinReadBottom {
	background-color: #00CC66;
	border-right: 1px solid #009900;
	}
	
	
	td.bulletinReadLast {
	background-color: #00CC66;
	border-bottom: 1px solid #009900;
	}
	
	
	tr.emptyBulletin td{
	background-color: #00CC66;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	td.leftBg {
	background-color: #00CC66;
	border-right: 1px solid #009900;
	}
	

	a.edit:link {color: white; text-decoration: underline; }
	a.edit:visited {color: white; text-decoration: underline; }
	a.edit:hover {color: white; text-decoration: underline; }
	a.edit:active {color: white; text-decoration: underline; } 


	
	td.bulletinReadRight {
	border-bottom: 1px solid #009900;
	}
	
	
	td.bulletinReadRightBottom {
	border-bottom: none;
	}
	
	td.bulletinReadBottom {
	background-color: #00CC66;
	border-right: 1px solid #009900;
	border-bottom: none;
	}
	
	tr.bulletinCols td {
	border-bottom: 1px solid #009900;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	td.bulletinData {
	border-right: 1px solid #009900;
	padding-bottom: 5px;
	padding-right: 3px;
	padding-left: 3px;
	}
<?php } elseif($profile['profileColor'] == "orange") { ?>
	.userTable {
	border: 1px solid #fdbe00;
	background-color: #f7f8e6;
	width: 300px;
	}
	
	.spaceMaker {
	padding-top: 2px;
	}
		
	tr.rows td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	tr.connectRows td{
	padding-top: 3px;
	}
	
	tr.broadcastRow td {
	padding-top: 6px;
	padding-bottom: 6px;
	}
	
	tr.connectRowsTop td {
	padding-top: 8px;
	}
	
	tr.connectRowsBottom td {
	padding-top: 3px;
	padding-bottom: 8px;
	}

	tr.rowsLine td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	border-bottom: 1px solid #fdbe00;
	}
	
	tr.rowsLineBottom td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	.profileTitles {
	font-family:  Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #daa501;
	padding-top: 4px;
	padding-bottom: 4px;
	}
	
	.profileHeaders {
	background-color: #fdbe00;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	color: #FFFFFF;
	padding-bottom: 3px;
	padding-top: 3px;
	}
	
	.aboutTable {
	width: 560px;
	border: 1px solid #fdbe00;
	}
	
	.aboutImg {
	width: 140px;
	height: 108px;
	border: 2px solid #fdbe00;
	}
	
	.bordersImg {
	border: 2px solid #fdbe00;
	}
	
	.commentPostTable {
	width: 560px;
	border: 1px solid #fdbe00;
	border: 1px solid #fdbe00;
	}
	
	
	.videoPostTable {
	width: 560px;
	border: 1px solid #fdbe00;
	padding-left: 15px;
	}
	
	.videoPostImg {
	width: 154px;
	height: 124px;
	border: 1px solid #fdbe00;
	}
	
	
	.connectTable {
	border: 1px solid #fdbe00;	
	width: 300px;
	}
	
	.topSpace {
	padding-top: 3px;
	}	
	
	.connectImages {
	padding-left: 3px;
	}
	
	.connectImages2 {
	padding-left: 2px;
	}

	
	.connectLinks {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	}
	
	.bulletinTable {
	width: 300px;
	border: 1px solid #fdbe00;
	}
	
	tr.bulletin td {
	background-color: #f7f8e6;
	border-right: 1px solid #FFFFFF;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-left: 3px;
	padding-right: 3px;
	border-bottom: 1px solid #FFFFFF;
	}
	
	tr.bulletinTitle td {
	padding-top: 3px;
	padding-bottom: 3px;
	border-bottom: 1px solid #fdbe00;
	}
	
	tr.bulletinPost td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #fdbe00;
	}
	
	tr.commentsMsg td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #fdbe00;
	background-color: #f7f8e6;
	}
	
	td.buttonPost {
	padding-top: 4px;
	padding-bottom: 4px;
	border-top: 1px solid #fdbe00;
	}
	
	td.bulletinTopFirstCells {
	border-right: 1px solid #fdbe00;
	border-bottom: none;
	}
	
	td.checkBoxSection {
	background-color: #f7f8e6;
	width: 15px;
	border-right: 1px solid #fdbe00;
	}
		
	
	.bulletinSmallImg {
	padding-left: 5px;
	}
	
	.commentsImg {
	width: 60px;
	border: 2px solid #fdbe00;
	}
	
	tr.comments td{
	border-bottom: 1px solid #fdbe00;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	.bulletinReadTable {
	width: 560px;
	border: 1px solid #fdbe00;
	}
	
	td.bulletinRead {
	background-color: #f7f8e6;
	border-right: 1px solid #fdbe00;
	border-bottom: 1px solid #fdbe00;
	}
	
	td.bulletinReadBottom {
	background-color: #f7f8e6;
	border-right: 1px solid #fdbe00;
	}
	
	
	td.bulletinReadLast {
	background-color: #f7f8e6;
	border-bottom: 1px solid #fdbe00;
	}
	
	
	tr.emptyBulletin td{
	background-color: #f7f8e6;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	td.leftBg {
	background-color: #f7f8e6;
	border-right: 1px solid #fdbe00;
	}
	

	a.edit:link {color: white; text-decoration: underline; }
	a.edit:visited {color: white; text-decoration: underline; }
	a.edit:hover {color: white; text-decoration: underline; }
	a.edit:active {color: white; text-decoration: underline; } 


	
	td.bulletinReadRight {
	border-bottom: 1px solid #fdbe00;
	}
	
	
	td.bulletinReadRightBottom {
	border-bottom: none;
	}
	
	td.bulletinReadBottom {
	background-color: #f7f8e6;
	border-right: 1px solid #fdbe00;
	border-bottom: none;
	}
	
	tr.bulletinCols td {
	border-bottom: 1px solid #fdbe00;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	td.bulletinData {
	border-right: 1px solid #fdbe00;
	padding-bottom: 5px;
	padding-right: 3px;
	padding-left: 3px;
	}
<?php } elseif($profile['profileColor'] == "pink") { ?>
	.userTable {
	border: 1px solid #e9799f;
	background-color: #fae3eb;
	width: 300px;
	}
	
	.spaceMaker {
	padding-top: 2px;
	}
		
	tr.rows td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	tr.connectRows td{
	padding-top: 3px;
	}
	
	tr.broadcastRow td {
	padding-top: 6px;
	padding-bottom: 6px;
	}
	
	tr.connectRowsTop td {
	padding-top: 8px;
	}
	
	tr.connectRowsBottom td {
	padding-top: 3px;
	padding-bottom: 8px;
	}

	tr.rowsLine td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	border-bottom: 1px solid #e9799f;
	}
	
	tr.rowsLineBottom td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	.profileTitles {
	font-family:  Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #e9799f;
	padding-top: 4px;
	padding-bottom: 4px;
	}
	
	.profileHeaders {
	background-color: #e9799f;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	color: #FFFFFF;
	padding-bottom: 3px;
	padding-top: 3px;
	}
	
	.aboutTable {
	width: 560px;
	border: 1px solid #e9799f;
	}
	
	.aboutImg {
	width: 140px;
	height: 108px;
	border: 2px solid #e9799f;
	}
	
	.bordersImg {
	border: 2px solid #e9799f;
	}
	
	.commentPostTable {
	width: 560px;
	border: 1px solid #e9799f;
	border: 1px solid #e9799f;
	}
	
	
	.videoPostTable {
	width: 560px;
	border: 1px solid #e9799f;
	padding-left: 15px;
	}
	
	.videoPostImg {
	width: 154px;
	height: 124px;
	border: 1px solid #e9799f;
	}
	
	
	.connectTable {
	border: 1px solid #e9799f;	
	width: 300px;
	}
	
	.topSpace {
	padding-top: 3px;
	}	
	
	.connectImages {
	padding-left: 3px;
	}
	
	.connectImages2 {
	padding-left: 2px;
	}

	
	.connectLinks {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	}
	
	.bulletinTable {
	width: 300px;
	border: 1px solid #e9799f;
	}
	
	tr.bulletin td {
	background-color: #fae3eb;
	border-right: 1px solid #FFFFFF;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-left: 3px;
	padding-right: 3px;
	border-bottom: 1px solid #FFFFFF;
	}
	
	tr.bulletinTitle td {
	padding-top: 3px;
	padding-bottom: 3px;
	border-bottom: 1px solid #e9799f;
	}
	
	tr.bulletinPost td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #e9799f;
	}
	
	tr.commentsMsg td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #e9799f;
	background-color: #fae3eb;
	}
	
	td.buttonPost {
	padding-top: 4px;
	padding-bottom: 4px;
	border-top: 1px solid #e9799f;
	}
	
	td.bulletinTopFirstCells {
	border-right: 1px solid #e9799f;
	border-bottom: none;
	}
	
	td.checkBoxSection {
	background-color: #fae3eb;
	width: 15px;
	border-right: 1px solid #e9799f;
	}
		
	
	.bulletinSmallImg {
	padding-left: 5px;
	}
	
	.commentsImg {
	width: 60px;
	border: 2px solid #e9799f;
	}
	
	tr.comments td{
	border-bottom: 1px solid #e9799f;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	.bulletinReadTable {
	width: 560px;
	border: 1px solid #e9799f;
	}
	
	td.bulletinRead {
	background-color: #fae3eb;
	border-right: 1px solid #e9799f;
	border-bottom: 1px solid #e9799f;
	}
	
	td.bulletinReadBottom {
	background-color: #fae3eb;
	border-right: 1px solid #e9799f;
	}
	
	
	td.bulletinReadLast {
	background-color: #fae3eb;
	border-bottom: 1px solid #e9799f;
	}
	
	
	tr.emptyBulletin td{
	background-color: #fae3eb;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	td.leftBg {
	background-color: #fae3eb;
	border-right: 1px solid #e9799f;
	}
	

	a.edit:link {color: white; text-decoration: underline; }
	a.edit:visited {color: white; text-decoration: underline; }
	a.edit:hover {color: white; text-decoration: underline; }
	a.edit:active {color: white; text-decoration: underline; } 


	
	td.bulletinReadRight {
	border-bottom: 1px solid #e9799f;
	}
	
	
	td.bulletinReadRightBottom {
	border-bottom: none;
	}
	
	td.bulletinReadBottom {
	background-color: #fae3eb;
	border-right: 1px solid #e9799f;
	border-bottom: none;
	}
	
	tr.bulletinCols td {
	border-bottom: 1px solid #e9799f;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	td.bulletinData {
	border-right: 1px solid #e9799f;
	padding-bottom: 5px;
	padding-right: 3px;
	padding-left: 3px;
	}
<?php } elseif($profile['profileColor'] == "purple") { ?>
	.userTable {
	border: 1px solid #9560ca;
	background-color: #eae1f4;
	width: 300px;
	}
	
	.spaceMaker {
	padding-top: 2px;
	}
		
	tr.rows td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	tr.connectRows td{
	padding-top: 3px;
	}
	
	tr.broadcastRow td {
	padding-top: 6px;
	padding-bottom: 6px;
	}
	
	tr.connectRowsTop td {
	padding-top: 8px;
	}
	
	tr.connectRowsBottom td {
	padding-top: 3px;
	padding-bottom: 8px;
	}

	tr.rowsLine td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	border-bottom: 1px solid #9560ca;
	}
	
	tr.rowsLineBottom td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	.profileTitles {
	font-family:  Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #9560ca;
	padding-top: 4px;
	padding-bottom: 4px;
	}
	
	.profileHeaders {
	background-color: #9560ca;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	color: #FFFFFF;
	padding-bottom: 3px;
	padding-top: 3px;
	}
	
	.aboutTable {
	width: 560px;
	border: 1px solid #9560ca;
	}
	
	.aboutImg {
	width: 140px;
	height: 108px;
	border: 2px solid #9560ca;
	}
	
	.bordersImg {
	border: 2px solid #9560ca;
	}
	
	.commentPostTable {
	width: 560px;
	border: 1px solid #9560ca;
	border: 1px solid #9560ca;
	}
	
	
	.videoPostTable {
	width: 560px;
	border: 1px solid #9560ca;
	padding-left: 15px;
	}
	
	.videoPostImg {
	width: 154px;
	height: 124px;
	border: 1px solid #9560ca;
	}
	
	
	.connectTable {
	border: 1px solid #9560ca;	
	width: 300px;
	}
	
	.topSpace {
	padding-top: 3px;
	}	
	
	.connectImages {
	padding-left: 3px;
	}
	
	.connectImages2 {
	padding-left: 2px;
	}

	
	.connectLinks {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	}
	
	.bulletinTable {
	width: 300px;
	border: 1px solid #9560ca;
	}
	
	tr.bulletin td {
	background-color: #eae1f4;
	border-right: 1px solid #FFFFFF;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-left: 3px;
	padding-right: 3px;
	border-bottom: 1px solid #FFFFFF;
	}
	
	tr.bulletinTitle td {
	padding-top: 3px;
	padding-bottom: 3px;
	border-bottom: 1px solid #9560ca;
	}
	
	tr.bulletinPost td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #9560ca;
	}
	
	tr.commentsMsg td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #9560ca;
	background-color: #eae1f4;
	}
	
	td.buttonPost {
	padding-top: 4px;
	padding-bottom: 4px;
	border-top: 1px solid #9560ca;
	}
	
	td.bulletinTopFirstCells {
	border-right: 1px solid #9560ca;
	border-bottom: none;
	}
	
	td.checkBoxSection {
	background-color: #eae1f4;
	width: 15px;
	border-right: 1px solid #9560ca;
	}
		
	
	.bulletinSmallImg {
	padding-left: 5px;
	}
	
	.commentsImg {
	width: 60px;
	border: 2px solid #9560ca;
	}
	
	tr.comments td{
	border-bottom: 1px solid #9560ca;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	.bulletinReadTable {
	width: 560px;
	border: 1px solid #9560ca;
	}
	
	td.bulletinRead {
	background-color: #eae1f4;
	border-right: 1px solid #9560ca;
	border-bottom: 1px solid #9560ca;
	}
	
	td.bulletinReadBottom {
	background-color: #eae1f4;
	border-right: 1px solid #9560ca;
	}
	
	
	td.bulletinReadLast {
	background-color: #eae1f4;
	border-bottom: 1px solid #9560ca;
	}
	
	
	tr.emptyBulletin td{
	background-color: #eae1f4;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	td.leftBg {
	background-color: #eae1f4;
	border-right: 1px solid #9560ca;
	}
	

	a.edit:link {color: white; text-decoration: underline; }
	a.edit:visited {color: white; text-decoration: underline; }
	a.edit:hover {color: white; text-decoration: underline; }
	a.edit:active {color: white; text-decoration: underline; } 


	
	td.bulletinReadRight {
	border-bottom: 1px solid #9560ca;
	}
	
	
	td.bulletinReadRightBottom {
	border-bottom: none;
	}
	
	td.bulletinReadBottom {
	background-color: #eae1f4;
	border-right: 1px solid #9560ca;
	border-bottom: none;
	}
	
	tr.bulletinCols td {
	border-bottom: 1px solid #9560ca;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	td.bulletinData {
	border-right: 1px solid #9560ca;
	padding-bottom: 5px;
	padding-right: 3px;
	padding-left: 3px;
	}
<?php } elseif($profile['profileColor'] == "red") { ?>
	.userTable {
	border: 1px solid #cd311b;
	background-color: #f8e0e0;
	width: 300px;
	}
	
	.spaceMaker {
	padding-top: 2px;
	}
		
	tr.rows td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	tr.connectRows td{
	padding-top: 3px;
	}
	
	tr.broadcastRow td {
	padding-top: 6px;
	padding-bottom: 6px;
	}
	
	tr.connectRowsTop td {
	padding-top: 8px;
	}
	
	tr.connectRowsBottom td {
	padding-top: 3px;
	padding-bottom: 8px;
	}

	tr.rowsLine td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	border-bottom: 1px solid #cd311b;
	}
	
	tr.rowsLineBottom td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	.profileTitles {
	font-family:  Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #cd311b;
	padding-top: 4px;
	padding-bottom: 4px;
	}
	
	.profileHeaders {
	background-color: #cd311b;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	color: #FFFFFF;
	padding-bottom: 3px;
	padding-top: 3px;
	}
	
	.aboutTable {
	width: 560px;
	border: 1px solid #cd311b;
	}
	
	.aboutImg {
	width: 140px;
	height: 108px;
	border: 2px solid #cd311b;
	}
	
	.bordersImg {
	border: 2px solid #cd311b;
	}
	
	.commentPostTable {
	width: 560px;
	border: 1px solid #cd311b;
	border: 1px solid #cd311b;
	}
	
	
	.videoPostTable {
	width: 560px;
	border: 1px solid #cd311b;
	padding-left: 15px;
	}
	
	.videoPostImg {
	width: 154px;
	height: 124px;
	border: 1px solid #cd311b;
	}
	
	
	.connectTable {
	border: 1px solid #cd311b;	
	width: 300px;
	}
	
	.topSpace {
	padding-top: 3px;
	}	
	
	.connectImages {
	padding-left: 3px;
	}
	
	.connectImages2 {
	padding-left: 2px;
	}

	
	.connectLinks {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	}
	
	.bulletinTable {
	width: 300px;
	border: 1px solid #cd311b;
	}
	
	tr.bulletin td {
	background-color: #f8e0e0;
	border-right: 1px solid #FFFFFF;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-left: 3px;
	padding-right: 3px;
	border-bottom: 1px solid #FFFFFF;
	}
	
	tr.bulletinTitle td {
	padding-top: 3px;
	padding-bottom: 3px;
	border-bottom: 1px solid #cd311b;
	}
	
	tr.bulletinPost td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #cd311b;
	}
	
	tr.commentsMsg td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #cd311b;
	background-color: #f8e0e0;
	}
	
	td.buttonPost {
	padding-top: 4px;
	padding-bottom: 4px;
	border-top: 1px solid #cd311b;
	}
	
	td.bulletinTopFirstCells {
	border-right: 1px solid #cd311b;
	border-bottom: none;
	}
	
	td.checkBoxSection {
	background-color: #f8e0e0;
	width: 15px;
	border-right: 1px solid #cd311b;
	}
		
	
	.bulletinSmallImg {
	padding-left: 5px;
	}
	
	.commentsImg {
	width: 60px;
	border: 2px solid #cd311b;
	}
	
	tr.comments td{
	border-bottom: 1px solid #cd311b;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	.bulletinReadTable {
	width: 560px;
	border: 1px solid #cd311b;
	}
	
	td.bulletinRead {
	background-color: #f8e0e0;
	border-right: 1px solid #cd311b;
	border-bottom: 1px solid #cd311b;
	}
	
	td.bulletinReadBottom {
	background-color: #f8e0e0;
	border-right: 1px solid #cd311b;
	}
	
	
	td.bulletinReadLast {
	background-color: #f8e0e0;
	border-bottom: 1px solid #cd311b;
	}
	
	
	tr.emptyBulletin td{
	background-color: #f8e0e0;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	td.leftBg {
	background-color: #f8e0e0;
	border-right: 1px solid #cd311b;
	}
	

	a.edit:link {color: white; text-decoration: underline; }
	a.edit:visited {color: white; text-decoration: underline; }
	a.edit:hover {color: white; text-decoration: underline; }
	a.edit:active {color: white; text-decoration: underline; } 


	
	td.bulletinReadRight {
	border-bottom: 1px solid #cd311b;
	}
	
	
	td.bulletinReadRightBottom {
	border-bottom: none;
	}
	
	td.bulletinReadBottom {
	background-color: #f8e0e0;
	border-right: 1px solid #cd311b;
	border-bottom: none;
	}
	
	tr.bulletinCols td {
	border-bottom: 1px solid #cd311b;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	td.bulletinData {
	border-right: 1px solid #cd311b;
	padding-bottom: 5px;
	padding-right: 3px;
	padding-left: 3px;
	}
<?php } else { ?>
	.userTable {
	border: 1px solid #999999;
	background-color: #F4F4F4;
	width: 300px;
	}
	
	.spaceMaker {
	padding-top: 2px;
	}
		
	tr.rows td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	tr.connectRows td{
	padding-top: 3px;
	}
	
	tr.broadcastRow td {
	padding-top: 6px;
	padding-bottom: 6px;
	}
	
	tr.connectRowsTop td {
	padding-top: 8px;
	}
	
	tr.connectRowsBottom td {
	padding-top: 3px;
	padding-bottom: 8px;
	}

	tr.rowsLine td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	border-bottom: 1px solid #999999;
	}
	
	tr.rowsLineBottom td{
	padding-top: 6px;
	padding-bottom: 6px;
	padding-left: 15px;
	}
	
	.profileTitles {
	font-family:  Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #999999;
	padding-top: 4px;
	padding-bottom: 4px;
	}
	
	.profileHeaders {
	background-color: #999999;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	color: #FFFFFF;
	padding-bottom: 3px;
	padding-top: 3px;
	}
	
	.aboutTable {
	width: 560px;
	border: 1px solid #999999;
	}
	
	.aboutImg {
	width: 140px;
	height: 108px;
	border: 2px solid #999999;
	}
	
	.bordersImg {
	border: 2px solid #999999;
	}
	
	.commentPostTable {
	width: 560px;
	border: 1px solid #999999;
	border: 1px solid #999999;
	}
	
	
	.videoPostTable {
	width: 560px;
	border: 1px solid #999999;
	padding-left: 15px;
	}
	
	.videoPostImg {
	width: 154px;
	height: 124px;
	border: 1px solid #999999;
	}
	
	
	.connectTable {
	border: 1px solid #999999;	
	width: 300px;
	}
	
	.topSpace {
	padding-top: 3px;
	}	
	
	.connectImages {
	padding-left: 3px;
	}
	
	.connectImages2 {
	padding-left: 2px;
	}

	
	.connectLinks {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	}
	
	.bulletinTable {
	width: 300px;
	border: 1px solid #999999;
	}
	
	tr.bulletin td {
	background-color: #F4F4F4;
	border-right: 1px solid #FFFFFF;
	padding-top: 3px;
	padding-bottom: 3px;
	padding-left: 3px;
	padding-right: 3px;
	border-bottom: 1px solid #FFFFFF;
	}
	
	tr.bulletinTitle td {
	padding-top: 3px;
	padding-bottom: 3px;
	border-bottom: 1px solid #999999;
	}
	
	tr.bulletinPost td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #999999;
	}
	
	tr.commentsMsg td {
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px solid #999999;
	background-color: #F4F4F4;
	}
	
	td.buttonPost {
	padding-top: 4px;
	padding-bottom: 4px;
	border-top: 1px solid #999999;
	}
	
	td.bulletinTopFirstCells {
	border-right: 1px solid #999999;
	border-bottom: none;
	}
	
	td.checkBoxSection {
	background-color: #F4F4F4;
	width: 15px;
	border-right: 1px solid #999999;
	}
		
	
	.bulletinSmallImg {
	padding-left: 5px;
	}
	
	.commentsImg {
	width: 60px;
	border: 2px solid #999999;
	}
	
	tr.comments td{
	border-bottom: 1px solid #999999;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	.bulletinReadTable {
	width: 560px;
	border: 1px solid #999999;
	}
	
	td.bulletinRead {
	background-color: #F4F4F4;
	border-right: 1px solid #999999;
	border-bottom: 1px solid #999999;
	}
	
	td.bulletinReadBottom {
	background-color: #F4F4F4;
	border-right: 1px solid #999999;
	}
	
	
	td.bulletinReadLast {
	background-color: #F4F4F4;
	border-bottom: 1px solid #999999;
	}
	
	
	tr.emptyBulletin td{
	background-color: #F4F4F4;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	
	td.leftBg {
	background-color: #F4F4F4;
	border-right: 1px solid #999999;
	}
	

	a.edit:link {color: white; text-decoration: underline; }
	a.edit:visited {color: white; text-decoration: underline; }
	a.edit:hover {color: white; text-decoration: underline; }
	a.edit:active {color: white; text-decoration: underline; } 


	
	td.bulletinReadRight {
	border-bottom: 1px solid #999999;
	}
	
	
	td.bulletinReadRightBottom {
	border-bottom: none;
	}
	
	td.bulletinReadBottom {
	background-color: #F4F4F4;
	border-right: 1px solid #999999;
	border-bottom: none;
	}
	
	tr.bulletinCols td {
	border-bottom: 1px solid #999999;
	padding-top: 3px;
	padding-bottom: 5px;
	}
	
	td.bulletinData {
	border-right: 1px solid #999999;
	padding-bottom: 5px;
	padding-right: 3px;
	padding-left: 3px;
	}
<?php } ?>
</style>        
           
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