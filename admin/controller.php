<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		controller.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * General Controller of Realestatenow component
 */
class RealestatenowController extends JControllerLegacy
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 * Recognized key values include 'name', 'default_task', 'model_path', and
	 * 'view_path' (this list is not meant to be comprehensive).
	 *
	 * @since   3.0
	 */
	public function __construct($config = array())
	{
		// set the default view
		$config['default_view'] = 'realestatenow';

		parent::__construct($config);
	}

	/**
	 * display task
	 *
	 * @return void
	 */
	function display($cachable = false, $urlparams = false)
	{
		// set default view if not set
		$view   = $this->input->getCmd('view', 'realestatenow');
		$data	= $this->getViewRelation($view);
		$layout	= $this->input->get('layout', null, 'WORD');
		$id    	= $this->input->getInt('id');

		// Check for edit form.
		if(RealestatenowHelper::checkArray($data))
		{
			if ($data['edit'] && $layout == 'edit' && !$this->checkEditId('com_realestatenow.edit.'.$data['view'], $id))
			{
				// Somehow the person just went to the form - we don't allow that.
				$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
				$this->setMessage($this->getError(), 'error');
				// check if item was opend from other then its own list view
				$ref 	= $this->input->getCmd('ref', 0);
				$refid 	= $this->input->getInt('refid', 0);
				// set redirect
				if ($refid > 0 && RealestatenowHelper::checkString($ref))
				{
					// redirect to item of ref
					$this->setRedirect(JRoute::_('index.php?option=com_realestatenow&view='.(string)$ref.'&layout=edit&id='.(int)$refid, false));
				}
				elseif (RealestatenowHelper::checkString($ref))
				{

					// redirect to ref
					$this->setRedirect(JRoute::_('index.php?option=com_realestatenow&view='.(string)$ref, false));
				}
				else
				{
					// normal redirect back to the list view
					$this->setRedirect(JRoute::_('index.php?option=com_realestatenow&view='.$data['views'], false));
				}

				return false;
			}
		}

		return parent::display($cachable, $urlparams);
	}

	protected function getViewRelation($view)
	{
		// check the we have a value
		if (RealestatenowHelper::checkString($view))
		{
			// the view relationships
			$views = array(
				'country' => 'countries',
				'state' => 'states',
				'city' => 'cities',
				'agency' => 'agencies',
				'agent' => 'agents',
				'property' => 'properties',
				'residential' => 'residentials',
				'land' => 'lands',
				'commercial' => 'commercials',
				'multifamily' => 'multifamilies',
				'area' => 'areas',
				'feature' => 'features',
				'financial' => 'financials',
				'rental' => 'rentals',
				'market_status' => 'market_statuses',
				'transaction_type' => 'transaction_types',
				'rental_frequency' => 'rental_frequencies',
				'rent_type' => 'rent_types',
				'feature_type' => 'feature_types',
				'mls' => 'mls_records',
				'favorite_listing' => 'favorite_listings',
				'image' => 'images'
					);
			// check if this is a list view
			if (in_array($view, $views))
			{
				// this is a list view
				return array('edit' => false, 'view' => array_search($view,$views), 'views' => $view);
			}
			// check if it is an edit view
			elseif (array_key_exists($view, $views))
			{
				// this is a edit view
				return array('edit' => true, 'view' => $view, 'views' => $views[$view]);
			}
		}
		return false;
	}
}
