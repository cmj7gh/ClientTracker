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


<?php echo $this->Form->create('Meeting', array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
            'div' => array('class' => 'control-group'),
            'label' => array('class' => 'control-label'),
            'between' => '<div class="controls">',
            'after' => '</div>',
            'class' => ''))); ?>
	<h3>Where Will This Session Take Place?</h3>
	<div class="attendance-form" style="padding-left: 180px;">
	<table>
	<?php 
		$count = 0;
		foreach($center_ids as $m){
			if($count % 3 == 0){
				echo('<tr>');
			}
			echo('<td>');
			echo('<input type="checkbox" name="Center[]" value=' . $m . ' id="check' . $count .'" /><label for="check' . $count .'">' . $centers[$m] . '</label>');
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
