<?php 
	/**
██╗   ██╗██╗███████╗██╗    ██╗    ██████╗ ██████╗  ██████╗ ██████╗ ███████╗██████╗ ████████╗██╗   ██╗
██║   ██║██║██╔════╝██║    ██║    ██╔══██╗██╔══██╗██╔═══██╗██╔══██╗██╔════╝██╔══██╗╚══██╔══╝╚██╗ ██╔╝
██║   ██║██║█████╗  ██║ █╗ ██║    ██████╔╝██████╔╝██║   ██║██████╔╝█████╗  ██████╔╝   ██║    ╚████╔╝ 
╚██╗ ██╔╝██║██╔══╝  ██║███╗██║    ██╔═══╝ ██╔══██╗██║   ██║██╔═══╝ ██╔══╝  ██╔══██╗   ██║     ╚██╔╝  
 ╚████╔╝ ██║███████╗╚███╔███╔╝    ██║     ██║  ██║╚██████╔╝██║     ███████╗██║  ██║   ██║      ██║   
  ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝     ╚═╝     ╚═╝  ╚═╝ ╚═════╝ ╚═╝     ╚══════╝╚═╝  ╚═╝   ╚═╝      ╚═╝   
	*/
	echo $this->Html->css('bootstrap.min.css');
	echo $this->Html->css('jquery.rateyo.min.css');
	echo $this->Html->script('jquery-1.12.0.min.js');
	echo $this->Html->script('bootstrap.min.js');
	echo $this->Html->script('jquery.jcarousel.min.js');
	echo $this->Html->script('jquery.rateyo.min.js');
	$userEmail = $this->Session->read('Auth.User.User.email');

	//debug($PropertiesOwner);
	//debug($streamingAvailable);
	//debug($Property);
?>
</script>

