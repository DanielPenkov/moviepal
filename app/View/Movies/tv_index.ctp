<h1>TV Series DB</h1>


    <?php foreach ($movies as $movie): ?>
 
      <div>

      	<?php echo $movie['Movie']['title']; ?>
		<?php echo $this->Html->image($movie['Movie']['poster'], array( "alt" => "Poster", 'url' => array('controller' => 'movies', 'action' => 'index')));?>


      </div>

    <?php endforeach; ?>



    