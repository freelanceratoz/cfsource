<?php
class SocialContactDetail extends AppModel
{
    public $name = 'SocialContactDetail';
    public $hasMany = array(
        'SocialContact' => array(
            'className' => 'SocialMarketing.SocialContact',
            'foreignKey' => 'social_contact_detail_id',
            'dependent' => true,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
}
?>