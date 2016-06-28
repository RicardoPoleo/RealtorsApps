<?php
App::uses('AppController', 'Controller');
/**
 * Ratings Controller
 *
 * @property Rating $Rating
 * @property PaginatorComponent $Paginator
 */
class RatingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter()
	{
		$this->Auth->Allow('mobile_add', 'mobile_delete', 'mobile_viewAll', 'mobile_view','ajax_rating');
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

 		$result 	=	$this->isPost($result, $_POST, 'rating', "Didn't receive the request as a POST in 'rating' param.");

 		if($result['ready'])
 		{
 			$result 	= 	$this->paramRequired($result, "rating_properties_id", "Didn't receive the property id");
 			$result 	= 	$this->paramRequired($result, "rating_users_email", "Didn't receive the user email");
 			$result 	= 	$this->paramRequired($result, "rating_value", "Didn't receive the raiting value");

 			if($result['ready'])
 			{
 				$Rating 	= 	$this->Rating->findAllByPropertiesIdAndUsersEmail($result['data']['rating_properties_id'], $result['data']['rating_users_email']);

 				if($Rating)
 				{
 					$result 	= 	$this->addFailError($result, "There is a rating already registered, from this user, to this property.");
 				}
 				else
 				{
 					$newRating 	=	array(
 							'properties_id'	=>	$result['data']['rating_properties_id'],
 							'users_email'	=>	$result['data']['rating_users_email'],
 							'value'			=>	$result['data']['rating_value'],
 							'creationdate'	=>	$this->getDate()
 						); 

 					$response 	= 	$this->Rating->save($newRating);

 					if(!$response)
 					{
 						$result 	= 	$this->addFailError($result, "There was an error summiting your rating.");
 					}
 					else
 					{
 						//Actions after rating.
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
 		$result 	= 	$this->setUp();

 		$result 	=	$this->isPost($result, $_POST, 'rating', "Didn't receive the request as a POST in 'rating' param.");

 		if($result['ready'])
 		{
 			$result 	= 	$this->paramRequired($result, "rating_properties_id", "Didn't receive the property id");
 			$result 	= 	$this->paramRequired($result, "rating_users_email", "Didn't receive the user email");

 			if($result['ready'])
 			{
 				$Rating 	= 	$this->Rating->findAllByPropertiesIdAndUsersEmail($result['data']['rating_properties_id'], $result['data']['rating_users_email']);

 				if($Rating)
 				{
 					$conditions 	=	array(
 							'Rating.properties_id' 	=> $result['data']['rating_properties_id'],
 							'Rating.users_email' 	=> $result['data']['rating_users_email']
 						);

 					$response 		= 	$this->Rating->deleteAll($conditions, false);

 					if(!$response)
 					{
 						$result 	= 	$this->addFailError($result, "There was an error trying to delete this rating.");
 					}
 					else
 					{
 						//Actions after deleting the rating.
 					}
 				}
 				else
 				{
 					$result 	= 	$this->addFailError($result, "There is no rating, from this user, asigned to this property.");
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

 		$result 	=	$this->isPost($result, $_POST, 'rating', "Didn't receive the request as a POST in 'rating' param.");

 		if($result['ready'])
 		{
 			$result 	= 	$this->paramRequired($result, "rating_properties_id", "Didn't receive the property id");
 			$result 	= 	$this->paramRequired($result, "rating_users_email", "Didn't receive the user email");

 			if($result['ready'])
 			{
 				$Rating 	= 	$this->Rating->findAllByPropertiesIdAndUsersEmail($result['data']['rating_properties_id'], $result['data']['rating_users_email']);

 				if($Rating)
 				{
 					$result['rating'] = 	$Rating[0]['Rating'];
 				}
 				else
 				{
 					$result 	= 	$this->addFailError($result, "There is no rating, from this user, asigned to this property.");
 				}
 			}

 		}

 		$this->printResults($result);
 	}		

	/**
	 ██████╗ ███████╗████████╗     █████╗ ██╗   ██╗███████╗██████╗  █████╗  ██████╗ ███████╗
	██╔════╝ ██╔════╝╚══██╔══╝    ██╔══██╗██║   ██║██╔════╝██╔══██╗██╔══██╗██╔════╝ ██╔════╝
	██║  ███╗█████╗     ██║       ███████║██║   ██║█████╗  ██████╔╝███████║██║  ███╗█████╗  
	██║   ██║██╔══╝     ██║       ██╔══██║╚██╗ ██╔╝██╔══╝  ██╔══██╗██╔══██║██║   ██║██╔══╝  
	╚██████╔╝███████╗   ██║       ██║  ██║ ╚████╔╝ ███████╗██║  ██║██║  ██║╚██████╔╝███████╗
	 ╚═════╝ ╚══════╝   ╚═╝       ╚═╝  ╚═╝  ╚═══╝  ╚══════╝╚═╝  ╚═╝╚═╝  ╚═╝ ╚═════╝ ╚══════╝
	*/
 	public function getAverage()
 	{
 		$result 	= 	$this->setUp();

 		$result 	= 	$result 	=	$this->isPost($result, $_POST, 'rating', "Didn't receive the request as a POST in 'rating' param.");

 		if($result['ready'])
 		{
 			$result 	= 	$this->paramRequired($result, "rating_properties_id", "Didn't receive the property id");

 			if($result['ready'])
 			{
 				$Ratings 	= 	$this->Rating->findAllByPropertiesId($result['data']['rating_properties_id']);

 				if($Ratings)
 				{
 					$count 	=	0;
 					$sum 	=	0;
 					foreach ($Ratings as $Rating) 
 					{
 						$count++;
 						$sum 	= 	$sum + $Rating['Rating']['value'];
 					}
 					if($count==0)
 					{
 						$count = 1;
 					}
 					
 					$result['rating_average'] = $sum/$count;
 					
 				}
 				else
 				{
 					$result['rating_average'] = 0;
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

 		$result = $this->isPost($result, $_POST, 'rating', "Didn't receive the request as a POST in 'rating' param.");

 		if($result['ready'])
 		{
 			$result = $this->paramRequired($result, "rating_properties_id", "Didn't receive the property id.");

 			if($result['ready'])
 			{
 				$raitingList = array();

 				$Ratings = $this->Rating->findAllByPropertiesId($result['data']['rating_properties_id']);

 				if($Ratings)
 				{
 					foreach ($Ratings as $Rating) 
 					{
 						unset($Rating['Rating']['properties_id']);
 						array_push($raitingList, $Rating['Rating']);
 					}
 				}

 				$result['Ratings'] = $raitingList;
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

	public function paramNotBlank($param=null, $errorMessage="",$result=null)
	{
		if( (!isset($param)) and ($param=='') )
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
		$this->Rating->recursive = 0;
		$this->set('ratings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Rating->exists($id)) {
			throw new NotFoundException(__('Invalid rating'));
		}
		$options = array('conditions' => array('Rating.' . $this->Rating->primaryKey => $id));
		$this->set('rating', $this->Rating->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rating->create();
			if ($this->Rating->save($this->request->data)) {
				$this->Flash->success(__('The rating has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The rating could not be saved. Please, try again.'));
			}
		}
		$properties = $this->Rating->Property->find('list');
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
		if (!$this->Rating->exists($id)) {
			throw new NotFoundException(__('Invalid rating'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Rating->save($this->request->data)) {
				$this->Flash->success(__('The rating has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The rating could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Rating.' . $this->Rating->primaryKey => $id));
			$this->request->data = $this->Rating->find('first', $options);
		}
		$properties = $this->Rating->Property->find('list');
		$this->set(compact('properties'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) 
	{
		$this->Rating->id = $id;
		if (!$this->Rating->exists()) 
		{
			throw new NotFoundException(__('Invalid rating'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Rating->delete()) 
		{
			$this->Flash->success(__('The rating has been deleted.'));
		} 
		else 
		{
			$this->Flash->error(__('The rating could not be deleted. Please, try again.'));
		}
		
		return $this->redirect(array('action' => 'index'));
	}


	public function ajax_rating($user_email='', $property_id='', $property_rating='')
	{
		$result = $this->setUp();

		$result = $this->paramNotBlank($user_email, "User email not provided", $result);
		$result = $this->paramNotBlank($property_id, "Streaming id not provided", $result);
		$result = $this->paramNotBlank($property_rating, "Rating not provided", $result);

		$result['user_email'] 		= $user_email;
		$result['property_id'] 		= $property_id;
		$result['property_rating'] 	= $property_rating;
		
		if($result['ready'])
		{
			$this->loadModel('User');
			$user =	$this->User->findAllByEmail($user_email);

			if($user)
			{
				$rating = $this->Rating->findAllByPropertiesIdAndUsersEmail($property_id, $user_email); 

				if(!$rating)
				{

					$newRating = array(
							'properties_id' 	=> 	intval($property_id),
							'users_email' 		=> 	$user_email,
							'value' 			=> 	intval($property_rating),
							'creationdate' 		=> 	$this->getDate()
						);

					$response = $this->Rating->save($newRating);

					if(!$response)
					{
						$result = $this->addFailError($result, "There was an error trying to rate. Try again.");
					}
					else
					{
						$result['message_for_user'] = "Thanks for rate this property!";
					}					
				}
				else
				{
					$SQL 		= 	"DELETE FROM `admin_padpat`.`ratings` WHERE `ratings`.`properties_id` = ".$property_id." AND `ratings`.`users_email` = '".$user_email."'";
					$response 	= 	$this->Rating->query($SQL);

					$newRating = array(
							'properties_id' 	=> 	$property_id,
							'users_email' 		=> 	$user_email,
							'value' 			=> 	$property_rating,
							'creationdate' 		=> 	$this->getDate(),
						);

					$response = $this->Rating->save($newRating);

					if(!$response)
					{
						$result = $this->addFailError($result, "There was an error trying to rate. Try again.");
					}
					else
					{
						$result['message_for_user'] = "Thanks for update your rating!";
					}										
				}
			}
			else
			{
				$result = $this->addFailError($result, "There is no user related to this email");
			}
		}

		$this->printResults($result);
	}	
}
