<div class="users view">
<h2><?php  echo __('User'); ?></h2>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birthday'); ?></dt>
		<dd>
			<?php if(isset($user['User']['birthday'])){echo date('M j, Y', strtotime($user['User']['birthday']));} ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Related Meetings'); ?></h3>
	<?php if (!empty($user['Meeting'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Datetime'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Meeting'] as $meeting): ?>
		<tr>
			<td><?php echo $meeting['title']; ?></td>
			<td><?php echo $meeting['datetime']; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
<div class="related">
	<h3><?php echo __('Related Schools'); ?></h3>
	<?php if (!empty($user['School'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('City'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['School'] as $school): ?>
		<tr>
			<td><?php echo $school['name']; ?></td>
			<td><?php echo $school['address']; ?></td>
			<td><?php echo $school['city']; ?></td>

		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
