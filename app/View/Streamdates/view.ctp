<div class="streamdates view">
<h2><?php echo __('Streamdate'); ?></h2>
	<dl>
		<dt><?php echo __('Properties'); ?></dt>
		<dd>
			<?php echo $this->Html->link($streamdate['Properties']['id'], array('controller' => 'properties', 'action' => 'view', $streamdate['Properties']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Stream Datetime'); ?></dt>
		<dd>
			<?php echo h($streamdate['Streamdate']['stream_datetime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Capacity'); ?></dt>
		<dd>
			<?php echo h($streamdate['Streamdate']['capacity']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Streamdate'), array('action' => 'edit', $streamdate['Streamdate']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Streamdate'), array('action' => 'delete', $streamdate['Streamdate']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $streamdate['Streamdate']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Streamdates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Streamdate'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Properties'), array('controller' => 'properties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Properties'), array('controller' => 'properties', 'action' => 'add')); ?> </li>
	</ul>
</div>
