<div class="programs form">
<?php echo $this->Form->create('School', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		
	<p><b>Please read the following instructions before creating a new program:
	<ul>
	<li>To add a program, select the type of program and the school to which it belongs.</li>
	<li>You can add two different programs to the same school by filling out this form twice. </li>
	<li>The school must already exist to add a program - if you don't see your school in the dropdown, you must first add the school <?php echo $this->Html->link(
    'here',
    array('controller' => 'schools', 'action' => 'add'),
    array('confirm' => 'Any program on this page will not be saved if you go to the add schools page. Are you sure you want to leave?')
	);?></li>
	<li>Some Programs (Like the Silver Spring Civics Program), serve more than one school. To add those programs, contact Chris Jones</li>
	</b></p>
	<hr>
	<legend><?php echo __('Add Program'); ?></legend>
	<?php
		echo $this->Form->input('programtype_id', array('label' => array('class' => 'control-label'), 'empty' => 'Select A Program Type'));
		echo $this->Form->input('school_id', array('label' => array('class' => 'control-label'), 'empty' => 'Select A High School'));
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
