<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$cakeDescription = __d('MoviePal','MoviePal');
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="initial-scale=1">
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
		echo $this->Html->css('sweetalert');
		echo $this->Html->css('jquery.autocomplete');

		echo $this->Html->script('jquery-1.11.2');
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('moviepal');
		echo $this->Html->script('sweetalert.min');
		echo $this->Html->script('sweetalert-dev');
		echo $this->Html->script('jquery.autocomplete');
		echo $this->Html->script('jquery.autocomplete.min');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
	
			<nav class="navbar navbar-default navbar-fixed-top">
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


    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

    	<span class='navbar-brand'>   <?php echo $this->Html->link('MoviePal', array('controller' => 'movies','action' => 'index'));?>  </span>
    	
      <ul class="nav navbar-nav">
        <li ><?php echo $this->Html->link('Movies', array('controller' => 'movies','action' => 'index'));?></li>
        <li ><?php echo $this->Html->link('TV Series', array('controller' => 'movies','action' => 'tv_index'));?></li>


        <?php if ($loggedIn):?>
    	<li><?php echo $this->Html->link('My Profile', array('controller' => 'users','action' => 'index'));?></li>
    	<li><?php echo $this->Html->link('All Users', array('controller' => 'users','action' => 'allusers'));?></li>
    	<li><?php echo $this->Html->link('Friends', array('controller' => 'users','action' => 'friends'));?></li>
    	<li id="notification-menu"><?php echo $this->Html->link('Notifications', array('controller' => 'notifications','action' => 'index',$userId));?></li>
    	<li id="badge"> <a id='badge-link'> <span class="badge"><?php echo $vat?></span></a></li>
<?php endif; ?>

			

      </ul>

        <ul class="nav navbar-nav" id="menu-login">

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
