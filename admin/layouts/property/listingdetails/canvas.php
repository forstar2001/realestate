<?php
    /*----------------------------------------------------------------------------------|  www.vdm.io  |----/
                    Most Wanted Web Services, Inc.
    /-------------------------------------------------------------------------------------------------------/
    
        @version		2.0.0
        @build			20th November, 2017
        @created		1st May, 2016
        @package		Real Estate NOW!
        @subpackage		details_left.php
        @author			Most Wanted Web Services, Inc. <http://mostwantedrealestatesites.com>
        @copyright		Copyright (C) 2015-2017. All Rights Reserved
        @license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
        
        Real Estate NOW! Component
        
    /------------------------------------------------------------------------------------------------------*/
    
    // No direct access to this file
    
    defined('_JEXEC') or die('Restricted access');
    
    $form = $displayData->getForm();
    
    $options = array(
        'useCookie' => true
    );

?>
<div class="form-horizontal tabbable tabs-left">
    
    <?php echo JHtml::_('bootstrap.startTabSet', 'propertyListingDetailsTabs', $options); ?>
    
    <?php echo JHtml::_('bootstrap.addTab', 'propertyListingDetailsTabs', 'propertyListingDetailsTabsLeft', JText::_('COM_REALESTATENOW_PROPERTY_LISTING_DETAILS_LEFT', true)); ?>
    <div class="row-fluid form-horizontal-desktop">
        <div class="span6">
            <?php echo JLayoutHelper::render('property.listingdetails.left', $this); ?>
        </div>
    </div>
    <?php echo JHtml::_('bootstrap.endTab'); ?>
    
    <?php echo JHtml::_('bootstrap.addTab', 'propertyListingDetailsTabs', 'propertyListingDetailsTabsRight', JText::_('COM_REALESTATENOW_PROPERTY_LISTING_DETAILS_RIGHT', true)); ?>
    <div class="row-fluid form-horizontal-desktop">
        <div class="span6">
            <?php echo JLayoutHelper::render('property.listingdetails.right', $this); ?>
        </div>
    </div>
    <?php echo JHtml::_('bootstrap.endTab'); ?>
    
    <?php echo JHtml::_('bootstrap.endTabSet'); ?>

</div>