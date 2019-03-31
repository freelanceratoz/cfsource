<!DOCTYPE html>
<html lang="<?php echo isset($_COOKIE['CakeCookie']['user_language']) ?  strtolower($_COOKIE['CakeCookie']['user_language']) : strtolower(Configure::read('site.language')); ?>">
<head>
       <?php echo $this->Html->charset(), "\n";?>
		<title><?php echo $this->Html->cText(Configure::read('site.name'), false) . ' | ' . $this->Html->cText($title_for_layout, false); ?></title>
		<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js"></script>
		<![endif]-->
		<?php
		echo $this->Html->meta('icon'), "\n";
		?>
		<?php
		if (!empty($meta_for_layout['keywords'])):
		echo $this->Html->meta('keywords', $meta_for_layout['keywords']), "\n";
		endif;
		?>
		<?php
		if (!empty($meta_for_layout['description'])):
		echo $this->Html->meta('description', $meta_for_layout['description']), "\n";
		endif;
		?>
		<?php if (!empty($this->theme)) { ?>
			<link rel="apple-touch-icon" href="<?php echo Router::url('/') . 'theme/' . $this->theme; ?>/apple-touch-icon.png">
			<link rel="apple-touch-icon" sizes="72x72" href="<?php echo Router::url('/') . 'theme/' . $this->theme; ?>/apple-touch-icon-72x72.png" />
			<link rel="apple-touch-icon" sizes="114x114" href="<?php echo Router::url('/') . 'theme/' . $this->theme; ?>/apple-touch-icon-114x114.png" />
		<?php } else { ?>
			<link rel="apple-touch-icon" href="<?php echo Router::url('/'); ?>apple-touch-icon.png">
			<link rel="apple-touch-icon" sizes="72x72" href="<?php echo Router::url('/'); ?>apple-touch-icon-72x72.png" />
			<link rel="apple-touch-icon" sizes="114x114" href="<?php echo Router::url('/'); ?>apple-touch-icon-114x114.png" />
		<?php } ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<![endif]--> 
		<link href="<?php echo Router::url(array('controller' => 'feeds', 'action' => 'index', 'ext' => 'rss', 'admin' => false), true);?>" type="application/rss+xml" rel="alternate" title="RSS Feeds"/>   
		<meta content="<?php echo Configure::read('facebook.app_id');?>" property="og:app_id" />
		<meta content="<?php echo Configure::read('facebook.app_id');?>" property="fb:app_id" />
		<?php if (!empty($meta_for_layout['title'])) { ?>
			<meta property="og:title" content="<?php echo $this->Html->cText($meta_for_layout['title'], false);?>"/>
		<?php }else if(!empty($meta_for_layout['project_name'])){ ?>
			<meta property="og:title" content="<?php echo $this->Html->cText($meta_for_layout['project_name'], false);?>"/>
		<?php } ?>
		<?php if(!empty($meta_for_layout['project_description'])) { ?>
			<meta property="og:description" content="<?php echo $this->Html->cHtml($meta_for_layout['project_description'], false);?>" />
		<?php } ?>
		<?php if (!empty($meta_for_layout['project_image'])) { ?>
			<meta property="og:image" content="<?php echo $this->Html->cText($meta_for_layout['project_image'], false);?>"/>
		<?php } else { ?>
		<?php if (!empty($this->theme)) { ?>
			<meta property="og:image" content="<?php echo Router::url('/', true) . 'theme/' . $this->theme . '/img/Fedhar.png';?>"/>
		<?php } else { ?>
			<meta property="og:image" content="<?php echo Router::url('/', true) . 'img/Fedhar.png';?>"/>
		<?php } ?>
		<?php } ?>
		<?php if(!empty($meta_for_layout['project_url'])) { ?>
			<meta property="og:url" content="<?php echo $this->Html->cText($meta_for_layout['project_url'], false);?>" />
		<?php }?>
			<meta property="og:site_name" content="<?php echo $this->Html->cText(Configure::read('site.name'), false); ?>"/>
		<?php if (Configure::read('facebook.fb_user_id')): ?>
			<meta property="fb:admins" content="<?php echo Configure::read('facebook.fb_user_id'); ?>"/>
		<?php endif; ?>
		<?php
		echo $this->element('site_tracker', array('cache' => array('config' => 'sec')));
		$response = Cms::dispatchEvent('View.IntegratedGoogleAnalytics.pushScript', $this);
		echo !empty($response->data['content']) ? $response->data['content'] : '';
		?>
		<?php echo $scripts_for_layout; ?>
		<?php
		if (env('HTTP_X_PJAX') != 'true') {
			echo $this->fetch('highperformance');
		}
		?>
        <link href="<?php echo $this->webroot; ?>img/asset/css/plugins/plugins.css" rel="stylesheet">
        <link href="<?php echo $this->webroot; ?>img/asset/linearicons/fonts.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>img/asset/masterslider/style/masterslider.css" />
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>img/asset/css/master-slider-custom.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>img/asset/cubeportfolio/css/cubeportfolio.min.css">
        <link href="<?php echo $this->webroot; ?>img/asset/css/style.css" rel="stylesheet">
    </head>

    <body>
        <div id="preloader">
            <div id="preloader-inner"></div>
        </div>
        <?php echo $this->element('header-menu-new'); ?>
		<section class="page-wrapper">
            <div class="page-content">
				<?php echo $this->element('silde-menu'); ?>
                <main class="main-content">
					<?php echo $content_for_layout;?>
                   <?php echo $this->element('footer-new'); ?>
                </main>
            </div>
        </section>
        <a href="#" class="back-to-top" id="back-to-top"><i class="icon-chevron-up"></i></a>
        <script type="text/javascript" src="<?php echo $this->webroot; ?>img/asset/js/plugins/plugins.js"></script> 
        <script type="text/javascript" src="<?php echo $this->webroot; ?>img/asset/js/archi.custom.js"></script> 
        <script type="text/javascript" src="<?php echo $this->webroot; ?>img/asset/masterslider/masterslider.min.js"></script> 
        <script type="text/javascript" src="<?php echo $this->webroot; ?>img/asset/js/master-slider-home.js"></script> 
        <script type="text/javascript" src="<?php echo $this->webroot; ?>img/asset/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot; ?>img/asset/js/portfolio-2col-custom.js"></script> 
    </body>
</html>