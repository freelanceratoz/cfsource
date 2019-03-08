<?php
$display_none_arr=array('');
$display_block_arr=array('');
$none_height_style=array('');

$pids= array('');
if(!empty($_GET['pids'])){$pids=$_GET['pids']; $pids=explode(',',$pids);}

$uids='';
$from='';
if(!empty($_GET['uids'])){$uids=$_GET['uids'];}
if(!empty($_GET['from'])){$from=$_GET['from'];}
//--Project follow starts here--//
if (isPluginEnabled('ProjectFollowers')) {
if(!empty($_GET['pids'])) {
	$fid[]=array('');
	if($this->Auth->user('id')) {
		foreach ($followingprojectIds as $followingprojects) {
			$fid[]=$followingprojects['ProjectFollower']['project_id'];
		}
	}

	for($i=0;$i<count($pids); $i++) {

		if(!$this->Auth->user('id')) {
			$display_none_arr[] = 'alpuf-sm-' . $pids[$i];
			$display_none_arr[] = 'alpf-'.$pids[$i];
			$display_none_arr[] = 'alpuf-'.$pids[$i];
			$display_block_arr[] = 'blpuf-'.$pids[$i];

		}
		else
		{
			$display_none_arr[] = 'blpuf-' . $pids[$i];
			if ((isPluginEnabled('SocialMarketing')) && ($from=='project_view')){
				$display_none_arr[] = 'alpf-' . $pids[$i];

				if (!in_array($pids[$i],$fid)) {
					$display_block_arr[] = 'alpuf-sm-' . $pids[$i];
					$display_none_arr[] = 'alpuf-' . $pids[$i];
				}
				else
				{
					$display_none_arr[] = 'alpuf-sm-' . $pids[$i];
					$display_block_arr[] = 'alpuf-' . $pids[$i];
				}

			} else {
				$display_none_arr[] = 'alpuf-sm-' . $pids[$i];

				if (!in_array($pids[$i],(array)$fid)) {
					$display_block_arr[] = 'alpuf-' . $pids[$i];
					$display_none_arr[] = 'alpf-' . $pids[$i];

				}else {
					$display_block_arr[] = 'alpf-' . $pids[$i];
					$display_none_arr[] = 'alpuf-' . $pids[$i];
				}
			}
		}
	}
}
}
//--Project follow ends here--//

//--Project rating starts here--//
if (isPluginEnabled('Idea')) {
if(!empty($_GET['pids'])) {
	$rid[]=array('');
	if($this->Auth->user('id')) {
		foreach ($ratedprojectIds as $ratedproject) {
			$rid[]=$ratedproject['ProjectRating']['project_id'];
		}
	}
	for($i=0;$i<count($pids); $i++) {

		if(!$this->Auth->user('id')) {
			$display_none_arr[] = 'alpv-'.$pids[$i];
			$display_none_arr[] = 'alpuv-'.$pids[$i];
			$display_block_arr[] = 'blpv-'.$pids[$i];

		}
		else
		{
			$display_none_arr[] = 'blpv-' . $pids[$i];
			if (!in_array($pids[$i],$rid)) {
				$display_block_arr[] = 'alpuv-' . $pids[$i];
				$display_none_arr[] = 'alpv-' . $pids[$i];

			}else {
				$display_block_arr[] = 'alpv-' . $pids[$i];
				$display_none_arr[] = 'alpuv-' . $pids[$i];
			}

		}
	}
}
}
//--Project owner project control panel--//
if(!empty($_GET['pids'])) {
	if($this->Auth->user('id')) {
		$own_project_id[]='';
		foreach ($ownprojectIds as $ownprojects) {
			$own_project_id[]=$ownprojects['Project']['id'];
		}
		$own_project_id=implode(',',$own_project_id);
		$own_project_id=explode(',',$own_project_id);
		if (in_array($pids[0],(array)$own_project_id)) {
			$display_block_arr[] = 'alppcp';
		}
	} else {
		$display_none_arr[] = 'alppcp';
	}
}

//--Project rating ends here--//

//--Project fund starts here--//
if(!empty($_GET['pids'])) {
	if($this->Auth->user('id')) {
		$own_project_id[]='';
		$open_project_id[]='';
		foreach ($ownprojectIds as $ownprojects) {
			$own_project_id[]=$ownprojects['Project']['id'];
		}
		$own_project_id=implode(',',$own_project_id);
		$own_project_id=explode(',',$own_project_id);

		foreach ($openedprojectIds as $openedprojec) {
			$open_project_id[]=$openedprojec['Project']['id'];
		}
		$open_project_id=implode(',',$open_project_id);
		$open_project_id=explode(',',$open_project_id);
	}


	for($i=0;$i<count($pids); $i++) {



			if(!$this->Auth->user('id')) {
				$display_none_arr[] = 'alof-' . $pids[$i];
				$display_block_arr[] = 'blf-' . $pids[$i];
				$display_none_arr[] = 'alf-' . $pids[$i];
				$display_none_arr[] = 'ablfc-' . $pids[$i];
			}
			else
			{
				$display_none_arr[] = 'blf-' . $pids[$i];
				if (!in_array($pids[$i],(array)$open_project_id)) {
					$display_none_arr[] = 'alof-' . $pids[$i];
					$display_block_arr[] = 'ablfc-' . $pids[$i];
					$display_none_arr[] = 'alf-' . $pids[$i];

				} else if (in_array($pids[$i],(array)$own_project_id)) {
					$display_block_arr[] = 'alof-' . $pids[$i];
					$display_none_arr[] = 'alf-' . $pids[$i];
					$display_none_arr[] = 'ablfc-' . $pids[$i];
				}else {
					$display_none_arr[] = 'alof-' . $pids[$i];
					$display_block_arr[] = 'alf-' . $pids[$i];
					$display_none_arr[] = 'ablfc-' . $pids[$i];
				}
			}

	}
}
//--project fund ends here--//

