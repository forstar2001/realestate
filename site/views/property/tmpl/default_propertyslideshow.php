<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_propertyslideshow.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<div class="uk-container">
<div class="uk-slidenav-position" data-uk-slideshow="{animation: '<?php echo $this->params->get('slideshow_transtype'); ?>', autoplay:true,autoplayInterval: <?php echo $this->params->get('slider_autoplay_duration'); ?>}">
  <ul class="uk-slideshow">
    <?php
		if( is_array($this->allimages) && ( count($this->allimages) > 0 ) ):
			foreach ($this->allimages as $item):
	?>
    <li>
      <?php if ($item->remote == 1): ?>
      <img class="uk-thumbnail uk-thumbnail-medium uk-responsive-width" src="<?php echo $item->path.$item->filename; ?>" alt="" width="1000" height="700">
      <?php else: ?>
      <img class="uk-thumbnail uk-thumbnail-medium uk-responsive-width" src="<?php echo JURI::root().$item->path.$item->filename; ?>" alt="">
      <?php endif ?>
    </li>
    <?php endforeach; 
	else: ?>
    <div><img class="uk-thumbnail uk-thumbnail-medium uk-responsive-width" src="<?php echo JURI::root().'/media/com_realestatenow/images/No_image_available.png'; ?>"></div>
    <?php endif; ?>
  </ul>
  <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous" style="color: rgba(255,255,255,0.4)"></a> <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next" style="color: rgba(255,255,255,0.4)"></a> </div>
</div>
