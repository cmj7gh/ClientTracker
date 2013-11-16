<div class="logs view">
<h2><?php  echo __('Log'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($log['Log']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($log['Log']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Controller'); ?></dt>
		<dd>
			<?php echo h($log['Log']['controller']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Function'); ?></dt>
		<dd>
			<?php echo h($log['Log']['function']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Details'); ?></dt>
		<dd>
			<?php echo h($log['Log']['details']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Theid'); ?></dt>
		<dd>
			<?php echo h($log['Log']['theid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($log['Log']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($log['Log']['data']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ipaddr'); ?></dt>
		<dd>
			<?php echo h($log['Log']['ipaddr']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($log['Log']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
