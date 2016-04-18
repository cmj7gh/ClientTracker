<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

//$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeDescription = __d('cake_dev', 'Liberty\'s Promise');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		//echo $this->Html->css('universal');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->Html->css('jquery-ui.min');
		echo $this->Html->script('jquery-1.9.0');
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('jquery-ui.min');
	?>
		<script language="javascript">
			$('.dropdown-toggle').dropdown();
			$('.dropdown-menu').find('form').click(function (e) {
				e.stopPropagation();
			});
		</script>
</head>
<body>
	<div id="container">
		<div class="page-header">
			<?php echo $this->element('nav'); ?>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div class="bottom-bar">
		<div class="modal-footer">
			<a href="http://libertyspromise.org/">Liberty's Promise</a>  &copy; <?php echo date("Y") ?> Questions? Contact <a href="mailto:cmj7gh@virginia.edu">cmj7gh@virginia.edu</a> or <a href="mailto:databasevol@libertyspromise.org">databasevol@libertyspromise.org</a>
			
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
		</div>
	</div>
	<!--<?php echo $this->element('sql_dump'); ?>-->
</body>
</html>
