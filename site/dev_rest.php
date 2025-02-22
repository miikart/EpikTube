<?php require_once("needed/start.php"); ?>
<div class="tableSubTitle">Developer API: REST Interface</div>

<p>Calling the EpikTube APIs through REST interface is very easy.  All you have to do is make an HTTP request of the REST endpoint:</p>

<div class="codeArea">
	http://www.epiktube.xyz/api2_rest	
</div>

<p>So, requests take this form:</p>
<div class="codeArea">
	http://www.epiktube.xyz/api2_rest?api_parameter1=value1&amp;api_parameter2=value2
</div>

<p>This is an example REST call:</p>
<div class="codeArea">
http://www.epiktube.xyz/api2_rest?method=epiktube.users.get_profile&amp;user=<b>EPIKTUBE_USER_NAME</b>
</div>

<p>The response to this API call will be in the following form:</p>

<div class="codeArea">
&lt;?xml version=&quot;1.0&quot; encoding=&quot;utf-8&quot;?&gt;<br>
&lt;ut_response status=&quot;ok&quot;&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;user_profile&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;first_name&gt;EpikTube&lt;/first_name&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;last_name&gt;User&lt;/last_name&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;about_me&gt;EpikTube rocks!!&lt;/about_me&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;age&gt;30&lt;/age&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;video_upload_count&gt;7&lt;/video_upload_count&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>.... and more ....</b><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/user_profile&gt;<br>
&lt;/ut_response&gt;<br>
</div>  <!-- end REST response sample -->

<p>The easiest way to perform a quick test of a REST-style API call is to request the URL through your favorite web browser and examine the XML output.</p>
<?php require_once("needed/end.php"); ?>