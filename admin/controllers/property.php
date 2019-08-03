<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Most Wanted Web Services, Inc. 
/-------------------------------------------------------------------------------------------------------/

	@version		3.1.18
	@build			29th October, 2018
	@created		1st May, 2016
	@package		Real Estate NOW!
	@subpackage		property.php
	@author			Most Wanted Web Services, Inc. <https://mostwantedrealestatesites.com>	
	@copyright		Copyright (C) 2015-2018. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
	
	Real Estate NOW! Component
	
/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Property Controller
 */
class RealestatenowControllerProperty extends JControllerForm
{
	/**
	 * Current or most recently performed task.
	 *
	 * @var    string
	 * @since  12.2
	 * @note   Replaces _task.
	 */
	protected $task;

	/**
	 * Class constructor.
	 *
	 * @param   array  $config  A named array of configuration variables.
	 *
	 * @since   1.6
	 */
	public function __construct($config = array())
	{
		$this->view_list = 'Properties'; // safeguard for setting the return view listing to the main view.
		parent::__construct($config);
	}

 /**
	 * Method to upload images
	 *
	 * @param   object  $model  The model.
	 *
	 * @return  boolean   True if successful, false otherwise and internal error is set.
	 *
	 * @since   2.5
	 */
	public function uploadImage()
	{ 
		$app = JFactory::getApplication();		
		$jinput = $app->input; 
		  
		$propertyId =$jinput->get('propertyId', '', 'int');
		
		if(!empty($propertyId))
		{	
	        $targetPath = JPATH_SITE.'/media/com_realestatenow/pictures/'.$propertyId; 
			$folderPath = '/media/com_realestatenow/pictures/'.$propertyId; 
			
            if (!file_exists($targetPath)) {
               mkdir($targetPath, 0755, true);
            }	
            		
			if (!empty($_FILES)) {
                
                $db = JFactory::getDbo();
                
                if(is_array ($_FILES['file']['name'])){
                    for($i=0;$i<count($_FILES['file']['name']);$i++){
                        
                        $tempFile = $_FILES['file']['tmp_name'][$i];
                        $targetFileName = uniqid();
                        $originalFileName = $_FILES['file']['name'][$i];
    
                        /*
                         * Use this if Fileinfo is enabled on the server
                         */
                        //$result = new finfo();
                        //if (is_resource($result) === true)
                        //    $targetFileType = $result->file($targetFile, FILEINFO_MIME_TYPE);
                        $targetFileType = strtolower(explode('.',$originalFileName)[1]);
    
    
                        $targetFile =  $targetPath.'/'. $targetFileName.'.'.$targetFileType;
                        $targetThumbnailFile = $targetPath.'/'. $targetFileName.'_th'.'.'.$targetFileType;
                        $targetMainFile = $targetPath.'/'. $targetFileName.'_fs'.'.'.$targetFileType;
                        
                        move_uploaded_file($tempFile,$targetFile);
                        
                        $this->generate_image_thumbnail($targetFile, $targetThumbnailFile);
                        $this->generate_image_main($targetFile, $targetMainFile);
                        
                        $filePath = $folderPath.'/';

                        $userid = JFactory::getUser()->id;
                        
                        $columns = array('filename', 'type', 'path', 'propid', 'title', 'created_by', 'created');
                        
                        $values = array(
                            $db->quote($targetFileName),
                            $db->quote($targetFileType),
                            $db->quote($filePath),
                            $db->quote($propertyId),
                            $db->quote($originalFileName),
                            $db->quote($userid), 'NOW()'
                        );
                        $query = $db->getQuery(true);
                        $query
                            ->insert($db->quoteName('#__realestatenow_image'))
                            ->columns($db->quoteName($columns))
                            ->values(implode(',', $values));

                        $db->setQuery($query);
                        $exe = $db->query();
                        $insertid = $db->insertid();
                    }
                }else{
                            $tempFile = $_FILES['file']['tmp_name'];
                            $targetFile =  $targetPath.'/'. $_FILES['file']['name'];
                            move_uploaded_file($tempFile,$targetFile);

                            $filePath = $folderPath.'/';

                            $userid = JFactory::getUser()->id;

                            $db = JFactory::getDbo();
                    $query = $db->getQuery(true);
                            $columns = array('filename', 'path', 'propid', 'title', 'created_by', 'created');
                            $values = array($db->quote($_FILES['file']['name']), $db->quote($filePath), $db->quote($propertyId), $db->quote($_FILES['file']['name']), $db->quote($userid), 'NOW()');
                            $query = $db->getQuery(true);
                    $query
                        ->insert($db->quoteName('#__realestatenow_image'))
                        ->columns($db->quoteName($columns))
                        ->values(implode(',', $values));

                   $db->setQuery($query);
                   $exe = $db->query();
                        $insertid = $db->insertid();
                
                }
                            
			}
		}
		
		die();		
	}
        
