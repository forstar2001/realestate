<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		properties.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Properties Controller
 */
class RealestatenowControllerProperties extends JControllerAdmin
{
	/**
	 * The prefix to use with controller messages.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $text_prefix = 'COM_REALESTATENOW_PROPERTIES';

	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JModelLegacy  The model.
	 *
	 * @since   1.6
	 */
	public function getModel($name = 'Property', $prefix = 'RealestatenowModel', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}

	public function exportData()
	{
		// [Interpretation 8912] Check for request forgeries
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		// [Interpretation 8914] check if export is allowed for this user.
		$user = JFactory::getUser();
		if ($user->authorise('property.export', 'com_realestatenow') && $user->authorise('core.export', 'com_realestatenow'))
		{
			// [Interpretation 8918] Get the input
			$input = JFactory::getApplication()->input;
			$pks = $input->post->get('cid', array(), 'array');
			// [Interpretation 8921] Sanitize the input
			JArrayHelper::toInteger($pks);
			// [Interpretation 8923] Get the model
			$model = $this->getModel('Properties');
			// [Interpretation 8925] get the data to export
			$data = $model->getExportData($pks);
			if (RealestatenowHelper::checkArray($data))
			{
				// [Interpretation 8929] now set the data to the spreadsheet
				$date = JFactory::getDate();
				RealestatenowHelper::xls($data,'Properties_'.$date->format('jS_F_Y'),'Properties exported ('.$date->format('jS F, Y').')','properties');
			}
		}
		// [Interpretation 8934] Redirect to the list screen with error.
		$message = JText::_('COM_REALESTATENOW_EXPORT_FAILED');
		$this->setRedirect(JRoute::_('index.php?option=com_realestatenow&view=properties', false), $message, 'error');
		return;
	}


	public function importData()
	{
		// [Interpretation 8943] Check for request forgeries
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		// [Interpretation 8945] check if import is allowed for this user.
		$user = JFactory::getUser();
		if ($user->authorise('property.import', 'com_realestatenow') && $user->authorise('core.import', 'com_realestatenow'))
		{
			// [Interpretation 8949] Get the import model
			$model = $this->getModel('Properties');
			// [Interpretation 8951] get the headers to import
			$headers = $model->getExImPortHeaders();
			if (RealestatenowHelper::checkObject($headers))
			{
				// [Interpretation 8955] Load headers to session.
				$session = JFactory::getSession();
				$headers = json_encode($headers);
				$session->set('property_VDM_IMPORTHEADERS', $headers);
				$session->set('backto_VDM_IMPORT', 'properties');
				$session->set('dataType_VDM_IMPORTINTO', 'property');
				// [Interpretation 8961] Redirect to import view.
				$message = JText::_('COM_REALESTATENOW_IMPORT_SELECT_FILE_FOR_PROPERTIES');
				$this->setRedirect(JRoute::_('index.php?option=com_realestatenow&view=import', false), $message);
				return;
			}
		}
		// [Interpretation 8981] Redirect to the list screen with error.
		$message = JText::_('COM_REALESTATENOW_IMPORT_FAILED');
		$this->setRedirect(JRoute::_('index.php?option=com_realestatenow&view=properties', false), $message, 'error');
		return;
	}
/***[INSERTED$$$$]***//*507*/
 	/*18-1-2017 Logic Code*/
 	public function mytrash(){
 		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
 		$cid = JRequest::getVar('cid', array(), '', 'array');

 		if (!is_array($cid) || count($cid) < 1)
 			{
 				JError::raiseWarning(500, JText::_($this->text_prefix . '_NO_ITEM_SELECTED'));
 			}
 		else
 			{
 			for($i = 0; $i<count($cid); $i++){
 				$db = JFactory::getDbo();
 				$query = $db->getQuery(true);
 				$conditions = array(
 				$db->quoteName('id') . '='.$cid[$i]
 				);

 				$query->delete($db->quoteName('#__realestatenow_property'));

 				$query->where($conditions);

 				 $db->setQuery($query);
 				$resulta = $db->execute();
 				if($resulta){
 					$tables = array('realestatenow_residential','realestatenow_multifamily','realestatenow_land','realestatenow_financial','realestatenow_commercial','realestatenow_area','realestatenow_feature','realestatenow_rental','realestatenow_image');
 					foreach($tables as $table) {
 						$db = JFactory::getDbo();
 						$query = $db->getQuery(true);
 						$conditions = array(
 						$db->quoteName('propid') . '='.$cid[$i]
 						);

 						$query->delete($db->quoteName('#__'.$table));
 						$query->where($conditions);

 						$db->setQuery($query);
 						$result = $db->execute();

 					}
 				}
 				/*Delete Images with folder*/
 				$dbimage = JFactory::getDbo();
 						$query1 = $dbimage->getQuery(true);
 						$conditions = array(
 						$dbimage->quoteName('propid') . '='.$cid[$i],
 						$dbimage->quoteName('remote') . '=0'
 						);

 						$query1->delete($dbimage->quoteName('#__realestatenow_image'));
 						$query1->where($conditions);

 						$dbimage->setQuery($query1);
 						$resulti = $dbimage->execute();
 				$this->removeDirectory(JPATH_SITE.'/media/com_realestatenow/pictures/'.$cid[$i] );
 			}
 			}
 			if($result){
 							$this->setMessage('Properties Deleted successfully');
 						}else{
 							$this->setMessage('Please Try again');
 						}
 			$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list, false));
 	}

 public function removeDirectory($path) {
  	$files = glob($path . '/*');
 	foreach ($files as $file) {
 		is_dir($file) ? removeDirectory($file) : unlink($file);
 	}
 	rmdir($path);
  	return;
 }
 	/*18-1-2017 Logic Code*/

/***[/INSERTED$$$$]***/
}
