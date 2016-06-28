<div class="propertiesPhotos form">
<?php echo $this->Form->create('PropertiesPhoto'); ?>
	<fieldset>
		<legend><?php echo __('Add Properties Photo'); ?></legend>
	<?php
		echo $this->Form->input('properties_id');
		echo $this->Form->input('type');
		echo $this->Form->input('creationdate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Properties Photos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Properties'), array('controller' => 'properties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Properties'), array('controller' => 'properties', 'action' => 'add')); ?> </li>
	</ul>
</div>
