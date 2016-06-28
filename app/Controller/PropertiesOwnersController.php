<?php
App::uses('AppController', 'Controller');
/**
 * PropertiesOwners Controller
 *
 * @property PropertiesOwner $PropertiesOwner
 * @property PaginatorComponent $Paginator
 */
class PropertiesOwnersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter()
	{
		$this->Auth->Allow('mobile_add', 'mobile_delete', 'mobile_viewAll', 'mobile_view', 'mobile_edit', 'view');
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
 		$result 	= 	$this->setUp();

 		$result 	=	$this->isPost($result, $_POST, 'properties_owner', "Didn't receive the request as a POST in 'properties_owner' param.");

 		if($result['ready'])
 		{

 			//var_dump($result['data']);

 			$result 	= 	$this->paramRequired($result, "properties_owner_zip", 					"Didn't receive the property owner zip.");
 			$result 	= 	$this->paramRequired($result, "properties_owner_ext", 					"Didn't receive the property ext.");
 			$result 	= 	$this->paramRequired($result, "properties_owner_type", 					"Didn't receive the property owner type.");
 			$result 	= 	$this->paramRequired($result, "properties_owner_email", 				"Didn't receive the property owner email.");
 			$result 	= 	$this->paramRequired($result, "properties_owner_password", 				"Didn't receive the property owner password.");
 			$result 	= 	$this->paramRequired($result, "properties_owner_last_name", 			"Didn't receive the property owner last name.");
 			$result 	= 	$this->paramRequired($result, "properties_owner_first_name", 			"Didn't receive the property owner first name.");
 			$result 	= 	$this->paramRequired($result, "properties_owner_business_phone", 		"Didn't receive the property bussiness phone.");

 			if($result['ready'])
 			{
 				$PropertiesOwner = $this->PropertiesOwner->findAllByEmail($result['data']['properties_owner_email']);

 				if($PropertiesOwner)
 				{
 					$result = $this->addFailError($result, "There is already a property owner registered with that email.");
 				}
 				else
 				{
					$this->loadModel('User');
					$newUser = array(
							'type'		=> 	$result['data']['properties_owner_type'],
							'email'		=> 	$result['data']['properties_owner_email'],
							'password'	=> 	$result['data']['properties_owner_password']
						); 					

					$response = $this->User->save($newUser);

					if(!$response)
					{
						$result = $this->addFailError($result, "There was an error trying to save your user");
					}
					else
					{
						$newPropertiesOwner = array(
								'zip'					=>	$result['data']['properties_owner_zip'],
								'ext'					=>	$result['data']['properties_owner_ext'],
								'type'					=>	$result['data']['properties_owner_type'],
								'email'					=>	$result['data']['properties_owner_email'],
								'last_name'				=>	$result['data']['properties_owner_last_name'],
								'first_name'			=>	$result['data']['properties_owner_first_name'],
								'business_phone'		=>	$result['data']['properties_owner_business_phone']
							);

						$response = $this->PropertiesOwner->save($newPropertiesOwner);

						if(!$response)
						{
							$result = $this->addFailError($result, "There was an error trying to save the Properties Owner.");
						}
						else
						{
							//Actions after saving.
						}
					}
 				}
 			}

 		}

 		$this->printResults($result); 		
 	}

 	/**
	███╗   ███╗ ██████╗ ██████╗ ██╗██╗     ███████╗    ███████╗██████╗ ██╗████████╗
	████╗ ████║██╔═══██╗██╔══██╗██║██║     ██╔════╝    ██╔════╝██╔══██╗██║╚══██╔══╝
	██╔████╔██║██║   ██║██████╔╝██║██║     █████╗      █████╗  ██║  ██║██║   ██║   
	██║╚██╔╝██║██║   ██║██╔══██╗██║██║     ██╔══╝      ██╔══╝  ██║  ██║██║   ██║   
	██║ ╚═╝ ██║╚██████╔╝██████╔╝██║███████╗███████╗    ███████╗██████╔╝██║   ██║   
	╚═╝     ╚═╝ ╚═════╝ ╚═════╝ ╚═╝╚══════╝╚══════╝    ╚══════╝╚═════╝ ╚═╝   ╚═╝   

 	*/
 	public function mobile_edit()
 	{
 		$result 	= 	$this->setUp();

 		$result 	=	$this->isPost($result, $_POST, 'properties_owner', "Didn't receive the request as a POST in 'properties_owner' param.");

 		if($result['ready'])
 		{
 			$result 	= 	$this->paramRequired($result, "properties_owner_email", 				"Didn't receive the property owner email.");

 			$result 	=	$this->updateValidation($result, "properties_owner_zip", 				"zip",				"Integer");
 			$result 	=	$this->updateValidation($result, "properties_owner_ext", 				"ext",				"String");
 			$result 	=	$this->updateValidation($result, "properties_owner_type", 				"type",				"String");
 			$result 	=	$this->updateValidation($result, "properties_owner_password", 			"password",			"String");
 			$result 	=	$this->updateValidation($result, "properties_owner_last_name", 			"last_name",		"String");
 			$result 	=	$this->updateValidation($result, "properties_owner_first_name", 		"first_name",		"String");
 			$result 	=	$this->updateValidation($result, "properties_owner_bussiness_phone", 	"bussiness_phone",	"String");
 			//$result 	=	$this->updateValidation($result, "properties_owner_profession_category","bussiness_phone",	"String");

 			$result 	=	$this->updateValidation($result, "properties_owner_email_edit",			"email",			"String");

 			if($result['ready'])
 			{
 				$PropertiesOwner = $this->PropertiesOwner->findAllByEmail($result['data']['properties_owner_email']);

 				if($PropertiesOwner)
 				{
					$response 	= 	$this->PropertiesOwner->updateAll( $result['update'] ,array("email"=>$result['data']['properties_owner_email'])); 	

					if($result['data']['properties_owner_email_edit'])
					{
						//Lets make some updates!
 						$user_sql_update 			= 	"UPDATE  `admin_padpat`.`users` SET  `email` =  '".$result['data']['properties_owner_email_edit']."' WHERE  `users`.`email` =  '".$result['data']['properties_owner_email']."';";
						$property_sql_update 		= 	"UPDATE  `admin_padpat`.`properties` SET  `users_email` =  '".$result['data']['properties_owner_email_edit']."' WHERE  `properties`.`users_email` =  '".$result['data']['properties_owner_email']."';";

 						$this->loadModel('User'); 
 						$this->loadModel('Property'); 

 						$this->User->query($user_sql_update);
 						$this->Property->query($property_sql_update);
					}				
 				}
 				else
 				{
 					$result = $this->addFailError($result, "There isn't a property owner registered with that email.");
 				}
 			}

 		}

 		$this->printResults($result); 
 	}

 	/**
	███╗   ███╗ ██████╗ ██████╗ ██╗██╗     ███████╗    ██╗   ██╗██╗███████╗██╗    ██╗
	████╗ ████║██╔═══██╗██╔══██╗██║██║     ██╔════╝    ██║   ██║██║██╔════╝██║    ██║
	██╔████╔██║██║   ██║██████╔╝██║██║     █████╗      ██║   ██║██║█████╗  ██║ █╗ ██║
	██║╚██╔╝██║██║   ██║██╔══██╗██║██║     ██╔══╝      ╚██╗ ██╔╝██║██╔══╝  ██║███╗██║
	██║ ╚═╝ ██║╚██████╔╝██████╔╝██║███████╗███████╗     ╚████╔╝ ██║███████╗╚███╔███╔╝
	╚═╝     ╚═╝ ╚═════╝ ╚═════╝ ╚═╝╚══════╝╚══════╝      ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝ 
 	*/
 	public function mobile_view()
 	{
 		$result 	= 	$this->setUp();

 		$result 	=	$this->isPost($result, $_POST, 'properties_owner', "Didn't receive the request as a POST in 'properties_owner' param.");

 		if($result['ready'])
 		{
 			$result 	= 	$this->paramRequired($result, "properties_owner_email", 				"Didn't receive the property owner email.");

 			if($result['ready'])
 			{
 				$PropertiesOwner = $this->PropertiesOwner->findAllByEmail($result['data']['properties_owner_email']);

 				if($PropertiesOwner)
 				{
					$result['PropertiesOwner'] = $PropertiesOwner;			
 				}
 				else
 				{
 					$result = $this->addFailError($result, "There isn't a property owner registered with that email.");
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
			$result['data']	= json_decode($post[$index], true);
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
		$this->PropertiesOwner->recursive = 0;
		$this->set('propertiesOwners', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($email = null) 
	{
		$PropertiesOwner = $this->PropertiesOwner->findAllByEmail($email);

		if (!$PropertiesOwner) 
		{
			throw new NotFoundException(__('Invalid properties owner'));
		}
		else
		{
			$this->loadModel('Property');
			$Properties = $this->Property->findAllByUsersEmail($email);
			$this->set('Properties', $Properties);
		}

		$this->set('PropertiesOwner', $PropertiesOwner);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() 
	{

		if ($this->request->is('post')) 
		{

			if($this->request->data['PropertiesOwner']['password again']!=$this->request->data['PropertiesOwner']['password'])
			{
				$this->Flash->error(__('The passwords dont match.'));
				return;
			}

			$this->loadModel('User');
			$User = $this->User->findAllByEmail($this->request->data['PropertiesOwner']['email']);

			if($User)
			{ 
				$this->Flash->error(__('That email is in use. Try another or login.'));
				return;
			}

			$user = array(
				'type'		=>	$this->request->data['PropertiesOwner']['type'],
				'email'		=> 	$this->request->data['PropertiesOwner']['email'],	
				'password' 	=> 	$this->request->data['PropertiesOwner']['password']
				);

			$propertiesOwner = array(
				'ext'					=>	$this->request->data['PropertiesOwner']['ext'],
				'zip'					=>	$this->request->data['PropertiesOwner']['zip'],
				'email'					=>	$this->request->data['PropertiesOwner']['email'],
				'password'				=>	$this->request->data['PropertiesOwner']['password'],
				'last_name'				=>	$this->request->data['PropertiesOwner']['last_name'],
				'first_name'			=>	$this->request->data['PropertiesOwner']['first_name'],
				'business_phone'		=>	$this->request->data['PropertiesOwner']['business_phone'],
				'profession_category'	=>	$this->request->data['PropertiesOwner']['profession_category']
				);

			$response 	=	$this->User->save($user);

			if($response)
			{
				$response	=	$this->PropertiesOwner->save($propertiesOwner);

				if($response)
				{
					return $this->redirect(array('controller' => 'Users', 'action'=>'admin'));
				}
				else
				{
					$this->Flash->error(__('There was an error creating this '.$this->request->data['PropertiesOwner']['type'].'. Contact your manager.'));
					debug($this->PropertiesOwner->validationErrors);
					return;
				}
			}
			else
			{
				$this->Flash->error(__('There was an error creating this User. Contact your manager.'));
				return;
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PropertiesOwner->exists($id)) {
			throw new NotFoundException(__('Invalid properties owner'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PropertiesOwner->save($this->request->data)) {
				$this->Flash->success(__('The properties owner has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The properties owner could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PropertiesOwner.' . $this->PropertiesOwner->primaryKey => $id));
			$this->request->data = $this->PropertiesOwner->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PropertiesOwner->id = $id;
		if (!$this->PropertiesOwner->exists()) {
			throw new NotFoundException(__('Invalid properties owner'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PropertiesOwner->delete()) {
			$this->Flash->success(__('The properties owner has been deleted.'));
		} else {
			$this->Flash->error(__('The properties owner could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
