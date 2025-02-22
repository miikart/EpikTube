<?php
header("Content-Type: text/css");
?>
/* HTML Overrides */

body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	background-color: #FFFFFF;
	color: #222222;
/*
	margin: 0px;
	padding: 0px;
*/
}

a:link, a:visited, a:active {
	color: #0033CC;
}


td {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}

form {
	margin: 0px;
	padding: 0px;
}

h1 {
	font-size: 18px;
	font-weight: bold;
	color: #333333;
}
h2 {
	font-size: 16px;
	font-weight: bold;
	color: #333333;
}
h3 {
}
h4 {
	font-size: 14px;
	font-weight: bold;
	color: #333333;
	margin: 2px 0px 6px 0px;
	padding: 0px;
}
h5 {
}
h6 {
}

dt {
	font-weight: bold;
	padding-bottom: 5px
	}
	
dd {
	padding-bottom: 15px;
	}
	
emphasis {
	font-style: italic;
	}


/* Common Elements */

.bodystyle {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}

.small {
	font-size: 10px;
}

.label {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #333333;
}

.bold {
	font-weight: bold;
}

.highlight {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: 700;
	color: #333333;
}

.nav {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: 700;
}

.nav_sub {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: 400;
}


.title {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: 700;
	color: #003366;
}

.title_login {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: 400;
	color: #FFFFFF;
}

