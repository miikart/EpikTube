<div class="tableSubTitle">Developer API: Introduction</div>

<span class="highlight">Getting Started</span>
<div class="devIndent">
	<p>As a sneak preview of the ease-of-use of the API, request the following URL in your web browser to request your own user profile:</p>

	<div class="codeArea">
	http://www.epiktube.xyz/api2_rest?method=epiktube.users.get_profile&amp;user=<b>EPIKTUBE_USER_NAME</b>
	</div>

	<p>You should see results like the following:</p>

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
	</div>  <!-- end getting started example response -->

	<p>To maintain backward-compatibility, we have retained the older XML-based API. The older documentation can be found <a href="/api_v1">here</a>.

</div>

<span class="highlight">Result Format</span>
<div class="devIndent">
	<p>All API calls return an XML document.  Successful API calls return an XML document of the following form:</p>

	<div class="codeArea">
		&lt;ut_response status=&quot;ok&quot;&gt;<br>
		&nbsp;&nbsp;&nbsp;&nbsp;... response XML document ...<br>
		&lt;ut_response&gt;<br>
	</div>

	<p>Failed API calls return an XML document as follows:
	<div class="codeArea">
&lt;ut_response status=&quot;fail&quot;&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;error&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;code&gt;<b>7</b>&lt;/code&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;description&gt;<b>Missing dev_id parameter.</b>&lt;/description&gt;<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/error&gt;<br>
&lt;/ut_response&gt;<br < div>  <!-- end failed response example -->

	<p>The <b>code</b> element provides the machine-friendly error code that your application can use to determine the error type and handle it appropriately.  The <b>description</b> element provides you with a human-readable description of the error.</p>
</div> <!-- end result format -->

<span class="highlight">API Call Interfaces</span>
<div class="devIndent">
	<p>There are two styles of API calls that you can mix-and-match at your convenience, <a href="dev_rest">REST</a> and <a href="dev_xmlrpc">XML-RPC</a></p>
</div>