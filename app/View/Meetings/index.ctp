<div class="meetings index">
	<h2><?php echo __('Sessions'); ?></h2>
	<table class="table table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('school_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title', 'Session Number'); ?></th>
			<th><?php echo $this->Paginator->sort('datetime'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($meetings as $meeting): ?>
	<tr>
		<td><?php echo h($schools[$meeting['Meeting']['school_id']]); ?>&nbsp;</td>
		<td><?php echo h($meeting['Meeting']['title']); ?>&nbsp;</td>
		<td><?php if(isset($meeting['Meeting']['datetime'])){echo date('M j, Y', strtotime($meeting['Meeting']['datetime']));} ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $meeting['Meeting']['id']), array('class' => 'btn btn-small btn-success')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $meeting['Meeting']['id']), array('class' => 'btn btn-small btn-info')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $meeting['Meeting']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $meeting['Meeting']['id'])); ?>
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

