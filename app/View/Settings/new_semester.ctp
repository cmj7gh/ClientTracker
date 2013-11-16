<?php if(isset($updatedToStarted)){
//SUCCESS!
//show students who have been updated
echo("<legend><h2>Congratulations on another successful semester! The New Semester is: " . $newSemester . "</h2></legend>");

echo("<p class='lead'>The Following Students attended at least 6 meetings, so they are now considered members!</p>");
echo("<ul>");
foreach($updatedToMember as $member){
	echo("<li>" . $member['students']['first_name'] . " " . $member['students']['last_name'] . "</li>");
}
echo("</ul>");

echo("<hr><p class='lead'>The following students attended between 3 and 6 meetings, so they were not converted to members. They are now designated at 'Started'</p>");
echo("<ul>");
foreach($updatedToStarted as $start){
	echo("<li>" .$start['students']['first_name'] . " " . $start['students']['last_name'] . "</li>");
}
echo("</ul>");

echo("<hr><p class='lead'>The following students are members from previous semesters who returned this semester</p>");
echo("<ul>");
foreach($returningMember as $return){
	echo("<li>" .$return['students']['first_name'] . " " . $return['students']['last_name'] . "</li>");
}
echo("</ul>");

}else{
//ask for new semester name
//warn
?>
<div class="settings form">
<?php echo $this->Form->create('Setting', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('New Semester'); ?></legend>
		<p style="font-size:1.5em">WARNING: Submitting this form will permenantly end the current semester and will update student profiles based on their attendance. This action cannot be undone, so make sure that all of the meetings and attendance reports are correct before continuing!
		</p></br></br>
	<?php
		echo $this->Form->input('name', array('label' => array('class' => 'control-label', 'text' => 'Enter The Name Of The New Semester'), 'default' => 'ex: Fall 2013'));
		
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
<?php
}
?>