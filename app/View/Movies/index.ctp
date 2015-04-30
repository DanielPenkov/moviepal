<!-- File: /app/View/Posts/index.ctp -->

<h1>Movies DB</h1>


    <?php foreach ($movies as $movie): ?>
 
      <div class="col-md-12">

      	<div class="movie-title">

			<span class="title"><?php echo $movie['Movie']['title']; ?></span>
		</div>

		<div class="picture-container">
			<?php echo $this->Html->image($movie['Movie']['poster'], array( "alt" => "Poster",'height'=>300, 
				'width'=>200,  'url' => array('controller' => 'movies', 'action' => 'index')));?>
		</div>


      	<div class="movie-short-info">

      		
      		<span> Year: <?php echo $movie['Movie']['year']; ?> | </span>
      		<span> Rating: <?php echo $movie['Movie']['rating']; ?></span>
      		<h4> Plot: <?php echo $movie['Movie']['description']; ?></h4>
      	</div>


      </div>

    <?php endforeach; ?>
