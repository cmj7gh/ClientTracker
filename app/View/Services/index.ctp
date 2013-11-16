<div class="schools index">
	<h2><?php echo __('Schools'); ?></h2>
	<table class="table table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($schools as $school): ?>
	<tr>
		<td><?php echo h($school['School']['name']); ?>&nbsp;</td>
		<td><?php echo h($school['School']['address']); ?>&nbsp;</td>
		<td><?php echo h($school['School']['city']); ?>&nbsp;</td>
		<td><?php echo h($school['School']['created']); ?>&nbsp;</td>
		<td><?php echo h($school['School']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $school['School']['id']), array('class' => 'btn btn-small btn-success')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $school['School']['id']), array('class' => 'btn btn-small btn-info')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $school['School']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $school['School']['id'])); ?>
		</td>
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
