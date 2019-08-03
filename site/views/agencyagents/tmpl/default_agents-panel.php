<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_agents-panel.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Load JQuery Framework
JHtml::_('jquery.framework');

// Set Global Parameters
$globalParams = JComponentHelper::getParams('com_realestatenow');


?>
<!-- UIKit 3 Code -->
<div class="uk-child-width-1-4@m" uk-grid>
    <?php foreach ($this->items as $item): ?>
    <div>
        <div class="uk-card uk-card-default">
            <div class="uk-card-media-top">
                <?php if(empty($item->image)){ ?>
                    <div> <a href="<?php echo 'index.php?option=com_realestatenow&view=agentview&id='.$item->id;?>" title="<?php echo $item->name;?>" rel="" class="g-logo g-logo-alt"> <img class='uk-thumbnail' src="<?php echo JURI::root().'/media/com_realestatenow/images/No_image_available.png'; ?>"> </a> </div>
                <?php } else { ?>
                    <div> <a href="<?php echo 'index.php?option=com_realestatenow&view=agentview&id='.$item->id;?>" title="<?php echo $item->name;?>" rel="" class="g-logo g-logo-alt"> <img class='uk-thumbnail' src="<?php echo $item->image; ?>"> </a> </div>
                <?php } ?>
            </div>
            <div class="uk-card-body">
                <h1 class="uk-panel-title uk-margin-remove-bottom"><a href="<?php echo 'index.php?option=com_realestatenow&view=agentview&id='.$item->id;?>"><?php echo $item->name;?></a></h1>
                <h6 class="uk-margin-remove-top uk-margin-remove-bottom"><?php echo $item->agency_name; ?></h6>
                <span class="uk-text-small uk-margin-remove-top"><?php echo $item->title; ?></span>
                <h4><?php echo $item->street; ?><br>
                <?php echo $item->city_name.', '.$item->state_name.' '.$item->postcode; ?></h4>
                <h4><?php echo $item->phone; ?></h4>
                <spacer>
                    <p><?php echo $item->bio; ?></p>
                    <p><?php echo $item->editLink; ?></p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

