<div class="schools form">
<?php echo $this->Form->create('Scholarship', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Edit Scholarship'); ?></legend>
	<?php
		echo $this->Form->input('id', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('student_id', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('title', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('scholarship_value', array('label' => array('class' => 'control-label')));
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
