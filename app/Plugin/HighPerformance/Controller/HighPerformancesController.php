<?php
/**
 *
 * @package		Crowdfunding
 * @author 		ananda_176at12
 * @copyright 	Copyright (c) 2012 {@link http://www.agriya.com/ Agriya Infoway}
 * @license		http://www.agriya.com/ Agriya Infoway Licence
 * @since 		2012-07-25
 *
 */
class HighPerformancesController extends AppController
{
    public $name = 'HighPerformances';
    public function admin_check_s3_connection() 
    {
        App::import('Vendor', 'HighPerformance.S3');
        $s3 = new S3(Configure::read('s3.aws_access_key') , Configure::read('s3.aws_secret_key'));
        $s3->setEndpoint(Configure::read('s3.end_point'));
		$buckets = $s3->listBuckets();
		if (in_array(Configure::read('s3.bucket_name'), $buckets)) {
            $this->Session->setFlash(__l('Bucket name and configuration is ok') , 'default', null, 'success');
        } else {
            $this->Session->setFlash(__l('Problem with the configuration') , 'default', null, 'error');
        }
        if (!empty($_GET['f'])) {
            $this->redirect(Router::url('/', true) . $_GET['f']);
        }
    }
    public function admin_copy_static_contents() 
    {
        $this->_copy_content(JS, 'js');
        $this->_copy_content(CSS, 'css');
        $this->_copy_content(IMAGES, 'img');
        $this->_copy_content(WWW_ROOT . DS . 'font', 'font');
        App::import('Modal', 'Settings');
        if (!empty($_GET['f'])) {
            $this->Session->setFlash(__l('Static content successfully copied.') , 'default', null, 'success');
            $this->redirect(Router::url('/', true) . $_GET['f']);
        }
    }
    public function _copy_content($dir, $current_dir) 
    {
	   	App::import('Vendor', 'HighPerformance.S3');
		$s3 = new S3(Configure::read('s3.aws_access_key') , Configure::read('s3.aws_secret_key'));
	   	$handle = opendir($dir);
        while (false !== ($readdir = readdir($handle))) {
            if ($readdir != '.' && $readdir != '..') {
                $path = $dir . '/' . $readdir;
                if (is_dir($path)) {
                    @chmod($path, 0777);
                    if (!strstr($path, "_thumb")) {
                        $this->_copy_content($path, $current_dir . "/" . $readdir);
                    }
                }
                if (is_file($path)) {
                    @chmod($path, 0777);
					$s3->putObjectFile($path, Configure::read('s3.bucket_name') , $current_dir . '/' . $readdir, S3::ACL_PUBLIC_READ);
                    flush();
                }
            }
        }
        closedir($handle);
        return true;
    }
    public function update_content() 
    {
        $this->disableCache();
        if ($this->Auth->user('id')) {
            App::import('Model', 'Project');
            $this->Project = new Project();
            $conditions = array();
            $followinguserIds = array();
            if (isPluginEnabled('ProjectFollowers')) {
                $followingprojectIds = $this->Project->ProjectFollower->find('all', array(
                    'conditions' => array(
                        'ProjectFollower.user_id' => $this->Auth->user('id')
                    ) ,
                    'fields' => array(
                        'ProjectFollower.project_id'
                    ) ,
                    'recursive' => -1
                ));
            }
            if (isPluginEnabled('Idea')) {
                $ratedprojectIds = $this->Project->ProjectRating->find('all', array(
                    'conditions' => array(
                        'ProjectRating.user_id' => $this->Auth->user('id')
                    ) ,
                    'fields' => array(
                        'ProjectRating.project_id'
                    ) ,
                    'recursive' => -1
                ));
            }
            if (isPluginEnabled('SocialMarketing')) {
                $followinguserIds = $this->User->UserFollower->find('all', array(
                    'conditions' => array(
                        'UserFollower.user_id' => $this->Auth->user('id')
                    ) ,
                    'fields' => array(
                        'UserFollower.followed_user_id'
                    ) ,
                    'recursive' => -1
                ));
            }
            $ownprojectIds = $this->Project->find('all', array(
                'conditions' => array(
                    'Project.user_id' => $this->Auth->user('id')
                ) ,
                'fields' => array(
                    'Project.id'
                ) ,
                'recursive' => -1
            ));
            $response = Cms::dispatchEvent('Controller.ProjectType.getConditions', $this, array(
                'page' => 'update_content',
                'type' => 'open'
            ));
            if (!empty($response->data['conditions'])) {
                $conditions = array_merge($conditions, $response->data['conditions']);
            }
            $openedprojectIds = $this->Project->find('all', array(
                'conditions' => $conditions,
                'fields' => array(
                    'Project.id'
                ) ,
                'recursive' => 0
            ));
            $this->set('followingprojectIds', $followingprojectIds);
            $this->set('ratedprojectIds', $ratedprojectIds);
            $this->set('followinguserIds', $followinguserIds);
            $this->set('ownprojectIds', $ownprojectIds);
            $this->set('followinguserIds', $followinguserIds);
            $this->set('openedprojectIds', $openedprojectIds);
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $this->Auth->user('id') ,
                ) ,
                'recursive' => -1
            ));
            $this->response->modified($user['User']['modified']);
        }
    }
    public function remove_s3_file() 
    {
        if (!empty($this->request->data['url'])) {
            App::import('Vendor', 'HighPerformance.S3');
            $s3 = new S3(Configure::read('s3.aws_access_key') , Configure::read('s3.aws_secret_key'));
			$s3->setEndpoint(Configure::read('s3.end_point'));
            $s3->deleteObject(Configure::read('s3.bucket_name') , $this->request->data['url']);
            exit;
        }
    }
    public function show_project_comments() 
    {
        $this->disableCache();
        if (!empty($this->request->params['named']['id'])) {
            App::import('Model', 'Projects.Project');
            $this->Project = new Project();
            $project = $this->Project->find('first', array(
                'conditions' => array(
                    'Project.id' => $this->request->params['named']['id']
                ) ,
            	'contain'=> array(
						'User' => array(
							'fields' => array(
								'User.username',
							)
						),
            			'ProjectType' => array(
            					'fields' => array(
            							'ProjectType.name',
            							'ProjectType.slug',
            							'ProjectType.funder_slug',
            							'ProjectType.id',
            					) ,
            			) 
            	),
                'recursive' => 3
            ));
            $projectTypeName = ucwords($project['ProjectType']['name']);
            App::import('Model', $projectTypeName . '.' . $projectTypeName);
            $model = new $projectTypeName();
            $is_comment_allow = $model->onProjectViewMessageDisplay($project);
            $this->set('is_comment_allow', $is_comment_allow);
            $this->set('project', $project);
        }
        $this->layout = 'ajax';
    }
}
?>