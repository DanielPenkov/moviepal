<h1>Friends</h1>

    <?php foreach ($users as $user): ?>
 
      <div class="col-md-3 col-sm-4 col-xs-12">
        
        <div class="friend-container">

          <div class="friend-image">
            <?php echo $this->Html->image('/app/webroot/img/user-alt-128.png', array( "alt" => "user-img",'height'=>80, 
                    'width'=>80, 'url' => array('controller' => 'users',
                     'action' => 'publicProfile',$user['User']['id'])));?>
          </div>

          <div class="friend-info">
            <div class="friend-name">
              <span class="title"><?php echo $user['User']['username']; ?></span>
            </div>
            
          </div>

        </div>
      </div>

    <?php endforeach; ?>