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
class AffiliateStatus extends AppModel
{
    public $name = 'AffiliateStatus';
    public $displayField = 'name';
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $hasMany = array(
        'Affiliate' => array(
            'className' => 'Affiliates.Affiliate',
            'foreignKey' => 'affiliate_status_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
    }
}
?>