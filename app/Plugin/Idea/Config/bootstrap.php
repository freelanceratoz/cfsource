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
CmsNav::add('activities', array(
    'title' => __l('Activities') ,
    'weight' => 30,
    'children' => array(
        'Project Ratings' => array(
            'title' => sprintf(__l('%s Votings') , Configure::read('project.alt_name_for_project_singular_caps')) ,
            'url' => array(
                'controller' => 'project_ratings',
                'action' => 'index',
            ) ,
            'weight' => 10,
        ) ,
    ) ,
));
$defaultModel = array();
$pluginModel = array();
if (isPluginEnabled('Projects')) {
    $pluginModel = array(
        'Project' => array(
            'hasMany' => array(
                'ProjectRating' => array(
                    'className' => 'Idea.ProjectRating',
                    'foreignKey' => 'project_id',
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
            ) ,
        ) ,
        'Message' => array(
            'belongsTo' => array(
                'ProjectRating' => array(
                    'className' => 'Idea.ProjectRating',
                    'foreignKey' => 'foreign_id',
                    'conditions' => '',
                    'fields' => '',
                    'order' => '',
                ) ,
            ) ,
        ) ,
    );
    $defaultModel = $defaultModel+$pluginModel;
}
CmsHook::setExceptionUrl(array(
    'project_ratings/index',
));
CmsHook::bindModel($defaultModel);
