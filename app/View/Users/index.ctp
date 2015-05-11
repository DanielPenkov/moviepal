 


<div class="row">

 <div class="page-title"><h1>Watching List</h1></div>

<?php foreach ($to_watch_movies as $movie): ?>

  <div class="col-sm-4 col-md-3">



    <div class="thumbnail">
      <?php echo $this->Html->image($movie['movies']['poster'], array( "alt" => "Poster",'height'=>250, 
        'width'=>200,  'url' => array('controller' => 'movies', 'action' => 'index')));?>
      <div class="caption">
        <h3><?php echo $movie['movies']['title']; ?></h3>

        
      <a onclick="addToWatchedList(<?php echo $movie['movies']['id']; ?>)" "href="javascript:void(0);" class="btn btn-default" >Watched</a>

          <?php echo $this->Html->link( 'Delete' , array('controller' => 'movies','action' => 'deleteUserMovie',$movie['movies']['id'] ), array('escape' => false,'confirm' => 'Add movie to Watching List?','class' => 'btn btn-default')); ?>
        
         
          <a onclick="PopupCenterDual('/moviepal/recommendations/index/<?php echo $movie['movies']['id']?>','MoviePal','450','450');" href="javascript:void(0);" class="btn btn-default">Recommend</a></p>
      </div>
    </div>

   

  </div>

<?php endforeach; ?>
      
    <div style="float:right;">
      
      <a  href="#" class="btn btn-default">Show watching list</a>

    </div>



</div>

<div class="row">

 <div class="page-title"><h1>Watched List</h1></div>

<?php foreach ($watched_movies as $movie): ?>

  <div class="col-sm-4 col-md-3">



    <div class="thumbnail">
      <?php echo $this->Html->image($movie['movies']['poster'], array( "alt" => "Poster",'height'=>250, 
        'width'=>200,  'url' => array('controller' => 'movies', 'action' => 'index')));?>
      <div class="caption">
        <h3><?php echo $movie['movies']['title']; ?></h3>

        
        <p> <?php echo $this->Html->link( 'Watched' , array('controller' => 'movies','action' => 'addMovieWatchedList',$movie['movies']['id'] ), array('escape' => false,'confirm' => 'Add movie to Watching List?','class' => 'btn btn-primary')); ?>

          <?php echo $this->Html->link( 'Delete' , array('controller' => 'movies','action' => 'deleteUserMovie',$movie['movies']['id'] ), array('escape' => false,'confirm' => 'Add movie to Watching List?','class' => 'btn btn-default')); ?>
        
         
          <a onclick="PopupCenterDual('/moviepal/recommendations/index/<?php echo $movie['movies']['id']?>','MoviePal','450','450');" href="javascript:void(0);" class="btn btn-default">Recommend</a></p>
      </div>
    </div>

   

  </div>

<?php endforeach; ?>

</div>



<div class="row">

 <div class="page-title"><h1>Recommended List</h1></div>

<?php foreach ($recommended_movies as $movie): ?>

  <div class="col-sm-4 col-md-3">



    <div class="thumbnail">
      <?php echo $this->Html->image($movie['movies']['poster'], array( "alt" => "Poster",'height'=>250, 
        'width'=>200,  'url' => array('controller' => 'movies', 'action' => 'index')));?>
      <div class="caption">
        <h3><?php echo $movie['movies']['title']; ?></h3>

        
        <p> <?php echo $this->Html->link( 'Watched' , array('controller' => 'movies','action' => 'addMovieWatchedList',$movie['movies']['id'] ), array('escape' => false,'confirm' => 'Add movie to Watching List?','class' => 'btn btn-primary')); ?>

          <?php echo $this->Html->link( 'Delete' , array('controller' => 'movies','action' => 'deleteUserMovie',$movie['movies']['id'] ), array('escape' => false,'confirm' => 'Add movie to Watching List?','class' => 'btn btn-default')); ?>
        
         
          <a onclick="PopupCenterDual('/moviepal/recommendations/index/<?php echo $movie['movies']['id']?>','MoviePal','450','450');" href="javascript:void(0);" class="btn btn-default">Recommend</a></p>
      </div>
    </div>

   

  </div>

<?php endforeach; ?>

</div>





