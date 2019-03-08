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
CmsNav::add('analytics', array(
    'title' => __l('Analytics') ,
    'icon-class' => 'bar-chart',
    'weight' => 11,
    'children' => array(
        'google_analytics' => array(
            'title' => __l('Google Analytics') ,
            'url' => array(
                'admin' => true,
                'controller' => 'google_analytics',
                'action' => 'analytics_chart',
            ) ,
            'htmlAttributes' => array(
                'class' => 'js-no-pjax'
            ) ,
            'weight' => 10,
        ) ,
    )
));
CmsHook::setJsFile(array(
    APP . 'Plugin' . DS . 'IntegratedGoogleAnalytics' . DS . 'webroot' . DS . 'js' . DS . 'common.js'
) , 'default');
?>