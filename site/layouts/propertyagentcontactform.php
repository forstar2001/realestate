<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		propertyagentcontactform.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('JPATH_BASE') or die('Restricted access');



?>
<!-- Contact Form start -->

<hr/>
<h4><?php echo JText::_('COM_REALESTATENOW_CONTACT_ME'); ?></h4>
<form class="uk-form uk-form-stacked">
  <div class='re_message'></div>
  <div class="uk-grid">
    <div class="uk-width-1-1">
      <div class="uk-form-row">
        <label class="uk-form-label" for="name"><?php echo JText::_('COM_REALESTATENOW_NAME'); ?><?php echo JText::_('COM_REALESTATENOW_REQUIRED'); ?></label>
        <div class="uk-form-controls">
          <input id="name" placeholder="Name" type="text" required>
        </div>
      </div>
      <div class="uk-form-row">
        <label class="uk-form-label" for="email"><?php echo JText::_('COM_REALESTATENOW_EMAIL'); ?><?php echo JText::_('COM_REALESTATENOW_REQUIRED'); ?></label>
        <div class="uk-form-controls">
          <input id="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <div class="uk-form-row">
        <label class="uk-form-label" for="message"><?php echo JText::_('COM_REALESTATENOW_MESSAGE'); ?><?php echo JText::_('COM_REALESTATENOW_REQUIRED'); ?></label>
        <div class="uk-form-controls">
          <textarea id="message" placeholder="Message" required></textarea>
        </div>
      </div>
      <div class="uk-form-row">
        <label class="uk-form-label" for="phone"><?php echo JText::_('COM_REALESTATENOW_DAYTIME_PHONE'); ?></label>
        <div class="uk-form-controls">
          <input id="phone" placeholder="phone" type="text">
        </div>
      </div>
      <input type='hidden' id='agent_email' value="<?php echo $displayData->agent_email; ?>">
		<div class="uk-form-row"></div>
      <div class="uk-form-row">
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
		<div class="uk-form-row"></div>
		<div class="uk-form-row"></div>
        <input class="uk-button uk-button-success" id='submit_btn'  name="submit" value="Submit" type="button">
        <input class="uk-button uk-button-primary" id='reset' name="Reset" value="Reset" type="reset">
      </div>
    </div>
  </div>
</form>
<hr/>
<!-- Contact Form end --> 

<script>
jQuery(document).ready(function(){
       
        jQuery('#submit_btn').click(function(){
            
            var name = jQuery('#name').val();
            var email = jQuery('#email').val();
            var agent_email = jQuery('#agent_email').val();
            var message = jQuery('#message').val();
            var phone = jQuery('#phone').val();
            var email_regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(name == '' || email == '' || agent_email == '' || message == '' || grecaptcha.getResponse() == ''){
            if(name==''){
                jQuery('#name').addClass('uk-form-danger');
            }else{
                jQuery('#name').removeClass('uk-form-danger');
            }
            if(email=='' || !email_regex.test(email)){
                jQuery('#email').addClass('uk-form-danger');
                
            }else{
                jQuery('#email').removeClass('uk-form-danger');
               
            }
            
            if(message==''){
                jQuery('#message').addClass('uk-form-danger');
            }else{
                jQuery('#message').removeClass('uk-form-danger');
            }
            
            if(grecaptcha.getResponse() == ''){
                jQuery('#recaptcha iframe').css('border','1px solid #dc8d99');
                
            }else{
                jQuery('#recaptcha iframe').css('border','none');
                
            }
        
        }else{
        jQuery.ajax({
            url: "<?php echo '/index.php?option=com_realestatenow&task=agentview.mailAgent'; ?>&name="+name+"&email="+email+"&message="+message+"&phone="+phone+"&agent_email="+agent_email+"&response=" + grecaptcha.getResponse(),
                       success: function(data) {
                          if(data == 1){
                              jQuery('#reset').click();
                              grecaptcha.reset();
                              jQuery('.re_message').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&#10006</button><h4 class="alert-heading">Message</h4><div class="alert-message">Email sent successfully</div></div>');
                              
                            }else{
                            jQuery('.re_message').html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&#10006</button><h4 class="alert-heading">Error</h4><div class="alert-message">Email sending failed, please try again!</div></div>');
                                }
                            }
                    });
                    }
       });
       
        
});
</script> 

