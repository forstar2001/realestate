<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_states-grid.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<!-- UIKit 3 Code -->

    <?php foreach ($this->items as $item): ?>
<div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
    <div class="uk-card-media-left uk-cover-container">
        <?php if(!empty($item->image)){ ?>
            <a href="<?php echo 'index.php?option=com_realestatenow&view=state&id='.$item->id;?>" title="<?php echo $item->name;?>"> <img src="<?php echo $item->image; ?>"> </a> </>
        <?php } else { ?>
            <a href="<?php echo 'index.php?option=com_realestatenow&view=state&id='.$item->id;?>" title="<?php echo $item->name;?>"> <img src="<?php echo JURI::root().'/media/com_realestatenow/images/No_image_available.png'; ?>"> </a>
        <?php } ?>
        <canvas width="600" height="100"></canvas>
    </div>
    <div>
        <div class="uk-card-body">
            <a href="<?php echo 'index.php?option=com_realestatenow&view=state&id='.$item->id;?>" title="<?php echo $item->name;?>" rel="" >
            <h3 class="uk-card-title"><?php echo $item->name; ?></h3>
            </a>
            <p><?php echo substr($item->description,0,390); if(strlen($item->description) > 390)echo '...'; ?></p>
        </div>
    </div>
</div>
    <?php endforeach; ?>

