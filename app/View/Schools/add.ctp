<div class="schools form">
<?php echo $this->Form->create('School', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Add School'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('address', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('city', array('label' => array('class' => 'control-label')));
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
