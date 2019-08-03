<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		view.html.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Realestatenow View class for the Feature_types
 */
class RealestatenowViewFeature_types extends JViewLegacy
{
	/**
	 * Feature_types view display method
	 * @return void
	 */
	function display($tpl = null)
	{
		if ($this->getLayout() !== 'modal')
		{
			// Include helper submenu
			RealestatenowHelper::addSubmenu('feature_types');
		}

		// Assign data to the view
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state = $this->get('State');
		$this->user = JFactory::getUser();
		$this->listOrder = $this->escape($this->state->get('list.ordering'));
		$this->listDirn = $this->escape($this->state->get('list.direction'));
		$this->saveOrder = $this->listOrder == 'ordering';
		// get global action permissions
		$this->canDo = RealestatenowHelper::getActions('feature_type');
		$this->canEdit = $this->canDo->get('core.edit');
		$this->canState = $this->canDo->get('core.edit.state');
		$this->canCreate = $this->canDo->get('core.create');
		$this->canDelete = $this->canDo->get('core.delete');
		$this->canBatch = $this->canDo->get('core.batch');

		// We don't need toolbar in the modal window.
		if ($this->getLayout() !== 'modal')
		{
			$this->addToolbar();
			$this->sidebar = JHtmlSidebar::render();
			// load the batch html
			if ($this->canCreate && $this->canEdit && $this->canState)
			{
				$this->batchDisplay = JHtmlBatch_::render();
			}
		}
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
		}

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_REALESTATENOW_FEATURE_TYPES'), 'joomla');
		JHtmlSidebar::setAction('index.php?option=com_realestatenow&view=feature_types');
		JFormHelper::addFieldPath(JPATH_COMPONENT . '/models/fields');

		if ($this->canCreate)
		{
			JToolBarHelper::addNew('feature_type.add');
		}

		// Only load if there are items
		if (RealestatenowHelper::checkArray($this->items))
		{
			if ($this->canEdit)
			{
				JToolBarHelper::editList('feature_type.edit');
			}

			if ($this->canState)
			{
				JToolBarHelper::publishList('feature_types.publish');
				JToolBarHelper::unpublishList('feature_types.unpublish');
				JToolBarHelper::archiveList('feature_types.archive');

				if ($this->canDo->get('core.admin'))
				{
					JToolBarHelper::checkin('feature_types.checkin');
				}
			}

			// Add a batch button
			if ($this->canBatch && $this->canCreate && $this->canEdit && $this->canState)
			{
				// Get the toolbar object instance
				$bar = JToolBar::getInstance('toolbar');
				// set the batch button name
				$title = JText::_('JTOOLBAR_BATCH');
				// Instantiate a new JLayoutFile instance and render the batch button
				$layout = new JLayoutFile('joomla.toolbar.batch');
				// add the button to the page
				$dhtml = $layout->render(array('title' => $title));
				$bar->appendButton('Custom', $dhtml, 'batch');
			}

			if ($this->state->get('filter.published') == -2 && ($this->canState && $this->canDelete))
			{
				JToolbarHelper::deleteList('', 'feature_types.delete', 'JTOOLBAR_EMPTY_TRASH');
			}
			elseif ($this->canState && $this->canDelete)
			{
				JToolbarHelper::trash('feature_types.trash');
			}

			if ($this->canDo->get('core.export') && $this->canDo->get('feature_type.export'))
			{
				JToolBarHelper::custom('feature_types.exportData', 'download', '', 'COM_REALESTATENOW_EXPORT_DATA', true);
			}
		}

		if ($this->canDo->get('core.import') && $this->canDo->get('feature_type.import'))
		{
			JToolBarHelper::custom('feature_types.importData', 'upload', '', 'COM_REALESTATENOW_IMPORT_DATA', false);
		}

		// set help url for this view if found
		$help_url = RealestatenowHelper::getHelpUrl('feature_types');
		if (RealestatenowHelper::checkString($help_url))
		{
				JToolbarHelper::help('COM_REALESTATENOW_HELP_MANAGER', false, $help_url);
		}

		// add the options comp button
		if ($this->canDo->get('core.admin') || $this->canDo->get('core.options'))
		{
			JToolBarHelper::preferences('com_realestatenow');
		}

