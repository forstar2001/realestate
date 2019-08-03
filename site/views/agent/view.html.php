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
 * Agent View class
 */
class RealestatenowViewAgent extends JViewLegacy
{
	/**
	 * display method of View
	 * @return void
	 */
	public function display($tpl = null)
	{
		// set params
		$this->params = JComponentHelper::getParams('com_realestatenow');
		// Assign the variables
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->script = $this->get('Script');
		$this->state = $this->get('State');
		// get action permissions
		$this->canDo = RealestatenowHelper::getActions('agent', $this->item);
		// get input
		$jinput = JFactory::getApplication()->input;
		$this->ref = $jinput->get('ref', 0, 'word');
		$this->refid = $jinput->get('refid', 0, 'int');
		$return = $jinput->get('return', null, 'base64');
		// set the referral string
		$this->referral = '';
		if ($this->refid && $this->ref)
		{
			// return to the item that referred to this item
			$this->referral = '&ref=' . (string)$this->ref . '&refid=' . (int)$this->refid;
		}
		elseif($this->ref)
		{
			// return to the list view that referred to this item
			$this->referral = '&ref=' . (string)$this->ref;
		}
		// check return value
		if (!is_null($return))
		{
			// add the return value
			$this->referral .= '&return=' . (string)$return;
		}

		// [Interpretation 8068] Get Linked view data
		$this->vwjproperty_listings = $this->get('Vwjproperty_listings');

		// Set the toolbar
		$this->addToolBar();
		
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
		// adding the joomla edit toolbar to the front
		JLoader::register('JToolbarHelper', JPATH_ADMINISTRATOR.'/includes/toolbar.php');
		JFactory::getApplication()->input->set('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId	= $user->id;
		$isNew = $this->item->id == 0;

		JToolbarHelper::title( JText::_($isNew ? 'COM_REALESTATENOW_AGENT_NEW' : 'COM_REALESTATENOW_AGENT_EDIT'), 'pencil-2 article-add');
		// [Interpretation 11906] Built the actions for new and existing records.
		if (RealestatenowHelper::checkString($this->referral))
		{
			if ($this->canDo->get('agent.create') && $isNew)
			{
				// [Interpretation 11918] We can create the record.
				JToolBarHelper::save('agent.save', 'JTOOLBAR_SAVE');
			}
			elseif ($this->canDo->get('agent.edit'))
			{
				// [Interpretation 11930] We can save the record.
				JToolBarHelper::save('agent.save', 'JTOOLBAR_SAVE');
			}
			if ($isNew)
			{
				// [Interpretation 11935] Do not creat but cancel.
				JToolBarHelper::cancel('agent.cancel', 'JTOOLBAR_CANCEL');
			}
			else
			{
				// [Interpretation 11940] We can close it.
				JToolBarHelper::cancel('agent.cancel', 'JTOOLBAR_CLOSE');
			}
		}
		else
		{
			if ($isNew)
			{
				// [Interpretation 11948] For new records, check the create permission.
				if ($this->canDo->get('agent.create'))
				{
					JToolBarHelper::apply('agent.apply', 'JTOOLBAR_APPLY');
					JToolBarHelper::save('agent.save', 'JTOOLBAR_SAVE');
					JToolBarHelper::custom('agent.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
				};
				JToolBarHelper::cancel('agent.cancel', 'JTOOLBAR_CANCEL');
			}
			else
			{
				if ($this->canDo->get('agent.edit'))
				{
					// [Interpretation 11975] We can save the new record
					JToolBarHelper::apply('agent.apply', 'JTOOLBAR_APPLY');
					JToolBarHelper::save('agent.save', 'JTOOLBAR_SAVE');
					// [Interpretation 11978] We can save this record, but check the create permission to see
					// [Interpretation 11979] if we can return to make a new one.
					if ($this->canDo->get('agent.create'))
					{
						JToolBarHelper::custom('agent.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
					}
				}
				$canVersion = ($this->canDo->get('core.version') && $this->canDo->get('agent.version'));
				if ($this->state->params->get('save_history', 1) && $this->canDo->get('agent.edit') && $canVersion)
				{
					JToolbarHelper::versions('com_realestatenow.agent', $this->item->id);
				}
				if ($this->canDo->get('agent.create'))
				{
					JToolBarHelper::custom('agent.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
				}
				JToolBarHelper::cancel('agent.cancel', 'JTOOLBAR_CLOSE');
			}
		}
		JToolbarHelper::divider();
		// [Interpretation 12031] set help url for this view if found
		$help_url = RealestatenowHelper::getHelpUrl('agent');
		if (RealestatenowHelper::checkString($help_url))
		{
			JToolbarHelper::help('COM_REALESTATENOW_HELP_MANAGER', false, $help_url);
		}
		// now initiate the toolbar
		$this->toolbar = JToolbar::getInstance();
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
		if(strlen($var) > 30)
		{
    		// use the helper htmlEscape method instead and shorten the string
			return RealestatenowHelper::htmlEscape($var, $this->_charset, true, 30);
		}
		// use the helper htmlEscape method instead.
		return RealestatenowHelper::htmlEscape($var, $this->_charset);
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$isNew = ($this->item->id < 1);
		if (!isset($this->document))
		{
			$this->document = JFactory::getDocument();
		}
		$this->document->setTitle(JText::_($isNew ? 'COM_REALESTATENOW_AGENT_NEW' : 'COM_REALESTATENOW_AGENT_EDIT'));
		// we need this to fix the form display (TODO)
		$this->document->addStyleSheet(JURI::root()."administrator/templates/isis/css/template.css", (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');
		$this->document->addScript(JURI::root()."administrator/templates/isis/js/template.js", (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript');
		// the default style of this view
		$this->document->addStyleSheet(JURI::root()."components/com_realestatenow/assets/css/agent.css", (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');

		// [Interpretation 8131] Add the CSS for Footable.
		$this->document->addStyleSheet(JURI::root() .'media/com_realestatenow/footable-v2/css/footable.core.min.css', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');

		// [Interpretation 8133] Use the Metro Style
		if (!isset($this->fooTableStyle) || 0 == $this->fooTableStyle)
		{
			$this->document->addStyleSheet(JURI::root() .'media/com_realestatenow/footable-v2/css/footable.metro.min.css', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');
		}
		// [Interpretation 8138] Use the Legacy Style.
		elseif (isset($this->fooTableStyle) && 1 == $this->fooTableStyle)
		{
			$this->document->addStyleSheet(JURI::root() .'media/com_realestatenow/footable-v2/css/footable.standalone.min.css', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');
		}

		// [Interpretation 8143] Add the JavaScript for Footable
		$this->document->addScript(JURI::root() .'media/com_realestatenow/footable-v2/js/footable.js', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript');
		$this->document->addScript(JURI::root() .'media/com_realestatenow/footable-v2/js/footable.sort.js', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript');
		$this->document->addScript(JURI::root() .'media/com_realestatenow/footable-v2/js/footable.filter.js', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript');
		$this->document->addScript(JURI::root() .'media/com_realestatenow/footable-v2/js/footable.paginate.js', (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript');

		$footable = "jQuery(document).ready(function() { jQuery(function () { jQuery('.footable').footable(); }); jQuery('.nav-tabs').on('click', 'li', function() { setTimeout(tableFix, 10); }); }); function tableFix() { jQuery('.footable').trigger('footable_resize'); }";
		$this->document->addScriptDeclaration($footable);

		// default javascript of this view
		$this->document->addScript(JURI::root().$this->script, (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript');
		$this->document->addScript(JURI::root(). "components/com_realestatenow/views/agent/submitbutton.js", (RealestatenowHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript'); 
		JText::script('view not acceptable. Error');
	}
}