a.title:link {font-family: Arial, Helvetica, sans-serif; color: #CCFFFF; font-size: 12px; font-weight: bold;}
a.title:active {font-family: Arial, Helvetica, sans-serif; color: #CCFFFF; font-size: 12px; font-weight: bold;}
a.title:visited {font-family: Arial, Helvetica, sans-serif; color: #CCFFFF; font-size: 12px; font-weight: bold;}
a.title:hover {font-family: Arial, Helvetica, sans-serif; color: #CCFFFF; font-size: 12px; font-weight: bolder;}

.table_top {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: 700;
	color:#333333;
}


.success {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: 700;
	color: #333333;
}

.error {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: 700;
	color: #FF0000;
}

.confirmation {
	font-size: 14px;
	font-weight: bold;
	color: #000000;
	border: 3px solid #666666;
	padding: 5px;
	text-align: center; 
}

.tableFavRemove {
	margin-right: 5px;
	margin-left: 10px;
	margin-top: 8px;
	margin-bottom: 5px;
	
}

.tableVideoStats {
	width: 100%;
	background-image: url(/img/table_results_selected_bg.gif);
	background-repeat: repeat-x;
	background-color: #FFFFCC;
	background-position: left top;
	border: 1px dashed #CCCC66;
	padding-top: 5px;
	padding-bottom: 15px;
	margin-top: 10px;
	margin-bottom: 10px;
}

.tableSubTitle {
	padding: 0px 0px 5px 0px;
	border-bottom: 1px dashed #CCC;
	margin-bottom: 10px;
	font-size: 14px;
	font-weight: bold;
	color: #CC6633;
}

.brownSubTitle {
	font-size: 13px;
	font-weight: bold;
	color: #CC6633;
}

.SubTitle {
	font-size: 14px;
	font-weight: bold;
	color: #CC6633;
}

.tableSubTitleInfo {
	font-size: 12px;
	padding: 3px;
	padding-left: 10px;
}




/* Modules */

.moduleEntrySelected {
	background-image: url(/img/table_results_selected_bg.gif);
	background-repeat: repeat-x;
	background-color: #FFFFCC;
	background-position: left top;
	border-bottom: 1px dashed #999999;
	padding: 10px 10px 0px 10px;
}

.moduleEntryPremium {
	background-image: url(/img/table_results_selected_bg.gif);
	background-color: #FFFFCC;
	background-position: left top;
	background-repeat: repeat-x;
	border-bottom: 1px dashed #999999;
	padding: 10px;
}

.moduleEntry {
	background-color: #DDD;
	background-image: url(/img/table_results_bg.gif);
	background-position: left top;
	background-repeat: repeat-x;
	border-bottom: 1px dashed #999999;
	padding: 10px;
}

.moduleEntryThumb {
	border: 5px solid #FFFFFF;
	margin-right: 10px;
}

.moduleEntryTitle {
	font-size: 14px;
	font-weight: bold;
	margin-bottom: 2px;
	color: #333333;
}

.moduleEntryDescription {
	font-size: 12px;
	margin-bottom: 6px;
	color: #333;
	padding-right: 10px;
    word-wrap: anywhere;
}

.moduleEntryTags {
	font-size: 12px;
	margin-bottom: 5px;
	color: #444;
}

.moduleEntryDetails {
	font-size: 11px;
	margin-bottom: 5px;
	color: #444;
}
.moduleEntrySpecifics {
	font-size: 11px;
	margin-bottom: 1px;
	color: #444;
    word-wrap: anywhere;
}

.moduleTitle {
	font-size: 14px;
	font-weight: bold;
	margin: 0px 0px 5px 5px;
	color: #444;
}

.moduleTitleBar {
	width: 100%;
	background-color: #CCC;
	border-bottom: 1px dashed #999;
}

.moduleFeatured {
	background-color: #DDD;
	background-image: url(/img/table_results_bg.gif);
	background-position: left top;
	background-repeat: repeat-x;
	border-bottom: 1px dashed #999999;
	padding: 5px 5px 15px 5px;
}
.moduleFeaturedVideoBar {
	background-color: #DDD;
	background-image: url(/img/table_results_bg.gif);
	background-position: left top;
	background-repeat: repeat-x;
	padding: 0px 0px 0px 0px;
	margin: 0px;
	border: none;
}

.moduleFeaturedThumb {
	border: 5px solid #FFFFFF;
	margin: 5px;
}

.moduleFeaturedTitle {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	margin-bottom: 3px;
	word-wrap: anywhere;
	color: #0033CC;
	
}

.moduleFeaturedDetails {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
	color: #666666;
	margin-bottom: 3px;
}

.moduleFrameBarTitle {
	font-size: 12px;
	font-weight: bold;
	margin: 0px 5px 5px 5px;
	color: #444;
}

.moduleFrameEntrySelected {
	width: 270px;
	background-color: #FFFFCC;
	background-image: url(/img/table_results_selected_bg.gif);
	background-repeat: repeat-x;
	background-position: left top;
	border-bottom: 1px dashed #999999;
	padding: 8px;
}

.moduleFrameEntry {
	width: 270px;
	background-color: #DDD;
	background-image: url(/img/table_results_bg.gif);
	background-position: left top;
	background-repeat: repeat-x;
	border-bottom: 1px dashed #999999;
	padding: 8px;
}

.moduleFrameTitle {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	margin-bottom: 3px;
	word-wrap: anywhere;
	color: #0033CC;
	
}

.moduleFrameDetails {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: normal;
	margin-bottom: 5px;
	color: #666666;
	
}



/* Form Elements */

.formTitle {
	padding: 4px;
	padding-left: 7px;
	padding-bottom: 5px;
	margin-bottom: 10px;
	background-color: #E5ECF9;
	border-bottom: 1px dashed #3366CC;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}

.formTable {
	width: 80%;
	padding: 5px;
	margin-bottom: 20px;
	margin-left: auto;
	margin-right: auto;
}

.formIntro {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: normal;
	margin-bottom: 15px;
	padding-left: 10px;
}

.formHighlight {
	background-image: url(/img/table_results_selected_bg.gif);
	background-repeat: repeat-x;
	background-color: #FFFFCC;
	background-position: left top;
	border: 1px dashed #CCCC66;
	padding: 7px;
	padding-bottom: 10px;
	margin-bottom: 5px;
}

.formHighlightText {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	color: #666633;
	margin-top: 5px;
	margin-left: 6px;
}

.formFieldInfo {
	font-size: 11px;
	color: #555555;
	margin-top: 5px;
	margin-bottom: 5px;
}



/* Page Elements */

.pageTitle {
	padding: 4px;
	padding-left: 7px;
	padding-bottom: 5px;
	margin-bottom: 15px;
	background-color: #E5ECF9;
	border-bottom: 1px dashed #3366CC;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}

.pageTable {
	padding: 0px 5px 0px 5px;
	margin-bottom: 20px;
}

.pageText {
	padding: 0px 5px 0px 5px;
}

.pageIntro {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: normal;
	margin-bottom: 15px;
}



/* Mail Elements */

.mailMessageArea {
	background-color: #FFFFFF;
	border: 1px dashed #999999;
	padding: 7px;
	padding-bottom: 10px;
	margin-bottom: 15px;
}



/* Watch Elements */


.watchTitleBar {
	background-color: #CCCCCC;
	border-bottom: 1px dashed #999999;
}

.watchTitle {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	margin-left: 5px;
	margin-bottom: 6px;
	color: #333333;
	
}

.watchTable {
	background-color: #DDDDDD;
	background-image: url(/img/table_results_bg.gif);
	background-repeat: repeat-x;
	background-position: left top;
	border-bottom: 1px dashed #999999;
	padding: 5px;
	padding-bottom: 10px;
	text-align: center;
}


.watchInfoArea {
	width: 395px;
	text-align: left;
	margin-left: auto;
	margin-right: auto;
	margin-bottom: 10px;
	padding-left: 15px;
	padding-right: 15px;
	padding-bottom: 15px;
	background-color:#FFFFFF;
}

.watchDescription {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	padding: 10px 0px 5px 0px;
	color: #000;
	border-top: 1px dotted #CCCCCC;
}

.watchTags {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	margin: 5px 0px 10px 0px;
	color: #333333;
}

.watchAdded {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	margin-bottom: 10px;
	color: #333333;
}

.watchDetails {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	color: #333333;
}

.commentsTitle {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #333333;
	background-color: #EEEEEE;
	padding: 5px;
	padding-bottom: 6px;
	border-top: 1px dashed #999999;
	border-bottom: 1px dashed #999999;

}

.groupCommentsTitle {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #333333;
	background-color: #EEEEEE;
	padding: 5px;
	padding-bottom: 6px;
}


.BoxedBorderTable {
	padding-left: 10px;
	border-top: 1px solid #CCCCCC;
	border-bottom: 1px solid #CCCCCC;
	border-right: 1px solid #CCCCCC;
	border-left: 1px solid #CCCCCC;
}
.vertLeftDashTable {
	border-left: 1px dashed #CCCCCC;
	background-image: url(/img/long_grad_bg.jpg);
	background-repeat: repeat-x;
	background-repeat: repeat-y;
}
.commentsEntry {
	font-size: 11px;
	background-color: #FFFFCC;
	padding: 10px;
	border-bottom: 1px dashed #999999;
}

.commentsThumb {
	border: 5px solid #FFFFFF;
	margin-right: 5px;
}

.profileLabel {
	font-size: 12px;
	font-weight: bold;
	color:#DD8833;
	margin: 10px 0px 2px 0px;
}



/* Code Elements */

.codeArea {
	background-color: #FFFFFF;
	border: 1px dashed #999999;
	padding: 7px;
	margin-bottom: 15px;
}

.apiLabel {
	background-color: #E5ECF9; 
	margin-top: 20px; 
	margin-bottom: 10px; 
	padding-left: 10px; 
	padding-right: 10px; 
	padding-top: 10px; 
	padding-bottom: 10px;
}

.standoutLabel {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
}	
.brightLabel {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
}	

#set_of_links {
	position:relative;
	padding:0px;
	border:none;
	background:#ffffff;
	margin-bottom:20px
}
#set_of_links a {
	display:inline;
	padding:2px 9px 2px 9px;
	text-decoration:none;
	color: #000000;
	background:#FFFFAA
}
#set_of_links a:hover {
	background:#E1EAF0;
	text-decoration:none
}

#set_of_links a span {
	display:none
}
#set_of_links a:hover span {
	display:inline;
	position:absolute;
	padding-top:30px;
	left:0px;
	background: #FFFFAA;
	padding:5px 15px 5px 0
}

.SubscriptionTables {
	border: none;
}

.SubscriptionTables td {
	padding-top: 10px; 
	padding-bottom: 10px;
	padding-left: 1px;
	padding-right: 1px; 
	text-align:center; 
	border-bottom: 1px dashed #666666;
	color: #666666;
}

.SubscriptionVideos {
	background-color:#FFFFFF; 
	text-align: center;
}

.SubscriptionVideos td {
	border-bottom: none;
}

.parentSection {
	background: #FFFFCC;	
}

.parentSection td {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	padding-top: 5px;
	padding-right: 2px;
	padding-bottom: 5px;
	margin-top: 1px;	
}

.childrenSection {
	background: #FFFFFF;
	border-bottom: 1px dashed #CCCCCC;		
}

.childrenSection td {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	padding-top: 5px;
	padding-right: 2px;
	padding-bottom: 5px;
	margin-top: 1px;
}

.parentSection td {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	padding-top: 5px;
	padding-right: 2px;
	padding-bottom: 5px;
	margin-top: 1px;	
	border-bottom: 1px dashed #CCCCCC;		
}
.commentButtons td {
	padding-bottom: 0px;
	margin-bottom: 0px;
	border-bottom: 0px
}

.commentsSpecifics {
	text-align: center;
}

.userStats {
	padding-top: 5px;
}

.devIndent {
	margin-left: 15px; 
	margin-right: 15px; 
	padding-top: 15px; 
	padding-bottom: 15px;
}

.apiShadedBox {
	background-color: #E5ECF9; 
	padding-left: 5px; 
	padding-right: 5px; 
	padding-top: 5px; 
	padding-bottom: 5px;
}

.apiDef {
	margin-left: 25px;
}

.apiHeader {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	color: #AA0000;
}



/* msolo remix */
.roundedTable {
margin: 0px auto 1em auto;
}

.sunkenTitle {
	font-size: 14px;
	font-weight: bold;
	margin: 0px 0px 5px 5px;
}

.sunkenTitleBar {
	width: 100%;
	border-bottom: 1px dashed #999;
}

.sunkenContent {
	background-color: #ddd;
	background-image: url(/img/table_results_bg.gif);
	background-position: left top;
	background-repeat: repeat-x;
	padding: 10px;
}

.videobarthumbnail_block
{
	float: left;
	width: 120px;
	padding: 2px;
}
img.videobarthumbnail_gray
{
	border: 3px solid #FFFFFF;
}
img.videobarthumbnail_white
{
	border: 3px solid #DDD;
}

.videotitlebarHeading
{
	float: left; 
	font-size: 13px;
	color: #6D6D6D;
	padding-left: 10px;
	padding-right: 10px;
}
.videotitlebarComment
{
	float: left; 
	font-size: 10px;
	color: #999999;
}
.videotitleBarLinkBlock {
	width: 173px;
	float: right;
}
.videotitlebarLink
{
	horizontal-align: right; 
	width: 150px;
}
img.videotitlebarLinkIcon
{
	horizontal-align: right; 
	vertical-align: bottom;
	border: 0px;
	width: 23px;
	height: 14px;
}

hr {
	border: none 0; 
	border-top: 1px dashed #999; /* the border */
	height: 1px; /* whatever the total width of the border-top and border-bottom equal */
}

img.rating {
	border: 0px;
	padding: 0px;
	margin: 0px;
	vertical-align: middle;
}

span.rating {
	color:#666666;
	font-size:smaller;
}

.tag_list {
	margin: 1em 0px 0.5em 0px;
	font-weight: bold;
	color: #333;
}

.tag_list p {
	margin: 0px 0px 0.5em 0px;
	padding-left: 0.5em;
	font-weight: normal;
	color: #999;
}

.moduleEntry input {
	margin: 1em 0px 0px 0px;
}