<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($user['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['created']); ?>
			&nbsp;
		</dd>		
	</dl>
	<?php if($user['type']=="Future Tenant"): ?>
		<h2><?php echo __('Future Tenant'); ?></h2>
		<dl>
			<dt><?php echo __('First name'); ?></dt>
			<dd>
				<?php echo h($futureTenant['first_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Last name'); ?></dt>
			<dd>
				<?php echo h($futureTenant['last_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('About me'); ?></dt>
			<dd>
				<?php echo h($futureTenant['about_me']); ?>
				&nbsp;
			</dd>					
		</dl>
	<?php else :?>	
		<h2><?php echo __('Property Owner / ' .$user['type']); ?></h2>
		<dl>
			<dt><?php echo __('First name'); ?></dt>
			<dd>
				<?php echo h($propertiesOwner['first_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Last name'); ?></dt>
			<dd>
				<?php echo h($propertiesOwner['last_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Business Phone'); ?></dt>
			<dd>
				<?php echo h($propertiesOwner['business_phone']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Ext'); ?></dt>
			<dd>
				<?php echo h($propertiesOwner['ext']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Zip'); ?></dt>
			<dd>
				<?php echo h($propertiesOwner['zip']); ?>
				&nbsp;
			</dd>											
		</dl>
	<?php endif; ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li> 
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['email'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['email']), array('confirm' => __('Are you sure you want to delete # %s?', $user['email']))); ?> </li>
		<li><?php echo $this->Html->link(__('Back to index'), array('action' => 'admin')); ?> </li>
	</ul>
</div>
