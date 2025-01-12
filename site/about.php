<?php
require "needed/start.php";
?>
<div class="tableSubTitle">About Us</div>

<div class="pageTable">
<span class="highlight">About EpikTube</span>
<br><br>
Epiktube is my personal project.
<br><br>
<span class="highlight">What is EpikTube?</span>

<br><br>
EpikTube is the way to get your videos to the people who matter to you. With EpikTube you can:

<ul>
<li> Show off your favorite videos to the world
<li> Take videos of your dogs, cats, and other pets
<li> Blog the videos you take with your digital camera or cell phone
<li> Securely and privately show videos to your friends and family around the world
<li> ... and much, much more!
</ul>
<?php if(empty($_SESSION['uid'])) { ?>
<br><span class="highlight"><a href="signup.php">Sign up now</a> and open a free account.</span>
<br><br> <?php } ?><br>

To learn more about our service, please see our <a href="help.php">Help</a> section.<br>



<br><br><span class="highlight">Thank You!</span>
<ul>
<li><strong><a href="/profile.php?user=copy">copy</a></strong> - Funny owner and developer of site.</li>
<li><strong><a href="profile.php?user=Mii">Mii</a></strong> - Hosts the website</li>
</ul>

<?php
require "needed/end.php";
?>