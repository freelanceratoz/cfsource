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
require_once 'constants.php';
Cms::hookComponent('*', 'SocialMarketing.FriendsDetails');
if (!empty($_REQUEST['request_ids'])) {
    Cms::hookComponent('*', 'SocialMarketing.FacebookRequest');
}
$defaultModel = array(
    'User' => array(
        'hasMany' => array(
            'UserFollower' => array(
                'className' => 'SocialMarketing.UserFollower',
                'foreignKey' => 'followed_user_id',
                'dependent' => true,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'exclusive' => '',
                'finderQuery' => '',
                'counterQuery' => ''
            ) ,
            'FollowedUser' => array(
                'className' => 'SocialMarketing.UserFollower',
                'foreignKey' => 'user_id',
                'dependent' => true,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'exclusive' => '',
                'finderQuery' => '',
                'counterQuery' => ''
            ) ,
        )
    )
);
CmsHook::bindModel($defaultModel);
