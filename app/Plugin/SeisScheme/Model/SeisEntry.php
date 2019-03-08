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
class SeisEntry extends AppModel
{
    public $name = 'SeisEntry';
    var $useTable = 'seis_entries';
    public $displayField = 'id';
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'company_name' => array(
                'rule' => 'notempty',
                'allowEmpty' => false,
                'message' => __l('Required')
            ) ,
            'number_of_employees' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required')
                ) ,
                'rule2' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Must be numeric')
                ) ,
            ) ,
            'year_of_founding' => array(
                'rule' => 'notempty',
                'message' => __l('Enter valid date')
            ) ,
            'total_asset' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required')
                ) ,
                'rule2' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Must be numeric')
                ) ,
            ) ,
        );
    }
}
?>