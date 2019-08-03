<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_countries-panel.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<!-- UIKit 3 Code -->

<div class="uk-child-width-1-4@m" uk-grid>
    <?php foreach ($this->items as $item): ?>
    <div>
        <div class="uk-card uk-card-default">
            <div class="uk-card-media-top">
                <?php if(!empty($item->image)){ ?>
                    <a href="<?php echo 'index.php?option=com_realestatenow&view=country&id='.$item->id;?>" title="<?php echo $item->name;?>"> <img src="<?php echo $item->image; ?>"> </a>
                <?php } else { ?>
                    <a href="<?php echo 'index.php?option=com_realestatenow&view=country&id='.$item->id;?>" title="<?php echo $item->name;?>"> <img src="<?php echo JURI::root().'/media/com_realestatenow/images/No_image_available.png'; ?>"> </a>
                <?php } ?>
            </div>
            <div class="uk-card-body">
                <h3 class="uk-card-title"><a href="<?php echo 'index.php?option=com_realestatenow&view=country&id='.$item->id;?>"><?php echo $item->name;?></a><br/></h3>
                <p><?php echo substr($item->description,0,390); if(strlen($item->description) > 390)echo '...'; ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

