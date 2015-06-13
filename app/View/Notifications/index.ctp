
<div>
<h2>Notifications</h2>

 <?php foreach ($notifications as $notification): ?>


 	<?php if ($notification['Notification']['type'] == 1):?>
 		<div> <h3>Friend requests</h3></div>
  
	<div class="col-md-3 col-sm-4 col-xs-12">
        
        <div class="friend-container">

          <div class="friend-image">
            <?php echo $this->Html->image('/app/webroot/img/user-alt-128.png', array( "alt" => "user-img",'height'=>80, 
                    'width'=>80, 'url' => array('controller' => 'users', 'action' => 'publicProfile',$notification['User']['id'])));?>
          </div>

          <div class="friend-info">
            <div class="friend-name">
              <span class="title"><?php echo $notification['User']['username']; ?></span>
            </div>
            
          </div>

            
                 <?php if ($notification['Notification']['status'] == 0):?>

          <div class="user-notification-buttons">
          	<span> <?php echo $this->Html->link( 'Accept' , array('controller' => 'notifications','action' => 'acceptFriendRequest',$notification['Notification']['id'], $notification['User']['id'] ), array('escape' => false,'confirm' => 'Accept?')); ?></span>

          	 <span style="  margin-left: 100px;"><?php echo $this->Html->link( 'Ignore' , array('controller' => 'notifications','action' => 'ignoreFriendRequest',$notification['Notification']['id'] ), array('escape' => false,'confirm' => 'Ignore?')); ?> </span>
          </div>
          <?php endif; ?>
        </div>
      </div>

	<?php endif; ?>

	 	<?php if ($notification['Notification']['type'] == 2):?>

	 		<div> <h3>Accepted friend requests</h3></div>
  
	<div class="col-md-3 col-sm-4 col-xs-12">
        
        <div class="friend-container">

          <div class="friend-image">
            <?php echo $this->Html->image('/app/webroot/img/user-alt-128.png', array( "alt" => "user-img",'height'=>80, 
                    'width'=>80, 'url' => array('controller' => 'users', 'action' => 'publicProfile',$notification['User']['id'])));?>
          </div>

          <div class="friend-info">
            <div class="friend-name">
              <span class="title"><?php echo $notification['User']['username']; ?></span>
            </div>
            
          </div>
          <div class="user-notification-buttons">

          	<span> <?php echo $this->Html->link( 'OK' , array('controller' => 'notifications','action' => 'acceptedFriendRequest',$notification['Notification']['id'], $notification['User']['id'] ), array('escape' => false,'confirm' => 'Accept?')); ?></span>

          </div>
        </div>
      </div>

	<?php endif; ?>



    <?php if ($notification['Notification']['type'] == 4):?>



      <div> <h3>Recommened Movies</h3></div>
  





    <div class="movie-title-profile">

      <span class="title"><?php echo $notification['Recommendation']['Movie']['title']; ?></span>
    </div>

    <div class="picture-container">

      
      <?php echo $this->Html->image($notification['Recommendation']['Movie']['poster'], array( "alt" => "Poster",'height'=>200, 
        'width'=>120,  'url' => array('controller' => 'movies', 'action' => 'index')));?>
    </div>


        <div class="movie-short-info">

        



















      <div> Recommended BY:</div> 
        
        <div class="friend-container">

          <div class="friend-image">
            <?php echo $this->Html->image('/app/webroot/img/user-alt-128.png', array( "alt" => "user-img",'height'=>80, 
                    'width'=>80, 'url' => array('controller' => 'users', 'action' => 'publicProfile',$notification['User']['id'])));?>
          </div>

          <div class="friend-info">
            <div class="friend-name">
              <span class="title"><?php echo $notification['User']['username']; ?></span>
            </div>
            
          </div>


          <div class="user-notification-buttons">

           <span> <?php echo $this->Html->link( 'Accept' , array('controller' => 'notifications','action' => 'acceptFriendRequest',$notification['Notification']['id'], $notification['User']['id'] ), array('escape' => false,'confirm' => 'Accept?')); ?></span>

             <span style="  margin-left: 100px;"><?php echo $this->Html->link( 'Ignore' , array('controller' => 'notifications','action' => 'ignoreFriendRequest',$notification['Notification']['id'] ), array('escape' => false,'confirm' => 'Ignore?')); ?> </span>
          </div>
        </div>
      </div>

    

  <?php endif; ?>

	
    	
    	

    <?php endforeach; ?>	

	



    </div>