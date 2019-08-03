<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		propertyagentcontactformcondensed.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('JPATH_BASE') or die('Restricted access');



?>

<h4>Contact Agent</h4>
<form class="uk-form uk-width-medium-1-3">
  <fieldset>
    <div class="uk-form-row">
      <input id="name" type="text" placeholder="Name" required>
    </div>
    <div class="uk-form-row">
      <input id="email" type="text" placeholder="Email" required>
    </div>
    <div class="uk-form-row">
      <input id="phone" type="text" placeholder="Phone">
    </div>
    <div class="uk-form-row">
      <textarea id="message" placeholder="Message" required></textarea>
    </div>
    <div>
      <input type='hidden' id='agent_email' value="<?php echo $this->agent->email; ?>">
    </div>
    <div class="uk-form-row" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;">
      <?php
                            JPluginHelper::importPlugin('captcha');
                                $dispatcher = JDispatcher::getInstance();
                                // This will put the code to load reCAPTCHA's JavaScript file into your <head>
                                $dispatcher->trigger('onInit', 'recaptcha');
                                // This will return the array of HTML code.
                                $recaptcha = $dispatcher->trigger('onDisplay', array(null, 'recaptcha', 'class=""'));
                                echo (isset($recaptcha[0])) ? $recaptcha[0] : '';
                    ?>
      <div id="recaptcha"></div>
      <input class="uk-button uk-button-success" id='submit_btn'  name="submit" value="Submit" type="button">
      <input class="uk-button uk-button-primary" id='reset' name="Reset" value="Reset" type="reset">
    </div>
  </fieldset>
</form>

