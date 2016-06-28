<?php
App::uses('AppController', 'Controller');
/**
 * PropertiesPhotos Controller
 *
 * @property PropertiesPhoto $PropertiesPhoto
 * @property PaginatorComponent $Paginator
 */
class PropertiesPhotosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter()
	{
		$this->Auth->Allow('mobile_add', 'mobile_delete', 'mobile_viewAll');
	}	
/**
██╗    ██╗███████╗██████╗     ███████╗███████╗██████╗ ██╗   ██╗██╗ ██████╗███████╗███████╗
██║    ██║██╔════╝██╔══██╗    ██╔════╝██╔════╝██╔══██╗██║   ██║██║██╔════╝██╔════╝██╔════╝
██║ █╗ ██║█████╗  ██████╔╝    ███████╗█████╗  ██████╔╝██║   ██║██║██║     █████╗  ███████╗
██║███╗██║██╔══╝  ██╔══██╗    ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║██║     ██╔══╝  ╚════██║
╚███╔███╔╝███████╗██████╔╝    ███████║███████╗██║  ██║ ╚████╔╝ ██║╚██████╗███████╗███████║
 ╚══╝╚══╝ ╚══════╝╚═════╝     ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝ ╚═════╝╚══════╝╚══════╝
*/

 	/**
	███╗   ███╗ ██████╗ ██████╗ ██╗██╗     ███████╗     █████╗ ██████╗ ██████╗ 
	████╗ ████║██╔═══██╗██╔══██╗██║██║     ██╔════╝    ██╔══██╗██╔══██╗██╔══██╗
	██╔████╔██║██║   ██║██████╔╝██║██║     █████╗      ███████║██║  ██║██║  ██║
	██║╚██╔╝██║██║   ██║██╔══██╗██║██║     ██╔══╝      ██╔══██║██║  ██║██║  ██║
	██║ ╚═╝ ██║╚██████╔╝██████╔╝██║███████╗███████╗    ██║  ██║██████╔╝██████╔╝
	╚═╝     ╚═╝ ╚═════╝ ╚═════╝ ╚═╝╚══════╝╚══════╝    ╚═╝  ╚═╝╚═════╝ ╚═════╝ 
 	*/
	public function mobile_add()
	{
		set_time_limit(300);

		$result = $this->setUp();

		$result = $this->isPost($result, $_POST, 'properties_photo', "Didn't receive the request in a POST in the param 'properties_photo'.");

		if($result['ready'])
		{
			$result = $this->paramRequired($result, 'properties_photo_property_id', "Didn't receive the Property id.");
			$result = $this->paramRequired($result, 'properties_photo_string', "Didn't receive the Image string.");
			$result = $this->paramRequired($result, 'properties_photo_type', "Didn't receive the type.");

			if($result['ready'])
			{
				$result = $this->safeToURL($result, $result['data']['properties_photo_string']);
			}

			if($result['ready'])
			{
				$this->loadModel('Property');
				$response = $this->Property->findAllById($result['data']['properties_photo_property_id']);

				if(!$response)
				{
					$result = $this->addFailError($result, "There is no Property registered with that id.");
				}
				else
				{
					$result['data']['properties_photo_id'] = null;

					if($result['data']['properties_photo_type']=="Main")
					{
						$response = $this->PropertiesPhoto->findAllByPropertiesIdAndType($result['data']['properties_photo_property_id'], "Main");

						if($response)
						{
							//In the case that there is already a Main image for this property, we are going to replace it.
							$result['data']['properties_photo_id'] = $response[0]['PropertiesPhoto']['id'];
						}
					}

					$newPropertiesPhoto = array(
							'id'			=>	$result['data']['properties_photo_id'],
							'properties_id'	=>	$result['data']['properties_photo_property_id'],
							'type'			=>	$result['data']['properties_photo_type'],
							'creationdate'	=>	$this->getFullDate()
						);

					$response = $this->PropertiesPhoto->save($newPropertiesPhoto);

					if(!$response)
					{
						$result = $this->addFailError($result, "There was an error trying to upload");
					}
					else
					{
						if($result['data']['properties_photo_id']==null)
						{
							$result['data']['properties_photo_id'] = $this->PropertiesPhoto->id;
						}

						$result['data']['properties_photo_string'] = $this->stringFromSafeToNormal($result['data']['properties_photo_string']);

						$data = base64_decode($result['data']['properties_photo_string']);

						$fileName = 'img/properties/'.$result['data']['properties_photo_id'].'.jpg';
						$response = file_put_contents($fileName, $data);

					}
				}
			}			
		}

		$this->printResults($result);
	}

	/**
	███╗   ███╗ ██████╗ ██████╗ ██╗██╗     ███████╗    ██████╗ ███████╗██╗     ███████╗████████╗███████╗
	████╗ ████║██╔═══██╗██╔══██╗██║██║     ██╔════╝    ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝
	██╔████╔██║██║   ██║██████╔╝██║██║     █████╗      ██║  ██║█████╗  ██║     █████╗     ██║   █████╗  
	██║╚██╔╝██║██║   ██║██╔══██╗██║██║     ██╔══╝      ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝  
	██║ ╚═╝ ██║╚██████╔╝██████╔╝██║███████╗███████╗    ██████╔╝███████╗███████╗███████╗   ██║   ███████╗
	╚═╝     ╚═╝ ╚═════╝ ╚═════╝ ╚═╝╚══════╝╚══════╝    ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝
	*/
	public function mobile_delete()
	{
		$result = $this->setUp();

		$result = $this->isPost($result, $_POST, 'properties_photo', "Didn't receive the request in a POST in the param 'properties_photo'.");

		if($result['ready'])
		{
			$result = $this->paramRequired($result, 'properties_photo_id', "Didn't receive the photo id.");

			if($result['ready'])
			{
				$response = $this->PropertiesPhoto->findAllById($result['data']['properties_photo_id']);

				if(!$response)
				{
					$result = $this->addFailError($result, "There isn't any photo registered with that id.");
				}
				else
				{
					$this->PropertiesPhoto->id = $result['data']['properties_photo_id'];
					$response = $this->PropertiesPhoto->delete();

					if(!$response)
					{
						$result = $this->addFailError($result, "There was an error trying to delete the photo.");
					}
					else
					{
						//Actions after deleting the photo. 
						$response = unlink('img/properties/'.$result['data']['properties_photo_id'].'.jpg');
					}
				}
			}
		}

		$this->printResults($result);
	}

	/**
	███╗   ███╗ ██████╗ ██████╗ ██╗██╗     ███████╗    ██╗   ██╗██╗███████╗██╗    ██╗     █████╗ ██╗     ██╗     
	████╗ ████║██╔═══██╗██╔══██╗██║██║     ██╔════╝    ██║   ██║██║██╔════╝██║    ██║    ██╔══██╗██║     ██║     
	██╔████╔██║██║   ██║██████╔╝██║██║     █████╗      ██║   ██║██║█████╗  ██║ █╗ ██║    ███████║██║     ██║     
	██║╚██╔╝██║██║   ██║██╔══██╗██║██║     ██╔══╝      ╚██╗ ██╔╝██║██╔══╝  ██║███╗██║    ██╔══██║██║     ██║     
	██║ ╚═╝ ██║╚██████╔╝██████╔╝██║███████╗███████╗     ╚████╔╝ ██║███████╗╚███╔███╔╝    ██║  ██║███████╗███████╗
	╚═╝     ╚═╝ ╚═════╝ ╚═════╝ ╚═╝╚══════╝╚══════╝      ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝     ╚═╝  ╚═╝╚══════╝╚══════╝
	*/
	public function mobile_viewAll()
	{
		$result = $this->setUp();

		$result = $this->isPost($result, $_POST, 'properties_photo', "Didn't receive the request in a POST in the param 'properties_photo'.");

		if($result['ready'])
		{
			$result = $this->paramRequired($result, 'properties_photo_property_id', "Didn't receive the photo id.");

			if($result['ready'])
			{
				$propertiesPhotosList = $this->PropertiesPhoto->findAllByPropertiesId($result['data']['properties_photo_property_id']);

				if(!$propertiesPhotosList)
				{
					$result = $this->addFailError($result, "There isn't any photo registered to that property id.");
				}
				else
				{
					$photos = array();
					foreach ($propertiesPhotosList as $propertyPhoto) 
					{
						array_push($photos, $propertyPhoto['PropertiesPhoto']);
					}

					$result['propertiesPhotos'] = $photos;
				}
			}
		}

		$this->printResults($result);
	}	

 /**
██╗   ██╗ █████╗ ██╗     ██╗██████╗  █████╗ ████████╗██╗ ██████╗ ███╗   ██╗
██║   ██║██╔══██╗██║     ██║██╔══██╗██╔══██╗╚══██╔══╝██║██╔═══██╗████╗  ██║
██║   ██║███████║██║     ██║██║  ██║███████║   ██║   ██║██║   ██║██╔██╗ ██║
╚██╗ ██╔╝██╔══██║██║     ██║██║  ██║██╔══██║   ██║   ██║██║   ██║██║╚██╗██║
 ╚████╔╝ ██║  ██║███████╗██║██████╔╝██║  ██║   ██║   ██║╚██████╔╝██║ ╚████║
  ╚═══╝  ╚═╝  ╚═╝╚══════╝╚═╝╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚═╝ ╚═════╝ ╚═╝  ╚═══╝
 */

	public function setUp()
	{
    	$this->autoRender=	false;  

    	$result 			= 	array();
    	$result['error'] 	= 	array();
    	$result['message']	=	"Success";
    	$result['ready']	=	true;

    	return $result;
	}

	public function printResults($result)
	{
		unset($result['ready']);
		$this->response->sharable(true, 61);
		$this->response->type('json');
		$this->response->body(json_encode($result));
		return $this->response;    	 
	}


	public function isPost($result, $post, $index, $errorMessage)
	{
		if(!isset($post[$index]))
		{
			$result['message']	=	"Fail";
			$result['ready']	=	false;
			array_push($result['error'], $errorMessage);			
		}
		else
		{
			$result['data']	= json_decode($_POST[$index], true);
		}

		return $result;
	}

	public function paramSet($param=null, $errorMessage="",$result=null)
	{
		if(!isset($param))
		{	
			$result['ready']	=	false;
			array_push($result['error'], $errorMessage);
		}

		return $result;
	}

	public function updateValidation($result, $datosIndex, $updateIndex, $updateType)
	{
		if( (isset($result['data'][$datosIndex])) && ($result['data'][$datosIndex]!="") )
		{
			if($updateType=="String")
			{
				$result['update'][$updateIndex] =	"'".$result['data'][$datosIndex]."'";
			}
			else
			{
				//Else is "Numeric" or "Boolean"
				$result['update'][$updateIndex] =	$result['data'][$datosIndex];
			}
		}

		return $result;
	}

	public function paramRequired($result, $dataIndex, $errorMessage)
	{
		if((!isset($result['data'][$dataIndex]))||($result['data'][$dataIndex]==""))
		{
			$result['ready']	=	false;
			$result['message']	=	"Fail";
			array_push($result['error'], $errorMessage);
		}
		
		return $result;
	}

	public function paramRequiredArray($param=null, $errorMessage="", $notEmptyMessage="",$result=null)
	{
		if((!isset($param))||($param==""))
		{	
			$result['ready']	=	false;
			$result['message']	=	"Fail";
			array_push($result['error'], $errorMessage);
		}
		elseif (count($param)==0) 
		{
			$result['ready']	=	false;
			$result['message']	=	"Fail";
			array_push($result['error'], $notEmptyMessage);
		}

		return $result;
	}

	public function addError($result, $errorMessage)
	{
		array_push($result['error'], $errorMessage);
		
		return $result;
	}

	public function addFailError($result, $errorMessage)
	{
		$result['ready']	=	false;
		$result['message']	=	"Fail";		
		
		array_push($result['error'], $errorMessage);		
		return $result;
	}	

	public function getFullDate()
	{
	    date_default_timezone_set('America/Caracas');
	    $date = new DateTime();
	    return $date->format('Y-m-d H:i:s');
	}

	public function getDate()
	{
	    date_default_timezone_set('America/Caracas');
	    $date = new DateTime();
	    return $date->format('Y-m-d');
	} 

	public function safeToURL($result, $baseString)
	 {
	 	if(strpos($baseString, ' ') !== FALSE)
	 	{
			$result['ready']	=	false;
			$result['message']	=	"Fail";		
			
			array_push($result['error'], "This string cant be converted to an image.");	 		
	 	}

	 	return $result;
	 }

	public function stringFromSafeToNormal($safeString)
	{
		$safeString 	= str_replace("-", "+", $safeString);
		$safeString 	= str_replace("_", "/", $safeString);

		return $safeString;		
	} 


