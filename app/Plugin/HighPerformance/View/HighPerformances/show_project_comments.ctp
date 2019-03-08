<section class="clearfix">
	<?php  if(Configure::read('Project.is_fb_project_comment_enabled')){?>
		<div class="main-section" id="comments">
			<h3 class="h2 navbar-btn roboto-bold font-size-28">
				<?php echo __l('Comments');?>
			</h3>
			<div id="js-comment-section">
			<?php
				$comment_code = Configure::read('Project.comment_code');
				echo strtr($comment_code,array(
					'##APPID##' => Configure::read('facebook.app_id'),
					'##URL##' =>Router::url(array('controller' => 'projects', 'action' => 'view', $project['Project']['slug']), true),
				));
			?>
			</div>
		</div>
	<?php } else { ?>
		<?php echo $this->element('Projects.message-discussions',array('project_id'=>$project['Project']['id'], 'cache' => array('config' => 'sec'))); ?>
		 <div id="comments">
			<?php
				if (!empty($is_comment_allow) && $this->Auth->user('id')) {
					echo $this->element('Projects.message-compose',array('user'=>$project['User']['username'],'project' => $project['Project'],'projecttype_slug' => $project['ProjectType']['slug'], 'funded_id' => !empty($this->request->params['named']['funded_id'])?$this->request->params['named']['funded_id']:'', 'cache' => array('config' => 'sec')));
				}
			?>
		</div>
	<?php } ?>
</section> &nbsp;