<li><span class="text-muted"><i class="fa-fw fa fa-chevron-right small"></i></span><?php echo $this->Html->link(sprintf(__l('%s - Pending For Approval'), Configure::read('project.alt_name_for_pledge_singular_caps')) . ' (' . $pledge_pending_for_approval_count. ')', array('controller' => 'pledges', 'action' => 'index', 'project_status_id' => ConstPledgeProjectStatus::PendingAction), array('class' => 'h5 rgt-move'));?> </li>