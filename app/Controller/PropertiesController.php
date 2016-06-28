<?php
App::uses('AppController', 'Controller');
/**
 * Properties Controller
 *
 * @property Property $Property
 * @property PaginatorComponent $Paginator
 */
class PropertiesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter()
	{
		$this->Auth->Allow('mobile_add', 'mobile_delete', 'mobile_viewAll', 'mobile_edit', 'mobile_view', 'mobile_filterBy', 'view');
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

	/*
property={
				"property_users_email":"ricardopoleo@gmail.com",
				"property_address":"Test direction",
				"property_state": "Caracas",
				"property_city":"Caracas 1",
				"property_description":"A nice place to live",
				"property_dealtype": "Rent",
				"property_propertytype":"House",
				"property_amenities": "No smoking area, pool",
				"property_size":"Huge landing area",
				"property_zip":1234,
				"property_price":12.34,
				"property_datecreation":"2016-02-02"
			}
	*/
	public function mobile_add()
	{
		$result =	$this->setUp();

		$result = $this->isPost($result, $_POST, 'property', "Didn't receive the request as a POST in 'property' param.");

		if($result['ready'])
		{

			//STRINGS
			$result = $this->paramRequired($result, 'property_propertytype', 	"Property type type wasn't received.");
			$result = $this->paramRequired($result, 'property_users_email', 	"User email wasn't received.");
			$result = $this->paramRequired($result, 'property_description', 	"Description wasn't received.");
			$result = $this->paramRequired($result, 'property_amenities', 		"Amenities type type wasn't received.");
			$result = $this->paramRequired($result, 'property_dealtype', 		"Deal type wasn't received.");
			$result = $this->paramRequired($result, 'property_address', 		"Address wasn't received.");
			$result = $this->paramRequired($result, 'property_state', 			"State wasn't received.");
			$result = $this->paramRequired($result, 'property_city', 			"City wasn't received.");
			$result = $this->paramRequired($result, 'property_size', 			"Size type type wasn't received.");
		
			//OTHER TYPES
			$result = $this->paramRequired($result, 'property_zip', 			"Zip code wasn't received."); 	//INT
			$result = $this->paramRequired($result, 'property_price', 			"Price wasn't received."); 		//FLOAT

			//CAN BE NULL
			$result = $this->paramSet($result, 'property_latitude',  "Didn't receive the longitude coordinate.");
			$result = $this->paramSet($result, 'property_longitude', "Didn't receive the longitude coordinate.");

			if($result['ready'])
			{
				$newProperty	=	array(
							'propertytype'	=>	$result['data']['property_propertytype'],
							'users_email'	=>	$result['data']['property_users_email'],
							'description'	=>	$result['data']['property_description'],
							'amenities'		=>	$result['data']['property_amenities'],
							'longitude'		=>	$result['data']['property_longitude'],
							'latitude'		=>	$result['data']['property_latitude'],
							'dealtype'		=>	$result['data']['property_dealtype'],
							'address'		=>	$result['data']['property_address'],
							'state'			=>	$result['data']['property_state'],
							'price'			=>	$result['data']['property_price'],
							'city'			=>	$result['data']['property_city'],
							'size'			=>	$result['data']['property_size'],
							'zip'			=>	$result['data']['property_zip']
					);

				$response 	=	$this->Property->save($newProperty);

				if($response)
				{
					$result['data']['id'] = $this->Property->id;
				}
				else
				{
					$result 	= 	$this->addFailError($result, "There was an error saving your property.");
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
		$result 	=	$this->setUp();

		$result 	= 	$this->isPost($result, $_POST, 'property', "Didn't receive the request as a POST in 'property' param.");

		if($result['ready'])
		{
 			$result 	= 	$this->paramRequired($result, 'property_id', 		"Property id wasn't received.");

			$result 	=	$this->updateValidation($result, "property_propertytype","propertytype","String");
			$result 	=	$this->updateValidation($result, "property_description", "description",	"String");
			$result 	=	$this->updateValidation($result, "property_amenities", 	"amenities",	"String");
			$result 	=	$this->updateValidation($result, "property_longitude", 	"longitude",	"Float");
			$result 	=	$this->updateValidation($result, "property_latitude", 	"latitude",		"Float");
			$result 	=	$this->updateValidation($result, "property_dealtype", 	"dealtype",		"String");
			$result 	=	$this->updateValidation($result, "property_address", 	"address",		"String");
			$result 	=	$this->updateValidation($result, "property_state", 		"state",		"String");
			$result 	=	$this->updateValidation($result, "property_price", 		"price",		"Float");
			$result 	=	$this->updateValidation($result, "property_city", 		"city",			"String");
			$result 	=	$this->updateValidation($result, "property_size", 		"size",			"String");
			$result 	=	$this->updateValidation($result, "property_zip", 		"zip",			"Integer");

		
 			if($result['ready'])
 			{
 				$Property = $this->Property->findAllById($result['data']['property_id']);

 				if(!$Property)
 				{
 					$result 	=	$this->addFailError($result, "There was an error trying to delete this property.");
 				}
 				else
 				{
 					$response 	= 	$this->Property->updateAll( $result['update'] ,array("id"=>$result['data']['property_id']));
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
 		$result 	=	$this->setUp();

 		$result = $this->isPost($result, $_POST, 'property', "Didn't receive the request as a POST in 'property' param.");

 		if($result['ready'])
 		{
 			$result = $this->paramRequired($result, 'property_id', 		"Property id wasn't received.");

 			if($result['ready'])
 			{
 				$Property =	$this->Property->findAllById($result['data']['property_id']);

 				if(!$Property)
 				{
 					$result 	=	$this->addFailError($result, "There is no property registered with that id.");
 				}
 				else
 				{
 					$response 	=	$this->Property->delete($result['data']['property_id']);

 					if(!$response)
 					{
 						$result 	=	$this->addFailError($result, "There was an error trying to delete this property.");
 					}
 					else
 					{
 						//We delete all the ratings related to this property.
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
 		$result 	=	$this->setUp();

 		$result = $this->isPost($result, $_POST, 'property', "Didn't receive the request as a POST in 'property' param.");

 		if($result['ready'])
 		{
 			$result = $this->paramRequired($result, 'property_id', 		"Property id wasn't received.");

 			if($result['ready'])
 			{
 				$Property =	$this->Property->findAllById($result['data']['property_id']);

 				if(!$Property)
 				{
 					$result 	=	$this->addFailError($result, "There is no property registered with that id.");
 				}
 				else
 				{
 					$result['property'] = $Property[0]['Property'];
 				}

 			}
 		}

 		$this->printResults($result);
 	}

	/**
	███╗   ███╗ ██████╗ ██████╗ ██╗██╗     ███████╗    ███████╗██╗██╗  ████████╗███████╗██████╗     ██████╗ ██╗   ██╗
	████╗ ████║██╔═══██╗██╔══██╗██║██║     ██╔════╝    ██╔════╝██║██║  ╚══██╔══╝██╔════╝██╔══██╗    ██╔══██╗╚██╗ ██╔╝
	██╔████╔██║██║   ██║██████╔╝██║██║     █████╗      █████╗  ██║██║     ██║   █████╗  ██████╔╝    ██████╔╝ ╚████╔╝ 
	██║╚██╔╝██║██║   ██║██╔══██╗██║██║     ██╔══╝      ██╔══╝  ██║██║     ██║   ██╔══╝  ██╔══██╗    ██╔══██╗  ╚██╔╝  
	██║ ╚═╝ ██║╚██████╔╝██████╔╝██║███████╗███████╗    ██║     ██║███████╗██║   ███████╗██║  ██║    ██████╔╝   ██║   
	╚═╝     ╚═╝ ╚═════╝ ╚═════╝ ╚═╝╚══════╝╚══════╝    ╚═╝     ╚═╝╚══════╝╚═╝   ╚══════╝╚═╝  ╚═╝    ╚═════╝    ╚═╝   
	*/
 	public function mobile_filterBy()
	{
 		$result 	=	$this->setUp();

 		$result = $this->isPost($result, $_POST, 'property', "Didn't receive the request as a POST in 'property' param.");

 		if($result['ready'])
 		{

 			$result = $this->paramRequired($result, 'property_filter_type', "Didn't receive the type of filter.");
 			//$result = $this->paramRequiredArray($result, 'property_filter_conditions', "Didn't receive the filter conditions.", "The conditions array must have at least one value");

 			if($result['ready'])
 			{
 				$propertiesList = array();

 				switch ($result['data']['property_filter_type']) 
 				{
 					case "rate":
 					
 						$propertiesList = $this->getPropertiesByRate($result['data']['property_filter_conditions']['rating']);
 						break;
 					
  					case "price":

	 					$min = $result['data']['property_filter_conditions']['minimum'];
	 					$max = $result['data']['property_filter_conditions']['maximum'];

	 					$propertiesList = $this->getPropertiesByPrice($min, $max);
 						break;

  					case "deal_type":
	 				
	 					$type = $result['data']['property_filter_conditions']['type'];
	 					$propertiesList = $this->getPropertiesByDealType($type);
 						break;

   					case "distance":
	 				
	 					$distance 			= $result['data']['property_filter_conditions']['distance'];
	 					$actual_latitude	= $result['data']['property_filter_conditions']['actual_latitude'];
	 					$actual_longitude	= $result['data']['property_filter_conditions']['actual_longitude'];
	 					
	 					$propertiesList 	= $this->getPropertiesByDistance($distance, $actual_latitude, $actual_longitude);
 						break;	

 					case "owner_email":
 					
 						$owner_email 		= $result['data']['property_filter_conditions']['email'];

 						$propertiesList 	= $this->getPropertiesByOwnerEmail($owner_email);
 						break;

 					case "city":
 					
 						$city 				= $result['data']['property_filter_conditions']['city'];

 						$propertiesList 	= $this->getPropertiesByCity($city);
 						break;

 					default:
 						$propertiesList = $this->getAllProperties();
 						break;
 				}

 				$properties = array();

 				$this->loadModel('Rating');
 				$this->loadModel('PropertiesPhoto');
 				
 				foreach ($propertiesList as $property) 
 				{
 					$propertiesPhotosList = $this->PropertiesPhoto->findAllByPropertiesId($property['id']);
 					
 					$photos = array();
 					foreach ($propertiesPhotosList as $photo) 
 					{
 						$photo['PropertiesPhoto']['url'] = "http://padpatdev.mobilemediacms.com/APP/img/properties/".$photo['PropertiesPhoto']['id'].".jpg";
 						array_push($photos, $photo['PropertiesPhoto']);
 					}

 					$property['photos'] = $photos;

					$Ratings 	= 	$this->Rating->findAllByPropertiesId($property['id']);

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
		 				
		 				$property['rating_average'] = round($sum/$count);		
		 			}
		 			else
		 			{
		 				$property['rating_average'] = 0;
		 			}

 					array_push($properties, $property);
 				}

 				$result['Properties'] = $properties;

 			}
 		}
		
 		$this->printResults($result);
	}

	/**
	██████╗ ██╗   ██╗    ██████╗  █████╗ ████████╗███████╗
	██╔══██╗╚██╗ ██╔╝    ██╔══██╗██╔══██╗╚══██╔══╝██╔════╝
	██████╔╝ ╚████╔╝     ██████╔╝███████║   ██║   █████╗  
	██╔══██╗  ╚██╔╝      ██╔══██╗██╔══██║   ██║   ██╔══╝  
	██████╔╝   ██║       ██║  ██║██║  ██║   ██║   ███████╗
	╚═════╝    ╚═╝       ╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
	*/
	public function getPropertiesByRate($ratingValue)
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

			if($average>=$ratingValue)
			{
				$property['Property']['rating'] = $average;
				array_push($propertiesList, $property['Property']);
			} 						
		}

		return $propertiesList;
	}

	/**
	██████╗ ██╗   ██╗    ██████╗ ██████╗ ██╗ ██████╗███████╗
	██╔══██╗╚██╗ ██╔╝    ██╔══██╗██╔══██╗██║██╔════╝██╔════╝
	██████╔╝ ╚████╔╝     ██████╔╝██████╔╝██║██║     █████╗  
	██╔══██╗  ╚██╔╝      ██╔═══╝ ██╔══██╗██║██║     ██╔══╝  
	██████╔╝   ██║       ██║     ██║  ██║██║╚██████╗███████╗
	╚═════╝    ╚═╝       ╚═╝     ╚═╝  ╚═╝╚═╝ ╚═════╝╚══════╝
	*/
	public function getPropertiesByPrice($min, $max)
	{
		$propertiesList = array();

 		$properties 	= $this->Property->find('all');
 		foreach ($properties as $property) 
 		{	
			if(($min<=$property['Property']['price']) and ($property['Property']['price']<=$max))
			{
				array_push($propertiesList, $property['Property']);
			} 						
		}

		return $propertiesList;		
	} 	

	/**
	██████╗ ██╗   ██╗    ██████╗ ███████╗ █████╗ ██╗         ████████╗██╗   ██╗██████╗ ███████╗
	██╔══██╗╚██╗ ██╔╝    ██╔══██╗██╔════╝██╔══██╗██║         ╚══██╔══╝╚██╗ ██╔╝██╔══██╗██╔════╝
	██████╔╝ ╚████╔╝     ██║  ██║█████╗  ███████║██║            ██║    ╚████╔╝ ██████╔╝█████╗  
	██╔══██╗  ╚██╔╝      ██║  ██║██╔══╝  ██╔══██║██║            ██║     ╚██╔╝  ██╔═══╝ ██╔══╝  
	██████╔╝   ██║       ██████╔╝███████╗██║  ██║███████╗       ██║      ██║   ██║     ███████╗
	╚═════╝    ╚═╝       ╚═════╝ ╚══════╝╚═╝  ╚═╝╚══════╝       ╚═╝      ╚═╝   ╚═╝     ╚══════╝
	*/
	public function getPropertiesByDealType($dealtype)
	{
		$propertiesList = array();

 		$properties 	= $this->Property->find('all');
 		foreach ($properties as $property) 
 		{	
			if($property['Property']['dealtype']==$dealtype)
			{
				array_push($propertiesList, $property['Property']);
			} 						
		}

		return $propertiesList;		
	}

	/**
	██████╗ ██╗   ██╗    ██████╗ ██╗███████╗████████╗ █████╗ ███╗   ██╗ ██████╗███████╗
	██╔══██╗╚██╗ ██╔╝    ██╔══██╗██║██╔════╝╚══██╔══╝██╔══██╗████╗  ██║██╔════╝██╔════╝
	██████╔╝ ╚████╔╝     ██║  ██║██║███████╗   ██║   ███████║██╔██╗ ██║██║     █████╗  
	██╔══██╗  ╚██╔╝      ██║  ██║██║╚════██║   ██║   ██╔══██║██║╚██╗██║██║     ██╔══╝  
	██████╔╝   ██║       ██████╔╝██║███████║   ██║   ██║  ██║██║ ╚████║╚██████╗███████╗
	╚═════╝    ╚═╝       ╚═════╝ ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═══╝ ╚═════╝╚══════╝
	*/
	public function getPropertiesByDistance($distance, $actual_latitude, $actual_longitude)
	{
		$degrees 	= 0.009*$distance;

		$lat_min 	= $actual_latitude - $degrees;
		$lat_max 	= $actual_latitude + $degrees;
		
		$long_min 	= $actual_longitude - ($degrees/cos($actual_latitude*M_PI/180));
		$long_max 	= $actual_longitude + ($degrees/cos($actual_latitude*M_PI/180));

		$propertiesList = array();

 		$properties 	= $this->Property->find('all');
 		foreach ($properties as $property) 
 		{	
			if( ( ($lat_min<=$actual_latitude) and ($actual_latitude<=$lat_max) ) and ( ($long_min<=$actual_longitude) and ($actual_longitude<=$long_max) ) )
			{
				array_push($propertiesList, $property['Property']);
			} 						
		}

		return $propertiesList;		
	}

	/**
	██████╗ ██╗   ██╗     ██████╗ ██╗    ██╗███╗   ██╗███████╗██████╗ 
	██╔══██╗╚██╗ ██╔╝    ██╔═══██╗██║    ██║████╗  ██║██╔════╝██╔══██╗
	██████╔╝ ╚████╔╝     ██║   ██║██║ █╗ ██║██╔██╗ ██║█████╗  ██████╔╝
	██╔══██╗  ╚██╔╝      ██║   ██║██║███╗██║██║╚██╗██║██╔══╝  ██╔══██╗
	██████╔╝   ██║       ╚██████╔╝╚███╔███╔╝██║ ╚████║███████╗██║  ██║
	╚═════╝    ╚═╝        ╚═════╝  ╚══╝╚══╝ ╚═╝  ╚═══╝╚══════╝╚═╝  ╚═╝
	*/
	public function getPropertiesByOwnerEmail($owner_email)
	{
		$propertiesList = array();
		$properties 	= $this->Property->findAllByUsersEmail($owner_email);

		foreach ($properties as $property) 
		{
			array_push($propertiesList, $property['Property']);
		}	

		return $propertiesList;
	}	

/**
	██████╗ ██╗   ██╗     ██████╗██╗████████╗██╗   ██╗
	██╔══██╗╚██╗ ██╔╝    ██╔════╝██║╚══██╔══╝╚██╗ ██╔╝
	██████╔╝ ╚████╔╝     ██║     ██║   ██║    ╚████╔╝ 
	██╔══██╗  ╚██╔╝      ██║     ██║   ██║     ╚██╔╝  
	██████╔╝   ██║       ╚██████╗██║   ██║      ██║   
	╚═════╝    ╚═╝        ╚═════╝╚═╝   ╚═╝      ╚═╝   
*/
	public function getPropertiesByCity($city)
	{
		$propertiesList = array();
		$properties 	= $this->Property->findAllByCity($city);

		foreach ($properties as $property) 
		{
			array_push($propertiesList, $property['Property']);
		}	

		return $propertiesList;
	}

	/**
	 █████╗ ██╗     ██╗     
	██╔══██╗██║     ██║     
	███████║██║     ██║     
	██╔══██║██║     ██║     
	██║  ██║███████╗███████╗
	╚═╝  ╚═╝╚══════╝╚══════╝
	*/
	public function getAllProperties()
	{
		$propertiesList = array();

 		$properties 	= $this->Property->find('all');
 		foreach ($properties as $property) 
 		{	
			array_push($propertiesList, $property['Property']);
		}

		return $propertiesList;		
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

	public function paramSet($result, $index, $errorMessage="")
	{
		if(!isset($result['data'][$index]))
		{	
			$result['data'][$index] = NULL;
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

	public function paramRequiredArray($result, $index, $errorMessage="", $notEmptyMessage="")
	{
		if((!isset($result['data'][$index]))||($result['data'][$index]==""))
		{	
			$result['ready']	=	false;
			$result['message']	=	"Fail";
			array_push($result['error'], $errorMessage);
		}
		elseif (count($result['data'][$index])==0) 
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

	public function stillOnTime($datetime)
	{
		$today = $this->getFullDate();

		if($today>=$datetime)
		{
			return true;
		}

		return false;
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
		$this->Property->recursive = 0;
		$this->set('properties', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) 
	{
		//INFO related to the property
		$Property = $this->Property->findAllById($id);

		if($Property)
		{
			$this->loadModel('Rating');
			$this->loadModel('Booking');
			$this->loadModel('Streamdate');
			$this->loadModel('PropertiesOwner');
			$this->loadModel('PropertiesPhoto');
			
			//INFO related to the Streaming dates upcoming
			$SQL = "SELECT * FROM streamdates WHERE properties_id = {$id} ORDER BY stream_datetime ASC";
			$StreamDates = $this->Streamdate->query($SQL);

			$streamingAvailable = array();
			foreach ($StreamDates as $Stream) 
			{
				//If the StreamDate hasn't pass
				$now 	= new DateTime();
				$time 	= new DateTime($Stream['streamdates']['stream_datetime']);
				
				if ($now <= $time) 
				{
					$SQL = "SELECT COUNT( * ) AS amount FROM  `bookings` WHERE  `bookings`.`streamdates_id` = ".$Stream['streamdates']['id'];

					$totalBookings = $this->Booking->query($SQL);
					$totalBookings = $totalBookings[0][0]['amount'];

					if($totalBookings<$Stream['streamdates']['capacity'])
					{
						$Stream['streamdates']['booked'] 		= 	$totalBookings;
						$Stream['streamdates']['totalBookings'] =	$totalBookings;

						array_push($streamingAvailable, $Stream);
					}
				}
			}


			if(count($streamingAvailable)>0)
			{
				$Property[0]['Property']['hasStreams'] = true;				
			}
			else
			{
				$Property[0]['Property']['hasStreams'] = false;				
			}

			if( ($Property[0]['Property']['longitude']==null) or ($Property[0]['Property']['latitude']==null) )
			{
				$Property[0]['Property']['latitude'] 	= 0;
				$Property[0]['Property']['longitude'] 	= 0;
			}

			//Property Photos
			$propertiesPhotosList = $this->PropertiesPhoto->findAllByPropertiesId($Property[0]['Property']['id']);
 					
 			$photos = array();
 			foreach ($propertiesPhotosList as $photo) 
 			{
 				$photo['PropertiesPhoto']['url'] = "http://padpatdev.mobilemediacms.com/APP/img/properties/".$photo['PropertiesPhoto']['id'].".jpg";
 				array_push($photos, $photo['PropertiesPhoto']);
 			}

 			$Property[0]['Property']['photos'] = $photos;

 			//Property Owner
			$PropertiesOwner = $this->PropertiesOwner->findAllByEmail($Property[0]['Property']['users_email']);

			//Property Rating
			$Ratings 	= 	$this->Rating->findAllByPropertiesId($Property[0]['Property']['id']);

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
		 		

		 		$average = $sum/$count;

		 		$Property[0]['Property']['rating_average'] = round($average);		
		 	}
		 	else
		 	{
		 		$Property[0]['Property']['rating_average'] = -1;
		 	}			

			$this->set('Property', $Property);
			$this->set('PropertiesOwner', $PropertiesOwner);
			$this->set('streamingAvailables', $streamingAvailable);
		}
		else
		{
			$this->Flash->error(__("There is no property with that id.") );
		}

		$options = array('conditions' => array('Property.' . $this->Property->primaryKey => $id));
		$this->set('property', $this->Property->find('first', $options));
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
			$this->Property->create();
			if ($this->Property->save($this->request->data)) 
			{
				$this->Flash->success(__('The property has been saved.'));
				return $this->redirect(array('controller'=> 'users', 'action' => 'admin'));
			} else {
				$this->Flash->error(__('The property could not be saved. Please, try again.'));
			}
		}

		$deal_type = array('Rent'=> 'Rent', 'Sale'=>'Sale');
		$property_type = array('Apartment'=> 'Apartment', 'House'=>'House', 'Room'=>'Room');

		$this->loadModel('PropertiesOwner');
		$owners = $this->PropertiesOwner->find('all');

		$owners_list = array();

		foreach ($owners as $owner) 
		{
			$owners_list[ $owner['PropertiesOwner']['email'] ] = $owner['PropertiesOwner']['last_name'].' '.$owner['PropertiesOwner']['first_name'];
		}

		$this->set('deal_type', $deal_type);
		$this->set('owners_list', $owners_list);
		$this->set('property_type', $property_type);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Property->exists($id)) {
			throw new NotFoundException(__('Invalid property'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Property->save($this->request->data)) {
				$this->Flash->success(__('The property has been saved.'));
				return $this->redirect(array('controller'=>'Users', 'action' => 'admin'));
			} else {
				$this->Flash->error(__('The property could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Property.' . $this->Property->primaryKey => $id));
			$this->request->data = $this->Property->find('first', $options);
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
		$this->Property->id = $id;
		if (!$this->Property->exists()) {
			throw new NotFoundException(__('Invalid property'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Property->delete()) {
			$this->Flash->success(__('The property has been deleted.'));
		} else {
			$this->Flash->error(__('The property could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller'=>'Users', 'action' => 'admin'));
	}
}
