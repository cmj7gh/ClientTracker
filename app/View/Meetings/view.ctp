<div class="meetings view">
<h2><?php  echo __('Session'); ?>
&nbsp;
<?php echo $this->Html->link(__('Edit This Session'), array('action' => 'edit', $meeting['Meeting']['id']), array('class' => 'btn btn-large btn-info')); ?>

</h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('School'); ?></dt>
		<dd>
			<?php echo h($schools[$meeting['Meeting']['school_id']]); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($meeting['Meeting']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hosted By'); ?></dt>
		<dd>
			<?php foreach($meeting['User'] as $host):
					echo h($host['first_name'] . ' ' . $host['last_name']);
					endforeach;
			?>
		<dt><?php echo __('Datetime'); ?></dt>
		<dd>
			<?php if(isset($meeting['Meeting']['datetime'])){echo date('M j, Y', strtotime($meeting['Meeting']['datetime']));} ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('Students In Attendance'); ?></h3>
	<?php if (!empty($meeting['Student'])): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Country'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($meeting['Student'] as $student): ?>
		<tr>
			<td><?php echo $this->Html->link(__($student['name']), array('controller' => 'students', 'action' => 'view', $student['id'])); ?>
			</td>
			<td><?php echo $student['email']; ?></td>
			<td><?php echo $student['phone']; ?></td>
			<td><?php echo $student['country']; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
