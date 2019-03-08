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
class ProjectReward extends AppModel
{
    public $name = 'ProjectReward';
    public $belongsTo = array(
        'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'project_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true,
        )
    );
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
        $this->_permanentCacheAssociations = array(
            'Project'
        );
        $this->validate = array(
            'pledge_amount' => array(
                'rule5' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => (Configure::read('Project.is_project_reward_optional')) ? true : false,
                    'message' => __l('Enter valid amount')
                ) ,
                'rule4' => array(
                    'rule' => '_rewardAmountCheck',
                    'allowEmpty' => (Configure::read('Project.is_project_reward_optional')) ? true : false,
                ) ,
                'rule3' => array(
                    'rule' => '_rewardAmount',
                    'allowEmpty' => (Configure::read('Project.is_project_reward_optional')) ? true : false,
                    'message' => __l('Must be less than needed amount')
                ) ,
                'rule2' => array(
                    'rule' => array(
                        'comparison',
                        '>=',
                        1
                    ) ,
                    'allowEmpty' => (Configure::read('Project.is_project_reward_optional')) ? true : false,
                    'message' => __l('Must be greater than zero')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => (Configure::read('Project.is_project_reward_optional')) ? true : false,
                    'message' => __l('Required')
                ) ,
            ) ,
            'reward' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => (Configure::read('Project.is_project_reward_optional')) ? true : false,
                    'message' => __l('Required')
                ) ,
            ) ,
            'pledge_max_user_limit' => array(
                'rule2' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => true,
                    'message' => __l('Enter valid limit in numbers')
                ) ,
                'rule1' => array(
                    'rule' => '_checkUserCount',
                    'allowEmpty' => true,
                    'message' => __l('This limit can not be entered  ')
                ) ,
            ) ,
            'estimated_delivery_date' => array(
                'rule1' => array(
                    'rule' => '_checkEndDate',
                    'allowEmpty' => true,
                    'message' => sprintf(__l('Must be greater than %s end date.') , Configure::read('project.alt_name_for_project_singular_small'))
                ),
            ) ,
            'is_having_additional_info' => array(
                'rule1' => array(
                    'rule' => '_checkAdditinalInfoLabel',
                    'allowEmpty' => true,
                    'message' => __l('Must be enter the additional information label')
                ) ,
            )
        );
    }
    public function _checkEndDate() 
    {
        if (!empty($this->data[$this->name]['is_shipping']) && !empty($this->data[$this->name]['estimated_delivery_date']) && !empty($this->data[$this->name]['pledge_amount'])) {
            if (!empty($this->data['Project']['project_end_date'])) {
                $project_end_date = explode('-', $this->data['Project']['project_end_date']);
                $end_date = strtotime($project_end_date[2] . '-' . $project_end_date[1] . '-' . $project_end_date[0]);
            } else {
                $end_date = time();
            }
			$estimated_date_arr = explode('-', $this->data[$this->name]['estimated_delivery_date']);
            $estimated_dat = strtotime($estimated_date_arr[2] . '-' . $estimated_date_arr[1] . '-' . $estimated_date_arr[0]);
            if ($estimated_dat > $end_date) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
    public function _checkAdditinalInfoLabel() 
    {
        if (!empty($this->data[$this->name]['is_having_additional_info'])) {
            if (empty($this->data[$this->name]['additional_info_label'])) {
                return __l('Required');
            } else {
                return true;
            }
        } else {
            return true;
        }
    }
    public function _checkUserCount() 
    {
        if ($this->data[$this->name]['pledge_amount']*$this->data[$this->name]['pledge_max_user_limit'] > $this->data[$this->name]['max_amount'] && !$this->data[$this->name]['is_allow_over_funding']) {
            return false;
        } else {
            return true;
        }
    }
    public function _rewardAmountCheck() 
    {
        if ($this->data[$this->name]['pledge_amount'] != $this->data[$this->name]['min_amount'] && $this->data[$this->name]['pledge_type_id'] == ConstPledgeTypes::Fixed) {
            return __l('Amount should be equal to fixed amount');
        } else if ($this->data[$this->name]['pledge_amount'] < $this->data[$this->name]['min_amount'] && $this->data[$this->name]['pledge_type_id'] == ConstPledgeTypes::Minimum) {
            return __l('Amount should not be less then minimum amount');
        } else if ($this->data[$this->name]['pledge_amount'] < $this->data[$this->name]['min_amount'] && $this->data[$this->name]['pledge_type_id'] == ConstPledgeTypes::Multiple) {
            return __l('Amount should not be less then denomination amount');
        } else if (is_numeric($this->data[$this->name]['pledge_amount']) && $this->data[$this->name]['max_amount']%$this->data[$this->name]['pledge_amount'] != 0 && $this->data[$this->name]['pledge_type_id'] == ConstPledgeTypes::Multiple && !$this->data[$this->name]['is_allow_over_funding']) {
            return __l('Amount cannot be equally shared or else you should allow over funding.');
        } else {
            return true;
        }
    }
    public function _rewardAmount() 
    {
        if ($this->data[$this->name]['pledge_amount'] >= $this->data[$this->name]['max_amount']) {
            return __l('Must be less than needed amount');
        } else {
            return true;
        }
    }
    public function _rewardNotEmpty() 
    {
        if (!empty($this->data[$this->name]['pledge_amount']) && empty($this->data[$this->name]['reward']) && empty($this->validationErrors['reward'])) {
            return __l('Required');
        } else {
            return true;
        }
    }
    public function _pledgeNotEmpty() 
    {
        if (empty($this->data[$this->name]['pledge_amount']) && empty($this->validationErrors['pledge_amount'])) {
            return __l('Required');
        } else {
            return true;
        }
    }
}
?>