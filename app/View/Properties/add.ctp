<div class="properties form">
<?php echo $this->Form->create('Property'); ?>
	<fieldset>
		<legend><?php echo __('Add Property'); ?></legend>
	<?php
		echo $this->Form->input('users_email', array('label'=>'Owner', 'type'=>'select', 'options'=>$owners_list));
		echo $this->Form->input('address');
		echo $this->Form->input('state');
		echo $this->Form->input('city');
		echo $this->Form->input('zip');
		echo $this->Form->input('description');
		echo $this->Form->input('dealtype', array('label'=>'Deal Type', 'type'=>'select', 'options'=>$deal_type));
		echo $this->Form->input('price');
		echo $this->Form->input('propertytype', array('label'=>'Type', 'type'=>'select', 'options'=>$property_type));
		echo $this->Form->input('amenities');
		echo $this->Form->input('size');
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
