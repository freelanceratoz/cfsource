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
class CloudFlareBehavior extends ModelBehavior
{
    /**
     * Setup
     *
     * @param object $model
     * @param array  $config
     * @return void
     */
    public function beforeDelete(Model $model, $cascade = true) 
    {
        $this->deleteCloudFlareCache($model);
        parent::beforeDelete($model);
    }
    public function afterSave(Model $model, $created) 
    {
        $this->deleteCloudFlareCache($model);
        parent::afterSave($model, $created);
    }
    public function deleteCloudFlareCache($Model) 
    {
        App::uses('HttpSocket', 'Network/Http');
        $HttpSocket = new HttpSocket();
        if ($Model->alias == 'Project') {
            App::import('Model', 'Projects.Project');
        } else {
            App::import('Model', $Model->alias);
        }
        $model_obj = new $Model->alias();
        $data = $model_obj->find('first', array(
            'conditions' => array(
                $Model->alias . '.id =' => $Model->data[$Model->alias]['id'],
            ) ,
            'recursive' => -1
        ));
        $z = Router::url('/', true);
        $url_arr = array();
        if ($Model->alias == 'Project') {
            $slug = $data[$Model->alias]['slug'];
            $url = Router::url(array(
                'controller' => $Model->useTable,
                'action' => 'view',
                $slug,
                'admin' => false
            ) , true);
            $url_arr = array(
                $url,
                $z
            );
        } else if ($Model->alias == 'User') {
            $slug = $data[$Model->alias]['username'];
            $url = Router::url(array(
                'controller' => $Model->useTable,
                'action' => 'view',
                $slug,
                'admin' => false
            ) , true);
            $url_arr = array(
                $url
            );
        }
        foreach($url_arr as $url) {
            $httpResponse = $HttpSocket->post('https://www.cloudflare.com/api_json.html', 'a=zone_file_purge&tkn=' . configure::read('cloudflare.token') . '&email=' . configure::read('cloudflare.email') . '&z=' . $z . '&url=' . $url);
        }
    }
}
