<div class="programs index">
	<h2><?php echo __('Programs'); ?></h2>
	<table class="table table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($programs as $program): ?>
	<tr>
		<td><?php echo h($program['Program']['name']); ?>&nbsp;</td>
<!--
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $program['Program']['id']), array('class' => 'btn btn-small btn-success')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $program['Program']['id']), array('class' => 'btn btn-small btn-info')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $program['Program']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $program['Program']['id'])); ?>
		</td>
-->
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
