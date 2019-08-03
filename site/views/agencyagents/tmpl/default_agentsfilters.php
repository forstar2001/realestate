<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_agentsfilters.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<!-- Begin Agents AJAX Filters -->

<div class='uk-grid' style='margin-bottom: 15px;'>
    <div class="uk-form-row uk-width-1-1">
        <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" id="toggle_filters"><i class="fa fa-sliders"></i> Toggle Filters</button>
    </div>
</div>

<div id="filters">
    <div class='uk-grid'>
        <div class="uk-width-1-2">
            <div class="uk-form-row uk-width-1-1">
                <label>Keyword Search</label>
                <?php $filter_keywords = $this->active_state_vars['filter']['keywords'] ? $this->active_state_vars['filter']['keywords'] : '';?>
                <input type="text" id="keywords" placeholder="Keyword" value="<?php echo $filter_keywords;?>">
            </div>
        </div>
        <div class="uk-width-1-2">
            <div class="uk-form-row uk-width-1-1 uk-button uk-form-select" data-uk-form-select="">
                <span class="uk-hover">All Cities:</span> <i class="uk-icon-caret-down"></i>
                <select id="city">
                    <option value="">All Cities:</option>
                    <?php foreach ($this->citylist as $city) { ?>
                        <?php $selected = ( $this->active_state_vars['filter']['city'] == $city->id ) ? "selected" : ''; ?>
                        <option value="<?php echo $city->id; ?>" <?php echo $selected;?> ><?php echo $city->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
</div>

<!- End Agents AJAX Filters -->
