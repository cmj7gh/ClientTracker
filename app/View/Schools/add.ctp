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
		echo $this->Form->input('county', array('label' => array('class' => 'control-label')));
	?>
	<!-- removing this box for now. Someday we'll have to figure out how to handle creation of centers that serve more than one school (like Silver Spring)
	<div class="control-group">
		<div class="controls">
		  <label class="checkbox">
			<input type="hidden" name="data[School][isCenter]" id="SchoolIsCenter_" value="0">
			<input type="checkbox" name="data[School][School]" value="1" id="SchoolIsCenter"> Does this center serve students from more than one high school?
		  </label>
		</div>
	</div>	
	-->
	</fieldset>
		<div class="control-group">
		<div class="controls">
		<button type="submit" class="btn btn-success">
		<?php echo __('Submit'); ?>
		</div>
	</div>
<?php $this->Form->end(); ?>
</div>
