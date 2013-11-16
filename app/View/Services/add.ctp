<div class="schools form">
<?php echo $this->Form->create('Service', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Add Service'); ?></legend>
	<?php
		echo $this->Form->input('student_id', array('label' => array('class' => 'control-label'), 'default' => $student_id));
		echo $this->Form->input('description', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('type', array('options' => array('College'=>'College', 
																'Scholarship'=>'Scholarship',
																'Job'=>'Job',
																'Youth Programs'=>'Youth Programs',
																'Family'=>'Family',
																'Other'=>'Other'), 'label' => array('text'=>'Type of Service', 'class' => 'control-label')));
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
