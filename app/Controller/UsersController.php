<?php
App::uses('AppController', 'Controller');
App::uses('Validation', 'Validation');
App::uses('CakeEmail', 'Network/Email');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	
	public $components = array(
		'Paginator'
    );
 
    public function beforeFilter() 
    { 
        $this->Auth->allow('mobile_add', 'mobile_view', 'mobile_edit', 'mobile_delete', 'mobile_login', 'login', 'register');
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
 		$result = $this->setUp();
 	
 		//We validate that the REQUEST is POST.
 		$result = $this->isPost($result, $_POST, 'user', "Didn't receive the request as a POST in 'user' param.");

 		if($result['ready'])
 		{
 			$data = json_decode($_POST['user'], true);

 			//We validate that we received all the data.
 			$result = $this->paramRequired($result, $data, 'user_email', 		"User email wasn't received.");
 			$result = $this->paramRequired($result, $data, 'user_password', 	"User password wasn't received.");

 			if($result['ready'])
 			{
 				//We validate that this email didn't exist.
 				$user =	$this->User->findAllByEmail($data['user_email']);

 				if($user)
 				{
 					$result = $this->addFailError($result, "This email is already registered.");
 				}
 				else
 				{
 					$newUser	=	array(
 							'email'		=>	$data['user_email'],
 							'password'	=>	$data['user_password'] 
 						);

 					$this->User->save($newUser);
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
 		$result = $this->setUp();
 	
 		//We validate that the REQUEST is POST.
 		$result = $this->isPost($result, $_POST, 'user', "Didn't receive the request as a POST in 'user' param.");

 		if($result['ready'])
 		{
 			$data = json_decode($_POST['user'], true);

 			//We validate that we received all the data.
 			$result = $this->paramRequired($result, $data, 'user_email', 		"User email wasn't received.");

 			if($result['ready'])
 			{
 				//We validate that this email is registered.
 				$user =	$this->User->findAllByEmail($data['user_email']);

 				if(!$user)
 				{
 					$result = $this->addFailError($result, "This email is not registered.");
 				}
 				else
 				{
 					$result['User'] 	=	$user[0]['User'];
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
 		$result = $this->setUp();
 	
 		//We validate that the REQUEST is POST.
 		$result = $this->isPost($result, $_POST, 'user', "Didn't receive the request as a POST in 'user' param.");

 		if($result['ready'])
 		{
 			$data = json_decode($_POST['user'], true);

 			//We validate that we received all the data.
 			$result 	= 	$this->paramRequired($result, $data, 'user_email', 	"User email wasn't received.");

			$result 	=	$this->updateValidation($result, $data, "user_password", "password",	"String");

 			if($result['ready'])
 			{
 				//We validate that this email is registered.
 				$user =	$this->User->findAllByEmail($data['user_email']);

 				if(!$user)
 				{
 					$result = $this->addFailError($result, "This email is not registered.");
 				}
 				else
 				{
 					$respuesta 	= 	$this->User->updateAll( $result['update'] ,array("email"=>$data['user_email']));	
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
 	
 		//We validate that the REQUEST is POST.
 		$result = $this->isPost($result, $_POST, 'user', "Didn't receive the request as a POST in 'user' param.");

 		if($result['ready'])
 		{
 			$data = json_decode($_POST['user'], true);

 			//We validate that we received all the data.
 			$result = $this->paramRequired($result, $data, 'user_email', 		"User email wasn't received.");

 			if($result['ready'])
 			{
 				//We validate that this email is registered.
 				$user =	$this->User->findAllByEmail($data['user_email']);

 				if(!$user)
 				{
 					$result = $this->addFailError($result, "This email is not registered.");
 				}
 				else
 				{
 					$this->User->deleteAll(array('User.email' => $data['user_email']), false);
 				}
 			}
 		}

 		$this->printResults($result);
 	}

 	/**
	███╗   ███╗ ██████╗ ██████╗ ██╗██╗     ███████╗    ██╗      ██████╗  ██████╗ ██╗███╗   ██╗
	████╗ ████║██╔═══██╗██╔══██╗██║██║     ██╔════╝    ██║     ██╔═══██╗██╔════╝ ██║████╗  ██║
	██╔████╔██║██║   ██║██████╔╝██║██║     █████╗      ██║     ██║   ██║██║  ███╗██║██╔██╗ ██║
	██║╚██╔╝██║██║   ██║██╔══██╗██║██║     ██╔══╝      ██║     ██║   ██║██║   ██║██║██║╚██╗██║
	██║ ╚═╝ ██║╚██████╔╝██████╔╝██║███████╗███████╗    ███████╗╚██████╔╝╚██████╔╝██║██║ ╚████║
	╚═╝     ╚═╝ ╚═════╝ ╚═════╝ ╚═╝╚══════╝╚══════╝    ╚══════╝ ╚═════╝  ╚═════╝ ╚═╝╚═╝  ╚═══╝                                                                                        
 	*/
 	public function mobile_login()
 	{
 		$result = $this->setUp();
 	
 		//We validate that the REQUEST is POST.
 		$result = $this->isPost($result, $_POST, 'user', "Didn't receive the request as a POST in 'user' param.");

 		if($result['ready'])
 		{
 			$data = json_decode($_POST['user'], true);

 			//We validate that we received all the data.
 			$result = $this->paramRequired($result, $data, 'user_email', 		"User email wasn't received.");
 			$result = $this->paramRequired($result, $data, 'user_password', 	"User password wasn't received.");

 			if($result['ready'])
 			{
 				//We validate that this email is registered.
 				$user =	$this->User->findAllByEmail($data['user_email']);

 				if(!$user)
 				{
 					$result = $this->addFailError($result, "This email is not registered.");
 				}
 				else if($user[0]['User']['password']!=$data['user_password'])
 				{
 					$result = $this->addFailError($result, "Wrong password.");
 				}
 				else
 				{
 					$result['user'] = $user[0]['User'];
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

	public function updateValidation($result, $datos, $datosIndex, $updateIndex, $updateType)
	{
		if( (isset($datos[$datosIndex])) && ($datos[$datosIndex]!="") )
		{
			if($updateType=="String")
			{
				$result['update'][$updateIndex] =	"'".$datos[$datosIndex]."'";
			}
			else
			{
				//Else is "Numeric" or "Boolean"
				$result['update'][$updateIndex] =	$datos[$datosIndex];
			}
		} 

		return $result;
	}

	public function paramRequired($result, $data, $dataIndex, $errorMessage)
	{
		if((!isset($data[$dataIndex]))||($data[$dataIndex]==""))
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

/**
██████╗  █████╗  ██████╗██╗  ██╗███████╗███╗   ██╗██████╗ 
██╔══██╗██╔══██╗██╔════╝██║ ██╔╝██╔════╝████╗  ██║██╔══██╗
██████╔╝███████║██║     █████╔╝ █████╗  ██╔██╗ ██║██║  ██║
██╔══██╗██╔══██║██║     ██╔═██╗ ██╔══╝  ██║╚██╗██║██║  ██║
██████╔╝██║  ██║╚██████╗██║  ██╗███████╗██║ ╚████║██████╔╝
╚═════╝ ╚═╝  ╚═╝ ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═══╝╚═════╝ 
*/


	/**
	███████╗████████╗██████╗ ███████╗ █████╗ ███╗   ███╗
	██╔════╝╚══██╔══╝██╔══██╗██╔════╝██╔══██╗████╗ ████║
	███████╗   ██║   ██████╔╝█████╗  ███████║██╔████╔██║
	╚════██║   ██║   ██╔══██╗██╔══╝  ██╔══██║██║╚██╔╝██║
	███████║   ██║   ██║  ██║███████╗██║  ██║██║ ╚═╝ ██║
	╚══════╝   ╚═╝   ╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═╝     ╚═╝
	*/
	public function stream()
	{
		
	}

	public function webcam()
	{
		//App::import('vendor', 'Slim');
		//App::uses('vendor', 'Slim');
		//App::uses('vendor', 'Gregwar');
		//App::uses('vendor', 'opentok');
		/*
		use Slim\Slim;
		use Gregwar\Cache\Cache;
		use OpenTok\OpenTok;
		*/

		// Initialize Slim application
		/*
		$app = new Slim(array(
		    'templates.path' => __DIR__.'/../templates'
		));
		*/
		echo "TODO FALLO. EPIC CAKEPHP IMPORTS";
	}

/**
 █████╗ ██████╗ ███╗   ███╗██╗███╗   ██╗
██╔══██╗██╔══██╗████╗ ████║██║████╗  ██║
███████║██║  ██║██╔████╔██║██║██╔██╗ ██║
██╔══██║██║  ██║██║╚██╔╝██║██║██║╚██╗██║
██║  ██║██████╔╝██║ ╚═╝ ██║██║██║ ╚████║
╚═╝  ╚═╝╚═════╝ ╚═╝     ╚═╝╚═╝╚═╝  ╚═══╝
                                        
*/
public function admin()
{
 	$Conditions = array(
 			'order' => array('created' => 'desc'),
 			'limit' => 10
 		);

 	$this->loadModel('Property');

 	$users 			= 	$this->User->find('all', $Conditions);
 	$properties 	=	array();

 	$withOutRating	= 	true;

 	if ($this->request->is(array('post', 'put'))) 
	{
		if($this->request['data']['type']=="price")
		{
			$Conditions = array(
				'conditions' 		=> 	array(
					'Property.price >= '=> 	$this->request['data']['min'],
					'Property.price <= '=> 	$this->request['data']['max'],
					),
 				'order' => array('created' => 'desc'),
 				'limit' => 10				
				);
		}
		else if($this->request['data']['type']=="deal_type")
		{
			$Conditions = array(
				'conditions' 		=> 	array(
					'Property.dealtype = '=> 	$this->request['data']['dealtype']
					),
 				'order' => array('created' => 'desc'),
 				'limit' => 10				
				);
		}
		else if($this->request['data']['type']=="date")
		{
			$Conditions = array(
				'conditions' 		=> 	array(
					'Property.created >= '=> 	$this->request['data']['datetimeMin']['year']."-".$this->request['data']['datetimeMin']['month']."-".$this->request['data']['datetimeMin']['day'] . " 00:00:00",
					'Property.created <= '=> 	$this->request['data']['datetimeMax']['year']."-".$this->request['data']['datetimeMax']['month']."-".$this->request['data']['datetimeMax']['day'] . " 23:59:59"
					),
 				'order' => array('created' => 'desc'),
 				'limit' => 10				
				);
		}
		else if($this->request['data']['type']=="average")
		{
			$propertiesList = array();

	 		$properties 	= $this->Property->find('all');
	 		foreach ($properties as $property) 
	 		{
	 			$this->loadModel('Rating');
	 			$ratings = $this->Rating->findAllByPropertiesId($property['Property']['id']);

				$sum 		= 0;
				$average 	= 0;
				$amount 	= count($ratings);
				
				if($amount>0)
				{
						foreach ($ratings as $rating ) 
						{
							$sum += $rating['Rating']['value'];
						}

						$average = $sum/$amount;
				}

				if($average>=$this->request['data']['average'])
				{
					$property['Property']['rating'] = $average;
					array_push($propertiesList, $property);
				} 						
			}

			$properties = $propertiesList;
			$withOutRating = false;
		}
	}

	if ($withOutRating) 
	{
		$properties = 	$this->Property->find('all', $Conditions); 	
	}
	
	$filter_types = array(
		'all'		=>	'--------',
		'date'		=>	'By Date',
		'price' 	=>	'By Price',
		'average'	=>	'By Rating',
		'deal_type'	=>	'By Deal Type'
		);

	$deal_types = array(
		'Rent'	=> 'Rent',
		'Sale'	=> 'Sale'
		);

	$average =array(
		0 =>	0,
		1 =>	1,
		2 =>	2,
		3 =>	3,
		4 =>	4,
		5 =>	5
		);

 	$this->set('users', $users);
 	$this->set('average', $average);
 	$this->set('properties', $properties);
 	$this->set('deal_types', $deal_types);
 	$this->set('filter_types', $filter_types);
}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
██╗   ██╗██╗███████╗██╗    ██╗
██║   ██║██║██╔════╝██║    ██║
██║   ██║██║█████╗  ██║ █╗ ██║
╚██╗ ██╔╝██║██╔══╝  ██║███╗██║
 ╚████╔╝ ██║███████╗╚███╔███╔╝
  ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝ 
                              
*/
	public function view($email = null) 
	{
		$user = $this->User->findAllByEmail($email);

		if (!$user) 
		{
			throw new NotFoundException(__('Invalid user'));
		}
		else
		{
			if($user[0]['User']['type']=="Future Tenant") 
			{
				$this->loadModel('FutureTenant');
				$futureTenant 	= 	$this->FutureTenant->findAllByEmail($user[0]['User']['email']);

				$this->set('futureTenant', $futureTenant[0]['FutureTenant']);
			}
			else
			{
				$this->loadModel('PropertiesOwner');
				$propertiesOwner = $this->PropertiesOwner->findAllByEmail($user[0]['User']['email']);

				$this->set('propertiesOwner', $propertiesOwner[0]['PropertiesOwner']);
			}
		}
		$this->set('user', $user[0]['User']);
	}

/**
 █████╗ ██████╗ ██████╗ 
██╔══██╗██╔══██╗██╔══██╗
███████║██║  ██║██║  ██║
██╔══██║██║  ██║██║  ██║
██║  ██║██████╔╝██████╔╝
╚═╝  ╚═╝╚═════╝ ╚═════╝ 
                        
*/
	public function add() 
	{
		if ($this->request->is('post')) 
		{
			$this->User->create();
			if ($this->User->save($this->request->data)) 
			{
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
███████╗██████╗ ██╗████████╗
██╔════╝██╔══██╗██║╚══██╔══╝
█████╗  ██║  ██║██║   ██║   
██╔══╝  ██║  ██║██║   ██║   
███████╗██████╔╝██║   ██║   
╚══════╝╚═════╝ ╚═╝   ╚═╝   
                            
*/
	public function edit($email = null) 
	{
		$user = $this->User->findAllByEmail($email);

		if (!$user) 
		{
			throw new NotFoundException(__('Invalid user'));
		}

		if ($this->request->is(array('post', 'put'))) 
		{
			$email 	= $this->request->data['User']['oldEmail'];

			$update 	=	array();

			$update 	=	$this->prepareUpdate($update, $this->request->data['User'], "type"); 
			$update 	=	$this->prepareUpdate($update, $this->request->data['User'], "email"); 
			$update 	=	$this->prepareUpdate($update, $this->request->data['User'], "password"); 

			$response = $this->User->updateAll( $update ,array("email"=>$email)); 

			if($response)
			{
				$this->Flash->success(__('User updated!'));

				if($this->request->data['User']['email']!=$email)
				{
					if($this->request->data['User']['type']=="Future Tenant")
					{
						$this->loadModel('FutureTenant');
						$this->FutureTenant->query("UPDATE  `admin_padpat`.`future_tenants` SET  `email` =  '".$this->request->data['User']['email']."' WHERE  `future_tenants`.`email` ='".$email."';");
					}
					else
					{
						$this->loadModel('PropertiesOwner');
						$this->PropertiesOwner->query("UPDATE  `admin_padpat`.`properties_owners` SET  `email` =  '".$this->request->data['User']['email']."' WHERE  `properties_owners`.`email` ='".$email."';");
					}
				}
			}
			else
			{
				$this->Flash->error(__('There was an error trying to update that user!'));
			}


			return $this->redirect(array('action' => 'edit', $this->request->data['User']['email']));
		} 
		else 
		{
			$this->request->data = $user[0];
		}

	}



/**
██████╗ ███████╗██╗     ███████╗████████╗███████╗
██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝
██║  ██║█████╗  ██║     █████╗     ██║   █████╗  
██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝  
██████╔╝███████╗███████╗███████╗   ██║   ███████╗
╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝
                                                 
*/
	public function delete($email = null) 
	{
		$user = $this->User->findAllByEmail($email);

		if (!$user) 
		{
			throw new NotFoundException(__('Invalid user'));
		}

		$this->request->allowMethod('post', 'delete');
		$response = $this->User->deleteAll(array('User.email' => $email), false);

		if ($response) 
		{
			if($user[0]['User']['type']=="Future Tenant")
			{
				$this->loadModel("FutureTenant");
				$response = $this->FutureTenant->deleteAll(array('FutureTenant.email' => $email), false);
			}
			else if ( ($user[0]['User']['type']=="Owner") or ($user[0]['User']['type']=="Realtor") ) 
			{
				$this->loadModel("PropertiesOwner");
				$response = $this->PropertiesOwner->deleteAll(array('PropertiesOwner.email' => $email), false);
			}

			if ($response) 
			{
				$this->Flash->success(__('The user has been deleted.'));
			}
			else
			{
				$this->Flash->error(__('The profile asociated to this user could not be deleted. Please, contact your manager.'));
			}

		} 
		else
		{
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		
		return $this->redirect(array('action' => 'admin'));
	}


	/**
	███████╗██████╗  ██████╗ ███╗   ██╗████████╗    ███████╗███╗   ██╗██████╗ 
	██╔════╝██╔══██╗██╔═══██╗████╗  ██║╚══██╔══╝    ██╔════╝████╗  ██║██╔══██╗
	█████╗  ██████╔╝██║   ██║██╔██╗ ██║   ██║       █████╗  ██╔██╗ ██║██║  ██║
	██╔══╝  ██╔══██╗██║   ██║██║╚██╗██║   ██║       ██╔══╝  ██║╚██╗██║██║  ██║
	██║     ██║  ██║╚██████╔╝██║ ╚████║   ██║       ███████╗██║ ╚████║██████╔╝
	╚═╝     ╚═╝  ╚═╝ ╚═════╝ ╚═╝  ╚═══╝   ╚═╝       ╚══════╝╚═╝  ╚═══╝╚═════╝ 
	*/

	/**
	██╗      ██████╗  ██████╗ ██╗███╗   ██╗
	██║     ██╔═══██╗██╔════╝ ██║████╗  ██║
	██║     ██║   ██║██║  ███╗██║██╔██╗ ██║
	██║     ██║   ██║██║   ██║██║██║╚██╗██║
	███████╗╚██████╔╝╚██████╔╝██║██║ ╚████║
	╚══════╝ ╚═════╝  ╚═════╝ ╚═╝╚═╝  ╚═══╝
	*/	
	public function login() 
	{
	    if ($this->request->is('post')) 
	    {	
	    	//var_dump($this->request['data']);
	    	$user = $this->User->findAllByEmail($this->request['data']['FutureTenant']['email']);

	    	if(!$user)
	    	{
	        	$this->Flash->error(__('No user registered with that Email'));
	    	}
	    	else
	    	{
	    		var_dump($user);
	    		
	    		if($this->request['data']['FutureTenant']['password']!=$user[0]['User']['password'])
	    		{
	        		$this->Flash->error(__('Invalid password, try again'));
	    		}
	    		else
	    		{
	   	 			$this->Auth->login($user[0]);
	   	 			//$this->Session->write('Auth.User'
	   	 			if($user[0]['User']['type']=="Future Tenant")
	   	 			{
				        return $this->redirect(
				        	array('controller'=> 'FutureTenants', 'action' => 'index')
				        );
	   	 			}
	   	 			else if( ($user[0]['User']['type']=="Realtor") or ($user[0]['User']['type']=="Owner") )
	   	 			{
				        return $this->redirect(
				        	array('action' => 'admin')
				        );
	   	 			}
	   	 			else
	   	 			{
	   	 				$this->Flash->error(__('There was an error. Please login.'));
				        return $this->redirect(
				        	array('action' => 'logout')
				        );	   	 				
	   	 			}
	    		}
	    		/**/
	    	}
	    }
	}

	/**
	██╗      ██████╗  ██████╗  ██████╗ ██╗   ██╗████████╗
	██║     ██╔═══██╗██╔════╝ ██╔═══██╗██║   ██║╚══██╔══╝
	██║     ██║   ██║██║  ███╗██║   ██║██║   ██║   ██║   
	██║     ██║   ██║██║   ██║██║   ██║██║   ██║   ██║   
	███████╗╚██████╔╝╚██████╔╝╚██████╔╝╚██████╔╝   ██║   
	╚══════╝ ╚═════╝  ╚═════╝  ╚═════╝  ╚═════╝    ╚═╝   
	*/
	public function logout() 
	{
	    return $this->redirect($this->Auth->logout());
	}


   

	/**
	███████╗██╗   ██╗████████╗██╗   ██╗██████╗ ███████╗    ████████╗███████╗███╗   ██╗ █████╗ ███╗   ██╗████████╗███████╗
	██╔════╝██║   ██║╚══██╔══╝██║   ██║██╔══██╗██╔════╝    ╚══██╔══╝██╔════╝████╗  ██║██╔══██╗████╗  ██║╚══██╔══╝██╔════╝
	█████╗  ██║   ██║   ██║   ██║   ██║██████╔╝█████╗         ██║   █████╗  ██╔██╗ ██║███████║██╔██╗ ██║   ██║   ███████╗
	██╔══╝  ██║   ██║   ██║   ██║   ██║██╔══██╗██╔══╝         ██║   ██╔══╝  ██║╚██╗██║██╔══██║██║╚██╗██║   ██║   ╚════██║
	██║     ╚██████╔╝   ██║   ╚██████╔╝██║  ██║███████╗       ██║   ███████╗██║ ╚████║██║  ██║██║ ╚████║   ██║   ███████║
	╚═╝      ╚═════╝    ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝       ╚═╝   ╚══════╝╚═╝  ╚═══╝╚═╝  ╚═╝╚═╝  ╚═══╝   ╚═╝   ╚══════╝	                                                                                                                     
	*/

	/**
	██████╗ ███████╗ ██████╗ ██╗███████╗████████╗███████╗██████╗ 
	██╔══██╗██╔════╝██╔════╝ ██║██╔════╝╚══██╔══╝██╔════╝██╔══██╗
	██████╔╝█████╗  ██║  ███╗██║███████╗   ██║   █████╗  ██████╔╝
	██╔══██╗██╔══╝  ██║   ██║██║╚════██║   ██║   ██╔══╝  ██╔══██╗
	██║  ██║███████╗╚██████╔╝██║███████║   ██║   ███████╗██║  ██║
	╚═╝  ╚═╝╚══════╝ ╚═════╝ ╚═╝╚══════╝   ╚═╝   ╚══════╝╚═╝  ╚═╝
	*/
	public function register()
	{
		if ($this->request->is('post')) 
		{
			/*
			if($this->request->data['FutureTenant']['password_again']!=$this->request->data['FutureTenant']['password'])
			{
				$this->Flash->error(__('The passwords dont match.'));
				return;
			}
			*/
			$this->loadModel('User');
			$User = $this->User->findAllByEmail($this->request->data['FutureTenant']['email']);

			if($User)
			{ 
				$this->Flash->error(__('That email is in use. Try another or login.'));
				return;
			}

			$user = array(
				'email'		=> 	$this->request->data['FutureTenant']['email'],	
				'password' 	=> 	$this->request->data['FutureTenant']['password'],
				'type'		=>	'Future Tenant'
				);

			$futureTenant = array(
				'email'		=>	$this->request->data['FutureTenant']['email']
				);

			$response 	=	$this->User->save($user);

			if($response)
			{
				$this->loadModel('FutureTenant');
				$response	=	$this->FutureTenant->save($futureTenant);

				if($response)
				{
					$this->Flash->success(__('Register Complete! Please log in'));

					$Email = new CakeEmail();
					$Email->from(array('noreply@PadPat.com' => 'PadPat'));
					$Email->to($this->request->data['FutureTenant']['email']);
					$Email->subject('PadPat - Register');
					$Email->send('You have been registered!');

					return $this->redirect(array('controller' => 'Users', 'action'=>'login'));
				}
				else
				{
					$this->Flash->error(__('There was an error creating this Future Tenant. Contact your manager.'));
					debug($this->FutureTenant->validationErrors);
					return;
				}
			}
			else
			{
				$this->Flash->error(__('There was an error creating this profile.'));
				return;
			}
		}
	}

	public function ft_index()
	{
	 	$Conditions = array(
	 			'order' => array('created' => 'desc'),
	 			'limit' => 10
	 		);

	 	$this->loadModel('Property');

	 	$users 			= 	$this->User->find('all', $Conditions);
	 	$properties 	=	array();

	 	$withOutRating	= 	true;

	 	if ($this->request->is(array('post', 'put'))) 
		{
			if($this->request['data']['type']=="price")
			{
				$Conditions = array(
					'conditions' 		=> 	array(
						'Property.price >= '=> 	$this->request['data']['min'],
						'Property.price <= '=> 	$this->request['data']['max'],
						),
	 				'order' => array('created' => 'desc'),
	 				'limit' => 10				
					);
			}
			else if($this->request['data']['type']=="deal_type")
			{
				$Conditions = array(
					'conditions' 		=> 	array(
						'Property.dealtype = '=> 	$this->request['data']['dealtype']
						),
	 				'order' => array('created' => 'desc'),
	 				'limit' => 10				
					);
			}
			else if($this->request['data']['type']=="date")
			{
				$Conditions = array(
					'conditions' 		=> 	array(
						'Property.created >= '=> 	$this->request['data']['datetimeMin']['year']."-".$this->request['data']['datetimeMin']['month']."-".$this->request['data']['datetimeMin']['day'] . " 00:00:00",
						'Property.created <= '=> 	$this->request['data']['datetimeMax']['year']."-".$this->request['data']['datetimeMax']['month']."-".$this->request['data']['datetimeMax']['day'] . " 23:59:59"
						),
	 				'order' => array('created' => 'desc'),
	 				'limit' => 10				
					);
			}
			else if($this->request['data']['type']=="average")
			{
				$propertiesList = array();

		 		$properties 	= $this->Property->find('all');
		 		foreach ($properties as $property) 
		 		{
		 			$this->loadModel('Rating');
		 			$ratings = $this->Rating->findAllByPropertiesId($property['Property']['id']);

					$sum 		= 0;
					$average 	= 0;
					$amount 	= count($ratings);
					
					if($amount>0)
					{
							foreach ($ratings as $rating ) 
							{
								$sum += $rating['Rating']['value'];
							}

							$average = $sum/$amount;
					}

					if($average>=$this->request['data']['average'])
					{
						$property['Property']['rating'] = $average;
						array_push($propertiesList, $property);
					} 						
				}

				$properties = $propertiesList;
				$withOutRating = false;
			}
		}

		if ($withOutRating) 
		{
			$properties = 	$this->Property->find('all', $Conditions); 	
		}
		
		$filter_types = array(
			'all'		=>	'--------',
			'date'		=>	'By Date',
			'price' 	=>	'By Price',
			'average'	=>	'By Rating',
			'deal_type'	=>	'By Deal Type'
			);

		$deal_types = array(
			'Rent'	=> 'Rent',
			'Sale'	=> 'Sale'
			);

		$average =array(
			0 =>	0,
			1 =>	1,
			2 =>	2,
			3 =>	3,
			4 =>	4,
			5 =>	5
			);

	 	$this->set('users', $users);
	 	$this->set('average', $average);
	 	$this->set('properties', $properties);
	 	$this->set('deal_types', $deal_types);
	 	$this->set('filter_types', $filter_types);
	}

/**
██████╗ ██████╗ ███████╗██████╗  █████╗ ██████╗ ███████╗    ██╗   ██╗██████╗ ██████╗  █████╗ ████████╗███████╗
██╔══██╗██╔══██╗██╔════╝██╔══██╗██╔══██╗██╔══██╗██╔════╝    ██║   ██║██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝
██████╔╝██████╔╝█████╗  ██████╔╝███████║██████╔╝█████╗      ██║   ██║██████╔╝██║  ██║███████║   ██║   █████╗  
██╔═══╝ ██╔══██╗██╔══╝  ██╔═══╝ ██╔══██║██╔══██╗██╔══╝      ██║   ██║██╔═══╝ ██║  ██║██╔══██║   ██║   ██╔══╝  
██║     ██║  ██║███████╗██║     ██║  ██║██║  ██║███████╗    ╚██████╔╝██║     ██████╔╝██║  ██║   ██║   ███████╗
╚═╝     ╚═╝  ╚═╝╚══════╝╚═╝     ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝     ╚═════╝ ╚═╝     ╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚══════╝
                                                                                                              
*/
	public function prepareUpdate($update, $data, $index)
	{
		$update[$index] = "'".$data[$index]."'";
		return $update;
	}	
}
