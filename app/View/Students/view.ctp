<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
</script>
<div class="students view">
<h2><?php  echo __($student['Student']['name']); ?>
&nbsp;
<?php echo $this->Html->link(__('Edit This Student'), array('action' => 'edit', $student['Student']['id']), array('class' => 'btn btn-large btn-info')); ?>

</h2>
<div id="tabs">
<ul>
	<li><a href="#tabs-1">Demographics</a></li>
	<li><a href="#tabs-2">Contact Info</a></li>
	<li><a href="#tabs-3">High School Data</a></li>
	<li><a href="#tabs-4">Internship Data</a></li>
	<li><a href="#tabs-5">College Data</a></li>
	<li><a href="#tabs-6">Employment Data</a></li>
	<li><a href="#tabs-7">Semesters Active</a></li>
	<li><a href="#tabs-8">Services and Scholarships</a></li>
</ul>

	<div id="tabs-1">
	<dl class="dl-horizontal">
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($student['Student']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($student['Student']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($student['Student']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nickname'); ?></dt>
		<dd>
			<?php echo h($student['Student']['nickname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birthday'); ?></dt>
		<dd>
			<?php if(isset($student['Student']['birthday'])){echo date('M j, Y', strtotime($student['Student']['birthday']));} ?>
			&nbsp;
		</dd>
		<!--2015-12-13: Hiding "Member Since". See note in add.ctp 
		<dt><?php echo __('Member Since'); ?></dt>
		<dd>
			<?php if(isset($student['Student']['semester_member'])){echo h($semesters[$student['Student']['semester_member']]);} ?>
			&nbsp;
		</dd>
		-->
		<dt><?php echo __('Notes'); ?></dt>
		<dd>
			<?php echo h($student['Student']['notes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('# of Children'); ?></dt>
		<dd>
			<?php echo h($student['Student']['number_children']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deceased?'); ?></dt>
		<dd>
			<?php if($student['Student']['deceased']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		<h3>Nationality</h3>
		<dt><?php echo __('Countries'); ?></dt>
		<dd>
			<?php echo h($student['Student']['country'] . "\n" . $student['Student']['country2']); ?>
			&nbsp;
		</dd>
		<!--
		<dt><?php echo __('Immigrant?'); ?></dt>
		<dd>
			<?php if($student['Student']['immigrant']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		-->
		<dt><?php echo __('Arrived In Us'); ?></dt>
		<dd>
			<?php echo h($student['Student']['arrived_in_us']); ?>
			&nbsp;
		</dd>
		<!--
		<dt><?php echo __('Refugee/Asylee?'); ?></dt>
		<dd>
			<?php if($student['Student']['refugee_asylee']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		-->
	</dl>
	</div>
	<div id="tabs-2">
	<dl class="dl-horizontal">
		<h3>Contact Info</h3>
		<dt><?php echo __('In Const. Cont.?'); ?></dt>
		<dd>
			<?php if($student['Student']['constant_contact']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($student['Student']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Facebook Name'); ?></dt>
		<dd>
			<?php echo h($student['Student']['facebook_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instagram Name'); ?></dt>
		<dd>
			<?php echo h($student['Student']['instagram_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Twitter Name'); ?></dt>
		<dd>
			<?php echo h($student['Student']['twitter_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Home Phone'); ?></dt>
		<dd>
			<?php echo h($student['Student']['home_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cell Phone'); ?></dt>
		<dd>
			<?php echo h($student['Student']['cell_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Home Address'); ?></dt>
		<dd>
			<?php echo h($student['Student']['home_address']); ?>
			&nbsp;
		</dd>
	</dl>
	</div>
	<div id="tabs-3">
	<dl class="dl-horizontal">
		<h3>High School Data</h3>
		<dt><?php echo __('School'); ?></dt>
		<dd>
			<?php echo $this->Html->link($student['School']['name'], array('controller' => 'schools', 'action' => 'view', $student['School']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('High School Class'); ?></dt>
		<dd>
			<?php echo h($student['Student']['graduation_year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FARMS?'); ?></dt>
		<dd>
			<?php if($student['Student']['free_and_reduced_lunches']){echo('Yes');}else{echo('No');} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Graduated?'); ?></dt>
		<dd>
			<?php if($student['Student']['graduated']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dropped Out?'); ?></dt>
		<dd>
			<?php if($student['Student']['dropped_out_of_high_school']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('GED?'); ?></dt>
		<dd>
			<?php if($student['Student']['ged']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
	</dl>
	</div>
	<div id="tabs-4">
	<dl class="dl-horizontal">
		<h3>Internship Data</h3>
		<dt><?php echo __('Semester'); ?></dt>
		<dd>
			<?php if(isset($student['Student']['internship_semester_id'])){echo h($semesters[$student['Student']['internship_semester_id']]);} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($student['Student']['internship_location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Completed'); ?></dt>
		<dd>
			<?php if($student['Student']['did_not_finish_internship']){echo("No");}else{echo("Yes");} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('JSW'); ?></dt>
		<dd>
			<?php if($student['Student']['job_skills_completed']){echo("Completed");}else{echo("Not Completed");} ?>
			&nbsp;
		</dd>
	</dl>
	</div>
	<div id="tabs-5">
	<dl class="dl-horizontal">
		<h3>College Data</h3>
		<dt><?php echo __('Went to College?'); ?></dt>
		<dd>
			<?php if($student['Student']['college']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('College Class'); ?></dt>
		<dd>
			<?php echo h($student['Student']['college_graduation_year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Which College?'); ?></dt>
		<dd>
			<?php echo h($student['Student']['which_college']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Major'); ?></dt>
		<dd>
			<?php echo h($student['Student']['major']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('College Grad?'); ?></dt>
		<dd>
			<?php if($student['Student']['graduated_college']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		<h3>Grad School Data</h3>
		<dt><?php echo __('Grad School?'); ?></dt>
		<dd>
			<?php if($student['Student']['grad_school']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Which School?'); ?></dt>
		<dd>
			<?php echo h($student['Student']['which_grad_school']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finished?'); ?></dt>
		<dd>
			<?php if($student['Student']['graduated_grad_school']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
	</dl>
	</div>
	<div id="tabs-6">
	<dl class="dl-horizontal">
		<h3>Employment Data</h3>
		<dt><?php echo __('Employed?'); ?></dt>
		<dd>
			<?php 	IF($student['Student']['employed'] == 'full'){echo("Yes, Full Time");}
					ELSEIF($student['Student']['employed'] == 'part'){echo("Yes, Part Time");}
					ELSEIF($student['Student']['employed'] == 'no'){echo("No, Unemployed");}
					ELSE{echo("Unknown");}?>
			&nbsp;
		</dd>
		<dt><?php echo __('Where Employed'); ?></dt>
		<dd>
			<?php echo h($student['Student']['where_employed']); ?>
			&nbsp;
		</dd>
	</dl>
	</div>

<div id="tabs-7" class="related">
	<h3><?php echo __('Semesters Active'); ?></h3>
	<?php if (!empty($student['StudentSemester'])): ?>
	<?php //var_dump($student['Semester']); ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Semester'); ?></th>
		<th><?php echo __('Program'); ?></th>		
	</tr>
	<?php
		
		$i = 0;
		foreach ($student['StudentSemester'] as $semester):?>
		<tr>
			<td><?php echo $semester['Semester']['name']; ?></td>
			<td><?php echo $semester['Program']['name']; ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php else: echo __('None Yet'); endif; ?>
	<form action="/students/addSemester/<?php echo $student['Student']['id'] ?>" class="form-horizontal" id="StudentSearchForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>
	<div class="control-group" style="float:left;"><label for="StudentSearchType" class="control-label">Add Semester</label>
	<div class="controls">
		<select name="data[Student][semester]" class="" style="width: 500px;" id="StudentSemester">
			<?php foreach($semesters as $semID => $sem):
				
				echo('<option value="' . $semID . '">' . $sem . '</option>');
			endforeach;
			?>
		</select>
		<select name="data[Student][program]" class="" style="width: 500px;" id="StudentProgram">
			<?php foreach($programs as $progID => $prog):
				
				echo('<option value="' . $progID . '">' . $prog . '</option>');
			endforeach;
			?>
		</select>
	</div>
		</div>
		<div class="control-group" style="float:left;">
			<div class="controls" style="margin: 0px; margin-left:10px">
				<button type="submit" class="btn btn-success">
				Add			
			</div>
		</div>
	</form>	
</div>
</br></br>
<div id="tabs-8">
<div class="related">
	<h3><?php echo __('Services Performed'); ?>
	<?php echo $this->Html->link(__('Add A Service'), array('controller' => 'services', 'action' => 'add', $student['Student']['id']), array('class' => 'btn btn-large btn-success')); ?></h3>
	<?php if (!empty($student['Service'])): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Actions'); ?></th>		
	</tr>
	<?php
		$i = 0;
		foreach ($student['Service'] as $service): ?>
		<tr>
			<td><?php echo $service['description']; ?></td>
			<td><?php echo $service['type']; ?></td>
			<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('controller'=>'services','action' => 'edit', $service['id']), array('class' => 'btn btn-small btn-info')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('controller'=>'services','action' => 'delete', $service['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $service['id'])); ?>
		</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php else: echo __('None Yet'); endif; ?>
</div>
<div class="related">
	<h3><?php echo __('Scholarships Received'); ?>
	<?php echo $this->Html->link(__('Add A Scholarship'), array('controller' => 'scholarships', 'action' => 'add', $student['Student']['id']), array('class' => 'btn btn-large btn-success')); ?></h3>
	<?php if (!empty($student['Scholarship'])): ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Scholarship Value'); ?></th>
		<th><?php echo __('Actions'); ?></th>		
	</tr>
	<?php
		$i = 0;
		foreach ($student['Scholarship'] as $scholarship): ?>
		<tr>
			<td><?php echo $scholarship['title']; ?></td>
			<td><?php echo $scholarship['scholarship_value']; ?></td>
			<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('controller'=>'scholarships','action' => 'edit', $scholarship['id']), array('class' => 'btn btn-small btn-info')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('controller'=>'scholarships','action' => 'delete', $scholarship['id']), array('class' => 'btn btn-small btn-danger'), __('Are you sure you want to delete # %s?', $scholarship['id'])); ?>
		</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php else: echo __('None Yet'); endif; ?>
</div>
</div>
</div>
<div class="related">
	<?php if (!empty($student['Meeting'])): ?>
	<h3><?php echo __('Sessions Attended: ' . count($student['Meeting']) . ' Total'); ?></h3>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Semester'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Datetime'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($student['Meeting'] as $meeting): ?>
		<tr>
			<td><?php echo $meeting['semester']; ?></td>
			<td><?php echo $meeting['title']; ?></td>
			<td><?php echo $meeting['datetime']; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<?php echo h("This page last modified on " . $student['Student']['modified'] . " by " . $student['Student']['modified_by']); ?>

