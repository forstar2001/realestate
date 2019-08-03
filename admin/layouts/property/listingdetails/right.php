<?php
    /*----------------------------------------------------------------------------------|  www.vdm.io  |----/
                    Most Wanted Web Services, Inc.
    /-------------------------------------------------------------------------------------------------------/
    
        @version		2.0.0
        @build			27th November, 2017
        @created		1st May, 2016
        @package		Real Estate NOW!
        @subpackage		listing_details_right.php
        @author			Most Wanted Web Services, Inc. <http://mostwantedrealestatesites.com>
        @copyright		Copyright (C) 2015-2017. All Rights Reserved
        @license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
        
        Real Estate NOW! Component
        
    /------------------------------------------------------------------------------------------------------*/
    
    // No direct access to this file
    
    defined('_JEXEC') or die('Restricted access');
?>

<div class="row">
    <?php echo JLayoutHelper::render( 'property.listingdetails.feature.modal',  $displayData->getTypeCasted('feature') ) ?>
</div>
<div class="row">
    <?php echo JLayoutHelper::render( 'property.listingdetails.rental.modal',  $displayData->getTypeCasted('rental') ) ?>
</div>
<div class="row">
    <?php echo JLayoutHelper::render( 'property.listingdetails.financial.modal',  $displayData->getTypeCasted('financial') ) ?>
</div>
<div class="row">
    <?php echo JLayoutHelper::render( 'property.listingdetails.area.modal',  $displayData->getTypeCasted('area') ) ?>
</div>
