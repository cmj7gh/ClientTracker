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
		<legend><h2><?php echo __('Add Student'); ?></h2></legend>
	<?php
		echo $this->Form->input('id', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('school_id', array('label' => array('class' => 'control-label'), 'empty' => 'Select A High School'));
		echo $this->Form->input('first_name', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('last_name', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('nickname', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('gender', array('label' => array('class' => 'control-label'), 'options' => array('Male'=>'Male', 'Female'=>'Female'), 'empty' => 'Select One'));
	?>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][constant_contact]" id="StudentConstantContact_" value="0">
				<input type="checkbox" name="data[Student][constant_contact]" value="1" id="StudentConstantContact"> Constant Contact?
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
		echo $this->Form->input('birthday', array('label' => array('class' => 'control-label'), 'type' => 'date', 'dateFormat' => 'DMY', 'minYear' => '1980', 'maxYear' => date('Y')-10, 'empty'=>' '));
		echo $this->Form->input('home_address', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('notes', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('number_children', array('label' => array('class' => 'control-label')));
	?>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][deceased]" id="StudentDeceased_" value="0">
				<input type="checkbox" name="data[Student][deceased]" value="1" id="StudentDeceased"> Deceased
			  </label>
			</div>
		</div>
	<?php	
		//As of 12/13/2015: Deprecating for now. LP says that they are only interested in tracking students who are actually members. We can do everything off of the student_semesters
		//table (the "Semesters Active" Page), so this information is redundant.
		//echo $this->Form->input('semester_started', array('label' => array('class' => 'control-label'), 'options' => $semesters, 'empty' => 'Select Semester'));
		//echo $this->Form->input('semester_member', array('label' => array('class' => 'control-label'), 'options' => $semesters, 'empty' => 'Select Semester'));
	?>	
	<!-- Select form for countries should follow the logic for this: 

	echo $this->Form->input('gender', array('label' => array('class' => 'control-label'), 'options' => array('Male'=>'Male', 'Female'=>'Female'), 'empty' => 'Select One'));-->
	<h3>Nationality</h3>
	<?php
		echo "<p>If country is not listed, please contact database developer</p>";	
		echo $this->Form->input('country', array('label' => array('class' => 'control-label'), 'options' =>array(
		"Afghanistan",
		"Albania",
		"Algeria",
		"Andorra",
		"Angola",
		"Antigua and Barbuda",
		"Argentina",
		"Armenia",
		"Australia",
		"Austria",
		"Azerbaijan",
		"Bahamas",
		"Bahrain",
		"Bangladesh",
		"Barbados",
		"Belarus",
		"Belgium",
		"Belize",
		"Benin",
		"Bhutan",
		"Bolivia",
		"Bosnia and Herzegovina",
		"Botswana",
		"Brazil",
		"Brunei",
		"Bulgaria",
		"Burkina Faso",
		"Burundi",
		"Cambodia",
		"Cameroon",
		"Canada",
		"Cape Verde",
		"Central African Republic",
		"Chad",
		"Chile",
		"China",
		"Colombia",
		"Comoros",
		"Republic of Congo/Congo-Brazzaville",
		"Congo",
		"Costa Rica",
		"Cote d'Ivoire",
		"Croatia",
		"Cuba",
		"Cyprus",
		"Czech Republic",
		"Denmark",
		"Djibouti",
		"Dominica",
		"Dominican Republic",
		"East Timor",
		"Ecuador",
		"Egypt",
		"El Salvador",
		"Equatorial Guinea",
		"Eritrea",
		"Estonia",
		"Ethiopia",
		"Fiji",
		"Finland",
		"France",
		"Gabon",
		"The Gambia",
		"Georgia",
		"Germany",
		"Ghana",
		"Greece",
		"Grenada",
		"Guatemala",
		"Guinea",
		"Guinea-Bissau",
		"Guyana",
		"Haiti",
		"Honduras",
		"Hong Kong",
		"Hungary",
		"Iceland",
		"India",
		"Indonesia",
		"Iran",
		"Iraq",
		"Ireland",
		"Israel",
		"Italy",
		"Jamaica",
		"Japan",
		"Jordan",
		"Kazakhstan",
		"Kenya",
		"Kiribati",
		"North Korea",
		"South Korea",
		"Kuwait",
		"Kyrgyzstan",
		"Laos",
		"Latvia",
		"Lebanon",
		"Lesotho",
		"Liberia",
		"Libya",
		"Liechtenstein",
		"Lithuania",
		"Luxembourg",
		"Macedonia",
		"Madagascar",
		"Malawi",
		"Malaysia",
		"Maldives",
		"Mali",
		"Malta",
		"Mauritania",
		"Mauritius",
		"Mexico",
		"Micronesia",
		"Moldova",
		"Monaco",
		"Mongolia",
		"Morocco",
		"Mozambique",
		"Myanmar",
		"Namibia",
		"Nauru",
		"Nepal",
		"Netherlands",
		"New Zealand",
		"Nicaragua",
		"Niger",
		"Nigeria",
		"Norway",
		"Oman",
		"Pakistan",
		"Palau",
		"Palestine",
		"Panama",
		"Papua New Guinea",
		"Paraguay",
		"Peru",
		"Philippines",
		"Poland",
		"Portugal",
		"Qatar",
		"Romania",
		"Russia",
		"Rwanda",
		"Saint Kitts and Nevis",
		"Saint Lucia",
		"Saint Vincent",
		"Samoa",
		"San Marino",
		"Sao Tome and Principe",
		"Saudi Arabia",
		"Senegal",
		"Serbia and Montenegro",
		"Seychelles",
		"Sierra Leone",
		"Singapore",
		"Slovakia",
		"Slovenia",
		"Solomon Islands",
		"Somalia",
		"South Africa",
		"Spain",
		"Sri Lanka",
		"Sudan",
		"Suriname",
		"Swaziland",
		"Sweden",
		"Switzerland",
		"Syria",
		"Taiwan",
		"Tajikistan",
		"Tanzania",
		"Thailand",
		"Tibet",
		"Togo",
		"Tonga",
		"Trinidad and Tobago",
		"Tunisia",
		"Turkey",
		"Turkmenistan",
		"Tuvalu",
		"Uganda",
		"Ukraine",
		"United Arab Emirates",
		"United Kingdom",
		"United States",
		"Uruguay",
		"Uzbekistan",
		"Vanuatu",
		"Vatican City",
		"Venezuela",
		"Vietnam",
		"Yemen",
		"Zambia",
		"Zimbabwe"), 'empty' => 'Select a country'));
		echo $this->Form->input('country2', array('label' => array('class' => 'control-label'), 'options' =>array(
		"Afghanistan",
		"Albania",
		"Algeria",
		"Andorra",
		"Angola",
		"Antigua and Barbuda",
		"Argentina",
		"Armenia",
		"Australia",
		"Austria",
		"Azerbaijan",
		"Bahamas",
		"Bahrain",
		"Bangladesh",
		"Barbados",
		"Belarus",
		"Belgium",
		"Belize",
		"Benin",
		"Bhutan",
		"Bolivia",
		"Bosnia and Herzegovina",
		"Botswana",
		"Brazil",
		"Brunei",
		"Bulgaria",
		"Burkina Faso",
		"Burundi",
		"Cambodia",
		"Cameroon",
		"Canada",
		"Cape Verde",
		"Central African Republic",
		"Chad",
		"Chile",
		"China",
		"Colombia",
		"Comoros",
		"Republic of Congo/Congo-Brazzaville",
		"Congo",
		"Costa Rica",
		"Cote d'Ivoire",
		"Croatia",
		"Cuba",
		"Cyprus",
		"Czech Republic",
		"Denmark",
		"Djibouti",
		"Dominica",
		"Dominican Republic",
		"East Timor",
		"Ecuador",
		"Egypt",
		"El Salvador",
		"Equatorial Guinea",
		"Eritrea",
		"Estonia",
		"Ethiopia",
		"Fiji",
		"Finland",
		"France",
		"Gabon",
		"The Gambia",
		"Georgia",
		"Germany",
		"Ghana",
		"Greece",
		"Grenada",
		"Guatemala",
		"Guinea",
		"Guinea-Bissau",
		"Guyana",
		"Haiti",
		"Honduras",
		"Hong Kong",
		"Hungary",
		"Iceland",
		"India",
		"Indonesia",
		"Iran",
		"Iraq",
		"Ireland",
		"Israel",
		"Italy",
		"Jamaica",
		"Japan",
		"Jordan",
		"Kazakhstan",
		"Kenya",
		"Kiribati",
		"North Korea",
		"South Korea",
		"Kuwait",
		"Kyrgyzstan",
		"Laos",
		"Latvia",
		"Lebanon",
		"Lesotho",
		"Liberia",
		"Libya",
		"Liechtenstein",
		"Lithuania",
		"Luxembourg",
		"Macedonia",
		"Madagascar",
		"Malawi",
		"Malaysia",
		"Maldives",
		"Mali",
		"Malta",
		"Mauritania",
		"Mauritius",
		"Mexico",
		"Micronesia",
		"Moldova",
		"Monaco",
		"Mongolia",
		"Morocco",
		"Mozambique",
		"Myanmar",
		"Namibia",
		"Nauru",
		"Nepal",
		"Netherlands",
		"New Zealand",
		"Nicaragua",
		"Niger",
		"Nigeria",
		"Norway",
		"Oman",
		"Pakistan",
		"Palau",
		"Palestine",
		"Panama",
		"Papua New Guinea",
		"Paraguay",
		"Peru",
		"Philippines",
		"Poland",
		"Portugal",
		"Qatar",
		"Romania",
		"Russia",
		"Rwanda",
		"Saint Kitts and Nevis",
		"Saint Lucia",
		"Saint Vincent",
		"Samoa",
		"San Marino",
		"Sao Tome and Principe",
		"Saudi Arabia",
		"Senegal",
		"Serbia and Montenegro",
		"Seychelles",
		"Sierra Leone",
		"Singapore",
		"Slovakia",
		"Slovenia",
		"Solomon Islands",
		"Somalia",
		"South Africa",
		"Spain",
		"Sri Lanka",
		"Sudan",
		"Suriname",
		"Swaziland",
		"Sweden",
		"Switzerland",
		"Syria",
		"Taiwan",
		"Tajikistan",
		"Tanzania",
		"Thailand",
		"Tibet",
		"Togo",
		"Tonga",
		"Trinidad and Tobago",
		"Tunisia",
		"Turkey",
		"Turkmenistan",
		"Tuvalu",
		"Uganda",
		"Ukraine",
		"United Arab Emirates",
		"United Kingdom",
		"United States",
		"Uruguay",
		"Uzbekistan",
		"Vanuatu",
		"Vatican City",
		"Venezuela",
		"Vietnam",
		"Yemen",
		"Zambia",
		"Zimbabwe"), 'empty' => 'Select a country'));

		echo $this->Form->input('arrived_in_us', array('label' => array('class' => 'control-label')));
	?>
	<!--
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][immigrant]" id="StudentImmigrant_" value="0">
				<input type="checkbox" name="data[Student][immigrant]" value="1" id="StudentImmigrant"> Immigrant
			  </label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][refugee_asylee]" id="StudentRefugeeAsylee_" value="0">
				<input type="checkbox" name="data[Student][refugee_asylee]" value="1" id="StudentRefugeeAsylee"> Refugee/Asylee
			  </label>
			</div>
		</div>	
	-->
	<h3>High School Data</h3>
	<?php
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
				<input type="checkbox" name="data[Student][graduated]" value="1" id="StudentGraduated"> Graduated
			  </label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][dropped_out_of_high_school]" id="StudentDroppedOutOfHighSchool_" value="0">
				<input type="checkbox" name="data[Student][dropped_out_of_high_school]" value="1" id="StudentDroppedOutOfHighSchool"> Dropped Out
			  </label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][ged]" id="StudentGed_" value="0">
				<input type="checkbox" name="data[Student][ged]" value="1" id="StudentGed"> GED
			  </label>
			</div>
		</div>
	<h3>Internship Data</h3>
	<?php
		//echo $this->Form->input('internship_semester', array('label' => array('class' => 'control-label'), 'options' => array('Spring','Summer','Fall'),  'empty' => 'Select Semester'));
		//echo $this->Form->input('internship_year', array('label' => array('class' => 'control-label'), 'options' => $year_range,  'empty' => 'Select Year'));
		echo $this->Form->input('internship_semester_id', array('label' => array('class' => 'control-label'), 'options' => $semesters, 'empty' => 'Select Semester'));
		echo $this->Form->input('internship_location', array('label' => array('class' => 'control-label')));
	?>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][did_not_finish_internship]" id="StudentDidNotFinishInternship_" value="0">
				<input type="checkbox" name="data[Student][did_not_finish_internship]" value="1" id="StudentDidNotFinishInternship"> Did Not Finish
			  </label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][job_skills_completed]" id="StudentJobSkillsCompleted_" value="0">
				<input type="checkbox" name="data[Student][job_skills_completed]" value="1" id="StudentJobSkillsCompleted"> Job Skills Completed
			  </label>
			</div>
		</div>
	<h3>College Data</h3>
	
		<!--//echo $this->Form->input('college', array('label' => array('class' => 'control-label')));-->
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][college]" id="StudentCollege_" value="0">
				<input type="checkbox" name="data[Student][college]" value="1" id="StudentCollege"> Went to College
			  </label>
			</div>
		</div>
	<?php
		echo $this->Form->input('which_college', array('label' => array('class' => 'control-label college-field')));
		echo $this->Form->input('major', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('college_graduation_year', array('label' => array('class' => 'control-label'), 'options' => $year_range,  'empty' => 'Select Year'));
	?>
		<!--//echo $this->Form->input('graduated_college', array('label' => array('class' => 'control-label')));-->
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][graduated_college]" id="StudentGraduatedCollege_" value="0">
				<input type="checkbox" name="data[Student][graduated_college]" value="1" id="StudentGraduatedCollege"> Graduated College
			  </label>
			</div>
		</div>
	
		<h3>Grad School Data</h3>
	
		<!--//echo $this->Form->input('grad_school', array('label' => array('class' => 'control-label')));-->
		<div class="control-group">
			<div class="controls">
			  <label class="checkbox">
				<input type="hidden" name="data[Student][grad_school]" id="StudentGradSchool_" value="0">
				<input type="checkbox" name="data[Student][grad_school]" value="1" id="StudentGradSchool"> Went to Grad School
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
				<input type="checkbox" name="data[Student][graduated_grad_school]" value="1" id="StudentGraduatedGradSchool"> Graduated Grad School
			  </label>
			</div>
		</div>
	

	<h3>Employment Data</h3>
	<?php
	echo $this->Form->input('employed', array('label' => array('class' => 'control-label'), 'options' => array('full'=>'Full Time', 'part'=>'Part Time', 'no'=>'Unemployed'), 'empty' => 'Select One'));
	echo $this->Form->input('where_employed', array('label' => array('class' => 'control-label')));
	?>
	</fieldset>
		<div class="control-group">
		<div class="controls">
		<button type="submit" class="btn btn-success">
		<?php echo __('Submit'); ?>
		</div>
	</div>
<?php $this->Form->end(); ?>
</div>
