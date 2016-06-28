<?php
App::uses('AppController', 'Controller');
/**
 * Bookings Controller
 *
 * @property Booking $Booking
 * @property PaginatorComponent $Paginator
 */
class BookingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter()
	{
		$this->Auth->Allow('mobile_add', 'mobile_delete', 'mobile_viewAll', 'ajax_booking');
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

		$result = $this->isPost($result, $_POST, 'booking', "Didn't receive the request in a POST in the param 'booking'.");

		if($result['ready'])
		{
			$result = $this->paramRequired($result, 'booking_stream_dates_id', "Didn't receive the Streamdate id.");
			$result = $this->paramRequired($result, 'booking_user_email', "Didn't receive the user email.");

			if($result['ready'])
			{
				$booking = $this->Booking->findAllByStreamdatesIdAndUsersEmail($result['data']['booking_stream_dates_id'], $result['data']['booking_user_email']); 

				if($booking)
				{
					foreach ($booking as $booked) 
					{
						if($booked['Booking']['status']=="Pending")
						{
							$result = $this->addFailError($result, "There is already an active booking for this user to this property.");
							break;
						}
					}
				}

				if ($result['ready']) 
				{
					$this->loadModel('Streamdate');
					$Streamdate = 	$this->Streamdate->findAllById($result['data']['booking_stream_dates_id']);
					$capacity 	=	$Streamdate[0]['Streamdate']['capacity'];

					$bookingList	=	$this->Booking->findAllByStreamdatesId($result['data']['booking_stream_dates_id']);

					if(count($bookingList)>=$capacity)
					{
						$result = $this->addFailError($result, "This stream date is already full.");
					}

					if($result['ready'])
					{
						$newBooking = array(
								'streamdates_id' 	=> 	$result['data']['booking_stream_dates_id'],
								'users_email' 		=> 	$result['data']['booking_user_email'],
								'creationdate' 		=> 	$this->getFullDate(),
								'status' 			=> 	"Pending"
							);

						$response = $this->Booking->save($newBooking);

						if(!$response)
						{
							$result = $this->addFailError($result, "There was an error registering your booking.");
						}
						else
						{
							//Actions after registering Booking.
						}						
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

		$result = $this->isPost($result, $_POST, 'booking', "Didn't receive the request in a POST in the param 'booking'.");

		if($result['ready'])
		{
			$result = $this->paramRequired($result, 'booking_id', "Didnt't receive the booking id");

			if($result['ready'])
			{
				$booking = $this->Booking->findAllById($result['data']['booking_id']);

				if(!$booking)
				{
					$result = $this->addFailError($result, "There is no booking registered with that id.");
				}
				else
				{
					$conditions = array(
							'id'	=> $result['data']['booking_id']
						);

					$response = $this->Booking->deleteAll($conditions, false);

					if(!$response)
					{
						$this->addFailError($result, "There was an error trying to delete your booking.");
					}
					else
					{
						//Actions after deleting your booking.
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

		$result = $this->isPost($result, $_POST, 'booking', "Didn't receive the request in a POST in the param 'booking'.");

		if($result['ready'])
		{
			$result = $this->paramRequired($result, 'booking_stream_dates_id', "Didnt't receive the streamdate id");

			if($result['ready'])
			{
				$this->loadModel('Streamdate');
				$Streamdate = $this->Streamdate->findAllById($result['data']['booking_stream_dates_id']);

				if(!$Streamdate)
				{
					$result = $this->addFailError($result, "There is no Streamdate registered with that id.");
				}
				else
				{
					$bookingList 	= array();
					$bookings 		= $this->Booking->findAllByStreamdatesId($result['data']['booking_stream_dates_id']);

					foreach ($bookings as $booking) 
					{
						array_push($bookingList, $booking['Booking']);
					}
					$result['Bookings'] = $bookingList;
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
		$this->Booking->recursive = 0;
		$this->set('bookings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Booking->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		$options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
		$this->set('booking', $this->Booking->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Booking->create();
			if ($this->Booking->save($this->request->data)) {
				$this->Flash->success(__('The booking has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The booking could not be saved. Please, try again.'));
			}
		}
		$streamdates = $this->Booking->Streamdate->find('list');
		$this->set(compact('streamdates'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Booking->exists($id)) {
			throw new NotFoundException(__('Invalid booking'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Booking->save($this->request->data)) {
				$this->Flash->success(__('The booking has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The booking could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
			$this->request->data = $this->Booking->find('first', $options);
		}
		$streamdates = $this->Booking->Streamdate->find('list');
		$this->set(compact('streamdates'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Booking->id = $id;
		if (!$this->Booking->exists()) {
			throw new NotFoundException(__('Invalid booking'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Booking->delete()) {
			$this->Flash->success(__('The booking has been deleted.'));
		} else {
			$this->Flash->error(__('The booking could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 █████╗      ██╗ █████╗ ██╗  ██╗
██╔══██╗     ██║██╔══██╗╚██╗██╔╝
███████║     ██║███████║ ╚███╔╝ 
██╔══██║██   ██║██╔══██║ ██╔██╗ 
██║  ██║╚█████╔╝██║  ██║██╔╝ ██╗
╚═╝  ╚═╝ ╚════╝ ╚═╝  ╚═╝╚═╝  ╚═╝
*/

	/**
	██████╗  ██████╗  ██████╗ ██╗  ██╗██╗███╗   ██╗ ██████╗ 
	██╔══██╗██╔═══██╗██╔═══██╗██║ ██╔╝██║████╗  ██║██╔════╝ 
	██████╔╝██║   ██║██║   ██║█████╔╝ ██║██╔██╗ ██║██║  ███╗
	██╔══██╗██║   ██║██║   ██║██╔═██╗ ██║██║╚██╗██║██║   ██║
	██████╔╝╚██████╔╝╚██████╔╝██║  ██╗██║██║ ╚████║╚██████╔╝
	╚═════╝  ╚═════╝  ╚═════╝ ╚═╝  ╚═╝╚═╝╚═╝  ╚═══╝ ╚═════╝ 
	*/
	public function ajax_booking($user_email='', $streaming_id='')
	{
		$result = $this->setUp();

		$result = $this->paramNotBlank($user_email, "User email not provided", $result);
		$result = $this->paramNotBlank($streaming_id, "Streaming id not provided", $result);

		$result['user_email'] = $user_email;
		$result['stream_id'] = $streaming_id;
		
		if($result['ready'])
		{
			$this->loadModel('User');
			$user =	$this->User->findAllByEmail($user_email);

			if($user)
			{
				$booking = $this->Booking->findAllByStreamdatesIdAndUsersEmail($streaming_id, $user_email); 

				if(!$booking)
				{
					$newBooking = array(
							'streamdates_id' 	=> 	$streaming_id,
							'users_email' 		=> 	$user_email,
							'creationdate' 		=> 	$this->getFullDate(),
							'status' 			=> 	"Pending"
						);

						$response = $this->Booking->save($newBooking);

						if(!$response)
						{
							$result = $this->addFailError($result, "There was an error trying to book. Try again.");
						}					
				}
				else
				{
					$result = $this->addFailError($result, "You already have booked for this streaming ");
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