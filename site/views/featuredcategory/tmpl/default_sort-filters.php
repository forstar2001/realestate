<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_sort-filters.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<!-- Being Property AJAX Sort Filters -->

<div class='uk-grid uk-margin-top'>
    <div class="uk-width-1-2">
        <div class="uk-form-row uk-width-1-2 uk-button uk-form-select" data-uk-form-select="">
            <span class="uk-hover">Sort Result By :</span>  <i class="uk-icon-caret-down"></i>


            <select name="sortTable" id="sortTables">
                <option value="">Sort Results By:</option>
                <?php $sort_options = ['name_asc'=>'Address Ascending','name_desc'=>'Address Descending','price_asc'=>'Price Ascending','price_desc'=>'Price Descending']; ?>
                <?php foreach($sort_options as $sort_option_value=>$sort_option_name): ?>
                    <?php $selected = ( $this->active_state_vars['list']['sort'] == $sort_option_value ) ? "selected" : ''; ?>
                    <option value="<?php echo $sort_option_value;?>"   <?php echo $selected;?> ><?php echo $sort_option_name;?> </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="uk-width-1-2">
        <div class="uk-form-row uk-width-1-6 uk-float-right uk-button uk-form-select" data-uk-form-select="">
            <span class="uk-hover"></span> <i class="uk-icon-caret-down"></i>
            <select name="perpagelimit" id="perpagelimit">
                <?php $list_limit_options = [5,10,15,20,25,30,50]; ?>
                <?php foreach($list_limit_options as $list_limit_option): ?>
                    <?php $selected = ( $this->active_state_vars['list']['limit'] == $list_limit_option ) ? "selected" : ''; ?>
                    <option value="<?php echo $list_limit_option;?>"  <?php echo $selected;?> ><?php echo $list_limit_option;?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<!-- End Property AJAX Sort Filters -->
