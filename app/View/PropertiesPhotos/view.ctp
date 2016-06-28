<div class="propertiesPhotos view">
<h2><?php echo __('Properties Photo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($propertiesPhoto['PropertiesPhoto']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Properties'); ?></dt>
		<dd>
			<?php echo $this->Html->link($propertiesPhoto['Properties']['id'], array('controller' => 'properties', 'action' => 'view', $propertiesPhoto['Properties']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($propertiesPhoto['PropertiesPhoto']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creationdate'); ?></dt>
		<dd>
			<?php echo h($propertiesPhoto['PropertiesPhoto']['creationdate']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Properties Photo'), array('action' => 'edit', $propertiesPhoto['PropertiesPhoto']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Properties Photo'), array('action' => 'delete', $propertiesPhoto['PropertiesPhoto']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $propertiesPhoto['PropertiesPhoto']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Properties Photos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Properties Photo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Properties'), array('controller' => 'properties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Properties'), array('controller' => 'properties', 'action' => 'add')); ?> </li>
	</ul>
</div>
