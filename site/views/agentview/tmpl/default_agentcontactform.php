<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_agentcontactform.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<!-- Contact Form start -->

<hr/>
<h4><?php echo JText::_('COM_REALESTATENOW_CONTACT_ME'); ?></h4>
<form class="uk-form uk-form-stacked">
  <div class='re_message'></div>
  <div class="uk-grid">
    <div class="uk-width-1-2">
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
        <label class="uk-form-label" ><?php echo JText::_('COM_REALESTATENOW_INTERESTED_IN'); ?></label>
        <input class='mobile-options' id="r_buying" name="interested_in" type="radio" value="Buying" checked="checked">
        <label class='mobile-options' for="r_buying"><?php echo JText::_('COM_REALESTATENOW_BUYING'); ?></label>
        <br>
        <input class='mobile-options' id="r_selling" name="interested_in" type="radio" value="Selling">
        <label class='mobile-options' for="r_selling"><?php echo JText::_('COM_REALESTATENOW_SELLING'); ?></label>
        <br>
      </div>
    </div>
    <div class="uk-width-1-2">
      <div class="uk-form-row">
        <label class="uk-form-label" for="day_phone"><?php echo JText::_('COM_REALESTATENOW_DAYTIME_PHONE'); ?></label>
        <div class="uk-form-controls">
          <input id="day_phone" placeholder="Day phone" type="text">
        </div>
      </div>
      <div class="uk-form-row">
        <label class="uk-form-label" for="evening_phone"><?php echo JText::_('COM_REALESTATENOW_EVENING_PHONE'); ?></label>
        <div class="uk-form-controls">
          <input id="evening_phone" placeholder="Evening Phone" type="text">
        </div>
      </div>
      <div class="uk-form-row">
        <label class="uk-form-label" for="mobile_phone"><?php echo JText::_('COM_REALESTATENOW_MOBILE_PHONE'); ?></label>
        <div class="uk-form-controls">
          <input id="mobile_phone" placeholder="Mobile phone" type="text">
        </div>
      </div>
      <div class="uk-form-row">
        <label class="uk-form-label" ><?php echo JText::_('COM_REALESTATENOW_PREFERRED_CONTACT_METHOD_REQUIRED'); ?></label>
        <input class='mobile-options' id="r_email" name="pre_contact" type="radio" value="Email" checked="checked">
        <label class='mobile-options' for="r_email"><?php echo JText::_('COM_REALESTATENOW_EMAIL'); ?></label>
        <br>
        <input class='mobile-options' id="r_day_phone" name="pre_contact" type="radio" value="Daytime phone">
        <label class='mobile-options' for="r_day_phone"><?php echo JText::_('COM_REALESTATENOW_DAYTIME_PHONE'); ?></label>
        <br>
        <input class='mobile-options' id="r_evening_phone" name="pre_contact" type="radio" value='Evening Phone'>
        <label class='mobile-options' for="r_evening_phone"><?php echo JText::_('COM_REALESTATENOW_EVENING_PHONE'); ?></label>
        <br>
        <input class='mobile-options' id="r_mobile_phone" name="pre_contact" type="radio" value='Mobile phone'>
        <label class='mobile-options'for="r_mobile_phone"><?php echo JText::_('COM_REALESTATENOW_MOBILE_PHONE'); ?></label>
      </div>
      <input type='hidden' id='agent_email' value="<?php echo $this->agent->email; ?>">
    </div>
    <div class="uk-width-1-2">
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
            var day_phone = jQuery('#day_phone').val();
            var evening_phone = jQuery('#evening_phone').val();
            var mobile_phone = jQuery('#mobile_phone').val();
            var pre_contact = jQuery("input[name='pre_contact']:checked").val();
            var interested_in = jQuery("input[name='interested_in']:checked").val();
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
            url: "<?php echo '/index.php?option=com_realestatenow&task=agentview.mailAgent'; ?>&name="+name+"&email="+email+"&message="+message+"&day_phone="+day_phone+"&evening_phone="+evening_phone+"&mobile_phone="+mobile_phone+"&pre_contact="+pre_contact+"&agent_email="+agent_email+"&response=" + grecaptcha.getResponse(),
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

