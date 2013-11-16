<div class="logs index">
	<h2><?php echo __('Logs'); ?></h2>
	<table class="table table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('controller'); ?></th>
			<th><?php echo $this->Paginator->sort('function'); ?></th>
			<th><?php echo $this->Paginator->sort('details'); ?></th>
			<th><?php echo $this->Paginator->sort('theid'); ?></th>
			<th><?php echo $this->Paginator->sort('url'); ?></th>
			<th><?php echo $this->Paginator->sort('data'); ?></th>
			<th><?php echo $this->Paginator->sort('ipaddr'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($logs as $log): ?>
	<tr>
		<td><?php echo h($log['Log']['id']); ?>&nbsp;</td>
		<td><?php echo h($log['Log']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($log['Log']['controller']); ?>&nbsp;</td>
		<td><?php echo h($log['Log']['function']); ?>&nbsp;</td>
		<td><?php echo h($log['Log']['details']); ?>&nbsp;</td>
		<td><?php echo h($log['Log']['theid']); ?>&nbsp;</td>
		<td><?php echo h($log['Log']['url']); ?>&nbsp;</td>
		<td><?php echo h($log['Log']['data']); ?>&nbsp;</td>
		<td><?php echo h($log['Log']['ipaddr']); ?>&nbsp;</td>
		<td><?php echo h($log['Log']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $log['Log']['id']), array('class' => 'btn btn-small btn-success')); ?>
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
