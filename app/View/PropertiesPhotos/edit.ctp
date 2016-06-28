<div class="propertiesPhotos form">
<?php echo $this->Form->create('PropertiesPhoto'); ?>
	<fieldset>
		<legend><?php echo __('Edit Properties Photo'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PropertiesPhoto.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('PropertiesPhoto.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Properties Photos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Properties'), array('controller' => 'properties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Properties'), array('controller' => 'properties', 'action' => 'add')); ?> </li>
	</ul>
</div>
