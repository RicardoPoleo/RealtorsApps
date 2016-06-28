<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 */
class CitiesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter()
	{
		$this->Auth->Allow('mobile_add', 'mobile_delete', 'mobile_viewAll', 'mobile_view');
	}

	public function mobile_viewAll($limit = 9999999999)
	{
		$result 	=	$this->setUp();
	
		$Cities =  $this->City->query('SELECT DISTINCT city FROM  `cities` LIMIT 0 , '.$limit);

		$listCities = array();

		foreach ($Cities as $City) 
		{
			array_push($listCities, $City['cities']);
		}

		$result['cities'] = $listCities; 

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

}
