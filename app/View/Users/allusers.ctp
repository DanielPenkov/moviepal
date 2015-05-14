<h1>Users</h1>

<?php echo $this->Session->flash('flash', array('element' => 'positive_flash')); ?>





<div class="row">
<?php foreach ($users as $user): ?>

  <div class="col-sm-4 col-md-3">
    <div class="thumbnail">

      <?php echo $this->Html->image('/app/webroot/img/user-alt-128.png', array( "alt" => "user-img",'height'=>200, 
                    'width'=>200));?>

      <div class="caption">
        <h3><?php echo $user['User']['username']; ?></h3>
        <p><?php echo $user['User']['email']; ?></p>
        <p><a href="#" class="btn btn-primary" role="button">View profile</a>


         <a onclick="addFriend(<?php echo $user['User']['id']; ?>)" "href="javascript:void(0);" class="btn btn-default" >Add to Friends</a></p>


      </div>
    </div>
  </div>

   <?php endforeach; ?>
</div>
