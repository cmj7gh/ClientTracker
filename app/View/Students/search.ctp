<div class="students index">
	<h2><?php echo __('Students'); ?>
	<?php echo $this->Html->link(__('Add A Student'), array('action' => 'add'), array('class' => 'btn btn-large btn-success')); ?>
	</h2>

	<?php echo $this->element('student_search_form') ?>
	
	
	
	<table class="table table-hover" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('school_id'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('cell_phone'); ?></th>
			<th><?php echo $this->Paginator->sort('country'); ?></th>
			<th><?php echo $this->Paginator->sort('birthday'); ?></th>
			<th><?php echo $this->Paginator->sort('graduated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($students as $student): ?>
	<tr>
		<td><?php if(isset($student['Student']['nickname']) && $student['Student']['nickname'] != ''){echo h($student['Student']['fullName']);}else{echo h($student['Student']['name']);}?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($student['School']['name'], array('controller' => 'schools', 'action' => 'view', $student['School']['id'])); ?>
		</td>
		<td><?php echo h($student['Student']['email']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['cell_phone']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['country']); ?>&nbsp;</td>
		<td><?php echo h($student['Student']['birthday']); ?>&nbsp;</td>
		<td><?php if( h($student['Student']['graduated'])){echo("Yes");} ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $student['Student']['id']), array('class' => 'btn btn-small btn-success')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $student['Student']['id']), array('class' => 'btn btn-small btn-info')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $student['Student']['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $student['Student']['id'])); ?>
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
<?php echo $this->element('paging_for_search'); ?>
	</div>
</div>

<?=
//die(var_dump($this->here));
$this->Html->link('Export this page to a CSV',$this->here . "/export:true?" . http_build_query($this->request->query));
?>