        /**
	 * Method to delete images
	 *
	 * @param   object  $model  The model.
	 *
	 * @return  boolean   1 if successful, 0 otherwise and internal error is set.
	 *
	 * @since   2.5
	 */
	public function deleteImage()
	{ 
		$app = JFactory::getApplication();		
		$jinput = $app->input; 
		  
		 $propertyId =$jinput->get('propertyId', '', 'int');
		 $image_id =$jinput->get('key', '', 'INT');
        
        if(!empty($propertyId) && !empty($image_id))
        {
    
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select([
                $db->quoteName('filename'),
                $db->quoteName('path')
            ])
                ->from($db->quoteName('#__realestatenow_image') )
                ->where( $db->quoteName('id') . ' = '. $image_id);
            
            $db->setQuery($query);
            $result = $db->loadObject();
            
            $targetPath = JPATH_SITE.$result->path;
            //$folderPath = '/media/com_realestatenow/pictures/'.$propertyId;
            //$targetFilePath = $targetPath.'/'.$fileName;
            //$filePathDb = $folderPath.'/'.$fileName;
            //$fileExists = file_exists($targetFilePath);
            
            foreach (glob($targetPath.$result->filename.'*') as $filepath) {
                unlink($filepath);
            }
    
            $query = $db->getQuery(true);
            $query->delete($db->quoteName('#__realestatenow_image'));
            $query->where($db->quoteName('id') . ' = ' . $image_id);
            
            $db->setQuery($query);
            $result = $db->execute();
            
            if($result){
                echo true;
            }else{
                echo false;
            }
            
            
            /*if( 0 && $fileExists){
                $fileRemoved =unlink($targetFilePath);
                if($fileRemoved){
                    $conditions = array(
                        $db->quoteName('propid') . ' = '.$propertyId,
                        $db->quoteName('filename') . ' = "' . $fileName . '"',
                        $db->quoteName('path') . ' = "' . $filePathDb. '"'
                    );
                    
                    $query->delete($db->quoteName('#__realestatenow_image'));
                    $query->where($conditions);
                    
                    $db->setQuery($query);
                    $result = $db->execute();
                    if($result){
                        echo true;
                    }else{
                        echo false;
                    }
                }
            }*/
        }
        
        die();
    }

	/** Method to reorder images */
	public function orderImages(){
	    $dbo = JFactory::getDbo();
	    $ordering = json_decode($this->input->get('ordering','[]','raw'));
	    $JDbQuery = $dbo->getQuery(true);
	    $JDbQuery->update( $dbo->quoteName( "#__realestatenow_image") );
	    
        $setString = $dbo->quoteName('ordering') . ' = CASE ' ;
        $keys = [];
	    foreach($ordering as $image){
            $setString .= ' WHEN ' . $dbo->quoteName( 'id' ). ' = '. $image->key . ' THEN ' . $image->index;
	        $keys[] = $image->key;
        }
        
        $setString .= ' END ';
        $JDbQuery->set( $setString )
            ->where( $dbo->quoteName('id') . ' IN (' . implode(',',$keys ) . ')');
        
        $dbo->setQuery( $JDbQuery )->execute();
	    die();
    }
    
    
    private function generate_image_thumbnail($source_image_path, $thumbnail_image_path)
    {
        $thumbnail_image_height = 150;
        list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
        
        switch ($source_image_type) {
            case IMAGETYPE_GIF:
                $source_gd_image = imagecreatefromgif($source_image_path);
                break;
            case IMAGETYPE_JPEG:
                $source_gd_image = imagecreatefromjpeg($source_image_path);
                break;
            case IMAGETYPE_PNG:
                $source_gd_image = imagecreatefrompng($source_image_path);
                break;
        }
        
        if ($source_gd_image === false) {
            return false;
        }
        
        $source_aspect_ratio = $source_image_width / $source_image_height;
        
        $thumbnail_image_width  = $thumbnail_image_height * $source_aspect_ratio ;
        
        
        $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
        
        imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
        imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
        imagedestroy($source_gd_image);
        imagedestroy($thumbnail_gd_image);
        
        return true;
    }
    