//--user follow starts here--//
if(!empty($_GET['uids'])) {
	if($this->Auth->user('id')) {
		$uid[]=array('');
		foreach ($followinguserIds as $followinguser) {
			$uid[]=$followinguser['UserFollower']['followed_user_id'];
		}
	}
	if(!$this->Auth->user('id')) {
		$display_block_arr[] = 'blu-f-'.$uids;
		$display_none_arr[] = 'alu-f-'.$uids;
		$display_none_arr[] = 'alou-f-'.$uids;
		$display_none_arr[] = 'alu-uf-'.$uids;
	}
	else
	{
		$display_none_arr[] = 'blu-f-'.$uids;
		if($this->Auth->user('id')==$uids)
		{
			$display_none_arr[] = 'alu-f-'.$uids;
			$display_block_arr[] = 'alou-f-'.$uids;
			$display_none_arr[] = 'alu-uf-'.$uids;
		} else {
			$display_none_arr[] = 'alou-f-'.$uids;
			if (!in_array($uids,$uid)) {
				$display_block_arr[] = 'alu-f-'.$uids;
				$display_none_arr[] = 'alu-uf-'.$uids;
			}else {
				$display_none_arr[] = 'alu-f-'.$uids;
				$display_block_arr[] = 'alu-uf-'.$uids;
			}
		}
	}
}
//--user follow ends here--//

//--user send msg starts here--//
if(!$this->Auth->user('id')) {
	$display_block_arr[] = 'blu-sm-'.$uids;
	$display_none_arr[] = 'alu-sm-'.$uids;
	$display_none_arr[] = 'alou-sm-'.$uids;
} else {
	if($this->Auth->user('id')==$uids) {
		$display_none_arr[] = 'alu-sm-'.$uids;
		$display_block_arr[] = 'alou-sm-'.$uids;
	}else {
		$display_block_arr[] = 'alu-sm-'.$uids;
		$display_none_arr[] = 'alou-sm-'.$uids;
	}
	$display_none_arr[] = 'blu-sm-'.$uids;
}
//--user send msg ends here--//

//--admin user and project control panel--//
if ($this->Auth->sessionValid() && $this->Auth->user('role_id') == ConstUserTypes::Admin) {
	$display_block_arr[] = 'alab';
} else {
	$display_none_arr[] = 'alab';
}

//--User header--//
$head_style = '';
if ($this->Auth->sessionValid()) {
	if ($this->Auth->user('role_id') != ConstUserTypes::Admin) {
	  if (($this->request->url == '') || ($this->request->url == "projects/start")) {
		$head_style = '.js-hp-header{ padding-top: 60px; }';
	  }
	}
}
//--user header--//

//--project affix header--//
$project_affix_style = '';
if ($this->Auth->sessionValid()) {
	if ($this->Auth->user('role_id') == ConstUserTypes::Admin) {
		$project_affix_style = '.hp-affix{ top: 105px; }';
	} else {
		$project_affix_style = '.hp-affix{ top: 65px; }';
	}
}
//--user header--//

//--Report Project--//
if (isPluginEnabled('ProjectFlags')) {
	if(!empty($_GET['pids'])) {
		if($this->Auth->user('id') ) {
			$own_project_id[]='';
			foreach ($ownprojectIds as $ownprojects) {
				$own_project_id[]=$ownprojects['Project']['id'];
			}
			$own_project_id=implode(',',$own_project_id);
			$own_project_id=explode(',',$own_project_id);
			if (!in_array($pids[0],(array)$own_project_id)) {
				$display_block_arr[] = 'aurp';
			}
			$display_none_arr[] = 'burp';
		} else {
			$display_block_arr[] = 'burp';
			$display_none_arr[] = 'aurp';
		}
	}
}
//--Report Project--//

$none_style=implode(', .',$display_none_arr);
$none_style_height=implode(', .',$display_none_arr);
$none_style = substr($none_style, 1); //to remove 1st ',' from the array
$none_style_height = substr($none_style_height, 1); //to remove 1st ',' from the array
$none_style = $none_style.' { display: none; }';
$none_height_style = $none_style_height.' { height: 0px; }';

$block_style=implode(', .', $display_block_arr);
$block_style = substr($block_style, 1); //to remove 1st ',' from the array
$block_style=$block_style.' { display: block; }';


echo preg_replace('/(\>)\s+(<?)/', '$1$2', $block_style);
echo preg_replace('/(\>)\s+(<?)/', '$1$2', $none_style);
echo preg_replace('/(\>)\s+(<?)/', '$1$2', $none_height_style);
echo preg_replace('/(\>)\s+(<?)/', '$1$2', $head_style);
echo preg_replace('/(\>)\s+(<?)/', '$1$2', $project_affix_style);
?>