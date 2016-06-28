<?php 
/**
██╗   ██╗██╗███████╗██╗    ██╗    ███████╗██╗   ██╗████████╗██╗   ██╗██████╗ ███████╗    ████████╗
██║   ██║██║██╔════╝██║    ██║    ██╔════╝██║   ██║╚══██╔══╝██║   ██║██╔══██╗██╔════╝    ╚══██╔══╝
██║   ██║██║█████╗  ██║ █╗ ██║    █████╗  ██║   ██║   ██║   ██║   ██║██████╔╝█████╗         ██║   
╚██╗ ██╔╝██║██╔══╝  ██║███╗██║    ██╔══╝  ██║   ██║   ██║   ██║   ██║██╔══██╗██╔══╝         ██║   
 ╚████╔╝ ██║███████╗╚███╔███╔╝    ██║     ╚██████╔╝   ██║   ╚██████╔╝██║  ██║███████╗       ██║   
  ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝     ╚═╝      ╚═════╝    ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝       ╚═╝   
*/
	echo $this->Html->css('bootstrap.min.css');
	echo $this->Html->script('jquery-1.12.0.min.js');
	echo $this->Html->script('bootstrap.min.js');
	//debug($FutureTenant);
?>
<style type="text/css">
	.text-orange
	{
		color: #FF8B1F;
	}

	.text-red
	{
		color: red;
	}

	.text-huge
	{
		font-size: 30px;
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
</style>	
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
						<div class="col-md-3 ">
						<?php 
							echo $this->Html->link("Back to index", 'https://padpatdev.mobilemediacms.com/APP/FutureTenants/index', array( 'class' => 'btn btn-primary btn-md button-custom-orange padding-left padding-right', 'style'=> 'margin-top: 20%;'));
						?>	
						</div>
					</div>
				</div>
			</div>
		<div style="background-color: #F1F1F1;">
			<div class="row">
				<div class="col-md-2">
					<?php 
						echo $this->Html->image('default-user.png', 	array('class' => 'img-responsive', 'style'=>'text-align: center;'));
					?>					
				</div>
				<div class="col-md-10">
					<p class="text-bold text-orange text-huge">  Full Profile </p>
					<p class="text-bold text-orange">
						<?php echo "{$FutureTenant[0]['FutureTenant']['first_name']} {$FutureTenant[0]['FutureTenant']['last_name']} ";?>
					</p>
					<p><?php echo "{$FutureTenant[0]['FutureTenant']['email']}";?></p>
					<p><?php echo "{$FutureTenant[0]['FutureTenant']['about_me']}";?></p>
				</div>
			</div>
			<div class="row" style="text-align: -webkit-center; margin-top: 1%; margin-bottom: 1%;">
				<div class="col-md-2">
					<?php 
						echo $this->Html->link("Edit Profile", array('action'=> 'edit', $FutureTenant[0]['FutureTenant']['email']), array( 'class' => 'btn btn-primary btn-md button-custom-orange padding-left padding-right'));
					?>
				</div>
				<div class="col-md-10"></div>
			</div>
			<div>
				<p class="text-bold text-orange text-huge">  Your pending streams:</p>
			</div>
			<?php foreach ($availableStreams as $Stream): ?>
			<?php //debug($Stream);?>
				<div class="row" style="margin-top: 1%;">
					<div class="col-md-1"></div>
					<div class="col-md-3">
					<?php
						echo $this->Html->image('default.jpg', 	array('class'=>'img-responsive'));
					?>
					</div>
					<div class="col-md-4">
						<p class="text-bold text-red"> <?php echo "Scheduled to {$Stream[0]['Streamdate']['stream_datetime']}";?> </p>
						<p class="text-bold text-orange"> <?php echo "{$Stream[0]['Streamdate']['Property']['address']}";?> </p>
						<p class="text-bold"> <?php echo "{$Stream[0]['Streamdate']['Property']['propertytype']} for {$Stream[0]['Streamdate']['Property']['dealtype']}";?> </p>
						<p class="text-bold"> $<?php echo "{$Stream[0]['Streamdate']['Property']['price']}";?> </p>
						<p><?php echo "This stylish Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.";?></p>
					</div>
					<div class="col-md-4 text-center" style="padding-top: 25px">
						<div class="row">
							<div class="col-md-12">
								<?php 
									echo $this->Html->link("Join Stream", array('controller' => 'Streamdates','action'=> 'view_stream', $Stream[0]['Streamdate']['id'], $FutureTenant[0]['FutureTenant']['email']), array( 'class' => 'btn btn-primary btn-md button-custom-orange padding-left padding-right'));
								?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="margin-top:5%;"> 
								<?php 
									echo $this->Html->link("Check Property", array('controller' => 'Properties','action'=> 'view', $Stream[0]['Streamdate']['Property']['id']), array( 'class' => 'btn btn-primary btn-md button-custom-orange padding-left padding-right'));
								?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>						


		</div>
	</div>

