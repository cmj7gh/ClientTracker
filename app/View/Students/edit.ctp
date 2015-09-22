<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
</script>
<div class="students form">
<?php echo $this->Form->create('Student', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><h2><?php echo __('Edit Student'); ?></h2></legend>
		
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
	<?php
		echo $this->Form->input('id', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('first_name', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('last_name', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('gender', array('label' => array('class' => 'control-label'), 'options' => array('Male'=>'Male', 'Female'=>'Female'), 'empty' => 'Select One'));
		echo $this->Form->input('nickname', array('label' => array('class' => 'control-label')));		
		echo $this->Form->input('birthday', array('label' => array('class' => 'control-label'), 'type' => 'date', 'dateFormat' => 'DMY', 'minYear' => '1980', 'maxYear' => date('Y')-10, 'empty'=>' '));
		echo $this->Form->input('notes', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('number_children', array('label' => array('class' => 'control-label')));

	?>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][deceased]" id="StudentDeceased_" value="0">
				<input type="checkbox" name="data[Student][deceased]" value="1" <?php if($this->request->data['Student']['deceased']){echo('checked');}?> id="StudentDeceased"> Deceased
			  </label>
			</div>
		</div>
		
	<h3>Nationality</h3>
	<?php
		echo $this->Form->input('country', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('country2', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('arrived_in_us', array('label' => array('class' => 'control-label')));
	?>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][immigrant]" id="StudentImmigrant_" value="0">
				<input type="checkbox" name="data[Student][immigrant]" value="1" <?php if($this->request->data['Student']['immigrant']){echo('checked');}?> id="StudentImmigrant"> Immigrant
			  </label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][refugee_asylee]" id="StudentRefugeeAsylee_" value="0">
				<input type="checkbox" name="data[Student][refugee_asylee]" value="1" <?php if($this->request->data['Student']['refugee_asylee']){echo('checked');}?> id="StudentRefugeeAsylee"> Refugee/Asylee
			  </label>
			</div>
		</div>
	
		
</div>
<div id="tabs-2">	
	<h3>Contact Info</h3>
	<div class="control-group">
		<div class="controls">
		  <label class="checkbox">
			<input type="hidden" name="data[Student][constant_contact]" id="StudentConstantContact_" value="0">
			<input type="checkbox" name="data[Student][constant_contact]" value="1" <?php if($this->request->data['Student']['constant_contact']){echo('checked');}?> id="StudentConstantContact"> Constant Contact?
		  </label>
		</div>
	</div>
	
	<?php
		echo $this->Form->input('email', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('facebook_name', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('instagram_name', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('twitter_name', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('home_phone', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('cell_phone', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('home_address', array('label' => array('class' => 'control-label')));
	?>	
</div>
<div id="tabs-3">
	<h3>High School Data</h3>
	<?php
		echo $this->Form->input('school_id', array('label' => array('class' => 'control-label'),  'empty' => 'Select School'));
		echo $this->Form->input('semester_started', array('label' => array('class' => 'control-label'), 'options' => $semesters, 'empty' => 'Select Semester'));
		echo $this->Form->input('semester_member', array('label' => array('class' => 'control-label'), 'options' => $semesters, 'empty' => 'Select Semester'));

		//this generates the key-value array to use as the options for the dropdowns in "Graduation Year", "Internship Year", and "College Graduation Year"
		$keys = range(2005, date('Y')+5);
		$year_range = array_combine($keys, $keys);
		
		echo $this->Form->input('graduation_year', array('label' => array('class' => 'control-label'), 'options' => $year_range,  'empty' => 'Select Year'));
		echo $this->Form->input('free_and_reduced_lunches', array('label' => array('class' => 'control-label'), 'options' => array(0=>'No', 1=>'Yes'), 'empty' => 'Select One'));
	?>

		<!--//echo $this->Form->input('graduated', array('label' => array('class' => 'control-label')));-->
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][graduated]" id="StudentGraduated_" value="0">
				<input type="checkbox" name="data[Student][graduated]" value="1" <?php if($this->request->data['Student']['graduated']){echo('checked');}?> id="StudentGraduated"> Graduated
			  </label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][dropped_out_of_high_school]" id="StudentDroppedOutOfHighSchool_" value="0">
				<input type="checkbox" name="data[Student][dropped_out_of_high_school]" value="1" <?php if($this->request->data['Student']['dropped_out_of_high_school']){echo('checked');}?> id="StudentDroppedOutOfHighSchool"> Dropped Out
			  </label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][ged]" id="StudentGed_" value="0">
				<input type="checkbox" name="data[Student][ged]" value="1" <?php if($this->request->data['Student']['ged']){echo('checked');}?> id="StudentGed"> GED
			  </label>
			</div>
		</div>
</div>
<div id="tabs-4">		
	<h3>Internship Data</h3>
	<?php
		echo $this->Form->input('internship_semester_id', array('label' => array('class' => 'control-label'), 'options' => $semesters,  'empty' => 'Select Semester'));
		echo $this->Form->input('internship_location', array('label' => array('class' => 'control-label')));
	?>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][did_not_finish_internship]" id="StudentDidNotFinishInternship_" value="0">
				<input type="checkbox" name="data[Student][did_not_finish_internship]" value="1" <?php if($this->request->data['Student']['did_not_finish_internship']){echo('checked');}?> id="StudentDidNotFinishInternship"> Did Not Finish
			  </label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][job_skills_completed]" id="StudentJobSkillsCompleted_" value="0">
				<input type="checkbox" name="data[Student][job_skills_completed]" value="1" <?php if($this->request->data['Student']['job_skills_completed']){echo('checked');}?> id="StudentJobSkillsCompleted"> Job Skills Completed
			  </label>
			</div>
		</div>
</div>
<div id="tabs-5">		
	<h3>College Data</h3>
	
		<!--//echo $this->Form->input('college', array('label' => array('class' => 'control-label')));-->
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][college]" id="StudentCollege_" value="0">
				<input type="checkbox" name="data[Student][college]" value="1" <?php if($this->request->data['Student']['college']){echo('checked');}?> id="StudentCollege"> Went to College
			  </label>
			</div>
		</div>
	<?php
		echo $this->Form->input('college_graduation_year', array('label' => array('class' => 'control-label'), 'options' => $year_range, 'empty' => 'Select Year'));
		echo $this->Form->input('which_college', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('major', array('label' => array('class' => 'control-label')));
	?>
		<!--//echo $this->Form->input('graduated_college', array('label' => array('class' => 'control-label')));-->
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][graduated_college]" id="StudentGraduatedCollege_" value="0">
				<input type="checkbox" name="data[Student][graduated_college]" value="1" <?php if($this->request->data['Student']['graduated_college']){echo('checked');}?> id="StudentGraduatedCollege"> Graduated College
			  </label>
			</div>
		</div>
	<h3>Grad School Data</h3>
	
		<!--//echo $this->Form->input('college', array('label' => array('class' => 'control-label')));-->
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][grad_school]" id="StudentGradSchool_" value="0">
				<input type="checkbox" name="data[Student][grad_school]" value="1" <?php if($this->request->data['Student']['grad_school']){echo('checked');}?> id="StudentGradSchool"> Went to Grad School
			  </label>
			</div>
		</div>
	<?php
		echo $this->Form->input('which_grad_school', array('label' => array('class' => 'control-label')));
	?>
		<!--//echo $this->Form->input('graduated_grad_school', array('label' => array('class' => 'control-label')));-->
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][graduated_grad_school]" id="StudentGraduatedGradSchool_" value="0">
				<input type="checkbox" name="data[Student][graduated_grad_school]" value="1" <?php if($this->request->data['Student']['graduated_grad_school']){echo('checked');}?> id="StudentGraduatedGradSchool"> Graduated Grad School
			  </label>
			</div>
		</div>
</div>
<div id="tabs-6">		
	<h3>Employment Data</h3>
	<?php
		echo $this->Form->input('employed', array('label' => array('class' => 'control-label'), 'options' => array('full'=>'Full Time', 'part'=>'Part Time', 'no'=>'Unemployed'), 'empty' => 'Select Status'));	
		echo $this->Form->input('where_employed', array('label' => array('class' => 'control-label')));
	?>
</div>
<div id="tabs-7">
	<h3>To edit the list of semesters active, return to the "View Student" page</h3>
</div>
<div id="tabs-8">
	<h3>To edit service and scholarship information, return to the "View Student" page</h3>
</div>	
</div>
</br>	
	<div class="control-group">
		<div class="controls">
		<button type="submit" class="btn btn-large btn-success">
		<?php echo __('Save Changes'); ?>
		</div>
	</div>	

<?php $this->Form->end(); ?>
</div>
