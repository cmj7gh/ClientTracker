
<div class="students view">
<h2><?php  echo __($student['Student']['name']); ?>
&nbsp;
<?php echo $this->Html->link(__('Edit This Student'), array('action' => 'edit', $student['Student']['id']), array('class' => 'btn btn-large btn-info')); ?>
	
</h2>
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
		<dt><?php echo __('Member Since'); ?></dt>
		<dd>
			<?php if(isset($student['Student']['semester_member'])){echo h($semesters[$student['Student']['semester_member']]);} ?>
			&nbsp;
		</dd>
		<!--<dt><?php echo __('Semesters Active'); ?></dt>
		<dd>
			<?php echo h($student['Student']['semesters_active']); ?>
			&nbsp;
		</dd>-->
		<dt><?php echo __('Notes'); ?></dt>
		<dd>
			<?php echo h($student['Student']['notes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number of Children'); ?></dt>
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
		<dt><?php echo __('Immigrant?'); ?></dt>
		<dd>
			<?php if($student['Student']['immigrant']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Arrived In Us'); ?></dt>
		<dd>
			<?php echo h($student['Student']['arrived_in_us']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Refugee/Asylee?'); ?></dt>
		<dd>
			<?php if($student['Student']['refugee_asylee']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		<h3>Contact Info</h3>
		<dt><?php echo __('In Constant Contact?'); ?></dt>
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
		<h3>Internship Data</h3>
		<dt><?php echo __('Internship Semester'); ?></dt>
		<dd>
			<?php if(isset($student['Student']['internship_semester_id'])){echo h($semesters[$student['Student']['internship_semester_id']]);} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Internship Location'); ?></dt>
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
		<dt><?php echo __('Which College'); ?></dt>
		<dd>
			<?php echo h($student['Student']['which_college']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Major'); ?></dt>
		<dd>
			<?php echo h($student['Student']['major']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Graduated College?'); ?></dt>
		<dd>
			<?php if($student['Student']['graduated_college']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		<h3>Grad School Data</h3>
		<dt><?php echo __('Went to Grad School?'); ?></dt>
		<dd>
			<?php if($student['Student']['grad_school']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Which Grad School'); ?></dt>
		<dd>
			<?php echo h($student['Student']['which_grad_school']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finished Grad School?'); ?></dt>
		<dd>
			<?php if($student['Student']['graduated_grad_school']){echo("Yes");}else{echo("No");} ?>
			&nbsp;
		</dd>
		<h3>Employment Data</h3>
		<dt><?php echo __('Employed?'); ?></dt>
		<dd>
			<?php echo h($student['Student']['employed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Where Employed'); ?></dt>
		<dd>
			<?php echo h($student['Student']['where_employed']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Semesters Active'); ?></h3>
	<?php if (!empty($student['Semester'])): ?>
	<?php //var_dump($student['Semester']); ?>
	<table class="table table-hover" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Semester'); ?></th>
		<th><?php echo __('Year'); ?></th>		
	</tr>
	<?php
		$i = 0;
		foreach ($student['Semester'] as $semester): ?>
		<tr>
			<td><?php echo $semester['semester']; ?></td>
			<td><?php echo $semester['year']; ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php else: echo __('None Yet'); endif; ?>
	<form action="/students/addSemester/<?php echo $student['Student']['id'] ?>" class="form-horizontal" id="StudentSearchForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>
	<div class="control-group" style="float:left;"><label for="StudentSearchType" class="control-label">Add Semester</label>
	<div class="controls">
		<select name="data[Student][semester]" class="" style="width: 500px;" id="StudentSemester">
			<option value="29">Fall 2013</option>
			<option value="1">Spring 2013</option>
			<option value="2">Summer 2013</option>
			<option value="4">Winter 2013</option>
			<option value="26">Summer 2013</option>
			<option value="24">Spring 2012</option>
			<option value="25">Summer 2012</option>
			<option value="27">Fall 2012</option>
			<option value="21">Spring 2011</option>
			<option value="22">Fall 2011</option>
			<option value="23">Summer 2011</option>
			<option value="18">Summer 2010</option>
			<option value="19">Fall 2010</option>
			<option value="20">Spring 2010</option>
			<option value="15">Spring 2009</option>
			<option value="16">Fall 2009</option>
			<option value="17">Summer 2009</option>
			<option value="12">Fall 2008</option>
			<option value="13">Spring 2008</option>
			<option value="14">Summer 2008</option>
			<option value="9">Summer 2007</option>
			<option value="10">Fall 2007</option>
			<option value="11">Spring 2007</option>
			<option value="7">Summer 2006</option>
			<option value="8">Fall 2006</option>
			<option value="28">Spring 2006</option>
			<option value="5">Fall 2005</option>
			<option value="6">Summer 2005</option>
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

<h3>Last Modified</h3>
<?php echo h($student['Student']['modified'] . " by " . $student['Student']['modified_by']); ?>

