<?php
/**
 *
 * @package		Crowdfunding
 * @author 		siva_063at09
 * @copyright 	Copyright (c) 2012 {@link http://www.agriya.com/ Agriya Infoway}
 * @license		http://www.agriya.com/ Agriya Infoway Licence
 * @since 		2012-07-25
 *
 */
class LendNamesController extends AppController
{
    public $name = 'LendNames';
    public function index() 
    {
        $this->pageTitle = sprintf(__l('%s Names') , Configure::read('project.alt_name_for_lend_singular_caps') , Configure::read('project.alt_name_for_project_singular_caps'));
        $this->LendName->recursive = 0;
        $this->paginate = array(
            'conditions' => array(
                'LendName.user_id' => $this->Auth->user('id')
            ) ,
            'order' => array(
                'LendName.id' => 'desc'
            ) ,
            'recursive' => -1,
        );
        $this->set('lendNames', $this->paginate());
    }
}
?>