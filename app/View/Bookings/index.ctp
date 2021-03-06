<div class="bookings index">
	<h2><?php echo __('Bookings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('streamdates_id'); ?></th>
			<th><?php echo $this->Paginator->sort('users'); ?></th>
			<th><?php echo $this->Paginator->sort('creationdate'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($bookings as $booking): ?>
	<tr>
		<td><?php echo h($booking['Booking']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($booking['Streamdates']['id'], array('controller' => 'streamdates', 'action' => 'view', $booking['Streamdates']['id'])); ?>
		</td>
		<td><?php echo h($booking['Booking']['users']); ?>&nbsp;</td>
		<td><?php echo h($booking['Booking']['creationdate']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $booking['Booking']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $booking['Booking']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $booking['Booking']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $booking['Booking']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Booking'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Streamdates'), array('controller' => 'streamdates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Streamdates'), array('controller' => 'streamdates', 'action' => 'add')); ?> </li>
	</ul>
</div>
