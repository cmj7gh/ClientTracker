<div class="authentications form">
<?php echo $this->Form->create('Authentication'); ?>
	<fieldset>
		<legend><?php echo __('Edit Authentication'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('ipaddr');
		echo $this->Form->input('value');
		echo $this->Form->input('valid');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

