<html>
<!-- machid: 51 -->
<head><title>500 Internal Server Error</title></head>
<body>
<h1>500 Internal Server Error</h1>
<p>Sorry, something went wrong.<br><br>A team of highly trained monkeys has been dispatched to deal with this situation.  In any case, please <a href="/contact">report this incident</a> to customer service.</p>
Also, please include the following information in your error report:<br>
<pre><?php if(!isset($_GET["key"]) || isset($_GET["key"]) && $_GET["key"] !=  $config["aeskey"]) { echo $the500errorsplit; } else { echo decrypt($the500error); } ?></pre>
</body>
</html>