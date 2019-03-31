<div class="col-xs-12 col-sm-6 col-md-3 start-projects">
	<div class="start_project_content">
		<div class="img-contain"><?php echo $this->Html->image('donate_new.png'); ?></div>
		<?php echo $this->Html->link( __l(Configure::read('project.alt_name_for_donate_singular_caps')). " " . __l(Configure::read('project.alt_name_for_project_singular_caps')), array('controller' => 'projects', 'action' => 'add', 'project_type'=>'donate', 'admin' => false), array('title' => __l(Configure::read('project.alt_name_for_donate_singular_caps')). " " . __l(Configure::read('project.alt_name_for_project_singular_caps')),'class' => 'js-tooltip h3 sitegreenc', 'escape' => false));?>
		<p class="navbar-btn"><?php echo __l('People immediately pay to you. Can\'t offer rewards.'); ?></p>
	</div>
</div>