<div class="authentications view">
<h2><?php  echo __('Authentication'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($authentication['Authentication']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($authentication['Authentication']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ipaddr'); ?></dt>
		<dd>
			<?php echo h($authentication['Authentication']['ipaddr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($authentication['Authentication']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valid'); ?></dt>
		<dd>
			<?php echo h($authentication['Authentication']['valid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($authentication['Authentication']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($authentication['Authentication']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
