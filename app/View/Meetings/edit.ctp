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
<?php 
	echo $this->Form->create('Meeting', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<fieldset>
		<legend><?php echo __('Edit Session'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('school_id');
		echo $this->Form->input('title', array('label' => array('text' => 'Session', 'class' => 'control-label'), 'options' => array('Other' => 'Other', '1' => '1','2' => '2','3' => '3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'),  'empty' => 'Select Session Number'));
		echo $this->Form->input('datetime', array('label' => array('text' => 'Date', 'class' => 'control-label'), 'type' => 'date', 'dateFormat' => 'DMY'));
		//echo $this->Form->input('Student');
		echo $this->Form->input('User', array('label' => array('text' => 'Hosted By', 'class' => 'control-label')));
	?>
	</fieldset>
	<h3>Attendance</h3>
	<div class="attendance-form" style="padding-left: 180px;">
	<table>
	<?php 
		$count = 0;
		foreach($students as $m){
			if($count % 3 == 0){
				echo('<tr>');
			}
			echo('<td>');
			//echo('<input type="checkbox" name="Student[]" value=' . $m['Student']['id'] . ' id="check' . $count .'" /><label for="check' . $count .'">' . $m['Student']['first_name'] . ' ' . $m['Student']['last_name'] . '</label>');
			$attended = false;
			foreach($this->request->data['Student'] as $attendee){
				if($attendee['id'] == $m['Student']['id']){
					echo('<input type="checkbox" name="Student[]" value=' . $m['Student']['id'] . ' id="check' . $count .'" checked="checked"/><label for="check' . $count .'">' . $m['Student']['first_name'] . ' ' . $m['Student']['last_name'] . '</label>');
					$attended = true;
					break;
				}
			}
			if(!$attended){
				echo('<input type="checkbox" name="Student[]" value=' . $m['Student']['id'] . ' id="check' . $count .'" /><label for="check' . $count .'">' . $m['Student']['first_name'] . ' ' . $m['Student']['last_name'] . '</label>');
			}
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