    private function generate_image_main($source_image_path, $main_image_path)
    {
        $main_image_height = 500;
        
        list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
        
        switch ($source_image_type) {
            case IMAGETYPE_GIF:
                $source_gd_image = imagecreatefromgif($source_image_path);
                break;
            case IMAGETYPE_JPEG:
                $source_gd_image = imagecreatefromjpeg($source_image_path);
                break; case IMAGETYPE_PNG:
                $source_gd_image = imagecreatefrompng($source_image_path);
                break;
        }
        
        if ($source_gd_image === false) {
            return false;
        }
        
        $source_aspect_ratio = $source_image_width / $source_image_height;
        
        $main_image_width  = $main_image_height * $source_aspect_ratio ;
        
        
        $main_gd_image = imagecreatetruecolor($main_image_width, $main_image_height);
        imagecopyresampled($main_gd_image, $source_gd_image, 0, 0, 0, 0, $main_image_width, $main_image_height, $source_image_width, $source_image_height);
        imagejpeg($main_gd_image, $main_image_path, 90);
        imagedestroy($source_gd_image);
        imagedestroy($main_gd_image);
        return true;
    } 

        /**
	 * Method override to check if you can add a new record.
	 *
	 * @param   array  $data  An array of input data.
	 *
	 * @return  boolean
	 *
	 * @since   1.6
	 */
	protected function allowAdd($data = array())
	{
		// [Interpretation 10873] Get user object.
		$user = JFactory::getUser();
		// [Interpretation 10878] Access check.
		$access = $user->authorise('property.access', 'com_realestatenow');
		if (!$access)
		{
			return false;
		}

		// [Interpretation 10891] In the absense of better information, revert to the component permissions.
		return $user->authorise('property.create', $this->option);
	}

	/**
	 * Method override to check if you can edit an existing record.
	 *
	 * @param   array   $data  An array of input data.
	 * @param   string  $key   The name of the key for the primary key.
	 *
	 * @return  boolean
	 *
	 * @since   1.6
	 */
	protected function allowEdit($data = array(), $key = 'id')
	{		// [Interpretation 10932] get user object.
		$user = JFactory::getUser();
		// [Interpretation 10934] get record id.
		$recordId = (int) isset($data[$key]) ? $data[$key] : 0;


		// [Interpretation 10941] Access check.
		$access = ($user->authorise('property.access', 'com_realestatenow.property.' . (int) $recordId) && $user->authorise('property.access', 'com_realestatenow'));
		if (!$access)
		{
			return false;
		}

		if ($recordId)
		{
			// [Interpretation 10950] The record has been set. Check the record permissions.
			$permission = $user->authorise('property.edit', 'com_realestatenow.property.' . (int) $recordId);
			if (!$permission)
			{
				if ($user->authorise('property.edit.own', 'com_realestatenow.property.' . $recordId))
				{
					// [Interpretation 10972] Fallback on edit.own. Now test the owner is the user.
					$ownerId = (int) isset($data['created_by']) ? $data['created_by'] : 0;
					if (empty($ownerId))
					{
						// [Interpretation 10976] Need to do a lookup from the model.
						$record = $this->getModel()->getItem($recordId);

						if (empty($record))
						{
							return false;
						}
						$ownerId = $record->created_by;
					}

					// [Interpretation 10984] If the owner matches 'me' then do the test.
					if ($ownerId == $user->id)
					{
						if ($user->authorise('property.edit.own', 'com_realestatenow'))
						{
							return true;
						}
					}
				}
				return false;
			}
		}
		// [Interpretation 11016] Since there is no permission, revert to the component permissions.
		return $user->authorise('property.edit', $this->option);
	}

