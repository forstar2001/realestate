<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_properties-category-grid.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<!-- UIKit 3 Code -->

<div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
    <?php foreach ($this->items as $item): ?>
    <div class="uk-card-media-left uk-cover-container">
    <?php if (!empty($item->image)) { ?>
        <img src="<?php echo $item->image; ?>" uk-cover>
        <?php } else { ?>
        <img src="<?php echo JURI::root().'/media/com_realestatenow/images/No_image_available.png'; ?>" alt="" uk-cover>
        <?php } ?>
        <canvas width="600" height="400"></canvas>
    </div>
    <div>
        <div class="uk-card-body">
            <h3><a href="<?php echo JRoute::_('index.php?option=com_realestatenow&view=category&id='.$item->id); ?>" title="<?php echo $item->title;?>" rel=""><?php echo $item->title; ?></a></h3>
            <p><?php echo $item->description; ?></p>
        </div>
    </div>
    <?php endforeach; ?>
</div>
