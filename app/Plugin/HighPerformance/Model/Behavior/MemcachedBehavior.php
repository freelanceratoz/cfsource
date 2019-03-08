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
class MemcachedBehavior extends ModelBehavior
{
    /**
     * Setup
     *
     * @param object $model
     * @param array  $config
     * @return void
     */
    private function _updateCounter($model) 
    {
        $tag = !empty($model->name) ? '_' . $model->name : 'appmodel';
        Cache::write($tag, 1+(int)Cache::read($tag, 'queries') , 'queries');
        $this->_updateAssociatedModelCounter($model);
    }
	private function _updateAssociatedModelCounter($model) 
    {
    	//Quick fix Start
    	if($model->name == 'FormFieldGroup') {
    		$mem_models = array('FormField', 'FormFieldStep');
    		foreach($mem_models as $associatedModel) {
    			$tag = '_' . $associatedModel;
    			Cache::write($tag, 1+(int)Cache::read($tag, 'queries') , 'queries');
    		}
    	}
    	//Quick fix End
		if (!empty($model->_memcacheModels)) {
			foreach($model->_memcacheModels as $associatedModel) {
				$tag = '_' . $associatedModel;
				Cache::write($tag, 1+(int)Cache::read($tag, 'queries') , 'queries');
			}
		}
	}
    public function afterDelete(Model $model) 
    {
        $this->_updateCounter($model);
        parent::afterDelete($model);
    }
    public function afterSave(Model $model, $created) 
    {
        $this->_updateCounter($model);
        parent::afterSave($model, $created);
    }
}
