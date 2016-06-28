	<?php
		/**
	██╗███╗   ██╗██████╗ ███████╗██╗  ██╗    ███████╗██╗   ██╗████████╗██╗   ██╗██████╗ ███████╗    ████████╗
	██║████╗  ██║██╔══██╗██╔════╝╚██╗██╔╝    ██╔════╝██║   ██║╚══██╔══╝██║   ██║██╔══██╗██╔════╝    ╚══██╔══╝
	██║██╔██╗ ██║██║  ██║█████╗   ╚███╔╝     █████╗  ██║   ██║   ██║   ██║   ██║██████╔╝█████╗         ██║   
	██║██║╚██╗██║██║  ██║██╔══╝   ██╔██╗     ██╔══╝  ██║   ██║   ██║   ██║   ██║██╔══██╗██╔══╝         ██║   
	██║██║ ╚████║██████╔╝███████╗██╔╝ ██╗    ██║     ╚██████╔╝   ██║   ╚██████╔╝██║  ██║███████╗       ██║   
	╚═╝╚═╝  ╚═══╝╚═════╝ ╚══════╝╚═╝  ╚═╝    ╚═╝      ╚═════╝    ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝       ╚═╝   
	                                                                                                         
		*/
	?>
	<style>
		.no-decoration
		{
			list-style-type: none;
		}

		.width-40
		{
			width: 40% !important;
		}

		.nav-bar-select
		{
			float:right;
			margin-right: 14%;
		}
		.dropdown-menu>li
		{
			padding: 5px;
		}

		.overlay    
		{  
			background:rgba(0,0,0,.75);
	        text-align:center;
	        padding:45px 0 66px 0;
	        opacity:0;
	        -webkit-transition: opacity .25s ease;
			-moz-transition: opacity .25s ease;
		}

		.extra-info
		{
			width:	94%; 
			height: 100%; 
			opacity: 0; 
			position: absolute;
			background-color: #E47B3A; 
			z-index: 99;
			color: white;
		}

		.extra-info:hover 
		{
			opacity:0.70;
		}

		.general-info
		{
			background-color: black; 
			opacity: 0;
		}

		.extra-info:hover > .general-info
		{
			visibility: hidden;
		}

		.abs 
		{
			position: absolute;
		}

		.left
		{
			left: 0;
		}

		.right
		{
			right: 0;
		}

		.piso
		{
			bottom: 0;
		}

		.margin-top-25
		{
			margin-top: 25%;
		}

		.img-pretty
		{
			min-width: 300px;
			min-height: 249px;

			max-width: 249px;
			max-height: 249px;
		}

		.little-margin-top
		{
			margin-top: 5px;
		}

		.color-white
		{
			color: white;
		}

		.color-orange
		{
			color: #E69F66;
		}

		.text-left
		{
			text-align: left;
		}

		.text-center
		{
			text-align: center;
		}

		.text-right
		{
			text-align: right;
		}

		.width-200
		{
			width: 200px;
		}

		.width-140
		{
	    	width: 140px;		
		}

		.labels 
		{
			color: white;
	     	background-image: url("/APP/img/icon.png") ;
			background-repeat:no-repeat;
			background-size: auto 100%;
			background-position:center;	     	
	     	font-family: "Lucida Grande", "Arial", sans-serif;
	     	font-size: 10px;
	     	text-align: center;
	     	width: 90px;
	     	height: 24px;
	     	padding-top: 4px;
	     	white-space: nowrap;
	   	}

	   	.bigLabels
	   	{
			color: white;
	     	background-image: url("/APP/img/bigIcon.png");
			background-repeat:no-repeat;
			background-size:contain;
			background-position:center;	     	
	     	font-family: "Lucida Grande", "Arial", sans-serif;
	     	font-size: 10px;
	     	text-align: center;
	     	width: 42px;
	     	height: 24px;
	     	padding-top: 4px;
	     	background-repeat: no-repeat;
	     	white-space: nowrap;	   		
	   	}

		@media (min-width: 1200px)
		.container {
		    background-color: red;
		}

		.ui-autocomplete {
	    position: absolute;
	    z-index: 1000;
	    cursor: default;
	    padding: 0;
	    margin-top: 2px;
	    list-style: none;
	    background-color: #ffffff;
	    border: 1px solid #ccc
	    -webkit-border-radius: 5px;
	       -moz-border-radius: 5px;
	            border-radius: 5px;
	    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	       -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	}
	.ui-autocomplete > li {
	  padding: 3px 20px;
	}
	.ui-autocomplete > li.ui-state-focus {
	  background-color: #DDD;
	}
	.ui-helper-hidden-accessible {
	  display: none;
	}

	.tt-open
	{
	    position: absolute;
	    top: 100%;
	    left: 0px;
	    z-index: 100;
	    display: none;
	    background-color: ffffff;	
	}
	</style>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeKdml57ehEdvMSNDrm9D0ql_YiIGSR9A"></script>
	<?php 
		echo $this->Html->css('bootstrap.min.css');
		echo $this->Html->script('jquery-1.12.0.min.js');
		echo $this->Html->script('bootstrap.min.js');
		echo $this->Html->script('typehead.bundle.js');
		echo $this->Html->script('markerwithlabel_packed.js');
		$userEmail = $this->Session->read('Auth.User.User.email');
	?>
	<!--/script-->

	<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>

	<div class="container-fluid">	
	<div class="row">
		<div class="col-md-6"> 
			<?php echo $this->Html->image('padpat-fixed.jpg', array('class' => 'img-responsive'));?>
		</div>
		<div class="col-md-6"> 
			<div class="row">
				<div class="col-md-8"> </div>
				<div class="col-md-2">
					<?php
						$thumb_img = $this->Html->image('profile.png', 	array('class' => 'img-responsive rigth'));
						echo $this->Html->link( $thumb_img, array('controller'=>'FutureTenants','action'=>'view', $userEmail), array('escape'=>false));
					?>
				</div>
				<div class="col-md-2">
					<?php
						$thumb_img = $this->Html->image('logout.png', 	array('class' => 'img-responsive', 'style'=>'width: 80%'));
						echo $this->Html->link( $thumb_img, array('controller'=>'Users','action'=>'logout'), array('escape'=>false));
					?>
				</div>				
			</div>
		</div>
	</div>
	<nav class="navbar navbar-default" style="z-index:100">
		<?php echo $this->Form->create(null, array('url' => array('controller' => 'FutureTenants', 'action' => 'index' ), 'class'=> 'navbar-form navbar-left')); ?>

		<!--form class="navbar-form navbar-left" role="search" action=""-->
			<!--div class="form-group" id="the-basics">
				<input name ="search-text" type="text" class="form-control autocomplete typeahead" placeholder="Type the city">
			</div-->

		<div class="form-group ui-widget">
    		<input name="search-text" class="form-control autocomplete" placeholder="Search by City" />
  		</div>
		
			<!-- Start of: Deal Type -->
			<div class="form-group">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Deal Type <span class="caret"></span></a>
						<ul class="dropdown-menu width-140">
							<li> Rent
								<ul class="no-decoration">
									<li> <input name="rent-by-owner" 	type="checkbox"> By Owner</li>
									<li> <input name="rent-by-realtor" 	type="checkbox"> By Realtor</li>
								</ul>
							</li>
							<li> Sale
								<ul class="no-decoration">
									<li> <input name="sale-by-owner" 	type="checkbox"> By Owner</li>
									<li> <input name="sale-by-realtor" 	type="checkbox"> By Realtor</li>
								</ul>
							</li>					
						</ul>
					</li>
				</ul>
			</div>
			<!-- End of: Deal Type -->

			<!-- Start of: Price -->
			<div class="form-group">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Price <span class="caret"></span></a>
						<ul class="dropdown-menu width-200">
							<li> 
								<input name="price-min" type="text" class="form-control width-40" placeholder="Min">
								----
								<input name="price-max" type="text" class="form-control width-40" placeholder="Max">
							</li>					
						</ul>
					</li>
				</ul>
			</div>
			<!-- End of: Price -->

			<!-- Start of: Property Type -->
			<div class="form-group">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Property Type <span class="caret"></span></a>
						<ul class="dropdown-menu no-decoration">
							<li> <input name="type-multi" 		type="checkbox"> Multi-Family</li>					
							<li> <input name="type-townhouses" 	type="checkbox"> Townhouses</li>					
							<li> <input name="type-apartment" 	type="checkbox"> Apartment</li>					
							<li> <input name="type-condos" 		type="checkbox"> Condos</li>					
							<li> <input name="type-house" 		type="checkbox"> House</li>					
							<li> <input name="type-other" 		type="checkbox"> Other</li>					
						</ul>
					</li>
				</ul>
			</div>			
			<!-- End of: Property Type -->

			<!-- Start of: Size -->
			<!--div class="form-group">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Size <span class="caret"></span></a>
						<ul class="dropdown-menu no-decoration">
							<li>
								Bedrooms
								<select name="bedrooms" class="nav-bar-select">
								  <option value="n/a">--</option>
								  <option value="+1">+1</option>
								  <option value="+2">+2</option>
								  <option value="+3">+3</option>
								  <option value="+4">+4</option>
								</select> 
							</li>					
							<li>
								Bathrooms
								<select name="bathrooms" class="nav-bar-select">
								  <option value="n/a">--</option>
								  <option value="+1">+1</option>
								  <option value="+2">+2</option>
								  <option value="+3">+3</option>
								  <option value="+4">+4</option>
								</select> 
							</li>					
							<li>
								Beds
								<select name="beds" class="nav-bar-select">
								  <option value="n/a">--</option>
								  <option value="+1">+1</option>
								  <option value="+2">+2</option>
								  <option value="+3">+3</option>
								  <option value="+4">+4</option>
								</select> 
							</li>
							<li>
								Square Feets 
								<br>
								<input name="square-feets-min" type="text" class="form-control width-40" placeholder="Min">
								----
								<input name="square-feets-max" type="text" class="form-control width-40" placeholder="Max">
							</li>
							<li>
								Lots Size 
								<br>
								<input name="lots-size-min" type="text" class="form-control width-40" placeholder="Min">
								----
								<input name="lots-size-max" type="text" class="form-control width-40" placeholder="Max">
							</li>							
						</ul>
					</li>
				</ul>
			</div-->			
			<!-- End of: Size -->
		
			<!-- Start of: Amenities -->
			<!--div class="form-group">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Amenities <span class="caret"></span></a>
						<ul class="dropdown-menu no-decoration">
							<li> <input name="amenities-pets" type="checkbox"> Pets Allowed</li>					
							<li> <input name="amenities-parking" type="checkbox"> Parking Available</li>					
							<li> <input name="amenities-laundry" type="checkbox"> Laundry Available</li>					
							<li> <input name="amenities-air" type="checkbox"> Air Conditioning</li>										
						</ul>
					</li>
				</ul>
			</div-->			
			<!-- End of: Amenities -->			

			<!-- Start of: More -->
			<div class="form-group">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More <span class="caret"></span></a>
						<ul class="dropdown-menu no-decoration width-200">
							<li>
								Rating
								<select name="rating" class="nav-bar-select">
								  <option value="n/a">--</option>
								  <option value="1">+1</option>
								  <option value="2">+2</option>
								  <option value="3">+3</option>
								  <option value="4">+4</option>
								  <option value="5">+5</option>
								</select> 
							</li>
							<li>
								Days old
								<select name="days-old" class="nav-bar-select">
								  <option value="n/a">------</option>
								  <option value="1">1 week</option>
								  <option value="2">2 week</option>
								  <option value="3">3 week</option>
								  <option value="4">4 week</option>
								  <option value="5">5 week</option>
								</select> 
							</li>
							<!--li>
								Keywords 
								<input name="keywords" type="text" class="form-control width-40" style="min-width: 200px;">
							</li-->				
						</ul>
					</li>
				</ul>
			</div>			
			<!-- End of: More -->

			<div class="form-group">
				<button type="submit" class="btn btn-default">Filter</button>
			</div>		
		</form>	
	</nav>
	</div><!-- End of div nav -->

	
	<?php
	/**
	██████╗ ██████╗  ██████╗ ██████╗ ███████╗██████╗ ████████╗██╗   ██╗
	██╔══██╗██╔══██╗██╔═══██╗██╔══██╗██╔════╝██╔══██╗╚══██╔══╝╚██╗ ██╔╝
	██████╔╝██████╔╝██║   ██║██████╔╝█████╗  ██████╔╝   ██║    ╚████╔╝ 
	██╔═══╝ ██╔══██╗██║   ██║██╔═══╝ ██╔══╝  ██╔══██╗   ██║     ╚██╔╝  
	██║     ██║  ██║╚██████╔╝██║     ███████╗██║  ██║   ██║      ██║   
	╚═╝     ╚═╝  ╚═╝ ╚═════╝ ╚═╝     ╚══════╝╚═╝  ╚═╝   ╚═╝      ╚═╝   
	*/
	?>
	<!-- Start of: Main Container-->
	<div class="container-fluid" id="mainPropertyContainer"style="height-max: 80%">
		<!-- Start of: Main Row-->
		<div class="row" id="mainPropertyRow">
			<!-- Start of: col-md-6 for Properties-->
			<div class="col-md-6" id="" style="max-height: 610px; min-height: 610px; overflow-y: auto; overflow-x: hidden;">
				
				<!-- Start of: For -->
				<?php for ($i=0; $i < count($properties); $i++):?>

					<?php if( $i % 2==0): ?>
						<?php if($i>1):?>
							<div class="row little-margin-top">
						<?php else: ?>
							<div class="row">
						<?php endif ?>
					<?php endif ?>


					<?php echo "<!-- Start of: 	This property ".$i."-->"; ?>

						<div class="col-md-6 property" style="	text-align: -webkit-center; color: white; font-size: large;">
							<a href="/APP/Properties/view/<?php echo $properties[$i]['Property']['id']; ?>">
							<!--a target="_blank" href="/APP/Properties/view/<?php echo $properties[$i]['Property']['id']; ?>"-->
								<div class="extra-info">
									<div class="row">
										<div class="col-md-12" style="margin-top: 10%"> <?php echo $properties[$i]['Property']['address']; ?></div>
										<div class="col-md-12" style="margin-top: 10%"> 
											<?php echo $properties[$i]['Property']['propertytype'] . " for " . $properties[$i]['Property']['dealtype']; ?>
										</div>
										<div class="col-md-12"> <?php echo $properties[$i]['Property']['price']; ?> </div>
										<div class="col-md-12" style="margin-top: 10%;">
										<?php if($properties[$i]['Property']['Rating']==0): ?>
											<?php echo $this->Html->image('Stars1.png', 	array('class' => 'img-responsive', 'style'=>'width: 40%;'));?>
										<?php elseif($properties[$i]['Property']['Rating']<=1): ?>
											<?php echo $this->Html->image('Stars2.png', 	array('class' => 'img-responsive', 'style'=>'width: 40%;'));?>
										<?php elseif($properties[$i]['Property']['Rating']<=2): ?>
											<?php echo $this->Html->image('Stars3.png', 	array('class' => 'img-responsive', 'style'=>'width: 40%;'));?>
										<?php elseif($properties[$i]['Property']['Rating']<=3): ?>
											<?php echo $this->Html->image('Stars4.png', 	array('class' => 'img-responsive', 'style'=>'width: 40%;'));?>
										<?php elseif($properties[$i]['Property']['Rating']<=4): ?>
											<?php echo $this->Html->image('Stars5.png', 	array('class' => 'img-responsive', 'style'=>'width: 40%;'));?>
										<?php else: ?>
											<?php echo $this->Html->image('Stars6.png', 	array('class' => 'img-responsive', 'style'=>'width: 40%;'));?>		
										<?php endif; ?>		
										</div>
										<div class="col-md-12" style="margin-top: 10%">
											<!--div class="row">
												<div class="col-md-4">{Camas}</div>
												<div class="col-md-4">{Banos}</div>
												<div class="col-md-4">{Metraje}</div>
											</div-->
										</div>
									</div>
								</div>
								<div>
									<div class="row abs piso general-info">
										<div class="col-md-12">

										</div>
									</div>
									<div class="row abs piso ">
										<div class="col-md-12 color-white" style="padding-right: 25px;">
 										<!--div class="col-md-12 color-white" style="padding-right: 25px; background-color: rgba(119,119,119,0.5); margin-left: 5%; width: 290px;"-->
											<?php echo $properties[$i]['Property']['address']; ?>
											<div class="col-md-6 abs left color-orange text-left">
												<?php echo $properties[$i]['Property']['propertytype'] . " for " . $properties[$i]['Property']['dealtype']; ?>
											</div>
											<div class="col-md-6 abs right color-orange text-right margin-top"><?php echo $properties[$i]['Property']['price']; ?></div>
										</div>
									</div>
								</div>
							</a>
							<?php 
							echo $this->Html->image('properties/'.$properties[$i]['Photos'][0]['id'].'.jpg', 	array('class' => 'img-responsive img-pretty'));?>
						</div>

					<?php echo "<!-- End of: 	This property ".$i."-->"; ?>


					<?php if ( ($i%2!=0) or ($i == count($properties)-1) ): ?>
						</div>
					<?php endif?>

				<?php endfor ?>
				<!-- End of: For each-->
				

				<!-- End of: col-md-6 for Properties-->
			</div>

			<!-- Start of: col-md-6 for Maps-->
			<div id="map" class="col-md-6" style="background-color: black; width: 49%; height: 600px;">
				<?php //echo $this->Html->image('map.jpg', 	array('class' => 'img-responsive'));?>
			</div>
			<!-- End of: col-md-6 for Maps-->
		</div>
		<!-- End of: Main Row-->
	</div>
	<!-- End of: Main Container-->
