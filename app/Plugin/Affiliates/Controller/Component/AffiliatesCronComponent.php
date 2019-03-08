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
class AffiliatesCronComponent extends Component
{
    public function main() 
    {
        App::import('Model', 'Affiliates.Affiliate');
        $this->Affiliate = new Affiliate();
        $this->Affiliate->update_affiliate_status();
    }
}
