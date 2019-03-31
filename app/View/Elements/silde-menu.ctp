<aside class="left-nav visible-desktop">
	<div class="nav-container">
		<div class="nav-parent">
			<div class="row-brand text-center">
				<a href="index.html">
					
					<img src="img/fedhar.png" alt="">
				</a>
			</div>
			<div class="row-navbar">
				<ul class="list-unstyled verticle-nav">
					<li><a class="active" href="/">Home</a></li>
					<li><a href="how-it-works">About</a></li>
					<li><a href="contactus">Contact</a></li>
					<?php if (!$this->Auth->sessionValid()) {?>
						<li><?php echo $this->Html->link(__l('Login'), array('controller' => 'users', 'action' => 'login', 'admin' => false), array('title' => __l('Login')));?></li>
						<li><?php echo $this->Html->link(__l('Register'), array('controller' => 'users', 'action' => 'register', 'type' => 'social', 'admin' => false), array('title' => __l('Register')));?></li>
					<?php } else {?>
						<li><?php echo $this->Html->link(__l('My Account'), array('controller' => 'user_profiles', 'action' => 'edit', $this->Auth->user('id')), array('class' => 'js-no-pjax', 'title' => __l('My Account')));?></li>
						<li><?php echo $this->Html->link(__l('Logout'), array('controller' => 'users', 'action' => 'logout'), array('class' => 'js-no-pjax', 'title' => __l('Logout')));?></li>
					<?php }?>
				</ul>
			</div>
			<div class="row-social text-center">
				<ul class="list-inline">
					<li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
					<li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
					<li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
					<li class="list-inline-item"><a href="#"><i class="fa fa-behance"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</aside>