		if ($this->canState)
		{
			JHtmlSidebar::addFilter(
				JText::_('JOPTION_SELECT_PUBLISHED'),
				'filter_published',
				JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true)
			);
			// only load if batch allowed
			if ($this->canBatch)
			{
				JHtmlBatch_::addListSelection(
					JText::_('COM_REALESTATENOW_KEEP_ORIGINAL_STATE'),
					'batch[published]',
					JHtml::_('select.options', JHtml::_('jgrid.publishedOptions', array('all' => false)), 'value', 'text', '', true)
				);
			}
		}

		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_ACCESS'),
			'filter_access',
			JHtml::_('select.options', JHtml::_('access.assetgroups'), 'value', 'text', $this->state->get('filter.access'))
		);

		if ($this->canBatch && $this->canCreate && $this->canEdit)
		{
			JHtmlBatch_::addListSelection(
				JText::_('COM_REALESTATENOW_KEEP_ORIGINAL_ACCESS'),
				'batch[access]',
				JHtml::_('select.options', JHtml::_('access.assetgroups'), 'value', 'text')
			);
		}

		// [Interpretation 10672] Set Featuretype Selection
		$this->featuretypeOptions = $this->getTheFeaturetypeSelections();
		if ($this->featuretypeOptions)
		{
			// [Interpretation 10676] Featuretype Filter
			JHtmlSidebar::addFilter(
				'- Select '.JText::_('COM_REALESTATENOW_FEATURE_TYPE_FEATURETYPE_LABEL').' -',
				'filter_featuretype',
				JHtml::_('select.options', $this->featuretypeOptions, 'value', 'text', $this->state->get('filter.featuretype'))
			);

			if ($this->canBatch && $this->canCreate && $this->canEdit)
			{
				// [Interpretation 10685] Featuretype Batch Selection
				JHtmlBatch_::addListSelection(
					'- Keep Original '.JText::_('COM_REALESTATENOW_FEATURE_TYPE_FEATURETYPE_LABEL').' -',
					'batch[featuretype]',
					JHtml::_('select.options', $this->featuretypeOptions, 'value', 'text')
				);
			}
		}
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		if (!isset($this->document))
		{
			$this->document = JFactory::getDocument();
		}
		$this->document->setTitle(JText::_('COM_REALESTATENOW_FEATURE_TYPES'));
		$this->document->addStyleSheet(JURI::root() . "administrator/components/com_realestatenow/assets/css/feature_types.css", (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');
	}

	/**
	 * Escapes a value for output in a view script.
	 *
	 * @param   mixed  $var  The output to escape.
	 *
	 * @return  mixed  The escaped value.
	 */
	public function escape($var)
	{
		if(strlen($var) > 50)
		{
			// use the helper htmlEscape method instead and shorten the string
			return RealestatenowHelper::htmlEscape($var, $this->_charset, true);
		}
		// use the helper htmlEscape method instead.
		return RealestatenowHelper::htmlEscape($var, $this->_charset);
	}

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 */
	protected function getSortFields()
	{
		return array(
			'a.sorting' => JText::_('JGRID_HEADING_ORDERING'),
			'a.published' => JText::_('JSTATUS'),
			'a.featurename' => JText::_('COM_REALESTATENOW_FEATURE_TYPE_FEATURENAME_LABEL'),
			'a.featuretype' => JText::_('COM_REALESTATENOW_FEATURE_TYPE_FEATURETYPE_LABEL'),
			'a.id' => JText::_('JGRID_HEADING_ID')
		);
	}

	protected function getTheFeaturetypeSelections()
	{
		// [Interpretation 10543] Get a db connection.
		$db = JFactory::getDbo();

		// [Interpretation 10545] Create a new query object.
		$query = $db->getQuery(true);

		// [Interpretation 10547] Select the text.
		$query->select($db->quoteName('featuretype'));
		$query->from($db->quoteName('#__realestatenow_feature_type'));
		$query->order($db->quoteName('featuretype') . ' ASC');

		// [Interpretation 10551] Reset the query using our newly populated query object.
		$db->setQuery($query);

		$results = $db->loadColumn();

		if ($results)
		{
			// [Interpretation 10559] get model
			$model = $this->getModel();
			$results = array_unique($results);
			$_filter = array();
			foreach ($results as $featuretype)
			{
				// [Interpretation 10570] Translate the featuretype selection
				$text = $model->selectionTranslation($featuretype,'featuretype');
				// [Interpretation 10572] Now add the featuretype and its text to the options array
				$_filter[] = JHtml::_('select.option', $featuretype, JText::_($text));
			}
			return $_filter;
		}
		return false;
	}
}
