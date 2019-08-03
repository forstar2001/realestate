<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		default.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Set the heading of the page
$heading = ($this->params->get('page_heading')) ? $this->params->get('page_heading'):(isset($this->menu->title)) ? $this->menu->title:'';

?>
<form action="<?php echo JRoute::_('index.php?option=com_realestatenow'); ?>" method="post" name="adminForm" id="adminForm">
<?php echo $this->toolbar->render(); ?><?php echo $this->toolbar->render(); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<h2><?php echo JText::_('COM_REALESTATENOW_MY_FAVORITE_LISTINGS'); ?></h2>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="uk-grid uk-flex-middle" data-uk-grid-margin>
    <?php foreach ($this->items as $item): ?>
        <div class="uk-width-medium-1-5"><a
                    href="<?php echo 'index.php?option=com_realestatenow&view=property&id=' . $item->id; ?>">
                <?php if ($this->params->get('agent_thumb_type') == 1) : ?>
                    <div class="uk-slidenav-position"
                         data-uk-slideshow="{animation: 'scroll', autoplay:true,autoplayInterval: '3000'}">
                        <ul class="uk-slideshow">
                            <?php
                            if (is_array($item->idPropidImageH) && (count($item->idPropidImageH) > 0)):
                                foreach ($item->idPropidImageH as $idPropidImageH):
                                    ?>
                                    <li><img class="uk-thumbnail uk-thumbnail-medium"
                                             src="<?php echo JURI::root() . $idPropidImageH->path . $idPropidImageH->filename . '_th.' . $idPropidImageH->type; ?>"
                                             alt=""></li>
                                <?php
                                endforeach;
                            else:
                                ?>
                                <div>
                                    <a href="<?php echo 'index.php?option=com_realestatenow&view=property&id=' . $item->id; ?>"
                                       title="<?php echo $item->name; ?>" rel=""> <img
                                                class="uk-thumbnail uk-thumbnail-medium"
                                                src="<?php echo JURI::root() . '/media/com_realestatenow/images/No_image_available.png'; ?>">
                                    </a></div>
                            <?php
                            endif;
                            ?>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="uk-panel">
                        <?php
                        if (is_array($item->idPropidImageH) && (count($item->idPropidImageH) > 0)):
                            $idPropidImageH = array_shift($item->idPropidImageH)
                            ?>
                            <div><img class="uk-thumbnail uk-thumbnail-medium"
                                      src="<?php echo JURI::root() . $idPropidImageH->path . $idPropidImageH->filename; ?>"
                                      alt=""></div>
                        <?php
                        else:
                            ?>
                            <div>
                                <a href="<?php echo 'index.php?option=com_realestatenow&view=property&id=' . $item->id; ?>"
                                   title="<?php echo $item->name; ?>" rel=""> <img
                                            class="uk-thumbnail uk-thumbnail-medium"
                                            src="<?php echo JURI::root() . '/media/com_realestatenow/images/No_image_available.png'; ?>">
                                </a></div>
                        <?php
                        endif;
                        ?>
                    </div>
                <?php endif; ?>
            </a>
            <?php if ($item->property_featured == 1): ?>
                <div class="uk-badge uk-badge-success">Featured</div>
            <?php endif; ?>
            <?php if ($item->property_openhouse == 1): ?>
                <div class="uk-badge">Open House</div>
            <?php endif; ?>
        </div>
        <div class="uk-width-medium-3-5 uk-flex-middle"><a
                    href="<?php echo 'index.php?option=com_realestatenow&view=property&id=' . $item->propertyid; ?>"
                    title="<?php echo $item->property_name; ?>" rel="">
                <h3><?php echo $item->property_name; ?></h3>
            </a>
            <h4 class="uk-clearfix"><?php echo $item->property_street; ?><br/>
                <?php echo $item->city_name . ', ' . $item->state_name . ' ' . $item->property_postcode; ?></h4>
            <div>
                <?php if ($item->bedrooms > 0) { ?>
                <span data-uk-tooltip title="Bedrooms"><i class="uk-icon-bed"
                                                          aria-hidden="true"></i><?php echo ' ' . (int)$item->bedrooms . '  '; ?></span>
                <?php } ?>
                <?php if ($item->fullbaths > 0) { ?>
                <span data-uk-tooltip title="Full Baths></i><?php echo ' ' . (int)$item->fullbaths . '  '; ?></span>
<?php } ?>
<?php if ($item->halfbaths > 0) { ?>
<span  data-uk-tooltip title=" Half Bath"><img src="./media/com_realestatenow/images/sink.png" alt="Bathroom Sink"
                                               height="16"
                                               width="16"> <?php echo ' ' . (int)$item->halfbaths . '  '; ?></span>
                <?php } ?>
                <?php if ($displayData->squarefeet > 0) { ?>
                <i class="uk-icon-building" aria-hidden="true"></i><?php echo $item->squarefeet; ?>
                <?php if ($this->params->get('sqft_type') == 1) : ?>
                ft<sup>2</sup>
                <?php else : ?>
                m<sup>2</sup>
                <?php endif; ?>
                <?php } ?>
            </div>
            <div><?php echo substr($item->property_propdesc, 0, 390);
                if (strlen($item->property_propdesc) > 390) echo '...'; ?></div>
        </div>
        <div class="uk-width-medium-1-5">
            <?php if ($item->financial_pm_price_override == 1 && (int)$item->financial_propmgt_price != 0 && date("Y-m-d") <= $item->financial_pmenddate) { ?>
                <span style='color:red;text-decoration:line-through'> <span
                            style='color:black'> <?php echo '$' . number_format($item->property_price); ?> </span> </span>
                <span class="uk-text-large"> <?php echo '$' . number_format($item->financial_propmgt_price); ?> </span>
                <p class="uk-badge"><?php echo $item->financial_propmgt_special; ?></p>
            <?php } else { ?>
                <span class="uk-text-large"><?php echo '$' . number_format($item->property_price); ?></span>
            <?php } ?>
        </div>
        <div class="g-block left size-10">
            <input type='button' class="del btn btn-danger" onclick='deleteProperty("<?php echo $item->favid; ?>")'
                   value='Delete'>
        </div>
    <?php endforeach; ?>

<!--[INSERTED$$$$]--><!--609-->
<?php if ($this->params->get('show_footer') == 1): ?>
<div class="uk-alert uk-alert-primary uk-container uk-text-center">Powered by <a href="https://realestatesitesnow.com" target="_blank">Real Estate NOW!</a><br>Listing data processed by <a href="https://mostwantedwebhosting.com/ipals">iPALS (Internet Properties All Listings Software</a></div>
<?php endif; ?>
<!--[/INSERTED$$$$]-->
</div>
<script>
    //jQuery(document).ready(function(){
    function deleteProperty(id) {
        jQuery.ajax({
            url: "<?php echo JURI::root() . '/index.php?option=com_realestatenow&task=favorites.deletefromfavorites&id='; ?>" + id,
            success: function (data) {
                jQuery('#prop_' + id).remove();
                location.reload();
                if (jQuery('.list li').length == 0) {
                    jQuery('#container').html('<h4>No property is on your favorites list!</h4>');
                }

            }
        });

    }


    //});
</script> 


<?php if (isset($this->items) && isset($this->pagination) && isset($this->pagination->pagesTotal) && $this->pagination->pagesTotal > 1): ?>
	<div class="pagination">
		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter pull-right"> <?php echo $this->pagination->getPagesCounter(); ?> <?php echo $this->pagination->getLimitBox(); ?></p>
		<?php endif; ?>
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php endif; ?>
<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</form>
