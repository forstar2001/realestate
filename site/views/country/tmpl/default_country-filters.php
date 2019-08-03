<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default_country-filters.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<script>
    // Returns a function, that, as long as it continues to be invoked, will not
    // be triggered. The function will be called after it stops being called for
    // N milliseconds. If `immediate` is passed, trigger the function on the
    // leading edge, instead of the trailing.
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    function allpropteiesSetCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    
    function allpropteiesGetCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return false;
    }


    var getCookie = allpropteiesGetCookie;
    var setCookie = allpropteiesSetCookie;
</script>

<div id="filter_container" class="uk-container">
<form class="uk-form" data-uk-margin>
<div class="uk-grid">
    <?php if ($this->params->get('keyword_filter') == 1) : ?>
<div class="uk-form-row uk-width-1-1 uk-form-width-large">
    <input type="text" id="keyword" placeholder="Keyword">
</div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.keyword')){
                        jQuery("#filter_container #keyword").val(value);
                    }

                    jQuery("#filter_container #keyword").on("keyup",
                        debounce(function(e) {
                            setCookie('quicksearch.keyword',e.target.value)
                        }, 250 , false));
                });
            </script>
    <?php endif; ?>
    <?php if ($this->params->get('category_filter') == 1) : ?>
    <div  class="uk-form-row uk-width-1-1 uk-button uk-form-select uk-form-width-large" data-uk-form-select> <span></span> <i class="uk-icon-caret-down"></i>
      <select id="categoryDd">
        <option value="">All Property Categories:</option>
        <?php foreach ($this->categorylist as $item) {
						echo "<option style='font-weight:600;' value=" . $item->id . ">" . $item->title . "</option>";
						if(($this->getChildCategoryList($item->id)) > 0){
							foreach ($this->getChildCategoryList($item->id) as $itemd) {

								echo "<option value=" . $itemd->id . "> - " . $itemd->title . "</option>";	
							}
						}
						} ?>
      </select>
    </div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.categoryDd')){
                        jQuery("#filter_container #categoryDd").val(value);
                    }
                    jQuery("#filter_container #categoryDd").on("change",
                        function(e) {
                            setCookie('quicksearch.categoryDd',e.target.value)
                        });
                });
            </script>
    <?php endif; ?>
    <?php if ($this->params->get('transtype_filter') == 1) : ?>
    <div class="uk-form-row uk-width-1-1 uk-form-width-large uk-button uk-form-select" data-uk-form-select> <span></span> <i class="uk-icon-caret-down"></i>
      <select id="transtypeDd">
        <option value="">All Transaction Types:</option>
        <?php foreach ($this->transactiontypeslist as $item) {
                        echo "<option value=" . $item->id . ">" . $item->name . "</option>";
                    } ?>
      </select>
	  </div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.transtypeDd')){
                        jQuery("#filter_container #transtypeDd").val(value);
                    }
                    jQuery("#filter_container #transtypeDd").on("change",
                        function(e) {
                            setCookie('quicksearch.transtypeDd',e.target.value)
                        });
                });
            </script>
    <?php endif; ?>
    <?php if ($this->params->get('mktstatus_filter') == 1) : ?>
    <div class="uk-form-row uk-width-1-1 uk-form-width-large uk-button uk-form-select" data-uk-form-select> <span></span> <i class="uk-icon-caret-down"></i>
      <select id="marketstatusDd">
        <option value="">All Market Statuses:</option>
        <?php foreach ($this->marketstatuslist as $item) { echo "<option value=" . $item->id . ">" . $item->name . "</option>"; } ?>
      </select>
	  </div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.marketstatusDd')){
                        jQuery("#filter_container #marketstatusDd").val(value);
                    }
                    jQuery("#filter_container #marketstatusDd").on("change",
                        function(e) {
                            setCookie('quicksearch.marketstatusDd',e.target.value)});
                });
            </script>
    <?php endif; ?>
    <?php if ($this->params->get('agent_filter') == 1) : ?>
    <div  class="uk-form-row uk-width-1-1 uk-button uk-form-select uk-form-width-large" data-uk-form-select> <span></span> <i class="uk-icon-caret-down"></i>
      <select id="agentDd">
        <option value="">All Agents:</option>
        <?php foreach ($this->agentlist as $item) { echo "<option value=" . $item->id . ">" . $item->name . "</option>"; } ?>
      </select>
    </div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.agentDd')){
                        jQuery('#filter_container #agentDd').val(value);
                    }
                    jQuery('#filter_container #agentDd').on("change",
                        function(e) {
                            setCookie('quicksearch.agentDd',e.target.value)});
                });
            </script>
    <?php endif; ?>
    <?php if ($this->params->get('state_filter') == 1) : ?>
    <div class="uk-form-row uk-width-1-1 uk-button uk-form-select uk-form-width-large" data-uk-form-select> <span></span> <i class="uk-icon-caret-down"></i>
      <select id="stateDd">
        <option value="">All States:</option>
        <?php foreach ($this->statelist as $item) { echo "<option value=" . $item->id . ">" . $item->name . "</option>"; } ?>
      </select>
    </div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.stateDd')){
                        jQuery('#filter_container #stateDd').val(value);
                    }
                    jQuery('#filter_container #stateDd').on("change",
                        function(e) {
                            setCookie('quicksearch.stateDd',e.target.value)
                        });
                });
            </script>
    <?php endif; ?>
    <?php if ($this->params->get('city_filter') == 1) : ?>
    <div  class="uk-form-row uk-width-1-1 uk-button uk-form-select uk-form-width-large" data-uk-form-select> <span></span> <i class="uk-icon-caret-down"></i>
      <select id="cityDd">
        <option value="">All Cities:</option>
        <?php foreach ($this->citylist as $item) { echo "<option value=" . $item->id . ">" . $item->name . "</option>"; } ?>
      </select>
    </div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.cityDd')){
                        jQuery('#filter_container #cityDd').val(value);
                    }
                    jQuery('#filter_container #cityDd').on("change",
                        function(e) {
                            setCookie('quicksearch.cityDd',e.target.value)
                        });
                });
            </script>
    <?php endif; ?>
    <?php if ($this->params->get('waterfront_filter') == 1): ?>
    <div  class="uk-form-row uk-width-1-1 uk-button uk-form-select uk-form-width-large" data-uk-form-select> <span></span> <i class="uk-icon-caret-down"></i>
      <select id="waterfront">
        <option value="">Waterfront:</option>
        <option value="1">Yes</option>
        <option value="0">No</option>
      </select>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.waterfront')){
                        jQuery('#filter_container #waterfront').val(value);
                    }
                    jQuery('#filter_container #waterfront').on("change",
                        function(e) {
                            setCookie('quicksearch.waterfront',e.target.value)
                        });
                });
            </script>
    </div>
    <?php endif; ?>
    <div  class="uk-form-row uk-width-1-1 uk-button uk-form-select uk-form-width-large" data-uk-form-select> <span></span> <i class="uk-icon-caret-down"></i>
      <select id="featured">
        <option value="">Featured:</option>
        <option value="1">Yes - Featured</option>
        <option value="0">No - Unfeatured</option>
      </select>
    </div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.featured')){
                        jQuery('#filter_container #featured').val(value);
                    }
                    jQuery('#filter_container #featured').on("change",
                        function(e) {
                            setCookie('quicksearch.featured',e.target.value)
                        });
                });
            </script>
    <div  class="uk-form-row uk-width-1-1 uk-button uk-form-select uk-form-width-large" data-uk-form-select> <span></span> <i class="uk-icon-caret-down"></i>
      <select id="openhouse">
        <option value="">Open House:</option>
        <option value="1">Yes - Open House</option>
        <option value="0">No - No Open House</option>
      </select>
    </div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.openhouse)){
                        jQuery('#filter_container #openhouse).val(value);
                    }
                    jQuery('#filter_container #openhouse).on("change",
                        function(e) {
                            setCookie('quicksearch.openhouse,e.target.value)
                        });
                });
            </script>
    <?php if ($this->params->get('beds_filter') == 1) : ?>
    <div  class="uk-form-row uk-width-1-1 uk-button uk-form-select uk-form-width-large" data-uk-form-select> <span></span> <i class="uk-icon-caret-down"></i>
      <select name="minbedsDd" id='minbedsDd'>
        <option value="">Min beds:</option>
        <?php
                        $minbeds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                        foreach ($minbeds as $minbed) {
                            echo "<option value=" . $minbed . ">" . $minbed . "</option>";
                        }
                    ?>
      </select>
    </div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.minbedsDd')){
                        jQuery('#filter_container #minbedsDd').val(value);
                    }
                    jQuery('#filter_container #minbedsDd').on("change",
                        function(e) {
                            setCookie('quicksearch.minbedsDd',e.target.value)
                        });
                });
            </script>
    <?php endif; ?>
    <?php if ($this->params->get('baths_filter') == 1) : ?>
    <div  class="uk-form-row uk-width-1-1 uk-button uk-form-select uk-form-width-large" data-uk-form-select> <span></span> <i class="uk-icon-caret-down"></i>
      <select name="minbathDd" id='minbathDd'>
        <option value="">Min baths:</option>
        <?php
                        $minbaths = ['1 or more', '2 or more', '3 or more', '4 or more', '5 or more'];
                        foreach ($minbaths as $key => $val) {
                            echo "<option value=" . $key . ">" . $val . "</option>";
                        }
                    ?>
      </select>
    </div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.minbathDd')){
                        jQuery('#filter_container #minbathDd').val(value);
                    }
                    jQuery('#filter_container #minbathDd').on("change",
                        function(e) {
                            setCookie('quicksearch.minbathDd',e.target.value)
                        });
                });
            </script>
    <?php endif; ?>
    <?php if ($this->params->get('area_filter') == 1) : ?>
    <div  class="uk-form-row uk-width-1-1 uk-button uk-form-select uk-form-width-large" data-uk-form-select> <span></span> <i class="uk-icon-caret-down"></i>
      <select name="min_area" id='min_area'>
        <option value="">Min area:</option>
        <?php
                        $areas = [0, 500, 1000, 1500, 2000, 2500, 3000, 4000, 5000, 6000, 7000, 8000, 9000, 10000, 15000, 20000];
                        foreach ($areas as $area) {
                            echo "<option value=" . $area . ">" . $area . "</option>";
                        }
                    ?>
      </select>
    </div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.min_area')){
                        jQuery('#filter_container #min_area').val(value);
                    }
                    jQuery('#filter_container #min_area').on("change",
                        function(e) {
                            setCookie('quicksearch.min_area',e.target.value)
                        });
                });
            </script>
    <div  class="uk-form-row uk-width-1-1 uk-button uk-form-select uk-form-width-large" data-uk-form-select> <span></span> <i class="uk-icon-caret-down"></i>
      <select name="max_area" id='max_area'>
        <option value="">Max area:</option>
        <?php
                        $areas = [25000, 20000, 15000, 10000, 9000, 8000, 7000, 6000, 5000, 4000, 3000, 2500, 2000, 1500, 1000, 500, 0];
                        foreach ($areas as $area) {
                            echo "<option value=" . $area . ">" . $area . "</option>";
                        }
                    ?>
      </select>
    </div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.max_area')){
                        jQuery('#filter_container #max_area').val(value);
                    }
                    jQuery('#filter_container #max_area').on("change",
                        function(e) {
                            setCookie('quicksearch.max_area',e.target.value)
                        });
                });
            </script>
    <?php endif; ?>
    <?php if ($this->params->get('price_filter') == 1) : ?>
    <fieldset data-uk-margin>
