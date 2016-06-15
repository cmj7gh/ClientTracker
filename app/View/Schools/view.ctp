<div class="schools view">
<h2><?php  echo __('School'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($school['School']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($school['School']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($school['School']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($school['School']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($school['School']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($school['School']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('Students At This School'); ?></h3>
	<?php if (!empty($school['Student'])): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Home Phone'); ?></th>
		<th><?php echo __('Cell Phone'); ?></th>
		<th><?php echo __('Country'); ?></th>
		<th><?php echo __('Birthday'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<script>
		var Students = <?php echo json_encode($school['Student']); ?>;
	</script>
	<?php
		$i = 0;
		foreach ($school['Student'] as $student): ?>
		<tr>
			<td><?php echo $student['first_name']; ?></td>
			<td><?php echo $student['last_name']; ?></td>
			<td><?php echo $student['email']; ?></td>
			<td><?php echo ($student['home_phone'] ? $student['home_phone'] : 'None'); ?></td>
			<td><?php echo ($student['cell_phone'] ? $student['cell_phone'] : 'None'); ?></td>
			<td><?php echo $student['country']; ?></td>
			<td><?php echo $student['birthday']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'students', 'action' => 'view', $student['id']), array('class' => 'btn btn-small btn-success')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'students', 'action' => 'edit', $student['id']), array('class' => 'btn btn-small btn-info')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'students', 'action' => 'delete', $student['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $student['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
