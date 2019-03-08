<?php
/**
 *
 * @package		360Contest
 * @author 		siva_063at09
 * @copyright 	Copyright (c) 2012 {@link http://www.agriya.com/ Agriya Infoway}
 * @license		http://www.agriya.com/ Agriya Infoway Licence
 * @since 		2012-03-07
 *
 */
class FriendsDetailsComponent extends Component
{
    public function startup(Controller $controller) 
    {
        App::import('Model', 'SocialMarketing.UserFollower');
        $this->UserFollower = new UserFollower();
        if (!empty($_SESSION['Auth']['User']['id'])) {
            $userFollowers = $this->UserFollower->find('list', array(
                'conditions' => array(
                    'UserFollower.user_id' => $_SESSION['Auth']['User']['id']
                ) ,
                'fields' => array(
                    'UserFollower.id',
                    'UserFollower.followed_user_id',
                )
            ));
            Configure::write('site.friend_ids', $userFollowers);
        }
    }
}
