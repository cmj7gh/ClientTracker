<?php echo $this->html->script('jquery-1.9.0.js'); ?>
<?php echo $this->html->script('jquery-ui-1.10.0.custom.min.js'); ?>
<?php //echo $this->html->css('ui-lightness/jquery-ui-1.10.0.custom.css'); ?>
<?php echo $this->html->css('ui-lightness/jquery-ui-1.10.0.custom_edits_for_attendance.css'); ?>
<?php //var_dump($members); ?>
<!-- jQuery UI trial -->
<script>
  $(function() {
	var pickerOpts = {
        dateFormat:"yy-mm-dd"
    }; 
	$( "#datepicker" ).datepicker(pickerOpts);
	$( "#accordion" ).accordion({
      heightStyle: "content",
	  collapsible: true
    });
	$( "#tabs" ).tabs({ active: 1 });
  });
</script>


<div class="meetings form">
<?php echo $this->Form->create('Meeting', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Add Session'); ?></legend>
	<?php
		//this generates the key-value array to use as meetings title dropdown options
		$keys = range(1, 25);
		array_push($keys, 'Field Trip 1', 'Field Trip 2', 'Field Trip 3', 'Field Trip 4', 'Field Trip 5', 'Other');
		$meeting_titles = array_combine($keys, $keys);
		
		echo $this->Form->input('title', array('label' => array('text' => 'Session', 'class' => 'control-label'), 'options' => $meeting_titles,  'empty' => 'Select Session Number'));
		echo $this->Form->input('datetime', array('label' => array('text' => 'Date', 'class' => 'control-label'), 'type' => 'date', 'dateFormat' => 'DMY'));
	?>
	</fieldset>
	<h3>Attendance</h3>
	<div class="attendance-form" style="padding-left: 180px;">
	<table>
	<?php 
		$count = 0;
		//var_dump($students);
		foreach($students as $m){
			if($count % 3 == 0){
				echo('<tr>');
			}
			echo('<td>');
			echo('<input type="checkbox" name="Student[]" value=' . $m['Student']['id'] . ' id="check' . $count .'" /><label for="check' . $count .'">' . $m['Student']['first_name'] . ' ' . $m['Student']['last_name'] . '</label>');
			echo('</td>');
			if($count % 3 == 2){
				echo('</tr>');
			}		
			$count++;
		}

	?>
	</table>
	</div>
	
		<div class="control-group">
		<div class="controls">
		<button type="submit" class="btn btn-success">
		<?php echo __('Submit'); ?>
		</div>
	</div>
<?php $this->Form->end(); ?>
</div>
<?php
		for($i = 0; $i <= $count; $i++){
			echo("<script>");
			echo("$(function() {");
			echo('$( "#check' . $i . '" ).button();');
			echo("  });</script>");
		}
?>
