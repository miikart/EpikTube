<?php require_once("needed/start.php"); ?>
<div class="tableSubTitle">Developer API: Error Codes</div>

<span class="apiHeader">1 : EpikTube Internal Error</span><br>
<span class="apiDef">This is a potential issue with the EpikTube API.  Please <a href="/contact">report the issue to us</a> using the subject "Developer Question."</span><br><br>

<span class="apiHeader">2 : Bad XML-RPC format parameter</span><br>
<span class="apiDef">The parameter passed to the XML-RPC API call was of an incorrect type.  Please see the <a href="dev_xmlrpc">XML-RPC interface documentation</a> for more details.</span><br><br>

<span class="apiHeader">3 : Unknown parameter specified</span><br>
<span class="apiDef">Please double-check that the specified parameters match those in the API reference.</span><br><br>

<span class="apiHeader">4 : Missing required parameter</span><br>
<span class="apiDef">Please double-check that all required parameters for the API method you're calling are present in your request.</span><br><br>

<span class="apiHeader">5 : No method specified</span><br>
<span class="apiDef">All API calls must specify a method name.</span><br><br>

<span class="apiHeader">6 : Unknown method specified</span><br>
<span class="apiDef">Please check that you've spelled the method name correctly.</span><br><br>
<?php require_once("needed/end.php"); ?>
