<?php echo "<?xml version='1.0'?>";?><root><html_content><![CDATA[          <div class="picker-top">
    <div class="box-close-link"  onclick="_hidediv('safetymode-picker'); return false;">
      <img onclick="_hidediv('safetymode-picker');" src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="Close">
    </div>
    <h2>Choose your safety mode</h2>
    <p>
Use YouTube's Safety Mode if you don't want to see videos that contain potentially objectionable material on YouTube.<br>While it's not 100 percent accurate, we use community flagging and other content signals to determine and filter out inappropriate content.
    </p>
  </div>

  <div>
      <form id="safety-form" action="/set_safety_mode" method="post">
        <p>
          <label>
            <input id="safety-mode-on" name="safety_mode" type="radio" value="true" onchange="_showdiv(&#39;safety-mode-lock-section&#39;)" onpropertychange="_showdiv(&#39;safety-mode-lock-section&#39;)" >
On
          </label>

          <label>
            <input id="safety-mode-off" name="safety_mode" type="radio" value="false" onchange="_hidediv(&#39;safety-mode-lock-section&#39;)" onpropertychange="_hidediv(&#39;safety-mode-lock-section&#39;)"  checked >
Off
          </label>
        </p>

        <div id="safety-mode-lock-section" class="hid">
            <p>
You can lock the Safety Mode setting after you <a href="https://accounts.google.com/ServiceLogin?uilel=3&amp;service=youtube&amp;passive=true&amp;continue=http%3A%2F%2Fwww.youtube.com%2Fsignin%3Faction_handle_signin%3Dtrue%26nomobiletemp%3D1%26hl%3Den_US%26next%3D%252F&amp;hl=en_US&amp;ltmpl=sso">sign in</a>.
            </p>
        </div>

        <p>
          <script>
            document.write('<input type="hidden" name="next_url" value="' + window.location.href + '">');
          </script>
          <input type="hidden" name="session_token" value="CTWx-iXuhHDpVmcFGUxJcTfgqs18MEAxMzM0MDU1OTQw"/>
          <button type="submit" class=" yt-uix-button yt-uix-button-default" onclick=";return true;"  role="button"><span class="yt-uix-button-content">Save </span></button>
        </p>
      </form>
  </div>


]]></html_content><return_code><![CDATA[0]]></return_code></root>