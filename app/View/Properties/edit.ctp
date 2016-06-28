<div class="properties form">
<?php echo $this->Form->create('Property'); ?>
	<fieldset>
		<legend><?php echo __('Edit Property'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('users_email');
		echo $this->Form->input('address');
		echo $this->Form->input('state');
		echo $this->Form->input('city');
		echo $this->Form->input('zip');
		echo $this->Form->input('description');
		echo $this->Form->input('dealtype');
		echo $this->Form->input('price');
		echo $this->Form->input('propertytype');
		echo $this->Form->input('amenities');
		echo $this->Form->input('size');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Property.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Property.id')))); ?></li>
		<li><?php echo $this->Html->link(__('Back to index'), array('controller'=>'users', 'action' => 'admin')); ?></li>
	</ul>
</div>
