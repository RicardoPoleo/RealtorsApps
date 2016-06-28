<div class="streamdates index">
	<h2><?php echo __('Streamdates'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('properties_id'); ?></th>
			<th><?php echo $this->Paginator->sort('stream_datetime'); ?></th>
			<th><?php echo $this->Paginator->sort('capacity'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($streamdates as $streamdate): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($streamdate['Properties']['id'], array('controller' => 'properties', 'action' => 'view', $streamdate['Properties']['id'])); ?>
		</td>
		<td><?php echo h($streamdate['Streamdate']['stream_datetime']); ?>&nbsp;</td>
		<td><?php echo h($streamdate['Streamdate']['capacity']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $streamdate['Streamdate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $streamdate['Streamdate']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $streamdate['Streamdate']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $streamdate['Streamdate']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Streamdate'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Properties'), array('controller' => 'properties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Properties'), array('controller' => 'properties', 'action' => 'add')); ?> </li>
	</ul>
</div>
