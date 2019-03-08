<?php
/**
 *
 * @package		Crowdfunding
 * @author 		siva_063at09
 * @copyright 	Copyright (c) 2012 {@link http://www.agriya.com/ Agriya Infoway}
 * @license		http://www.agriya.com/ Agriya Infoway Licence
 * @since 		2012-03-07
 *
 */
class SocialMarketingCronComponent extends Component
{
    public function daily()
    {
        App::import('Model', 'SocialMarketing.SocialMarketing');
        $this->SocialMarketing = new SocialMarketing();
		if (empty($_GET) && !defined('STDIN')) {
			$this->SocialMarketing->updateSocialActivityCount();
		}
    }
}