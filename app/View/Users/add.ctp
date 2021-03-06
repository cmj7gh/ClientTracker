<div class="users form">
<?php echo $this->Form->create('User', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('first_name', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('last_name', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('email', array('label' => array('class' => 'control-label')));
		echo $this->Form->input('birthday', array('label' => array('class' => 'control-label'), 'type' => 'date', 'dateFormat' => 'DMY', 'minYear' => '1950', 'maxYear' => date('Y')-15));
		echo $this->Form->input('password', array('label' => array('class' => 'control-label')));
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

