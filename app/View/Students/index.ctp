<div class="students index">
	<h2><?php echo __('Students'); ?>
	<?php echo $this->Html->link(__('Add A Student'), array('action' => 'add'), array('class' => 'btn btn-large btn-success')); ?>
	</h2>
	
<form action="/students/search" class="form-horizontal" id="StudentSearchForm" method="get" accept-charset="utf-8"><div style="display:none;">
	</div>
	<div class="control-group" style="float:left;">
	<label for="StudentSearchType" class="control-label">Search Type</label>
	<div class="controls">
		<select name="searchType" class="" style="width: 500px;" id="StudentSearchType">
			<option value="searchName">Name</option>
			<option value="School.name">School</option>
			<option value="email">Email</option>
			<option value="country">Country</option>
		</select>
	</div>
		</div>
		<div class="control-group" style="float:left;">
		<label for="StudentSearchString" class="control-label">Search String</label>
		<div class="controls">
			<input name="searchString" class="" style="width: 500px;" type="text" id="StudentSearchString"/></div></div>		
		<div class="control-group" style="float:left;">
			<div class="controls" style="margin: 0px; margin-left:10px">
				<button type="submit" class="btn btn-success">
				Submit			
			</div>
		</div>
</form>
</br></br>
<?=$this->Html->link('Export this page to a CSV',$this->here . "/export:true")?>	
	
	
	
	
	
	<!--<?php
	echo $this->Form->create("Student", array(
		'url' => '/students/search',
		'action' => 'search',
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group', 'style'=>"display: inline-block;"),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => '')));
	?>

	<?php
		
		echo $this->Form->input('searchType', array('label' => array('class' => 'control-label'), 'options'=>array('name'=>'Name','School.name'=>'School', 'email'=>'Email','country'=>'Country'), 'style'=>'width: 500px;'));
		echo $this->Form->input('searchString', array('label' => array('class' => 'control-label'), 'style'=>'width: 500px;')); ?>
		<div class="control-group" style="display: inline-block;">
			<div class="controls" style="margin: 10px;">
				<button type="submit" class="btn btn-success">
				<?php echo __('Submit'); ?>
			</div>
		</div>
	<?php $this->Form->end(); ?>-->
	</br>
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
		<td><?php if(isset($student['Student']['birthday'])){echo date('M j, Y', strtotime($student['Student']['birthday']));} ?>&nbsp;</td>
		<td><?php if( h($student['Student']['graduated'])){echo("Yes");} ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $student['Student']['id']), array('class' => 'btn btn-small btn-success')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $student['Student']['id']), array('class' => 'btn btn-small btn-info')); ?>
			<?php 
			if($who == 'deleted'){
				echo $this->Form->postLink(__('Undelete')
												, array('action' => 'undelete'
												, $student['Student']['id'])
												, array('class' => 'btn btn-small btn-danger')
													, __('Are you sure you want to undelete student %s? \n Deleted students are not included in any searches, charts, and stats, \n before undeleting a student, make sure that their information is all up to date!', $student['Student']['name'])); 
													
			}else{
				echo $this->Form->postLink(__('Delete')
												, array('action' => 'delete'
												, $student['Student']['id'])
												, array('class' => 'btn btn-small btn-danger')
													, __('Are you sure you want to delete student %s? \n Deleted students will be removed from all searches, charts, and stats, \n but you can always un-delete them later from the \'deleted students\' page.', $student['Student']['name']));
			} ?>
		
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
