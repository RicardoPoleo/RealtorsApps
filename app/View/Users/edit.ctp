<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('oldEmail', array('value' => $this->request->data['User']['email'], "hidden" => "true"));
		echo $this->Form->input('email');
		echo $this->Form->input('type');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>  
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.email')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('User.email')))); ?></li>
		<li><?php echo $this->Html->link(__('Back to index'), array('action' => 'admin')); ?></li>
	</ul>
</div> 
   