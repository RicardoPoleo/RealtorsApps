<div class="futureTenants form">
<?php echo $this->Form->create('FutureTenant'); ?>
	<fieldset>
		<legend><?php echo __('Add Future Tenant'); ?></legend>
	<?php
		echo $this->Form->input('email', 		array('label'=>'Email'));
		echo $this->Form->input('firstname', 	array('label'=>'First Name'));
		echo $this->Form->input('lastname', 	array('label'=>'Last Name'));
		echo $this->Form->input('password', 	array('label'=>'Password', 'allowEmpty' => false, 'class'=>'required'));
		echo $this->Form->input('password_again', 	array('label'=>'Password Again'));
		echo $this->Form->input('aboutme', 	array('label'=>'About Me'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Back to index'), array('controller'=>'users', 'action' => 'admin')); ?></li>
	</ul>
</div>
