<?php 
	/**
██╗   ██╗██╗███████╗██╗    ██╗    ██████╗ ██████╗  ██████╗ ██████╗ ███████╗██████╗ ████████╗██╗   ██╗     ██████╗ ██╗    ██╗███╗   ██╗███████╗██████╗ 
██║   ██║██║██╔════╝██║    ██║    ██╔══██╗██╔══██╗██╔═══██╗██╔══██╗██╔════╝██╔══██╗╚══██╔══╝╚██╗ ██╔╝    ██╔═══██╗██║    ██║████╗  ██║██╔════╝██╔══██╗
██║   ██║██║█████╗  ██║ █╗ ██║    ██████╔╝██████╔╝██║   ██║██████╔╝█████╗  ██████╔╝   ██║    ╚████╔╝     ██║   ██║██║ █╗ ██║██╔██╗ ██║█████╗  ██████╔╝
╚██╗ ██╔╝██║██╔══╝  ██║███╗██║    ██╔═══╝ ██╔══██╗██║   ██║██╔═══╝ ██╔══╝  ██╔══██╗   ██║     ╚██╔╝      ██║   ██║██║███╗██║██║╚██╗██║██╔══╝  ██╔══██╗
 ╚████╔╝ ██║███████╗╚███╔███╔╝    ██║     ██║  ██║╚██████╔╝██║     ███████╗██║  ██║   ██║      ██║       ╚██████╔╝╚███╔███╔╝██║ ╚████║███████╗██║  ██║
  ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝     ╚═╝     ╚═╝  ╚═╝ ╚═════╝ ╚═╝     ╚══════╝╚═╝  ╚═╝   ╚═╝      ╚═╝        ╚═════╝  ╚══╝╚══╝ ╚═╝  ╚═══╝╚══════╝╚═╝  ╚═╝
	*/
	echo $this->Html->css('bootstrap.min.css');
	echo $this->Html->script('jquery-1.12.0.min.js');
	echo $this->Html->script('bootstrap.min.js');

	//debug($Properties);
?>
<style type="text/css">
	.text-orange
	{
		color: #FF8B1F;
	}

	.text-huge
	{
		font-size: 30px;
	}


	.text-red
	{
		color: red;
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
							echo $this->Html->link("Back to home", 'https://padpatdev.mobilemediacms.com/APP/FutureTenants/index', array( 'class' => 'btn btn-primary btn-md button-custom-orange padding-left padding-right', 'style'=> 'margin-top: 20%;'));
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
						<?php echo "{$PropertiesOwner[0]['PropertiesOwner']['first_name']} {$PropertiesOwner[0]['PropertiesOwner']['last_name']} ";?>
					</p>
					<p><?php echo "{$PropertiesOwner[0]['PropertiesOwner']['email']}";?></p>
					<p><?php echo "{$PropertiesOwner[0]['PropertiesOwner']['business_phone']} - {$PropertiesOwner[0]['PropertiesOwner']['ext']}";?></p>
					<p><?php echo "{$PropertiesOwner[0]['PropertiesOwner']['type']}";?></p>
				</div>
			</div>
			<div>
				<p class="text-bold text-orange text-huge">  This <?php echo "{$PropertiesOwner[0]['PropertiesOwner']['type']}";?>'s Properties </p>
			</div>

			<?php foreach ($Properties as $Property): ?>
				<div class="row" style="margin-top: 1%;">
					<div class="col-md-1"></div>
					<div class="col-md-3">
					<?php
						echo $this->Html->image('properties/'.$Property['Property']['id'].'.jpg', 	array('class'=>'img-responsive'));
					?>
					</div>
					<div class="col-md-4">
						<p class="text-bold text-orange"> <?php echo "{$Property['Property']['address']}";?> </p>
						<p class="text-bold"> <?php echo "{$Property['Property']['propertytype']} for {$Property['Property']['dealtype']}";?> </p>
						<p class="text-bold"> $<?php echo "500";?> </p>
						<p><?php echo "This stylish Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.";?></p>
					</div>
					<div class="col-md-4 text-center" style="padding-top: 25px">
						<?php 
							echo $this->Html->link("Check it out!", array('controller' => 'Properties','action'=> 'view', $Property['Property']['id']), array( 'class' => 'btn btn-primary btn-md button-custom-orange padding-left padding-right'));
						?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
