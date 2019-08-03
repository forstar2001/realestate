<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_agents-grid.php
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
$globalParams = JComponentHelper::getParams('com_realestatenow', true);


?>
<!-- Converted to UIKit 3 -->

<?php echo $this->loadTemplate('agentsfilters'); ?>
<?php echo $this->loadTemplate('agentssort'); ?>

<div>
    <ul class="uk-list" id="ajaxresultdiv">
        <?php if(!empty($this->items)): ?>
            <?php foreach($this->items as $items): ?>
                <?php echo $items->html; ?>
            <?php endforeach; ?>
        <?php else: ?>
                <li>
                    <h3 class="uk-text-center"><?php echo JText::_('COM_REALESTATENOW_THERE_ARE_NO_LISTINGS_IN_THIS_CATEGORY_AT_THIS_TIME_PLEASE_CHECK_BACK'); ?></h3>
                </li>
        <?php endif; ?>
    </ul>
</div>

<div class='uk-grid'>
    <div id="wait" class="loading-overlay" style="margin: auto;width: 50%; text-align: center;">
        <div class="overlay-content">Loading.....</div>
        <p><img src="<?php echo JURI::root().'components/com_realestatenow/assets/images/loader.gif'; ?>"></p>
    </div>
</div>
<div class="uk-alert uk-alert-warning" data-uk-alert style="display:none;">
    <a href="" class="uk-alert-close uk-close" uk-close></a>
    <p><?php echo JText::_('COM_REALESTATENOW_NO_AGENTS_WERE_FOUND'); ?></p>
</div>

<?php echo $this->loadTemplate('pagination'); ?>

