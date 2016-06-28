<?php 

	echo $this->Html->css('bootstrap.min.css');
	echo $this->Html->script('jquery-1.12.0.min.js');
	echo $this->Html->script('bootstrap.min.js');
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

	<div class="col-md-2">
		<?php echo $this->Html->image('default-user.png', 	array('class' => 'img-responsive', 'style'=>'text-align: center;'));?>
	</div>
	<div class="col-md-10">
		<?php echo $this->Form->create('FutureTenant'); ?>
			<fieldset>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('email', array('enable'=> false));
				echo $this->Form->input('first_name', array('value'=>$this->request->data['FutureTenant']['first_name']));
				echo $this->Form->input('last_name', array('value'=>$this->request->data['FutureTenant']['last_name']));
				echo $this->Form->input('about_me', array('value'=>$this->request->data['FutureTenant']['about_me']));
				echo $this->Form->input('old_email', array('value'=>$this->request->data['FutureTenant']['email'], 'type' => 'hidden'));
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>		
	</div>
</div>