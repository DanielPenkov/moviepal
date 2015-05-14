<h1>  <?php echo $username;?> Movies</h1>


 <?php foreach ($movies as $movie): ?>
 
      <div class="col-md-12">

      	<div class="movie-title">

			<span class="title"><?php echo $movie['movies']['title']; ?></span>
		</div>

		<div class="picture-container">
			<?php echo $this->Html->image($movie['movies']['poster'], array( "alt" => "Poster",'height'=>300, 
				'width'=>200,  'url' => array('controller' => 'movies', 'action' => 'index')));?>
		</div>


      	<div class="movie-short-info">

      		
      		<span> Year: <?php echo $movie['movies']['year']; ?> | </span>
      		<span> Rating: <?php echo $movie['movies']['rating']; ?></span>
      		<h4> Plot: <?php echo $movie['movies']['description']; ?></h4>
         

      	</div>


      </div>

    <?php endforeach; ?>
