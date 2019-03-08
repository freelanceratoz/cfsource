<?php
class SocialContact extends AppModel
{
    public $name = 'SocialContact';
    public $belongsTo = array(
        'SocialContactDetail' => array(
            'className' => 'SocialMarketing.SocialContactDetail',
            'foreignKey' => 'social_contact_detail_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true,
        ) ,
    );
    function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
    }
}
?>