<div class="uk-grid uk-form-row">
      <div class="uk-width-1-2"><input type="number" id="min_price" placeholder="Min Price"></div>
      <div class="uk-width-1-2"><input type="number" id="max_price" placeholder="Max Price"></div>
</div>
    </fieldset>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.min_price')){
                        jQuery('#filter_container #min_price').val(value);
                    }
                    jQuery('#filter_container #min_price').on("keyup",
                        debounce(function(e) {
                            setCookie('quicksearch.min_price',e.target.value)
                        }, 250 , false));

                    if( value = getCookie('quicksearch.max_price')){
                        jQuery('#filter_container #max_price').val(value);
                    }
                    jQuery('#filter_container #max_price').on("keyup",
                        debounce(function(e) {
                            setCookie('quicksearch.max_price',e.target.value)
                        }, 250, false));
                });
            </script>
    <?php endif; ?>
    <?php if ($this->params->get('land_filter') == 1) : ?>
<div class="uk-grid" data-uk-margin>
      <div class="uk-width-1-2"><input type="number" name='min_land' id='min_land' placeholder="Min Land"></div>
	  <div class="uk-width-1-2"><input type="number" name='max_land' id='max_land' placeholder="Max Land"></div>
</div>
    <script>
                jQuery(function(){
                    if( value = getCookie('quicksearch.min_land')){
                        jQuery('#filter_container #min_land').val(value);
                    }
                    jQuery('#filter_container #min_land').on("keyup",
                        debounce(function(e) {
                            setCookie('quicksearch.min_land',e.target.value)
                        }, 250, false));

                    if( value = getCookie('quicksearch.max_land')){
                        jQuery('#max_land').val(value);
                    }
                    jQuery('#filter_container #max_land').on("keyup",
                        debounce(function(e) {
                            setCookie('quicksearch.max_land',e.target.value)
                        }, 250, false));
                });
            </script>
    <?php endif; ?>
	</div>
  </form>
