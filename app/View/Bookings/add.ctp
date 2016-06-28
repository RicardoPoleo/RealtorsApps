<div class="bookings form">
<?php echo $this->Form->create('Booking'); ?>
	<fieldset>
		<legend><?php echo __('Add Booking'); ?></legend>
	<?php
		echo $this->Form->input('streamdates_id');
		echo $this->Form->input('users');
		echo $this->Form->input('creationdate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Bookings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Streamdates'), array('controller' => 'streamdates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Streamdates'), array('controller' => 'streamdates', 'action' => 'add')); ?> </li>
	</ul>
</div>
