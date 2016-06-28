<?php
App::uses('AppController', 'Controller');
/**
 * Streamdates Controller
 *
 * @property Streamdate $Streamdate
 * @property PaginatorComponent $Paginator
 */
class StreamdatesController extends AppController {

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
		$result = $this->setUp();

		$result = $this->isPost($result, $_POST, 'streamdate', "Didn't receive the request in a POST in the param 'streamdate'.");

		if($result['ready'])
		{
			$result = $this->paramRequired($result, "streamdate_properties_id", "Didn't receive the Property Id.");
			$result = $this->paramRequired($result, "streamdate_datetime", 		"Didn't receive the Streaming Datetime.");
			$result = $this->paramRequired($result, "streamdate_capacity", 		"Didn't receive the capacity.");

			if($result['ready'])
			{
				$streamdate = $this->Streamdate->findAllByPropertiesIdAndStreamDatetime($result['data']['streamdate_properties_id'], $result['data']['streamdate_datetime']);

				if(count($streamdate)==0)
				{
					$sessionId = file_get_contents("https://padpatdev.mobilemediacms.com/OpenTokTest/Server/web/generateSessionId.php");

					$sessionId = json_decode($sessionId);

					$newStreamdate = array(
							'properties_id'		=> 	$result['data']['streamdate_properties_id'],
							'stream_datetime'	=> 	$result['data']['streamdate_datetime'],
							'capacity'			=> 	$result['data']['streamdate_capacity'],
							'session_id'		=>	$sessionId->sessionId
						);

					$response = $this->Streamdate->save($newStreamdate);

					if(!$response)
					{
						$result = $this->addFailError($result, "There was an error trying to add your streamdate.");
					}
					else
					{
						//Actions after adding.
					}
				}
				else
				{
					$result = $this->addFailError($result, "There is already a stream date for this property at this time.");
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

		$result = $this->isPost($result, $_POST, 'streamdate', "Didn't receive the request in a POST in the param 'streamdate'.");

		if($result['ready'])
		{
			$result = $this->paramRequired($result, "streamdate_id", "Didn't receive the streamdate Id.");

			if($result['ready'])
			{
				$conditions = array(
						'id'		=> $result['data']['streamdate_id']
					);
				
				//$SQL = "SELECT * FROM streamdates WHERE properties_id = ".$result['data']['streamdate_properties_id']." AND stream_datetime LIKE '".$result['data']['streamdate_datetime']."'";
				//$streamdate = $this->Streamdate->query($SQL);
			
				$streamdate = $this->Streamdate->find('first', $conditions);	

				if($streamdate)
				{

					$response = $this->Streamdate->deleteAll($conditions);

					if(!$response)
					{
						$result = $this->addFailError($result, "There was an error trying to delete your streamdate.");
					}
					else
					{
						//Actions after adding.
					}
				}
				else
				{
					$result = $this->addFailError($result, "There isn't a Streamdate to that property in that datetime.");
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

		$result = $this->isPost($result, $_POST, 'streamdate', "Didn't receive the request in a POST in the param 'streamdate'.");

		if($result['ready'])
		{
			$result = $this->paramRequired($result, "streamdate_properties_id", "Didn't receive the Property Id.");

			if($result['ready'])
			{
				$streamdateList = array();
				$streamdates = $this->Streamdate->findAllByPropertiesId($result['data']['streamdate_properties_id']);

				foreach ($streamdates as $streamdate) 
				{
					array_push($streamdateList, $streamdate['Streamdate']);
				}

				$result['Streamdates'] = $streamdateList;
			}
		}

		$this->printResults($result);
	}

	/**
	██████╗ ███████╗ ██████╗ ██╗███╗   ██╗    ███████╗████████╗██████╗ ███████╗ █████╗ ███╗   ███╗
	██╔══██╗██╔════╝██╔════╝ ██║████╗  ██║    ██╔════╝╚══██╔══╝██╔══██╗██╔════╝██╔══██╗████╗ ████║
	██████╔╝█████╗  ██║  ███╗██║██╔██╗ ██║    ███████╗   ██║   ██████╔╝█████╗  ███████║██╔████╔██║
	██╔══██╗██╔══╝  ██║   ██║██║██║╚██╗██║    ╚════██║   ██║   ██╔══██╗██╔══╝  ██╔══██║██║╚██╔╝██║
	██████╔╝███████╗╚██████╔╝██║██║ ╚████║    ███████║   ██║   ██║  ██║███████╗██║  ██║██║ ╚═╝ ██║
	╚═════╝ ╚══════╝ ╚═════╝ ╚═╝╚═╝  ╚═══╝    ╚══════╝   ╚═╝   ╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═╝     ╚═╝
	*/
	public function begin_stream($streamdateId = null)
	{
		//For testing purposes. Without validations.
		$streamdate = $this->Streamdate->findAllById($streamdateId);

		if($streamdate)
		{
			$sessionId 	= 	$streamdate[0]['Streamdate']['session_id'];

			$credentials 	= 	file_get_contents("http://padpatdev.mobilemediacms.com/OpenTokTest/Server/web/generatePublisherToken.php?sessionId=".$sessionId);
			$credentials 	= 	json_decode($credentials);

			$token 			=	$credentials->token;	
			$apiKey 		=	$credentials->apiKey;	
			
			$this->set(compact('token','sessionId','apiKey'));
		}
		else
		{
			//No Streamdate related to that ID.
		}
	}

	/**
	██╗   ██╗██╗███████╗██╗    ██╗    ███████╗████████╗██████╗ ███████╗ █████╗ ███╗   ███╗
	██║   ██║██║██╔════╝██║    ██║    ██╔════╝╚══██╔══╝██╔══██╗██╔════╝██╔══██╗████╗ ████║
	██║   ██║██║█████╗  ██║ █╗ ██║    ███████╗   ██║   ██████╔╝█████╗  ███████║██╔████╔██║
	╚██╗ ██╔╝██║██╔══╝  ██║███╗██║    ╚════██║   ██║   ██╔══██╗██╔══╝  ██╔══██║██║╚██╔╝██║
	 ╚████╔╝ ██║███████╗╚███╔███╔╝    ███████║   ██║   ██║  ██║███████╗██║  ██║██║ ╚═╝ ██║
	  ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝     ╚══════╝   ╚═╝   ╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═╝     ╚═╝
	*/
	public function view_stream($streamdateId, $userEmail)
	{
		//For testing purposes. Without validations.
		$streamdate = $this->Streamdate->findAllById($streamdateId);

		if($streamdate)
		{
			$this->loadModel('Booking');
			$Booking 		= $this->Booking->findAllByStreamdatesIdAndUsersEmail($streamdateId,$userEmail);

			if($Booking)
			{
				$sessionId 		= 	$streamdate[0]['Streamdate']['session_id'];

				//$credentials 	= 	file_get_contents("http://padpatdev.mobilemediacms.com/OpenTokTest/Server/web/generateToken.php?sessionId=".$sessionId);
				$credentials 	= 	file_get_contents("http://padpatdev.mobilemediacms.com/OpenTokTest/Server/web/generatePublisherToken.php?sessionId=".$sessionId);
				$credentials 	= 	json_decode($credentials);

				$token 			=	$credentials->token;	
				$apiKey 		=	$credentials->apiKey;	
				
				$this->set(compact('token','sessionId','apiKey','userEmail'));
			}
			else
			{
				$this->Flash->error(__('You dont have a valid Booking for this Streaming. Book first!'));	
			}
		}
		else
		{
			$this->Flash->error(__('There is no streamdate associated to that ID. Please, try again.'));	
		}
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
		$this->Streamdate->recursive = 0;
		$this->set('streamdates', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Streamdate->exists($id)) {
			throw new NotFoundException(__('Invalid streamdate'));
		}
		$options = array('conditions' => array('Streamdate.' . $this->Streamdate->primaryKey => $id));
		$this->set('streamdate', $this->Streamdate->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Streamdate->create();
			if ($this->Streamdate->save($this->request->data)) {
				$this->Flash->success(__('The streamdate has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The streamdate could not be saved. Please, try again.'));
			}
		}
		$properties = $this->Streamdate->Property->find('list');
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
		if (!$this->Streamdate->exists($id)) {
			throw new NotFoundException(__('Invalid streamdate'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Streamdate->save($this->request->data)) {
				$this->Flash->success(__('The streamdate has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The streamdate could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Streamdate.' . $this->Streamdate->primaryKey => $id));
			$this->request->data = $this->Streamdate->find('first', $options);
		}
		$properties = $this->Streamdate->Property->find('list');
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
		$this->Streamdate->id = $id;
		if (!$this->Streamdate->exists()) {
			throw new NotFoundException(__('Invalid streamdate'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Streamdate->delete()) {
			$this->Flash->success(__('The streamdate has been deleted.'));
		} else {
			$this->Flash->error(__('The streamdate could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
