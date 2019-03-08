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
class JobsActEntry extends AppModel
{
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
        )
    );
    function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
        if ($_SESSION['Auth']['User']['role_id'] != ConstUserTypes::Admin) {
            $this->validate = array(
                'net_worth' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required')
                ) ,
                'annual_income_individual' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required')
                ) ,
                'annual_income_with_spouse' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required')
                ) ,
                'total_asset' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required')
                ) ,
            );
        }
    }
}
?>