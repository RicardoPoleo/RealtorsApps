 <div class="users index">
	<h2><?php echo __('Last 10 Users Created'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo h('email'); ?></th>
			<th><?php echo h('password'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['type']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['email'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['email'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['email']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['email']))); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<br>
	<h2><?php echo __('Last 10 Properties Created'); ?></h2>

	<?php echo $this->Form->create("Property", array('url' => array('controller' => 'Users', 'action' => 'admin' ))); ?>

	<table>
		<tr>
			<td style="width: 10%;"> <?php echo $this->Form->end(__('Fitler')); ?> </td>
			<td style="width: 10%;"> 
				<?php echo $this->Form->input('type', array('id'=>'typeSelect', 'label'=>'Filter Type', 'type'=>'select', 'options'=>$filter_types, 'onChange'=>'makeVisibles(this.value)')); ?> 
			</td>
			
			<td style="position: absolute;"> 
				<div id="deal_type" style="padding: initial; display: inline-flex;">
					<?php echo $this->Form->input('dealtype', 	array('label'=> 'Deal Type', 	'type'=>'select', 'options'	=>$deal_types));?> 
				</div>
				<div id="price" style="padding: initial; display: inline-flex;">
					<?php echo $this->Form->input('min', 		array('label'=>	'Min', 			'type'=>'number', 'width'	=>'10%')); ?>
					<?php echo $this->Form->input('max', 		array('label'=>	'Max', 			'type'=>'number', 'width'	=>'10%')); ?>
				</div>
				<div id="date" style="display: inline-flex;     top: 5px; left: 0; position: absolute;">
					<?php echo $this->Form->input('datetimeMin', 		array('id'=>'datetimeMin', 'label'=>	'Min Date', 			'type'=>'date', 'width'	=>'10%')); ?>
					<?php echo $this->Form->input('datetimeMax', 		array('id'=>'datetimeMax', 'label'=>	'Max Date', 			'type'=>'date', 'width'	=>'10%')); ?>
				</div>
				<div id="average" style="display: inline-flex;     top: 5px; left: 0; position: absolute;">
					<?php echo $this->Form->input('average', 	array('label'=> 'Min Rating', 	'type'=>'select', 'options'	=>$average));?> 
				</div>

			</td>

		</tr>
	</table>

	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo h('id'); ?></th>
			<th><?php echo h('Owner Email'); ?></th>
			<!--th><?php echo h('State'); ?></th-->
			<!--th><?php echo h('City'); ?></th-->
			<!--th><?php echo h('Zip'); ?></th-->
			<th><?php echo h('Price'); ?></th>
			<th><?php echo h('Deal Type'); ?></th>
			<th><?php echo h('Type'); ?></th>
			<!--th><?php echo h('amenities'); ?></th-->
			<!--th><?php echo h('Address'); ?></th-->
			<!--th><?php echo h('size'); ?></th-->
			<th><?php echo h('created'); ?></th>
			<!--th><?php echo h('description'); ?></th-->
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($properties as $property): ?>
	<tr>
		<td style="vertical-align: middle;"><?php echo h($property['Property']['id']); ?>&nbsp;</td>
		<td style="vertical-align: middle;"><?php echo h($property['Property']['users_email']); ?>&nbsp;</td>
		<!--td style="vertical-align: middle;"><?php echo h($property['Property']['state']); ?>&nbsp;</td-->
		<!--td style="vertical-align: middle;"><?php echo h($property['Property']['city']); ?>&nbsp;</td-->
		<!--td style="vertical-align: middle;"><?php echo h($property['Property']['zip']); ?>&nbsp;</td-->
		<td style="vertical-align: middle;"><?php echo h($property['Property']['price']); ?>&nbsp;</td>
		<td style="vertical-align: middle;"><?php echo h($property['Property']['dealtype']); ?>&nbsp;</td>
		<td style="vertical-align: middle;"><?php echo h($property['Property']['propertytype']); ?>&nbsp;</td>
		<!--td style="vertical-align: middle;"><?php echo h($property['Property']['amenities']); ?>&nbsp;</td-->
		<!--td style="vertical-align: middle;"><?php echo h($property['Property']['address']); ?>&nbsp;</td-->
		<!--td style="vertical-align: middle;"><?php echo h($property['Property']['size']); ?>&nbsp;</td-->
		<td><?php echo h($property['Property']['created']); ?>&nbsp;</td>
		<!--td><?php echo h($property['Property']['description']); ?>&nbsp;</td-->
		<td style="vertical-align: middle;"class="actions">
			<?php echo $this->Html->link(__('View'), array('controller'=>'Properties', 'action' => 'view', $property['Property']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('controller'=>'Properties', 'action' => 'edit', $property['Property']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('controller'=>'Properties', 'action' => 'delete', $property['Property']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $property['Property']['id']))); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>

</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Property'), array('controller'=>'Properties', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('New Future Tenant'), array('controller'=>'FutureTenants', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('New Owner/Realtor'), array('controller'=>'PropertiesOwners', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Log out'), array('action' => 'logout')); ?></li>
	</ul>
</div>

<script type="text/javascript">
	function makeVisibles (argument) 
	{
		allInvisible();
		
		if(argument=="date")
		{
			document.getElementById("date").style.visibility = "visible";
		}
		else if(argument=="price")
		{
			document.getElementById("price").style.visibility = "visible"; 
		}
		else if(argument=="deal_type")
		{
			document.getElementById("deal_type").style.visibility = "visible"; 
		}
		else if(argument=="average")
		{
			document.getElementById("average").style.visibility = "visible"; 
		}
		else if(argument=="property_type")
		{
			document.getElementById("property_type").style.visibility = "visible";
		}
	}

	function allInvisible () 
	{
		document.getElementById("date").style.visibility 		= "hidden"; 
		document.getElementById("price").style.visibility 		= "hidden"; 
		document.getElementById("average").style.visibility 	= "hidden"; 
		document.getElementById("deal_type").style.visibility 	= "hidden"; 
	}

	function setDefault()
	{
		document.getElementById("typeSelect").value = 'all';
	}

	document.onload = allInvisible();	
	document.onload = setDefault();	
</script>
