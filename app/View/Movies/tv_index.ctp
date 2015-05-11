
<div class="jumbotron">
<div style="margin:50px; width: 500px">
<h1>TV Series</h1>
</div>
</div>


  <?php foreach ($movies as $movie): ?>
 
      <div class="col-md-3 col-sm-6 col-xs-12">
        
        <div class="movie-container">

          <div class="movie-title">
              <div class="title"><?php echo $movie['Movie']['title']; ?></div>
              <div class="rating-block">
                <span> Year: <?php echo $movie['Movie']['year']; ?> | </span>
                <span> Rating: <?php echo $movie['Movie']['rating']; ?></span>


              </div>
          </div>

          <div class="buttons">

              <div class="btn btn-success">

                <?php echo $this->Html->link( 'To Watch' , array('controller' => 'movies','action' => 'addMovieWatchingList',$movie['Movie']['id'] ), array('escape' => false,'confirm' => 'Add movie to Watching List?')); ?>

                </div>

                <div class="btn btn-warning">

               <?php echo $this->Html->link( 'Watched' , array('controller' => 'movies','action' => 'addMovieWatchedList',$movie['Movie']['id'] ), array('escape' => false,'confirm' => 'Add movie to Watching List?')); ?>

               </div>
               </div>

          <div class="picture-container">
             <?php echo $this->Html->image($movie['Movie']['poster'], array( "alt" => "Poster",'height'=>350, 
                'width'=>250,  'url' => array('controller' => 'movies', 'action' => 'index')));?>
                          <div class="movie-button">

              
          </div>
          </div>


        </div>

      </div>

    <?php endforeach; ?>

    