	/**
	 * Gets the URL arguments to append to an item redirect.
	 *
	 * @param   integer  $recordId  The primary key id for the item.
	 * @param   string   $urlVar    The name of the URL variable for the id.
	 *
	 * @return  string  The arguments to append to the redirect URL.
	 *
	 * @since   1.6
	 */
	protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id')
	{
		// get the referral options (old method use return instead see parent)
		$ref = $this->input->get('ref', 0, 'string');
		$refid = $this->input->get('refid', 0, 'int');

		// get redirect info.
		$append = parent::getRedirectToItemAppend($recordId, $urlVar);

		// set the referral options
		if ($refid && $ref)
                {
			$append = '&ref=' . (string)$ref . '&refid='. (int)$refid . $append;
		}
		elseif ($ref)
		{
			$append = '&ref='. (string)$ref . $append;
		}

		return $append;
	}

	/**
	 * Method to run batch operations.
	 *
	 * @param   object  $model  The model.
	 *
	 * @return  boolean   True if successful, false otherwise and internal error is set.
	 *
	 * @since   2.5
	 */
	public function batch($model = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Set the model
		$model = $this->getModel('Property', '', array());

		// Preset the redirect
		$this->setRedirect(JRoute::_('index.php?option=com_realestatenow&view=properties' . $this->getRedirectToListAppend(), false));

		return parent::batch($model);
	}

	/**
	 * Method to cancel an edit.
	 *
	 * @param   string  $key  The name of the primary key of the URL variable.
	 *
	 * @return  boolean  True if access level checks pass, false otherwise.
	 *
	 * @since   12.2
	 */
	public function cancel($key = null)
	{
		// get the referral options
		$this->ref = $this->input->get('ref', 0, 'word');
		$this->refid = $this->input->get('refid', 0, 'int');

		// Check if there is a return value
		$return = $this->input->get('return', null, 'base64');

		$cancel = parent::cancel($key);

		if (!is_null($return) && JUri::isInternal(base64_decode($return)))
		{
			$redirect = base64_decode($return);

			// Redirect to the return value.
			$this->setRedirect(
				JRoute::_(
					$redirect, false
				)
			);
		}
		elseif ($this->refid && $this->ref)
		{
			$redirect = '&view=' . (string)$this->ref . '&layout=edit&id=' . (int)$this->refid;

			// Redirect to the item screen.
			$this->setRedirect(
				JRoute::_(
					'index.php?option=' . $this->option . $redirect, false
				)
			);
		}
		elseif ($this->ref)
		{
			$redirect = '&view='.(string)$this->ref;

			// Redirect to the list screen.
			$this->setRedirect(
				JRoute::_(
					'index.php?option=' . $this->option . $redirect, false
				)
			);
		}
		return $cancel;
	}

	/**
	 * Method to save a record.
	 *
	 * @param   string  $key     The name of the primary key of the URL variable.
	 * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
	 *
	 * @return  boolean  True if successful, false otherwise.
	 *
	 * @since   12.2
	 */
	public function save($key = null, $urlVar = null)
	{
		// get the referral options
		$this->ref = $this->input->get('ref', 0, 'word');
		$this->refid = $this->input->get('refid', 0, 'int');

		// Check if there is a return value
		$return = $this->input->get('return', null, 'base64');
		$canReturn = (!is_null($return) && JUri::isInternal(base64_decode($return)));

		if ($this->ref || $this->refid || $canReturn)
		{
			// to make sure the item is checkedin on redirect
			$this->task = 'save';
		}

		$saved = parent::save($key, $urlVar);

		// This is not needed since parent save already does this
		// Due to the ref and refid implementation we need to add this
		if ($canReturn)
		{
			$redirect = base64_decode($return);

			// Redirect to the return value.
			$this->setRedirect(
				JRoute::_(
					$redirect, false
				)
			);
		}
		elseif ($this->refid && $this->ref)
		{
			$redirect = '&view=' . (string)$this->ref . '&layout=edit&id=' . (int)$this->refid;

			// Redirect to the item screen.
			$this->setRedirect(
				JRoute::_(
					'index.php?option=' . $this->option . $redirect, false
				)
			);
		}
		elseif ($this->ref)
		{
			$redirect = '&view=' . (string)$this->ref;

			// Redirect to the list screen.
			$this->setRedirect(
				JRoute::_(
					'index.php?option=' . $this->option . $redirect, false
				)
			);
		}
		return $saved;
	}

	/**
	 * Function that allows child controller access to model data
	 * after the data has been saved.
	 *
	 * @param   JModel  &$model     The data model object.
	 * @param   array   $validData  The validated data.
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	protected function postSaveHook(JModelLegacy $model, $validData = array())
	{
		return;
	}

}