</div>
<?php
    $document = JFactory::getDocument();
    $document->addScript(JUri::base() . 'components/com_realestatenow/assets/js/propertyFilterPagination.js');
    $document->addScript(JUri::base() . 'components/com_realestatenow/assets/js/propertyfilter.js');
    $document->addScript(JUri::base() . 'components/com_realestatenow/assets/js/sortBy.js');
?>
<script type="text/javascript">

    var categoryMap = <?php echo json_encode($this->categoryMap);?>;
    var properties = <?php echo json_encode($this->items);?>;
    var properties_filters_basepath = '<?php echo JURI::root(); ?>';


    jQuery(function(){
        jQuery(document).ready(function () {
            
            <?php if ( isset( $_REQUEST['categoryDd'] ) &&  ( $_REQUEST['categoryDd'] != NULL ) ) { ?>
            jQuery('.categoryDd').val("<?php echo $_REQUEST['categoryDd']; ?>");
            <?php } ?>
            <?php if ( isset( $_REQUEST['transtypeDd'] ) &&  ( $_REQUEST['transtypeDd'] != NULL ) ) { ?>
            jQuery('.transtypeDd').val("<?php echo $_REQUEST['transtypeDd']; ?>");
            <?php } ?>
            <?php if ( isset( $_REQUEST['marketstatusDd'] ) &&  ( $_REQUEST['marketstatusDd'] != NULL ) ) { ?>
            jQuery('.marketstatusDd').val("<?php echo $_REQUEST['marketstatusDd']; ?>");
            <?php } ?>
            <?php if ( isset( $_REQUEST['agentDd'] ) &&  ( $_REQUEST['agentDd'] != NULL ) ) { ?>
            jQuery('.agentDd').val("<?php echo $_REQUEST['agentDd']; ?>");
            <?php } ?>
            <?php if ( isset( $_REQUEST['stateDd'] ) &&  ( $_REQUEST['stateDd'] != NULL ) ) { ?>
            jQuery('.stateDd').val("<?php echo $_REQUEST['stateDd']; ?>");
            <?php } ?>
            <?php if ( isset( $_REQUEST['cityDd'] ) &&  ( $_REQUEST['cityDd'] != NULL ) ) { ?>
            jQuery('.cityDd').val("<?php echo $_REQUEST['cityDd']; ?>");
            <?php } ?>
            <?php if ( isset( $_REQUEST['waterfront'] ) &&  ( $_REQUEST['waterfront'] != NULL ) ) { ?>
            jQuery('.waterfront').val("<?php echo $_REQUEST['waterfront']; ?>");
            <?php } ?>
            <?php if ( isset( $_REQUEST['minbedsDd'] ) &&  ( $_REQUEST['minbedsDd'] != NULL ) ) { ?>
            jQuery('.minbedsDd').val("<?php echo $_REQUEST['minbedsDd']; ?>");
            <?php } ?>
            <?php if ( isset( $_REQUEST['minbathDd'] ) &&  ( $_REQUEST['minbathDd'] != NULL ) ) { ?>
            jQuery('.minbathDd').val("<?php echo $_REQUEST['minbathDd']; ?>");
            <?php } ?>
            <?php if ( isset( $_REQUEST['min_area'] ) &&  ( $_REQUEST['min_area'] != NULL ) ) { ?>
            jQuery('.min_area').val("<?php echo $_REQUEST['min_area']; ?>");
            <?php } ?>
            <?php if (isset($_REQUEST['max_area']) &&  ($_REQUEST['max_area'] != NULL) ) { ?>
            jQuery('.max_area').val("<?php echo $_REQUEST['max_area']; ?>");
            <?php } ?>
            <?php if (isset($_REQUEST['max_area']) &&  ($_REQUEST['max_area'] != NULL) ) { ?>
            jQuery('.max_area').val("<?php echo $_REQUEST['max_area']; ?>");
            <?php } ?>
            <?php if (isset($_REQUEST['openhouse']) &&  ($_REQUEST['openhouse'] != NULL) ) { ?>
            jQuery('.openhouse').val("<?php echo $_REQUEST['openhouse']; ?>");
            <?php } ?>

        });

        initFilter();

    });
</script>
<?php
    $document = JFactory::getDocument();
    $document->addScript(JUri::base() . 'components/com_realestatenow/assets/js/js.cooky.js');
?>



