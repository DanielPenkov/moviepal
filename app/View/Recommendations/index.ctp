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

    echo $this->Html->script('jquery-1.11.2');
    echo $this->Html->script('bootstrap');
    echo $this->Html->script('moviepal');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>
</head>
<body>
  <div id="container">



<h1>Recommend</h1>

    <?php foreach ($users as $user): ?>
 
      <div class="col-md-6 col-sm-6 col-xs-6">
        
        <div class="friend-container">

          <div class="friend-image">
            <?php echo $this->Html->image('/app/webroot/img/user-alt-128.png', array( "alt" => "user-img",'height'=>80, 
                    'width'=>80, 'url' => array('controller' => 'recommendations', 'action' => 'recommend',$user['users']['id'], 
                    $movie_id)));?>
          </div>


          <div class="friend-info">
            <div class="friend-name">
              <span class="title"><?php echo $user['users']['username']; ?></span>
            </div>
            
          </div>

        </div>
      </div>

    <?php endforeach; ?>

    </div>
    </body>
