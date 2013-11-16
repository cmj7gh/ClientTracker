<div class="authentications index">
	<h2><?php echo __('Authentications'); ?></h2>
	<table class="table table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('ipaddr'); ?></th>
			<th><?php echo $this->Paginator->sort('value'); ?></th>
			<th><?php echo $this->Paginator->sort('valid'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($authentications as $authentication): ?>
	<tr>
		<td><?php echo h($authentication['Authentication']['id']); ?>&nbsp;</td>
		<td><?php echo h($authentication['Authentication']['user_id']); ?>&nbsp;</td>
		<td><?php echo h($authentication['Authentication']['ipaddr']); ?>&nbsp;</td>
		<td><?php echo h($authentication['Authentication']['value']); ?>&nbsp;</td>
		<td><?php echo h($authentication['Authentication']['valid']); ?>&nbsp;</td>
		<td><?php echo h($authentication['Authentication']['created']); ?>&nbsp;</td>
		<td><?php echo h($authentication['Authentication']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $authentication['Authentication']['id']), array('class' => 'btn btn-small btn-success')); ?>
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
</div>
