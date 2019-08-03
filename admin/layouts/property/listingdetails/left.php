<?php
    /*----------------------------------------------------------------------------------|  www.vdm.io  |----/
                    Most Wanted Web Services, Inc.
    /-------------------------------------------------------------------------------------------------------/
    
        @version		2.0.0
        @build			27th November, 2017
        @created		1st May, 2016
        @package		Real Estate NOW!
        @subpackage		\property\listingdetails\left.php
        @author			Most Wanted Web Services, Inc. <http://mostwantedrealestatesites.com>
        @copyright		Copyright (C) 2015-2017. All Rights Reserved
        @license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
        
        Real Estate NOW! Component
        
    /------------------------------------------------------------------------------------------------------*/
    
    // No direct access to this file
    
    defined('_JEXEC') or die('Restricted access');
    
?>
    
    <!-- Residential Tab -->
    <div class="row">
        <?php echo JLayoutHelper::render('property.listingdetails.residential.modal', $displayData->getTypeCasted('residential')); ?>
    </div>
    <!-- /Residential Tab -->

    <!-- Multifamily Tab -->
    <div class="row">
        <?php echo JLayoutHelper::render('property.listingdetails.multifamily.modal', $displayData->getTypeCasted('multifamily')); ?>
    </div>
    <!-- /Multifamily Tab -->

    <!-- Commercial Tab -->
    <div class="row">
        <?php echo JLayoutHelper::render('property.listingdetails.commercial.modal', $displayData->getTypeCasted('commercial')); ?>
    </div>
    <!-- /Multifamily Tab -->

    <!-- Land Tab -->
    <div class="row">
        <?php echo JLayoutHelper::render( 'property.listingdetails.land.modal',  $displayData->getTypeCasted('land') ) ?>
    </div>
    <!-- /Land Tab -->