</div>

<script type="text/javascript"> 
    var map;   
    
    function initMap() 
    {
    	var myLatLng = {lat: parseFloat("0"), lng: parseFloat("0")}; 

        map = new google.maps.Map(document.getElementById('map'), 
        {
            zoom: 14,
            center: myLatLng
        });

		var properties = <?php echo json_encode($properties); ?>;

		var firstLat = 0;
		var firstLon = 0;
		var iw;

		var added 	= 0;
		var markers = [];
		var infoWindows = [];

		//First we loop with the properties
		for(var i=0;i<properties.length;i++)
		{
			var obj = properties[i];

			if ( (obj['Property']['latitude'] != null) && (obj['Property']['longitude'] != null) )
			{
				if(i==0)
				{
					firstLat = obj['Property']['latitude'];
					firstLon = obj['Property']['longitude'];
					console.log("First Latitude: "+obj['Property']['latitude']+". First Longitude: "+obj['Property']['longitude']);
				}

				var myLatLng = {lat: parseFloat(obj['Property']['latitude']), lng: parseFloat(obj['Property']['longitude'])};

				var myHTML = "";

					myHTML = "<div class='container' style='width: 200px;'>" 
								+"<div class='col-md-12'>"
									+"<p>"+obj['Property']['address']+"</p>"
									+"<p>"+obj['Property']['propertytype']+" for "+obj['Property']['dealtype'] + "</p>"
									+"<p>$"+obj['Property']['price']+"/month</p>"
									+"<p> <a target='_blank' href='/APP/Properties/view/"+obj['Property']['id']+"'> Check it out!</a></p>"
								+"</div>"
							+"</div>";

				var marker;

				if(obj['Property']['price']>=1000000)
				{
					console.log("Bigger than 1M");
					marker = new MarkerWithLabel({
				    	id: obj['Property']['id'],
				        map: map,
				    	html: myHTML,		        
			        	icon: pinSymbol('#F48600'),
			        	position: myLatLng,
				        labelClass: "labels", // the CSS class for the label
				        labelAnchor: new google.maps.Point(20, 0),
				        labelContent: "$"+obj['Property']['iconPrice'],
			    	    labelInBackground: false
			      	});
				}
				else
				{
					console.log("Smaller than 1M");
					marker = new MarkerWithLabel({
				    	id: obj['Property']['id'],
				        map: map,
				    	html: myHTML,		        
			        	icon: pinSymbol('#F48600'),
			        	position: myLatLng,
				        labelClass: "bigLabels", // the CSS class for the label
				        labelAnchor: new google.maps.Point(20, 0),
				        labelContent: "$"+obj['Property']['iconPrice'],
			    	    labelInBackground: false
			      	});					
				}

		       

		      console.log("Marker's id: "+obj['Property']['id']+". Su precio: "+obj['Property']['price']+". Coordinates: "+obj['Property']['latitude']+ "||"+obj['Property']['longitude']);

			    markers[added] 		= 	marker;

				google.maps.event.addListener(markers[added], 'click', function()
				{
		        	var infowindow = new google.maps.InfoWindow({
		            	id: this.id,
		            	content:this.html,
		            	position:this.getPosition()
		          	});

		        	infoWindows[added] = infowindow;
          			infowindow.open(map);

				});				

				google.maps.event.addListener(map, 'click', function()
				{
					for (var i = infoWindows.length - 1; i >= 0; i--) 
					{
						if(infoWindows[i] !== null && typeof infoWindows[i] !== "undefined")
						{
							infoWindows[i].close();
						}
					}
				});
				
				added++;
			}
		}

		var myLatLng = {lat: parseFloat(firstLat), lng: parseFloat(firstLon)};		
		map.setCenter(myLatLng);
    }

	function isInfoWindowOpen(infoWindow)
	{
	    var map = infoWindow.getMap();
	    return (map !== null && typeof map !== "undefined");
	}

	  function pinSymbol(color) 
	  {
	      return {
	          path: 'M0 0',
	          fillColor: color,
	          fillOpacity: 1,
	          strokeColor: '#F48600',
	          strokeWeight: 2,
	          scale: 1
	      };
	  }

  	google.maps.event.addDomListener(window, 'load', initMap);

	//END OF: To the autocomplete
$(function() {
  var availableTags = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
		  'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
		  'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
		  'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
		  'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
		  'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
		  'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
		  'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
		  'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
		];
  
  $(".autocomplete").autocomplete({
    source: availableTags
  });
});
</script>
