<?php
$result = '';
$result.='Subscribe Newsletter
	<form action="" class="form_subscribe" style="display: inline;" role="form" id="form_subscribe">
				 <input class="newsletter_input" placeholder="Email Address" type="text" name="email_address" id="email_address" style="width: 60%;">

      	<input class="newsletter_button" type="submit" value="Sign up" id="btn-submit" style="background-color:#330000;color:#FFFFFF;">
        
    </form>';
$jVars["module:subscribe_form"] = $result;
?>