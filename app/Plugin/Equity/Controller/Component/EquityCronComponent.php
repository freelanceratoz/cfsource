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
class EquityCronComponent extends Component
{
    public function main() 
    {
        App::import('Model', 'Equity.Equity');
        $this->Equity = new Equity();
        $projects = $this->Equity->find('all', array(
            'conditions' => array(
                'Project.is_draft' => 0,
                'Equity.equity_project_status_id' => array(
                    ConstEquityProjectStatus::OpenForInvesting
                ) ,
            ) ,
            'contain' => array(
                'Project'
            ) ,
            'recursive' => 0
        ));
        foreach($projects as $project) {
            if (($project['Project']['collected_amount'] >= $project['Project']['needed_amount'] && strtotime($project['Project']['project_end_date'] . ' 23:55:59') <= strtotime(date('Y-m-d H:i:s'))) || (strtotime($project['Project']['project_end_date'] . ' 23:55:59') <= strtotime(date('Y-m-d H:i:s')) && $project['Project']['payment_method_id'] == ConstPaymentMethod::KiA)) {
                if (empty($project['Project']['project_fund_count'])) {
                    $this->Equity->updateStatus(ConstEquityProjectStatus::ProjectExpired, $project['Project']['id']);
                } else {
                    $this->Equity->updateStatus(ConstEquityProjectStatus::ProjectClosed, $project['Project']['id']);
                }
            } elseif (strtotime($project['Project']['project_end_date'] . ' 23:55:59') <= strtotime(date('Y-m-d H:i:s'))) {
                $this->Equity->updateStatus(ConstEquityProjectStatus::ProjectExpired, $project['Project']['id']);
            }
        }
    }
}
