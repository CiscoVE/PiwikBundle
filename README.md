Broken at the moment:

error message as follow:


``` html
<div style='word-wrap: break-word; border: 3px solid red; padding:4px; width:70%; background-color:#FFFF96;'>
        <strong>There is an error. Please report the message (Piwik 2.1.0)
        and full backtrace in the <a href='?module=Proxy&action=redirect&url=http://forum.piwik.org' target='_blank'>Piwik forums</a> (please do a Search first as it might have been reported already!).<br /><br/>
        Notice:</strong> <em>Array to string conversion</em> in <strong>/apps/piwik/core/dispatch.php</strong> on line <strong>33</strong>
<br /><br />Backtrace --&gt;<div style="font-family:Courier;font-size:10pt"><br />
#0  Piwik\Error::errorHandler(...) called at [/apps/piwik/core/dispatch.php:33]<br />
#1  require_once(...) called at [/apps/piwik/index.php:47]<br />
</div><br />
 </pre></div><br />
Array
```