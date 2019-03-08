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
class LendNamesLendProjectCategory extends AppModel
{
    public $name = 'LendNamesLendProjectCategory';
    public $displayField = 'id';
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'LendName' => array(
            'className' => 'Lend.LendName',
            'foreignKey' => 'lend_name_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'LendProjectCategory' => array(
            'className' => 'Lend.LendProjectCategory',
            'foreignKey' => 'lend_project_category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
    );
    function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'lend_name_id' => array(
                'rule' => 'numeric',
                'allowEmpty' => false,
                'message' => __l('Required')
            ) ,
            'lend_project_category_id' => array(
                'rule' => 'numeric',
                'allowEmpty' => false,
                'message' => __l('Required')
            )
        );
    }
}
?>