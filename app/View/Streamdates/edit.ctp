<div class="streamdates form">
<?php echo $this->Form->create('Streamdate'); ?>
	<fieldset>
		<legend><?php echo __('Edit Streamdate'); ?></legend>
	<?php
		echo $this->Form->input('properties_id');
		echo $this->Form->input('stream_datetime');
		echo $this->Form->input('capacity');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Streamdate.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Streamdate.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Streamdates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Properties'), array('controller' => 'properties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Properties'), array('controller' => 'properties', 'action' => 'add')); ?> </li>
	</ul>
</div>
