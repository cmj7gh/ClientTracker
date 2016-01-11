<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table class="table table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('birthday'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr <?php if ($user['User']['isActive'] == 0){echo('style="background-color: rgb(185, 185, 185);"');}?>>
		<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php if(isset($user['User']['birthday'])){echo date('M j, Y', strtotime($user['User']['birthday']));} ?>&nbsp;</td>
		<?php if ($user['User']['isActive'] == 1){ ?>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id']), array('class' => 'btn btn-small btn-success')); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-small btn-info')); ?>
				<?php echo $this->Form->postLink(__('Deactivate'), array('action' => 'deactivate', $user['User']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to deactivate %s? They won\'t be able to log in while they are deactivated, but you can always re-activate them later.', $user['User']['display_name'])); ?>
			</td>
		<?php }else{ ?>
			<td class="actions">
				<?php echo $this->Form->postLink(__('Reactivate'), array('action' => 'reactivate', $user['User']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to reactivate %s? They will have all of the same rights and access as they had before they were deactiviated.', $user['User']['display_name'])); ?>
			</td>
		<?php } ?>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing records {:start} - {:end} out of {:count}')
	));
	?>	</p>

	<div class="paging">
<?php echo $this->element('paging'); ?>
	</div>

</div>