/**
██████╗  █████╗  ██████╗██╗  ██╗███████╗███╗   ██╗██████╗ 
██╔══██╗██╔══██╗██╔════╝██║ ██╔╝██╔════╝████╗  ██║██╔══██╗
██████╔╝███████║██║     █████╔╝ █████╗  ██╔██╗ ██║██║  ██║
██╔══██╗██╔══██║██║     ██╔═██╗ ██╔══╝  ██║╚██╗██║██║  ██║
██████╔╝██║  ██║╚██████╗██║  ██╗███████╗██║ ╚████║██████╔╝
╚═════╝ ╚═╝  ╚═╝ ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═══╝╚═════╝ 
*/
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PropertiesPhoto->recursive = 0;
		$this->set('propertiesPhotos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PropertiesPhoto->exists($id)) {
			throw new NotFoundException(__('Invalid properties photo'));
		}
		$options = array('conditions' => array('PropertiesPhoto.' . $this->PropertiesPhoto->primaryKey => $id));
		$this->set('propertiesPhoto', $this->PropertiesPhoto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PropertiesPhoto->create();
			if ($this->PropertiesPhoto->save($this->request->data)) {
				$this->Flash->success(__('The properties photo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The properties photo could not be saved. Please, try again.'));
			}
		}
		$properties = $this->PropertiesPhoto->Property->find('list');
		$this->set(compact('properties'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PropertiesPhoto->exists($id)) {
			throw new NotFoundException(__('Invalid properties photo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PropertiesPhoto->save($this->request->data)) {
				$this->Flash->success(__('The properties photo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The properties photo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PropertiesPhoto.' . $this->PropertiesPhoto->primaryKey => $id));
			$this->request->data = $this->PropertiesPhoto->find('first', $options);
		}
		$properties = $this->PropertiesPhoto->Property->find('list');
		$this->set(compact('properties'));
	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PropertiesPhoto->id = $id;
		if (!$this->PropertiesPhoto->exists()) {
			throw new NotFoundException(__('Invalid properties photo'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PropertiesPhoto->delete()) {
			$this->Flash->success(__('The properties photo has been deleted.'));
		} else {
			$this->Flash->error(__('The properties photo could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
