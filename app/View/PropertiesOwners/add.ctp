<div class="propertiesOwners form">
<?php echo $this->Form->create('PropertiesOwner'); ?>
	<fieldset>
		<legend><?php echo __('Add Properties Owner'); ?></legend>
	<?php
		$options = array(
			'Owner' 	=> 	'Owner',
			'Realtor'	=>	'Realtor'
		);

		$attributes = array(
			'label' =>	'Type'
			);

		echo $this->Form->input('email');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('profession_category');
		echo $this->Form->input('zip');
		echo $this->Form->input('business_phone');
		echo $this->Form->input('ext');
		echo $this->Form->input('password');
		echo $this->Form->input('password again');

		echo $this->Form->input('type', array('label'=>'Type', 'type'=>'select', 'options'=>$options));
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
