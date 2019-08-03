<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		agentsgrid.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('JPATH_BASE') or die('Restricted access');

$globalParams = JComponentHelper::getParams('com_realestatenow', true);


?>
    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
		            <?php if(empty($displayData->image)){ ?>
        <div class="uk-card-media-left uk-cover-container">
            <a href="<?php echo 'index.php?option=com_realestatenow&view=agentview&id='.$displayData->id;?>" title="<?php echo $displayData->name;?>" rel=""><img src="<?php echo JURI::root().'/media/com_realestatenow/images/No_image_available.png'; ?>" alt="" uk-cover>
                <canvas width="300" height="150"></canvas></a>
        </div>
            <?php } else { ?>
        <div class="uk-card-media-left uk-cover-container uk-height-medium">
            <a href="<?php echo 'index.php?option=com_realestatenow&view=agentview&id='.$displayData->id;?>" title="<?php echo $displayData->name;?>" rel=""><img src="<?php echo $displayData->image; ?>" alt="" uk-cover>
                <canvas width="300" height="150"></canvas></a>
        </div>
            <?php } ?>

        <div>
            <div class="uk-card-body">
                <a href="<?php echo 'index.php?option=com_realestatenow&view=agentview&id='.$displayData->id;?>" title="<?php echo $displayData->name;?>" rel="" >
                    <h3 class="uk-card-title uk-margin-remove-bottom"><?php echo $displayData->name; ?> </a></h3>
                    <h6 class="uk-margin-remove-top"><?php echo $displayData->agency_name; ?></h6>
                    <span class="uk-text-small uk-margin-remove-top uk-margin-remove-bottom"><?php echo $displayData->title; ?></span>
                <?php if (!empty($displayData->street)) : ?>
                    <?php if ($globalParams->get('showagtaddylist') == 1) { ?>
                        <h4 class="uk-margin-bottom uk-clearfix"><?php echo $displayData->street; ?> <?php echo $displayData->city_name.', '.$displayData->state_name.' '.$displayData->postcode; ?></h4>
                    <?php } ?>
                <?php endif; ?>

                <?php if ($globalParams->get('showagtcontactist') == 1) : ?>
                    <div class="uk-grid uk-margin-bottom">
                        <?php if (!empty($displayData->email)) { ?>
                            <!--<h6 class="uk-width-2-4"><i class="uk-icon-envelope"></i>  <a href="mailto:<?php echo $displayData->email; ?>?Subject=Website%20Contact" target="_top"><?php echo $displayData->email; ?></a></h6>-->
                        <?php } ?>
                        <?php if (!empty($displayData->phone)) { ?>
                            <h6 class="uk-width-1-4"><i class="uk-icon-phone"></i>  <?php echo $displayData->phone; ?></h6>
                        <?php } ?>
                        <?php if (!empty($displayData->mobile)) { ?>
                            <h6 class="uk-width-1-4"><i class="uk-icon-mobile-phone"></i>  <?php echo $displayData->mobile; ?></h6>
                        <?php } ?>
                    </div>
                <?php endif; ?>

                <div><?php echo truncate($displayData->bio,390,array('html' => true, 'ending' => '')); if(strlen($displayData->bio) > 390)echo '...'; ?><?php echo $displayData->editLink; ?></div>
            </div>
        </div>
        <div class="uk-card-footer">
            <a class="uk-button uk-width-1-1" style="background-color:<?php echo ($globalParams->get('viewagentbtncolor')); ?>; color:<?php echo ($globalParams->get('viewagentbtntxtcolor')); ?>;" href="<?php echo 'index.php?option=com_realestatenow&view=agentview&id='.$displayData->id;?>">View <?php echo $displayData->title; ?></a>
        </div>
    </div>

