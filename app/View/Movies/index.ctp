<!-- File: /app/View/Posts/index.ctp -->

<?php
echo $this->Form->create('Movie', array('type' => 'post', 'action' => 'index'));
echo $this->Form->input('Title');
echo $this->Form->input('dropdownitem' ,array('label' => 'Genre', 'empty' => 'Choose genre'));
echo $this->Form->submit('Search');
echo $this->Form->end();
?>



<div class="row">

 <div class="page-title"><h1>Movies List</h1></div>

    <?php foreach ($movies as $movie): ?>
 
      <div class="col-md-4 col-sm-6 col-xs-12">

      <div class="thumbnail" id="movie-list">

      <div class="picture-container">
      <?php echo $this->Html->image($movie['Movie']['poster'], array( "alt" => "Poster", 'url' => array('controller' => 'movies', 'action' => 'index')));?>
    </div>
        
      <div class="movie-button">

      <div class="caption">
        <h3><?php echo $movie['Movie']['title']; ?></h3>

        <p> <?php echo substr($movie['Movie']['description'],0,200) ; ?></p>

        <p> 

      <a onclick="addToWatchedList(<?php echo $movie['Movie']['id']; ?>)" "href="javascript:void(0);" class="btn btn-default" >Watched</a>

          <a onclick="addToWatchingList(<?php echo $movie['Movie']['id']; ?>)" "href="javascript:void(0);" class="btn btn-default" >To Watch</a>


          </p>
      </div>
    </div>


</div>
</div>

        
        
    <?php endforeach; ?>
    </div>


   
<script>
$(document).ready(function(){  
$("#MovieTitle").autocomplete("/moviepal/movies/index.json", {
minChars: 3
});
});
</script>