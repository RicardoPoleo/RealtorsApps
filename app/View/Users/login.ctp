<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<style>
	.contenedor
	{
	    border: 2px solid;
	    border-color: #E9E9E9;
    	width: 40%;
    	padding: 20px 120px 20px 120px;	
	}
	.center
	{
		text-align: -webkit-center;
	}
	.link
	{
		color: #F8D0B7;
	}
	.orange
	{
		background-image: -webkit-gradient(linear, left top, left bottom, from(#EE7D32), to(#EE7D32));		
	}

	.orange_text
	{
		color:#EE7D32;	
	}
	.gray
	{
		color: #9A9B9B;
	}
	.round_border
	{
    	border-radius: 10px;
	}

	.box_border
	{
		border: 1px solid #A1A1A1;
	}
</style>
<div class="center">
	<?php echo $this->Html->image('padpat.png', array('border' => '0', 'width'=>'25%'));?>
	<p class="gray">Need a Pad, Book a Pad, Tag your mom get a Pad</p>
	<br>
	<br>
	<br>
</div>
<div class="">
	<?php echo $this->Form->create('FutureTenant'); ?>
	<fieldset class="center">
	<div class="contenedor">
		
		<p class="gray">Find that perfect home you have been</p>
		<p class="gray">looking for</p>
		<?php
			echo $this->Form->input('email', 		array('allowEmpty' => false, 'class'=>'required', 'label' => false, 'placeholder'=>"Email", 'class'=>'gray round_border box_border'));
			echo $this->Form->input('password', 	array('allowEmpty' => false, 'class'=>'required', 'label' => false, 'placeholder'=>"Password", 'class'=>'gray round_border box_border'));
		/*
		$options = array(
    	'label' => 'Login',
    	'class' => 'orange'
    	);
		echo $this->Form->end($options);
		*/
		?>

	<?php echo $this->Form->end(__('Login'), array('class'=>'orange')); ?> 
	<p class="gray">
		Not on Padpat yet? Signup to join us! 
		<?php echo $this->Html->link(__('Signup'), array('controller'=>'Users', 'action' => 'register'), array('class'=>'orange_text')); ?> 
	</p>
	</div>
	</fieldset>
</div>