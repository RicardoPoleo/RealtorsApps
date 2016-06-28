<div class="propertiesOwners form">
<?php echo $this->Form->create('PropertiesOwner'); ?>
	<fieldset>
		<legend><?php echo __('Edit Properties Owner'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('email');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('profession_category');
		echo $this->Form->input('zip');
		echo $this->Form->input('bussiness_phone');
		echo $this->Form->input('ext');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PropertiesOwner.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('PropertiesOwner.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Properties Owners'), array('action' => 'index')); ?></li>
	</ul>
</div>
