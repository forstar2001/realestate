<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_filters.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<!-- Begin Property AJAX Filters -->

<div class='uk-grid' style='margin-bottom: 15px;'>
    <div class="uk-form-row uk-width-1-1">
        <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" id="toggle_filters"><i class="fa fa-sliders"></i> <?php echo JText::_('COM_REALESTATENOW_CLICK_HERE_TO_SEARCH'); ?></button>
    </div>
</div>

<div id="filters">
    <div class='uk-grid'>
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1">
                <label>Min Price</label>
                <?php $filter_minprice = $this->active_state_vars['filter']['minpricerange'] ? $this->active_state_vars['filter']['minpricerange'] : 0;?>
                <input id="minpricerange" type="number" value="<?php echo $filter_minprice;?>" />
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1">
                <label>Max Price</label>
                <?php $filter_maxprice = $this->active_state_vars['filter']['maxpricerange'] ? $this->active_state_vars['filter']['maxpricerange'] : '';?>
                <input id="maxpricerange" type="number" value="<?php echo $filter_maxprice;?>" />
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1">
                <label>Keyword Search</label>
                <?php $filter_keywords = $this->active_state_vars['filter']['keywords'] ? $this->active_state_vars['filter']['keywords'] : '';?>
                <input type="text" id="keywords" placeholder="Keyword" value="<?php echo $filter_keywords;?>">
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1">
                <label>Min Land</label>
                <?php $filter_minlandrange = $this->active_state_vars['filter']['minlandrange'] ? $this->active_state_vars['filter']['minlandrange'] : '';?>
                <input id="minlandrange" type="number" value="<?php echo $filter_minlandrange;?>" />
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1">
                <label>Max Land</label>
                <?php $filter_maxlandrange = $this->active_state_vars['filter']['maxlandrange'] ? $this->active_state_vars['filter']['maxlandrange'] : '';?>
                <input id="maxlandrange" type="number" value="<?php echo $filter_maxlandrange;?>" />
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1 uk-button uk-form-select" data-uk-form-select="">
                <span class="">All Property Categories<i class="uk-icon-caret-down"></i></span>
                <select id="categoryIds">
                    <option value="">All Property Category:</option>
                    <?php foreach ( $this->categorylist as $item ): ?>
                        <?php $selected_parent = ( $this->active_state_vars['filter']['categoryids'] == $item->id ) ? "selected" : ''; ?>
                        <option style="font-weight:600;" value="<?php echo $item->id; ?>" <?php echo $selected_parent;?> ><?php echo $item->title; ?></option>
                        <?php if(($this->getChildCategoryList($item->id)) > 0):?>
                            <?php foreach ( $this->getChildCategoryList($item->id) as $itemd ): ?>
                                <?php $selected_child = ( $this->active_state_vars['filter']['categoryids'] == $itemd->id ) ? "selected" : ''; ?>
                                <option value="<?php echo $itemd->id; ?>" <?php echo $selected_child;?> > - <?php echo $itemd->title; ?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class='uk-grid'>
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1 uk-button uk-form-select" data-uk-form-select>
                <span></span> <i class="uk-icon-caret-down"></i>
                <select id="transactiontype">
                    <option value="">All Transaction Types:</option>
                    <?php foreach ($this->transactiontypeslist as $item) { ?>
                        <?php $selected = ( $this->active_state_vars['filter']['transactiontype'] == $item->id ) ? "selected" : ''; ?>
                        <option value="<?php echo $item->id; ?>" <?php echo $selected;?> ><?php echo $item->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1 uk-button uk-form-select" data-uk-form-select="">
                <span class="">All Market Statuses:</span> <i class="uk-icon-caret-down"></i>
                <select id="marketstatus">
                    <option value="">All Market Statuses:</option>
                    <?php foreach ($this->marketstatuslist as $item) { ?>
                        <?php $selected = ( $this->active_state_vars['filter']['marketstatus'] == $item->id ) ? "selected" : ''; ?>
                        <option value="<?php echo $item->id; ?>" <?php echo $selected;?> ><?php echo $item->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1 uk-button uk-form-select" data-uk-form-select="">
                <span class="uk-hover">All Agents:</span> <i class="uk-icon-caret-down"></i>
                <select id="agent">
                    <option value="">All Agents:</option>
                    <?php foreach ($this->agentlist as $item) { ?>
                        <?php $selected = ( $this->active_state_vars['filter']['agent'] == $item->id ) ? "selected" : ''; ?>
                        <option value="<?php echo $item->id; ?>" <?php echo $selected;?> ><?php echo $item->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <div class='uk-grid'>
        <div class="uk-width-1-3">
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
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1 uk-button uk-form-select" data-uk-form-select="">
                <span class="uk-hover">Open House:</span> <i class="uk-icon-caret-down"></i>
                <select id="openhouses">
                    <option value=""><?php echo JText::_('COM_REALESTATENOW_OPEN_HOUSE'); ?>:</option>
                    <option value="1"><?php echo JText::_('COM_REALESTATENOW_YES_OPEN_HOUSE'); ?></option>
                    <option value="0"><?php echo JText::_('COM_REALESTATENOW_NO_NO_OPEN_HOUSE') ?></option>
                </select>
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1 uk-button uk-form-select" data-uk-form-select="">
                <span class="">Min beds:</span> <i class="uk-icon-caret-down"></i>
                <select name="minbeds" id="minbeds">
                    <?php $selected = ( $this->active_state_vars['filter']['minbeds'] == "" ) ? "selected" : ''; ?>
                    <option value="" <?php echo $selected;?>>Min beds:</option>
                    <?php $minbeds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];?>
                    <?php foreach ($minbeds as $minbed): ?>
                        <?php $selected = ( $this->active_state_vars['filter']['minbeds'] == $minbed ) ? "selected" : ''; ?>
                        <option value="<?php echo $minbed; ?>" <?php echo $selected;?> ><?php echo $minbed; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class='uk-grid'>
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1 uk-button uk-form-select" data-uk-form-select="">
                <span class="uk-hover">Min baths:</span> <i class="uk-icon-caret-down"></i>
                <select name="minbath" id="minbath">
                    <option value="">Min baths:</option>
                    <?php $minbaths = [1 => '1 or more', 2 => '2 or more', 3 =>'3 or more', 4 => '4 or more', 5 => '5 or more']; ?>
                    <?php foreach ($minbaths as $key => $val): ?>
                        <?php $selected = ( $this->active_state_vars['filter']['minbath'] == $key ) ? "selected" : ''; ?>
                        <option value="<?php echo $key; ?>"  <?php echo $selected;?> ><?php echo $val; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1 uk-button uk-form-select" data-uk-form-select="">
                <span class="uk-hover">Min area:</span> <i class="uk-icon-caret-down"></i>
                <select name="min_areas" id="min_areas">
                    <option value="">Min area:</option>
                    <?php $minareas = [0, 500, 1000, 1500, 2000, 2500, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 15000, 20000];?>
                    <?php foreach ($minareas as $area): ?>
                        <?php $selected = ( $this->active_state_vars['filter']['min_areas'] === $area ) ? "selected" : ''; ?>
                        <option value="<?php echo $area; ?>"  <?php echo $selected;?> ><?php echo $area; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-form-row uk-width-1-1 uk-button uk-form-select" data-uk-form-select="">
                <span class="uk-hover">Max area:</span> <i class="uk-icon-caret-down"></i>
                <select name="max_areas" id="max_areas">
                    <option value="">Max area:</option>max_areas
                    <?php $maxareas = [25000, 20000, 15000, 10000, 9000, 8000, 7000, 6000, 5000, 4000, 3000, 2500, 2000, 1500, 1000, 500, 0];?>
                    <?php foreach ($maxareas as $area): ?>
                        <?php $selected = ( $this->active_state_vars['filter']['max_areas'] === $area ) ? "selected" : ''; ?>
                        <option value="<?php echo $area; ?>"  <?php echo $selected;?> ><?php echo $area; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
</div>

<!- End Property AJAX Filters -->
