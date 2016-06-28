<?php
App::uses('AppController', 'Controller');

/**
 * FutureTenants Controller
 *
 * @property FutureTenant $FutureTenant
 * @property PaginatorComponent $Paginator
 */
class FutureTenantsController extends AppController {
 public $helpers = array('Html');
/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator');

public function beforeFilter()
{
	$this->Auth->Allow('mobile_add', 'mobile_delete', 'mobile_view', 'mobile_edit', 'index', 'view');
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

		$result 	=	$this->isPost($result, $_POST, 'future_tenant', "Didn't receive the request as a POST in 'future_tenant' param.");

		if($result['ready'])
		{
			$result 	= 	$this->paramRequired($result, "future_tenant_email", 		"Didn't receive the future tenant email.");
			$result 	= 	$this->paramRequired($result, "future_tenant_about_me", 	"Didn't receive the future tenant about me.");
			$result 	= 	$this->paramRequired($result, "future_tenant_password", 	"Didn't receive the future tenant password.");
			$result 	= 	$this->paramRequired($result, "future_tenant_last_name", 	"Didn't receive the future tenant last name.");
			$result 	= 	$this->paramRequired($result, "future_tenant_first_name", 	"Didn't receive the future tenant first name.");

			if($result['ready'])
			{
				$FutureTenant = $this->FutureTenant->findAllByEmail($result['data']['future_tenant_email']);

				if($FutureTenant)
				{
					$result = $this->addFailError($result, "There is already a future tenant registered with that email.");
				}
				else
				{
					$this->loadModel('User');
					$newUser = array(
						'email'		=> 	$result['data']['future_tenant_email'],
						'password'	=> 	$result['data']['future_tenant_password'],
						'type'		=> 	"Future Tenant"
						); 					

					$response = $this->User->save($newUser);

					if(!$response)
					{
						$result = $this->addFailError($result, "There was an error trying to save your user");
					}
					else
					{
						$newFutureTenant = array(
							'email'			=>	$result['data']['future_tenant_email'],
							'about_me'		=>	$result['data']['future_tenant_about_me'],
							'last_name'		=>	$result['data']['future_tenant_last_name'],
							'first_name'	=>	$result['data']['future_tenant_first_name']
							);

						$response = $this->FutureTenant->save($newFutureTenant);

						if(!$response)
						{
							$result = $this->addFailError($result, "There was an error trying to save the future tenant.");
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

		$result 	=	$this->isPost($result, $_POST, 'future_tenant', "Didn't receive the request as a POST in 'future_tenant' param.");

		if($result['ready'])
		{
			$result 	= 	$this->paramRequired($result, "future_tenant_email", 		"Didn't receive the future tenant email.");

			if($result['ready'])
			{
				$FutureTenant = $this->FutureTenant->findAllByEmail($result['data']['future_tenant_email']);

				if($FutureTenant)
				{
					$result['FutureTenant'] = $FutureTenant[0]['FutureTenant'];
				}
				else
				{
					$result = $this->addFailError($result, "There isn't a future tenant registered with that email.");
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

		$result 	=	$this->isPost($result, $_POST, 'future_tenant', "Didn't receive the request as a POST in 'future_tenant' param.");

		if($result['ready'])
		{
			$result 	= 	$this->paramRequired($result, "future_tenant_email", 		"Didn't receive the future tenant email.");

			$result 	=	$this->updateValidation($result, "future_tenant_about_me", 		"about_me",		"String");
			$result 	=	$this->updateValidation($result, "future_tenant_last_name", 	"last_name",	"String");
			$result 	=	$this->updateValidation($result, "future_tenant_first_name", 	"first_name",	"String");
			$result 	=	$this->updateValidation($result, "future_tenant_email_edit", 	"email",		"String");

			if($result['ready'])
			{
				$FutureTenant = $this->FutureTenant->findAllByEmail($result['data']['future_tenant_email']);

				if($FutureTenant)
				{
					$response 	= 	$this->FutureTenant->updateAll( $result['update'] ,array("email"=>$result['data']['future_tenant_email']));

					if(isset($result['update']['email']))
					{
 						//Lets make some updates!
 						//The Old Email: $result['data']['future_tenant_email']
 						//The New Email: $result['update']['future_tenant_email_edit']

						$user_sql_update 			= 	"UPDATE  `admin_padpat`.`users` SET  `email` =  '".$result['data']['future_tenant_email_edit']."' WHERE  `users`.`email` =  '".$result['data']['future_tenant_email']."';";
						$rating_sql_update 			= 	"UPDATE  `admin_padpat`.`ratings` SET  `users_email` =  '".$result['data']['future_tenant_email_edit']."' WHERE `ratings`.`users_email` =  '".$result['data']['future_tenant_email']."';";
						$booking_sql_update 		=	"UPDATE  `admin_padpat`.`bookings` SET  `users_email` =  '".$result['data']['future_tenant_email_edit']."' WHERE  `bookings`.`users_email` =  '".$result['data']['future_tenant_email']."';";

						$this->loadModel('User'); 						
						$this->loadModel('Rating'); 						
						$this->loadModel('Booking');

						$this->User->query($user_sql_update);
						$this->Rating->query($rating_sql_update);
						$this->Booking->query($booking_sql_update); 						
					}
				}
				else
				{
					$result = $this->addFailError($result, "There isn't a future tenant registered with that email.");
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

		$result 	=	$this->isPost($result, $_POST, 'future_tenant', "Didn't receive the request as a POST in 'future_tenant' param.");

		if($result['ready'])
		{
			$result 	= 	$this->paramRequired($result, "future_tenant_email", 		"Didn't receive the future tenant email.");

			if($result['ready'])
			{
				$FutureTenant = $this->FutureTenant->findAllByEmail($result['data']['future_tenant_email']);

				if($FutureTenant)
				{
					$conditions 	=	array(
						'FutureTenant.email' 	=> $result['data']['future_tenant_email']
						);

					$response 		= 	$this->FutureTenant->deleteAll($conditions, false);

 					//$result['FutureTenant'] = $FutureTenant[0]['FutureTenant'];
				}
				else
				{
					$result = $this->addFailError($result, "There isn't a future tenant registered with that email.");
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

  public function form_isset($data, $index)
  {
  	if(!isset($data[$index]))
  	{
  		return false;
  	}

  	if ($data[$index]=='') 
  	{
  		return false;
  	}


  	if ($data[$index]=='n/a') 
  	{
  		return false;
  	}

  	return true;
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

	/**
██╗███╗   ██╗██████╗ ███████╗██╗  ██╗
██║████╗  ██║██╔══██╗██╔════╝╚██╗██╔╝
██║██╔██╗ ██║██║  ██║█████╗   ╚███╔╝ 
██║██║╚██╗██║██║  ██║██╔══╝   ██╔██╗ 
██║██║ ╚████║██████╔╝███████╗██╔╝ ██╗
╚═╝╚═╝  ╚═══╝╚═════╝ ╚══════╝╚═╝  ╚═╝
                                     
	*/
public function index() 
{
	$this->loadModel('Property');
	$Conditions = array(
		'order' => array('created' => 'desc'),
		'limit' => 10
		);
	$Properties = array();

	$propertiesList = array();

	if ($this->request->is(array('post', 'put')))
	{
		$data = $this->request['data'];
		$any = false;

		//If We are looking for some text
		if($this->form_isset($data, 'search-text'))
		{
			$any = true;
			$SQL = "SELECT Property . * 
			FROM  `properties` AS Property 
			WHERE city LIKE  '".$data['search-text']."'";

			$Properties = $this->Property->query($SQL);
		}
		//If we want to filter by DEAL TYPE
		elseif( ($this->form_isset($data, 'rent-by-owner')) || ($this->form_isset($data, 'rent-by-realtor')) || ($this->form_isset($data, 'sale-by-realtor')) || ($this->form_isset($data, 'sale-by-realtor')) )
		{
			$inUserTypeCondition 	= 	array();
			$inDealTypeCondition 	= 	array();

			if($this->form_isset($data, 'rent-by-owner'))
			{
				array_push($inUserTypeCondition, "'Owner'");
				array_push($inDealTypeCondition, "'Rent'");
			}

			if($this->form_isset($data, 'rent-by-realtor'))
			{
				array_push($inUserTypeCondition, "'Realtor'");
				array_push($inDealTypeCondition, "'Rent'");
			}

			if($this->form_isset($data, 'sale-by-owner'))
			{
				array_push($inUserTypeCondition, "'Owner'");
				array_push($inDealTypeCondition, "'Sale'");
			}

			if($this->form_isset($data, 'sale-by-realtor'))
			{
				array_push($inUserTypeCondition, "'Realtor'");
				array_push($inDealTypeCondition, "'Sale'");
			}

			$SQL = "SELECT Property . * 
			FROM properties AS Property, users AS u 
			WHERE u.type 	IN (".		implode(',',$inUserTypeCondition).") 
			AND u.email = Property.users_email 
			AND Property.dealtype IN (".	implode(',', $inDealTypeCondition).")";

			$Properties = $this->Property->query($SQL);
		}
		//If we want TO filter by PRICE
		elseif ( ($this->form_isset($data, 'price-min'))|| ($this->form_isset($data, 'price-max')) ) 
		{
			$any = true;
			if(!$this->form_isset($data, 'price-min'))
			{
				$data['price-min'] = 0;
			}

			if(!$this->form_isset($data, 'price-max'))
			{
				$data['price-max'] = 999999999;
			}

			$SQL = "SELECT Property . * FROM properties AS Property WHERE Property.price >= ".$data['price-min']." AND Property.price <= ".$data['price-max'];
			$Properties = $this->Property->query($SQL);
		}
		elseif( ($this->form_isset($data, 'type-multi')) 	|| ($this->form_isset($data, 'type-townhouses')) 
			|| ($this->form_isset($data, 'type-apartment')) || ($this->form_isset($data, 'type-condos')) 
			|| ($this->form_isset($data, 'type-house')) 	|| ($this->form_isset($data, 'type-other')) )
		{
			$inCondition = "(";
				$hasOneBefore = false;

				if($this->form_isset($data, 'type-multi'))
				{
					$hasOneBefore = true;
					$inCondition.="'Multy-Family'";
				}
				if($this->form_isset($data, 'type-townhouses'))
				{
					if($hasOneBefore)
					{
						$inCondition.=",'Townhouses'";
					}
					else
					{
						$hasOneBefore = true;
						$inCondition.="'Townhouses'";
					}
				}
				if($this->form_isset($data, 'type-apartment'))
				{
					if($hasOneBefore)
					{
						$inCondition.=",'Apartment'";
					}
					else
					{
						$hasOneBefore = true;
						$inCondition.="'Apartment'";
					}
				}
				if($this->form_isset($data, 'type-condos'))
				{
					if($hasOneBefore)
					{
						$inCondition.=",'Condos'";
					}
					else
					{
						$hasOneBefore = true;
						$inCondition.="'Condos'";
					}
				}
				if($this->form_isset($data, 'type-house'))
				{
					if($hasOneBefore)
					{
						$inCondition.=",'House'";
					}
					else
					{
						$hasOneBefore = true;
						$inCondition.="'House'";
					}
				}
				if($this->form_isset($data, 'type-other'))
				{
					if($hasOneBefore)
					{
						$inCondition.=",'Other'";
					}
					else
					{
						$hasOneBefore = true;
						$inCondition.="'Other'";
					}
				}

				$inCondition .= ")";

	$SQL = "SELECT Property . * FROM properties as Property WHERE Property.propertytype IN ".$inCondition;
	$Properties = $this->Property->query($SQL);			
}
elseif ($this->form_isset($data, 'rating') )
{
	$min_rating = $data['rating'];
	
	$propertiesRawList = array();

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

		if($average>=$min_rating)
		{
			$property['Property']['rating'] = $average;
			array_push($propertiesRawList, $property);
		} 						
	}
	$Properties = $propertiesRawList;
}
else
{
	$Properties = $this->Property->find('all');
}
}
else
{
	$Properties = $this->Property->find('all');
}

$this->loadModel('Rating');
$this->loadModel('PropertiesPhotos');
//This is giving the property some order and adding extra data
foreach ($Properties as $Property) 
{
	$Photos = $this->PropertiesPhotos->findAllByPropertiesId($Property['Property']['id']);

	//Adding the Photo List
	$PhotosList = array();

	if(count($Photos)>0)
	{
		foreach ($Photos as $Photo) 
		{
			unset($Photo['PropertiesPhotos']['properties_id']);
			array_push($PhotosList, $Photo['PropertiesPhotos']);
		}
	}
	else
	{
		$default = array(
			'id' 	=> 'default',
			'type' 	=> 'Main',
			'creationdate' => '2016-01-01 00:00:00'
			);

		array_push($PhotosList, $default);
	}

	//Adding the Rating
	$ratings = $this->Rating->findAllByPropertiesId($Property['Property']['id']);

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
	$Property['Property']['Rating'] = $average;

	$Property['Photos'] = 	$PhotosList;

	if($Property['Property']['price']>=1000000)
	{
		$price = $Property['Property']['price'] / 1000000;
		$price = round($price, 1);
		$Property['Property']['iconPrice']	= $price."M";
	}
	elseif($Property['Property']['price']>=1000)
	{
		$price = $Property['Property']['price'] / 1000;
		$price = round($price, 1);
		$Property['Property']['iconPrice']	= $price."K";
	}

	array_push($propertiesList, $Property); 
}

//$citiesList = $this->City->find('all');
$cities 	= array();




$this->set('properties', $propertiesList);
$this->set('propertiesJson', json_encode($propertiesList, JSON_FORCE_OBJECT));
}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/**
██╗   ██╗██╗███████╗██╗    ██╗
██║   ██║██║██╔════╝██║    ██║
██║   ██║██║█████╗  ██║ █╗ ██║
╚██╗ ██╔╝██║██╔══╝  ██║███╗██║
 ╚████╔╝ ██║███████╗╚███╔███╔╝
  ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝ 
                              
*/
  public function view($email = null, $from =null) 
  {
  	if($email==null)
  	{
	  	$this->Flash->error(__('Please log in first in order to access to special features.'));
	  	return $this->redirect(array('controller' => 'Users', 'action' => 'logout'));
  	}
  	else
  	{
	  	$FutureTenant = $this->FutureTenant->findAllByEmail($email);

	  	if (!$FutureTenant) 
	  	{
	  		$this->Flash->error(__('Please log in first in order to access to his special features.'));
	  		//$this->Flash->error(__('Invalid future tenant access.'));
	  		return $this->redirect(array('controller' => 'Users', 'action' => 'logout'));
	  	}
	  	else
	  	{
	  		$this->loadModel('Booking');
	  		$this->loadModel('Property');
	  		$this->loadModel('Streamdate');
	  		
				//Listing all your bookings
	  		$yourBookings = $this->Booking->findAllByUsersEmail($email);

	  		$availableStreams = array();

	  		foreach ($yourBookings as $booking) 
	  		{
					//Listing for each of then, the corresponding StreamDate
	  			$StreamDate = $this->Streamdate->findAllById($booking['Booking']['streamdates_id']);

	  			$now 	= new DateTime();

	  			$time 	= new DateTime($StreamDate[0]['Streamdate']['stream_datetime']);
					$time->add(new DateInterval('PT1H')); //You can join until 1 hour has passed
					
					if ($now <= $time) 
					{
						$Property = $this->Property->findAllById($StreamDate[0]['Streamdate']['properties_id']);

						//debug($Property);

						$StreamDate[0]['Streamdate']['Property'] = $Property[0]['Property'];
						
						array_push($availableStreams, $StreamDate);
					}
				}
			}

			if($FutureTenant[0]['FutureTenant']['first_name']==null)
			{
				$FutureTenant[0]['FutureTenant']['first_name'] = "You first name, ";	
			}
			
			if($FutureTenant[0]['FutureTenant']['last_name']==null)
			{
				$FutureTenant[0]['FutureTenant']['last_name'] = "Your last name.";	
			}
			
			if($FutureTenant[0]['FutureTenant']['about_me']==null)
			{
				$FutureTenant[0]['FutureTenant']['about_me'] = "You haven't set up your 'about me'.";	
			}

			$this->set('FutureTenant', $FutureTenant);
			$this->set('availableStreams', $availableStreams);
  	}
}

/**
 * add method
 *
 * @return void
 */
/**
 █████╗ ██████╗ ██████╗ 
██╔══██╗██╔══██╗██╔══██╗
███████║██║  ██║██║  ██║
██╔══██║██║  ██║██║  ██║
██║  ██║██████╔╝██████╔╝
╚═╝  ╚═╝╚═════╝ ╚═════╝ 
                        
*/
public function add() {
	if ($this->request->is('post')) 
	{
		
		if($this->request->data['FutureTenant']['password_again']!=$this->request->data['FutureTenant']['password'])
		{
			$this->Flash->error(__('The passwords dont match.'));
			return;
		}

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

			//var_dump($this->request->data['FutureTenant']);

		$futureTenant = array(
			'email'		=>	$this->request->data['FutureTenant']['email'],
			'first_name'=>	$this->request->data['FutureTenant']['firstname'],
			'last_name'	=>	$this->request->data['FutureTenant']['lastname'],
			'about_me'	=>	$this->request->data['FutureTenant']['aboutme']
			);

		$response 	=	$this->User->save($user);

		if($response)
		{
			$response	=	$this->FutureTenant->save($futureTenant);

			if($response)
			{
				return $this->redirect(array('controller' => 'Users', 'action'=>'admin'));
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
			$this->Flash->error(__('There was an error creating this User. Contact your manager.'));
				//debug($this->User->validationErrors);
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
	$FutureTenant = $this->FutureTenant->findAllByEmail($email);

	if (!$FutureTenant) 
	{
		$this->Flash->error(__("Your profile couldn't be updated . Please, try again."));
	}
	if ($this->request->is(array('post', 'put'))) 
	{
		$data = $this->request->data['FutureTenant'];

		$updateArray = array();

		$updateArray['id'] 			= "'{$this->request->data['FutureTenant']['id']}'";
		$updateArray['email'] 		= "'{$this->request->data['FutureTenant']['email']}'";
		$updateArray['about_me'] 	= "'{$this->request->data['FutureTenant']['about_me']}'";
		$updateArray['last_name'] 	= "'{$this->request->data['FutureTenant']['last_name']}'";
		$updateArray['first_name'] 	= "'{$this->request->data['FutureTenant']['first_name']}'";

		$response 	= 	$this->FutureTenant->updateAll( $updateArray ,array("email"=>$data['old_email']));

		if($response)
		{
			if($data['old_email']!=$data['email'])
			{
				$user_sql_update 			= 	"UPDATE  `admin_padpat`.`users` SET  `email` =  '".$data['email']."' WHERE  `users`.`email` =  '".$data['old_email']."';";
				$rating_sql_update 			= 	"UPDATE  `admin_padpat`.`ratings` SET  `users_email` =  '".$data['email']."' WHERE `ratings`.`users_email` =  '".$data['old_email']."';";
				$booking_sql_update 		=	"UPDATE  `admin_padpat`.`bookings` SET  `users_email` =  '".$data['email']."' WHERE  `bookings`.`users_email` =  '".$data['old_email']."';";

				$this->loadModel('User'); 						
				$this->loadModel('Rating'); 						
				$this->loadModel('Booking');

				$this->User->query($user_sql_update);
				$this->Rating->query($rating_sql_update);
				$this->Booking->query($booking_sql_update);

				$this->request->data['FutureTenant']['email'] = $data['email'];
				return $this->redirect(array('action' => 'edit', $data['email']));
			}
			$this->Flash->success(__('Your profile has been updated!'));
		}
		else
		{
			$this->Flash->error(__("Your profile couldn't be updated . Please, try again."));
		}
	} 
	else 
	{

		$this->request->data = $FutureTenant[0];
	}
}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/**
██████╗ ███████╗██╗     ███████╗████████╗███████╗
██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝
██║  ██║█████╗  ██║     █████╗     ██║   █████╗  
██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝  
██████╔╝███████╗███████╗███████╗   ██║   ███████╗
╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝
                                                 
*/
public function delete($id = null) {
	$this->FutureTenant->id = $id;
	if (!$this->FutureTenant->exists()) {
		throw new NotFoundException(__('Invalid future tenant'));
	}
	$this->request->allowMethod('post', 'delete');
	if ($this->FutureTenant->delete()) {
		$this->Flash->success(__('The future tenant has been deleted.'));
	} else {
		$this->Flash->error(__('The future tenant could not be deleted. Please, try again.'));
	}
	return $this->redirect(array('action' => 'index'));
}
}
