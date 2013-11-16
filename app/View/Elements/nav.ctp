<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container" style="width: 90%;">
         <!--<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </a>-->
			<?php
				if(isset($currentUser)){
					echo($this->Html->link("Home", '/pages/officer_home', array('class' => 'brand')));
				}else{
					echo($this->Html->link("Home", '/', array('class' => 'brand')));
				}
			?>
        <div class="nav-collapse collapse">
            <ul class="nav">
				<?php if(isset($currentUser)){ ?>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Officer Functions <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link(('Mark The End Of A Semester'), array('controller' => 'settings', 'action' => 'newSemester')); ?></li>
							<li><?php echo $this->Html->link(('Generate Stats'), array('controller' => 'pages', 'action' => 'stats')); ?></li>
						</ul>
					</li>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Youth <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link(('Youth at Your Schools'), array('controller' => 'students', 'action' => 'index', 'my')); ?></li>
							<li><?php echo $this->Html->link(('All LP Members'), array('controller' => 'students', 'action' => 'index', 'members')); ?></li>
							<li><?php echo $this->Html->link(('Youth Who Have Started LP Programs But Are Not Members'), array('controller' => 'students', 'action' => 'index', 'started')); ?></li>
							<li><?php echo $this->Html->link(('Everyone'), array('controller' => 'students', 'action' => 'index', 'all')); ?></li>
							<li><?php echo $this->Html->link(('LP Alumni'), array('controller' => 'students', 'action' => 'index', 'alumni')); ?></li>
						</ul>
					</li>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Sessions <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link(('Record New Session'), array('controller' => 'meetings', 'action' => 'before_add')); ?></li>
							<li><?php echo $this->Html->link(('Sessions at Your Schools'), array('controller' => 'meetings', 'action' => 'index', 'my')); ?></li>
							<li><?php echo $this->Html->link(('All Sessions'), array('controller' => 'meetings', 'action' => 'index')); ?></li>
						</ul>
					</li>
					
			   	<?php } ?>
            </ul>	
			
			<?php if (isset($currentUser))
			   { 
					//var_dump($currentUser);
				 echo '<ul class="nav pull-right">
					<li class="dropdown">
					   <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$currentUser['display_name'].' <b class="caret"></b></a>
					   <ul class="dropdown-menu">';
							echo '<li>' . $this->Html->link("Edit Your Profile", array('controller' => 'users', 'action' => 'edit', $currentUser['id'])) .'</li>';
							echo '<li>'. $this->Html->link("Logout", array("controller" => "users", "action" => "logout")). '</li>
					   </ul>
					</li>
				 </ul>';
			   }
			   else
			   { 
			?>
				<!--<ul class="nav pull-right">-->
					<div class="dropdown">
					<a href="#" class="dropdown-toggle btn btn-info pull-right" data-toggle="dropdown">Login <b class="caret"></b></a>
					<div class="dropdown-menu pull-right">
						<?php //echo $this->Session->flash('auth'); ?>
						<?php echo $this->Form->create('User', array('action' => 'login')); ?>
							<fieldset class='textbox' style="padding:10px">
								<?php 
									echo $this->Form->input('email', array('label'=>false,'style'=>"margin-top: 8px", 'type'=>"text", 'placeholder'=>"Email"));
									echo $this->Form->input('password', array('label'=>false,'style'=>"margin-top: 8px", 'type'=>"password", 'placeholder'=>"Password"));
								?>
								<input class="btn-primary" name="commit" type="submit" value="Log In" />
							</fieldset>
						<?php $this->Form->end(); ?>
					</div>
				   </div>
				<!-- </ul> -->
			   <?php } ?>
			
         </div>
      </div>
   </div>
</div>
