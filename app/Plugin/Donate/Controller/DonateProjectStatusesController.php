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
class DonateProjectStatusesController extends AppController
{
    public $name = 'DonateProjectStatuses';
    public function index() 
    {
        $this->pageTitle = sprintf(__l('%s %s Statuses') , Configure::read('project.alt_name_for_donate_singular_caps') , Configure::read('project.alt_name_for_project_singular_caps'));
        $this->DonateProjectStatus->recursive = 0;
        $this->paginate = array(
            'fields' => array(
                'DonateProjectStatus.name',
            ) ,
            'limit' => 12,
            'order' => 'DonateProjectStatus.name asc',
        );
        $this->set('projectStatuses', $this->paginate());
    }
    public function admin_index() 
    {
        $this->pageTitle = sprintf(__l('%s %s Statuses') , Configure::read('project.alt_name_for_donate_singular_caps') , Configure::read('project.alt_name_for_project_singular_caps'));
        $this->set('projectStatuses', $this->paginate());
    }
    public function admin_edit($id = null) 
    {
        $this->pageTitle = sprintf(__l('Edit %s') , sprintf(__l('%s %s Status') , Configure::read('project.alt_name_for_donate_singular_caps') , Configure::read('project.alt_name_for_project_singular_caps')));
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
            if ($this->DonateProjectStatus->save($this->request->data)) {
                $this->Session->setFlash(sprintf(__l('%s has been updated') , sprintf(__l('%s %s Status') , Configure::read('project.alt_name_for_donate_singular_caps') , Configure::read('project.alt_name_for_project_singular_caps'))) , 'default', null, 'success');
            } else {
                $this->Session->setFlash(sprintf(__l('%s could not be updated. Please, try again.') , sprintf(__l('%s %s Status') , Configure::read('project.alt_name_for_donate_singular_caps') , Configure::read('project.alt_name_for_project_singular_caps'))) , 'default', null, 'error');
            }
        } else {
            $this->request->data = $this->DonateProjectStatus->read(null, $id);
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->request->data['DonateProjectStatus']['name'];
    }
}
?>