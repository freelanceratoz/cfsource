<?php $select_range_id=$this->request->params['named']['select_range_id'];?>
<div class="js-cache-load js-cache-load-admin-charts {'data_url':'admin/google_analytics/chart_bounces/select_range_id:<?php echo $select_range_id;?>/from_section:metrics', 'data_load':'js-cache-load-admin-chart-bounces'}">
	<section class="col-md-10 center-box js-cache-load-admin-chart-bounces">
		<?php echo $this->element('chart-admin_chart_bounces', array('select_range_id' => $select_range_id, 'from_section'=>'metrics','cache' => array('config' => 'site_element_cache_15_min'))); ?>
	</section>
	<div class="clearfix js-cache-load js-cache-load-admin-charts {'data_url':'admin/google_analytics/chart_visitors/select_range_id:<?php echo $select_range_id;?>/from:chart_metrics', 'data_load':'js-cache-load-admin_chart_visitors'}">
		<?php echo $this->element('chart-admin_chart_visitors', array('select_range_id' => $select_range_id, 'from' => 'chart_metrics', 'cache' => array('config' => 'site_element_cache_15_min'))); ?>
	</div>
</div>