<!-- Latest compiled and minified CSS -->
<!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.1.1/jquery.rateyo.min.css"-->
<!-- Latest compiled and minified JavaScript -->
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.1.1/jquery.rateyo.min.js"></script-->
<style>
			.text-center
			{
				text-align: -webkit-center;
			}

			.text-right
			{
				text-align: -webkit-right;
			}

			.text-orange
			{
				color: #FF8B1F;
			}

			.text-bold
			{
				font-weight: 600;
			}

			.button-custom-orange
			{
				color: #fff;
    			border-color: transparent;				
    			background-color: #FF8B1F;
			}

			.button-custom-orange:hover
			{
				color:#FF8B1F;
				background-color: #fff;
				border-color: transparent;
			}

			.button-custom-orange:active
			{
				color: #fff;
    			border-color: transparent;				
    			background-color: #FF8B1F;
			}

			.padding-top-5
			{
				padding-top: 5px;
			}

			.padding-bottom-5
			{
				padding-bottom: 5px;
			}

			.padding-left-5
			{
				padding-left: 5px;
			}

			.padding-right-5
			{
				padding-right: 5px;
			}


			.float-right
			{
			    float: right;
			}

			.margin-top-5
			{
				margin-top: 5px;
			}

			.property-under-box
			{
			    background-color: #868686;
    			padding-top: 5px;
    			padding-bottom: 5px;
			}

			.side-bar
			{
				background-color: #ECECEC;
				max-height: 300px;
			}

			.side-bar-image
			{
				height: 5px;
			}

			.btn-primary:hover
			{
				color: #fff;
    			border-color: transparent;				
    			background-color: #FF8B1F;			
			}
	</style>
	<!-- For the carrousel -->
	<style type="text/css">
		.wrapper 
		{
		    max-width: 530px;
		}

		.jcarousel-wrapper 
		{
		    position: relative;
		    -webkit-border-radius: 5px;
		    -moz-border-radius: 5px;
		    border-radius: 5px;
		    -webkit-box-shadow: 0 0 2px #999;
		    -moz-box-shadow: 0 0 2px #999;
		}

		/** Carousel **/

		.jcarousel 
		{
		    position: relative;
		    overflow: hidden;
		    width: 100%;
		}

		.jcarousel ul 
		{
		    width: 20000em;
		    position: relative;
		    list-style: none;
		    margin: 0;
		    padding: 0;
		}

		.jcarousel li 
		{
		    width: 200px;
		    float: left;
    		text-align: -webkit-center;
		    -moz-box-sizing: border-box;
		    -webkit-box-sizing: border-box;
		    box-sizing: border-box;
		}

		.jcarousel img 
		{
		    display: block;
		    max-width: 100%;
		    height: 175px;
		}

		/** Carousel Controls **/

		.jcarousel-control-prev,
		.jcarousel-control-next 
		{
		    position: absolute;
		    top: 50%;
		    margin-top: -15px;
		    width: 30px;
		    height: 30px;
		    text-align: center;
		    background: #4E443C;
		    color: #fff;
		    text-decoration: none;
		    text-shadow: 0 0 1px #000;
		    font: 24px/27px Arial, sans-serif;
		    -webkit-border-radius: 30px;
		    -moz-border-radius: 30px;
		    border-radius: 30px;
		    -webkit-box-shadow: 0 0 4px #F0EFE7;
		    -moz-box-shadow: 0 0 4px #F0EFE7;
		    box-shadow: 0 0 4px #F0EFE7;
		}

		.jcarousel-control-prev 
		{
		    left: 15px;
		}

		.jcarousel-control-next {
		    right: 15px;
		}

		/** Carousel Pagination **/

		.jcarousel-pagination {
		    position: absolute;
		    bottom: -40px;
		    left: 50%;
		    -webkit-transform: translate(-50%, 0);
		    -ms-transform: translate(-50%, 0);
		    transform: translate(-50%, 0);
		    margin: 0;
		}

		.jcarousel-pagination a {
		    text-decoration: none;
		    display: inline-block;

		    font-size: 11px;
		    height: 10px;
		    width: 10px;
		    line-height: 10px;

		    background: #fff;
		    color: #4E443C;
		    border-radius: 10px;
		    text-indent: -9999px;

		    margin-right: 7px;


		    -webkit-box-shadow: 0 0 2px #4E443C;
		    -moz-box-shadow: 0 0 2px #4E443C;
		    box-shadow: 0 0 2px #4E443C;
		}

		.jcarousel-pagination a.active {
		    background: #4E443C;
		    color: #fff;
		    opacity: 1;
		    -webkit-box-shadow: 0 0 2px #F0EFE7;
		    -moz-box-shadow: 0 0 2px #F0EFE7;
		    box-shadow: 0 0 2px #F0EFE7;
		}
	</style>

	<script type="text/javascript">
		(function($) {
		    $(function() {
		        var jcarousel = $('.jcarousel');

		        jcarousel
		            .on('jcarousel:reload jcarousel:create', function () {
		                var carousel = $(this),
		                    width = carousel.innerWidth();

		                if (width >= 500) {
		                    width = width / 3;
		                } else if (width >= 350) {
		                    width = width / 2;
		                }

		                carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
		            })
		            .jcarousel({
		                wrap: 'circular'
		            });

		        $('.jcarousel-control-prev')
		            .jcarouselControl({
		                target: '-=1'
		            });

		        $('.jcarousel-control-next')
		            .jcarouselControl({
		                target: '+=1'
		            });

		        $('.jcarousel-pagination')
		            .on('jcarouselpagination:active', 'a', function() {
		                $(this).addClass('active');
		            })
		            .on('jcarouselpagination:inactive', 'a', function() {
		                $(this).removeClass('active');
		            })
		            .on('click', function(e) {
		                e.preventDefault();
		            })
		            .jcarouselPagination({
		                perPage: 1,
		                item: function(page) {
		                    return '<a href="#' + page + '">' + page + '</a>';
		                }
		            });
		    });
		})(jQuery);

	</script>
	<div class="container">	
		
			<div class="row">
				<div class="col-md-6"> 
					<?php 
						echo $this->Html->image('padpat-fixed.jpg', 	array('class' => 'img-responsive'));
					?> 
				</div>
				<div class="col-md-6"> 
					<div class="row">
						<div class="col-md-9"> </div>
						<div class="col-md-3" style="padding-top: 5%">
						<?php 
							echo $this->Html->link("Back to home", 'https://padpatdev.mobilemediacms.com/APP/FutureTenants/index', array( 'class' => 'btn btn-primary btn-md button-custom-orange padding-left padding-right', 'style'=> 'margin-top: 20%;'));
						?>
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="background-color: #F1F1F1;">
				<div class="col-md-6">
					<div class="row padding-top-5 padding-bottom-5">
							<?php if( $Property[0]['Property']['hasStreams'] ):?>
								<div class="col-md-4 text-orange text-bold margin-top-5">Next Tour</div>
								<div class="col-md-4 text-orange text-bold margin-top-5">March 13, 2015 3:00pm</div>
								<div class="col-md-4">
									<button 
										type="button" class="btn btn-primary btn-md button-custom-orange float-right padding-left padding-right" data-toggle="modal" data-target="#booking">Join
									</button>
								</div>
							<?php else: ?>
								<div class="col-md-2 text-orange text-bold margin-top-5">Next Tour</div>
								<div class="col-md-8 text-orange text-bold margin-top-5">There isn't any future tour scheduled</div>
								<div class="col-md-2"></div>
							<?php endif; ?>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="row">
								<div class="col-md-10">
									<?php
									if(isset($Property[0]['Property']['photos'][0]['id']))
									{
										echo $this->Html->image('properties/'.$Property[0]['Property']['photos'][0]['id'].'.jpg', 	array('class'=>'img-responsive', 'style'=>'width: 100%;'));
									}
									else
									{
										echo $this->Html->image('properties/default.jpg', 	array('class'=>'img-responsive', 'style'=>'width: 100%;'));
									}
									?>
								</div>
								<div class="col-md-2 side-bar">
									<?php
										echo $this->Html->image('book.png', 	array('style'=>'height: 75px;', 'data-toggle'=>'modal', 'data-target'=>'#booking'));
										echo $this->Html->image('rate.png', 	array('style'=>'height: 75px;', 'data-toggle'=>'modal', 'data-target'=>'#rating'));
										echo $this->Html->image('save.png', 	array('style'=>'height: 75px;'));
										echo $this->Html->image('share.png', 	array('style'=>'height: 75px;'));
									?>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row property-under-box">
								<div class="col-md-6 text-bold text-orange">
									<?php
										echo $Property[0]['Property']['propertytype']. " for " .$Property[0]['Property']['dealtype'];
									?>
								</div>
								<div class="col-md-6 text-bold text-orange text-right">$ <?php echo $Property[0]['Property']['price']; ?></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-11">
							<div class="row">
								<div class="col-md-2"> 
									<?php
										switch ($Property[0]['Property']['rating_average']) 
						 				{
						 					
						 					case -1:
												echo $this->Html->image('norating.png', array('class'=>'img-responsive', 'style'=>'margin-top: 10px'));
						 						break;					 					
						 					case 0:
												echo $this->Html->image('rating0.png', 	array('class'=>'img-responsive', 'style'=>'margin-top: 10px'));
						 						break;					 					
						 					case 1:
												echo $this->Html->image('rating1.png', 	array('class'=>'img-responsive', 'style'=>'margin-top: 10px'));
						 						break;					 					
						 					case 2:
												echo $this->Html->image('rating2.png', 	array('class'=>'img-responsive', 'style'=>'margin-top: 10px'));
						 						break;					 					
						 					case 3:
												echo $this->Html->image('rating3.png', 	array('class'=>'img-responsive', 'style'=>'margin-top: 10px'));
						 						break;					 					
						 					case 4:
												echo $this->Html->image('rating4.png', 	array('class'=>'img-responsive', 'style'=>'margin-top: 10px'));
						 						break;
						 					case 5:
												echo $this->Html->image('rating5.png', 	array('class'=>'img-responsive', 'style'=>'margin-top: 10px'));
						 						break;
						 				}
									?>
								</div>
								<div class="col-md-10 text-orange text-bold" style="margin-top: 30px; position: absolute; padding-left: 20%;">
									<?php echo $Property[0]['Property']['address']; ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<br>
									<p>
									 	<?php echo $Property[0]['Property']['description']; ?>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
					<div class="row">
						<div class="col-md-12" id="map" style="height: 250px">

						</div>
					</div>		
				</div>
				<div class="col-md-6">
					<!-- Comienzo del Size -->
					<!--table class="table table-striped">
						<thead>
							<tr><th colspan="2" style="text-align: center">Size</th> </tr>
						</thead>
						<tbody>
							<tr>
								<td>Bedrooms</td>
								<td>2</td>
							</tr>
							<tr>
								<td>Bedrooms</td>
								<td>2</td>
							</tr>
							<tr>
								<td>Bedrooms</td>
								<td>2</td>
							</tr>
							<tr>
								<td>Bedrooms</td>
								<td>2</td>
							</tr>
						</tbody>
					</table-->
					<!-- Fin del Size -->

					<!-- Comienzo de Amenities -->
					<!--table class="table table-striped">
						<thead>
							<tr><th colspan="2" style="text-align: center">Amenities</th> </tr>
						</thead>
						<tbody>
							<tr>
								<td>Bedrooms</td>
								<td>2</td>
							</tr>
							<tr>
								<td>Bedrooms</td>
								<td>2</td>
							</tr>
						</tbody>
					</table-->
					<!-- Fin de Amenities -->

					<!-- Photos Album -->
					<table class="table">
						<thead>
							<tr><th style="text-align: center">Album</th> </tr>
						</thead>
						<tbody>
							<tr>
								<td>
							        <div class="wrapper">
							            <div class="jcarousel-wrapper">
							                <div class="jcarousel">
							                    <ul>
							                    	<?php
							                    		foreach ($Property[0]['Property']['photos'] as $photo) 
							                    		{
							                    			echo '<li data-toggle="modal" data-target="#gallery-'.$photo['id'].'"><img src="/APP/img/properties/'.$photo['id'].'.jpg" 		alt="Image 1" style="margin-top: 7px;"></li>';
							                    		}
							                    	?>
							                    </ul>
							                </div>

							                <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
							                <a href="#" class="jcarousel-control-next">&rsaquo;</a>
							            </div>
							        </div>								
								</td>
							</tr>
						</tbody>
					</table>

					<!-- Realtor Information -->
					<table class="table">
						<thead>
							<tr><th style="text-align: center">The Realtor</th> </tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<div class="row">
										<div class="col-md-3">
											<?php
												echo $this->Html->image('default-user.png', 	array('class'=>'img-responsive img-circle'));
											?>
										</div>
										<div class="col-md-5">
											<p class="text-bold text-orange">
												<?php echo "{$PropertiesOwner[0]['PropertiesOwner']['first_name']} {$PropertiesOwner[0]['PropertiesOwner']['last_name']} ";?>
											</p>
											<p><?php echo "{$PropertiesOwner[0]['PropertiesOwner']['email']}";?></p>
											<p><?php echo "{$PropertiesOwner[0]['PropertiesOwner']['business_phone']} - {$PropertiesOwner[0]['PropertiesOwner']['ext']}";?></p>
											<p><?php echo "{$PropertiesOwner[0]['PropertiesOwner']['type']}";?></p>
										</div>
										<div class="col-md-4 text-center" style="padding-top: 25px">
											<?php 
											echo $this->Html->link("See Full Profile", array('controller' => 'PropertiesOwners','action'=> 'view', $PropertiesOwner[0]['PropertiesOwner']['email']), array( 'class' => 'btn btn-primary btn-md button-custom-orange padding-left padding-right'));
											?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<br>
											<p>This is the contact information of the realtor, who will always be at your disposal to answer your questions and work with you towards give you the best quality of our services. </p>

											<p>If you have any inconvenience, or this information is not reliable, you can let us know our contact information info@padpat.com </p>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>				
				</div>
			</div>

			<?php
				foreach ($Property[0]['Property']['photos'] as $photo) 
				{
					echo '<div id="gallery-'.$photo['id'].'" class="modal fade" role="dialog">
					  <div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					      </div>
					      <div class="modal-body" style="text-align: -webkit-center;">
					        <img src="/APP/img/properties/'.$photo['id'].'.jpg" 		alt="Image '.$photo['id'].'" style="margin-top: 7px;">
					      </div>
					      <div class="modal-footer" style="padding: 25px;">

					      </div>
					    </div>

					  </div>
					</div>';

					//echo '<div class="modal fade" id="gallery-'.$photo['id'].'" role="dialog">  </div>';
				}
			?>

			<!-- Streaming Modal -->
			<div class="modal fade" id="booking" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Booking dates</h4>
				        </div>
				        <div class="modal-body">
							<table class="table table-striped" style="text-align: center">
								<thead>
									<tr>
										<th style="text-align: center">Date</th> 
										<th style="text-align: center">Capacity</th> 
										<th style="text-align: center">Actions</th> 
									</tr>
								</thead>
								<tbody>
									<?php if( $Property[0]['Property']['hasStreams'] ):?>
									<?php foreach ($streamingAvailables as $stream): ?>
										<tr>
											<td> 	<?php echo "{$stream['streamdates']['stream_datetime']}"; ?> </td>
											<td>	<?php echo "{$stream['streamdates']['totalBookings']}/{$stream['streamdates']['capacity']}"; ?>		</td>
											<td>	
												<button type="button" class="btn btn-default" onClick="booking(<?php echo "{$stream['streamdates']['id']}"; ?>)">	Join
												</button>	
											</td>
										</tr>
									<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td>--- </td>
											<td>0/0</td>
											<td><button type="button" class="btn btn-default" disabled>Join</button></td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
				        </div>
				        <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        </div>
					</div>
				</div>
			</div>

			<!-- Rating Modal -->
			<div class="modal fade" id="rating" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Rate this property!</h4>
				        </div>
				        <div class="modal-body">
				        	<div id="rateYo"></div>
				        	
				        </div>
				        <div class="modal-footer">

							<input class="form-control" id="propertyRating" type="hidden" disabled value="5">
							<button type="button" class="btn btn-default" onClick="rating(<?php echo $Property[0]['Property']['id']; ?>)">Rate!</button>
				        </div>
					</div>
				</div>
			</div>

			<!-- Succes Booking Modal -->
			<div class="modal fade" id="bookingModal" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Booking</h4>
				        </div>
				        <div class="modal-body">
				        	<p id="message"></p>
				        </div>
				        <div class="modal-footer" style="padding: 25px">

				        </div>
					</div>
				</div>
			</div>

			<!-- Succes Rating Modal -->
			<div class="modal fade" id="ratingModal" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Rating</h4>
				        </div>
				        <div class="modal-body">
				        	<p id="messageRating"></p>
				        </div>
				        <div class="modal-footer" style="padding: 25px">

				        </div>
					</div>
				</div>
			</div>


			<!-- Please Log In Modal -->
			<div class="modal fade" id="logInModal" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Need to be registered</h4>
				        </div>
				        <div class="modal-body">
				        	<p id="messageRating">You need to <a href="https://padpatdev.mobilemediacms.com/APP/users/login">log in</a> or <a href="https://padpatdev.mobilemediacms.com/APP/Users/register">register</a> in order to access to this functionalities</p>
				        </div>
				        <div class="modal-footer" style="padding: 25px">

				        </div>
					</div>
				</div>
			</div>												
		</div>

    <script>

		function initMap() 
		{
			var myLatLng = {lat: <?php echo $Property[0]['Property']['latitude']; ?>, lng: <?php echo $Property[0]['Property']['longitude']; ?>};

		  	var map = new google.maps.Map(document.getElementById('map'), 
		  	{
		    	zoom: 11,
		    	center: myLatLng,
		    	mapTypeId: google.maps.MapTypeId.TERRAIN
		  	});

			var marker = new google.maps.Marker({
			    position: myLatLng,
			    map: map
			  });
		}

		function booking(streamId)
		{
			var userEmail = "<?php echo $userEmail; ?>";

			if(userEmail!=null && userEmail!="")
			{
				$.ajax({
					dataType: "html", 
					type: "POST",
					evalScripts: true,
					url: "/APP/Bookings/ajax_booking/"+userEmail+"/"+streamId,
					data: ({type:'original'}),
					success: function (data, textStatus)
					{
						//alert("Data: "+data);
						var response = JSON.parse(data);

						if(response.message=="Success")
						{
							document.getElementById("message").innerHTML = "Booking successful";
						}
						else
						{
							document.getElementById("message").innerHTML = response.error[0];
						}
						$('#bookingModal').modal('show');
					}
					
			       });
			}
			else
			{
				$('#booking').modal('hide');
				$('#logInModal').modal('show');
			}

		}


		function rating(propertyId)
		{
			//alert("Property id: "+propertyId);
			
			var userEmail = "<?php echo $userEmail; ?>";
			var propertyRating = document.getElementById("propertyRating").value;

			//alert("Users email: "+userEmail+". Rating: "+propertyRating);

			if(userEmail!=null && userEmail!="")
			{
				$.ajax({
					dataType: "html", 
					type: "POST",
					evalScripts: true,
					url: "/APP/Ratings/ajax_rating/"+userEmail+"/"+propertyId+"/"+propertyRating,
					data: ({type:'original'}),
					success: function (data, textStatus)
					{
						//alert("Data: "+data);
						var response = JSON.parse(data);

						if(response.message=="Success")
						{
							document.getElementById("messageRating").innerHTML = response.message_for_user;
						}
						else
						{
							document.getElementById("messageRating").innerHTML = response.error[0];
						}
						$('#rating').modal('hide');
						$('#ratingModal').modal('show');
						location.reload(true);
					}
					
			       });
			}
			else
			{
				$('#rating').modal('hide');
				$('#logInModal').modal('show');
			}

		}
			
    </script>

	<script type="text/javascript">
		<!-- http://rateyo.fundoocode.ninja/ fullStar -->

		$(function () 
		{
			$("#rateYo").rateYo({
				rating: 2,
			    fullStar: true
			});

			$("#rateYo").rateYo().on("rateyo.change", function (e, data) 
			{
				var rating = data.rating;
				document.getElementById("propertyRating").value = rating;
			});

		});
	</script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeKdml57ehEdvMSNDrm9D0ql_YiIGSR9A&callback=initMap" async defer></script>