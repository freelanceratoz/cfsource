<div class="install form">
    <h2><?php echo $this->Html->cText($title_for_layout, false); ?></h2>
	<iframe frameborder="0" width="630px" height="80px" src="https://google.com"></iframe>
	<?php
		Configure::write('debug', 0);
			echo $this->Form->create('Install', array('url' => array('controller' => 'install', 'action' => 'license'), 'class' => 'normal')); ?>
	<div class="content-block round-4">
			<?php 
			echo $this->Form->input('Install.license', array('label' => 'License Key')); ?>
	</div>
	<div class="clearfix">
		<div class="grid_right">
			<?php echo $this->Form->submit('Submit'); ?>
		</div>
	</div>
		<?php echo $this->Form->end(); ?>
</div>