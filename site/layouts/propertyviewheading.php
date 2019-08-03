<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		propertyviewheading.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('JPATH_BASE') or die('Restricted access');

    $app =  JFactory::getApplication();
    $template = $app->getTemplate();
    $uri = JFactory::getURI();
    $url = $uri->toString();
    $link = MailtoHelper::addLink($url);


?>
<div>
    <div>
<?php if( $displayData->navigation_dictionary ) : ?>
        <a id="itemPagingBack"
             class="uk-button uk-button-small"
    <?php if($displayData->navigation_dictionary['back']): ?>
             href="<?php echo $displayData->navigation_dictionary['back']['item_link']; ?>"
    <?php else: ?>
             disabled
    <?php endif; ?>
             style="background-color:<?php
                 echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtncolor'));
             ?>;color:<?php
                 echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtntxtcolor'));  ?>;">
              <?php echo JText::_('COM_REALESTATENOW_BACK'); ?>
        </a>
        <a id="itemPagingSearch"
           class="uk-button uk-button-small"
           href="<?php echo $displayData->return_to_search_link; ?>"
           style="background-color:<?php
             echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtncolor'));
         ?>;color:<?php
             echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtntxtcolor'));  ?>;"
        >
          <?php echo JText::_('COM_REALESTATENOW_RETURN_TO_SEARCH'); ?>
        </a>
        <a id="itemPagingNext"
           class="uk-button uk-button-small"
    <?php if($displayData->navigation_dictionary['next']): ?>
           href="<?php echo $displayData->navigation_dictionary['next']['item_link']; ?>"
    <?php else: ?>
           disabled
    <?php endif; ?>
           style="background-color:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtncolor')); ?>;color:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtntxtcolor')); ?>;"
        >
            <?php echo JText::_('COM_REALESTATENOW_NEXT'); ?>
        </a>
    <?php endif; ?>
    
    <div class="uk-button-group uk-float-right">
        <div class="uk-button-dropdown" data-uk-dropdown>

            <!-- This is the button toggling the dropdown -->
            <button class="uk-button uk-button-small uk-icon-share" style="background-color:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtncolor')); ?>;color:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtntxtcolor')); ?>;" ><?php echo JText::_('COM_REALESTATENOW_SHARE'); ?></button>

            <!-- This is the dropdown -->
            <div class="uk-dropdown uk-dropdown-small">
                <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                    <ul class="uk-nav uk-nav-dropdown">
                        <!-- AddToAny BEGIN -->
                        <li><a class="a2a_button_facebook"></a></li>
                        <li><a class="a2a_button_twitter"></a></li>
                        <li><a class="a2a_button_google_plus"></a></li>
                        <li><a class="a2a_button_linkedin"></a></li>
                        <li><a class="a2a_button_pinterest"></a></li>
                        <li><a class="a2a_button_copy_link"></a></li>
                        <!--<li><a class="a2a_dd" href="https://www.addtoany.com/share"></a></li>-->
                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                        <!-- AddToAny END -->
                    </ul>
                </div>
            </div>

        </div>
        <?php $add_button_class = isset($displayData->favorited) && $displayData->favorited  ? 'hidden' : ''; ?>
      <?php $remove_button_class = !isset($displayData->favorited) || !$displayData->favorited ? 'hidden' : ''; ?>
      <button class="uk-button uk-button-small uk-icon-bookmark <?php echo $remove_button_class; ?>" style="background-color:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtncolor')); ?>;color:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtntxtcolor')); ?>;visibility:visible;"
                data-guest="<?php echo JFactory::getUser()->guest;?>"
                onclick="removePropertyFromFavorites({this:this,id:<?php echo $displayData->id ;?>, that: jQuery(this).next()});return false;" > <?php echo JText::_('COM_REALESTATENOW_REMOVE_FROM_FAVORITES'); ?></button>
      <button class="uk-button uk-button-small uk-icon-bookmark <?php echo $add_button_class; ?>"  style="background-color:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtncolor')); ?>;color:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtntxtcolor')); ?>;visibility:visible;"
                data-guest="<?php echo JFactory::getUser()->guest;?>"
                onclick="addPropertyToFavorites({this:this, id:<?php echo $displayData->id ;?>, that: jQuery(this).prev()});return false;" > <?php echo JText::_('COM_REALESTATENOW_ADD_TO_FAVORITES'); ?></button>
      <div class="uk-button-dropdown" data-uk-dropdown>
        <button class="uk-button uk-button-small uk-icon-gear" style="background-color:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtncolor')); ?>;color:<?php echo (JComponentHelper::getParams('com_realestatenow')->get('propheaderbtntxtcolor')); ?>;" ><i class="uk-icon-caret-down"></i></button>
        <div class="uk-dropdown uk-dropdown-small">
          <ul class="uk-nav uk-nav-dropdown">
            <?php  if(JRequest::getVar('print') == 1)://todo move to view.html.php
                  $printButtonHtml
                      = 'onclick="window.print();"';
              else:
                  $printButtonHtml

                      = 'onclick="window.open(this.href,\'win2\',\'width=400,height=600,menubar=no,resizable=yes\'); return false;" href="'.$url.'&tmpl=print"';
              endif;  ?>
            <li><a class="uk-button uk-icon-print" <?php echo $printButtonHtml;?> ><?php echo JText::_('COM_REALESTATENOW_PRINT'); ?></a></li>
            <li> <a class="uk-button uk-icon-envelope"
                   href="index.php?option=com_mailto&tmpl=component&template=<?echo $template;?>&link=<?php echo  $link; ?>"
                   onclick="window.open(this.href,'win2','width=400,height=600,menubar=no,resizable=yes'); return false;" > <?php echo JText::_('COM_REALESTATENOW_EMAIL_TO_A_FRIEND'); ?></a></li>
            <!--<li><a class="uk-button uk-button-primary" href="/mwwebdev/components/com_realestatenow/views/property/tmpl/default_propertypdf.php" target="_blank"><?php echo JText::_('PDF'); ?></a></li>-->
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div>
  <div> </div>
</div>
<script type="text/javascript">
    function $_GET(q,s) {
        s = s ? s : window.location.search;
        var re = new RegExp('&'+q+'(?:=([^&]*))?(?=&|$)','i');
        return (s=s.replace(/^\?/,'&').match(re)) ? (typeof s[1] == 'undefined' ? '' : decodeURIComponent(s[1])) : undefined;
    }

    function addPropertyToFavorites(params){
        if (  (jQuery( params.this ).attr('data-guest') == "1" ) &&
            ( window.confirm('You must be logged in to add favorites. \nClick Ok to Login or Register') ) )
                document.location.href = "<?php echo JURI::root()."index.php?option=com_users&return=".base64_encode (JUri::getInstance()->toString()); ?>";
        else
            jQuery.ajax({
                url: "<?php echo JURI::root().'index.php?option=com_realestatenow&task=property.addToFavorites&propertyId='; ?>"+params.id,
                success: function(data) {
                    alert(data);
                    jQuery(params.this).toggle();
                    jQuery(params.that).toggle();
                }
            });

    }

    function removePropertyFromFavorites(params){
        console.log(params);
        jQuery.ajax({
            url: "<?php echo JURI::root().'index.php?option=com_realestatenow&task=property.deleteFromFavorites&propertyId='; ?>"+params.id,
            success: function(data) {
                alert(data);
                jQuery(params.this).toggle();
                jQuery(params.that).toggle();
            }
        });

    }
</script>
<?php
    $document = JFactory::getDocument();
    $document->addScript(JUri::base() . 'components/com_realestatenow/assets/js/js.cooky.js');
?>

