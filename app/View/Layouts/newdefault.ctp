<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Fedhar</title>    
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