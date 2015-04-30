<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-theme');  
		echo $this->Html->css('bootstrap.min');

		echo $this->Html->script('jquery-1.11.2');
		echo $this->Html->script('bootstrap');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
	
			<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>  
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    	<span class='navbar-brand'>   <?php echo $this->Html->link('MoviePal', array('controller' => 'movies','action' => 'index'));?>  </span>
      <ul class="nav navbar-nav">
        <li ><?php echo $this->Html->link('Movies', array('controller' => 'movies','action' => 'index'));?></li>
        <li ><?php echo $this->Html->link('TV Series', array('controller' => 'movies','action' => 'tv_index'));?></li>
       
      </ul>
      <ul class="nav navbar-nav" id="login-panel">

		<?php if ($loggedIn):?>
    		<li><?php echo $this->Html->link('Hello, '.$userName, array('controller' => 'movies','action' => 'index'));?></li>
      		<li><?php echo $this->Html->link('Logout', array('controller' => 'users','action' => 'logout'));?></li>
    		
		<?php else: ?>
			<li><?php echo $this->Html->link('Login', array('controller' => 'users','action' => 'login'));?></li>
      		<li><?php echo $this->Html->link('Register', array('controller' => 'users','action' => 'add'));?></li>
		<?php endif; ?>

      </ul>
        
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
		
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
