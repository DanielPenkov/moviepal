<?php

class MoviesController extends AppController {

    public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler','Session');


	

   public function index() {

		$this->loadmodel('Genre');
		$dropdownitems = $this->Genre->find('list',  array('fields' => array('Genre.genre')));
		$this->set(compact('dropdownitems'));

		if ($this->request->is('ajax')) {

				$this->autoRender = false;
				$results = $this->Movie->find('all', array(
				'fields' => array('Movie.title'),
				'conditions' => array('Movie.title LIKE ' => $this->request->query['q'] .'%')
				));
				foreach($results as $result) {
					echo $result['Movie']['title'] . "\n";
			}
		} 

		if($this->request->is('post')) {

			$data = $this->request->data;

			if($data['Movie']['Title'] && $data['Movie']['dropdownitem'] ==''){
				
				$result =$this->Movie->getMovieByTitle($data['Movie']['Title']);
				$this->set('movies',$result);		
			}

			if($data['Movie']['dropdownitem'] && $data['Movie']['Title'] == ''){
			
				$result = $this->Movie->getMoviesByGenre($data['Movie']['dropdownitem']);
				$this->set('movies',$result);		
			}
			if($data['Movie']['dropdownitem'] && $data['Movie']['Title']){
				
				$result = $this->Movie->getMovieByGenreAndTitle($data['Movie']['Title'], $data['Movie']['dropdownitem']);			
				$this->set('movies',$result);			
			}
		
		}else{

			 $result = $this->Movie->find('all', 
			 	array('conditions' => array('type' => 'movie',"not" => array ("Movie.poster" => 'N/A')), 
			 	 	  	'order' => array('Movie.year' => 'DESC'), 
			 	 		'limit' => 20
			 	)
			 );

        	$this->set('movies',$result);

		}
        		
    }

 	public function addMovieWatchedList(){

        $this->autoRender = false; 
        $this->request->onlyAllow('ajax');

        $movie_id = json_encode($this->request->data['id']);
        $user_id = $this->Auth->user('id');
 
        $message = $this->Movie->addToWatchedList($movie_id, $user_id);
        $this->set('_serialize', 'message');
        return json_encode($message);
	}

	public function addMovieWatchingList(){

    	$this->autoRender = false; 
        $this->request->onlyAllow('ajax');

        $movie_id = json_encode($this->request->data['id']);
        $user_id = $this->Auth->user('id');
 
        $message = $this->Movie->addToWatchingList($movie_id, $user_id);
        $this->set('_serialize', 'message');
        return json_encode($message);
    }

    public function deleteUserMovie($movie_id){

        	$user_id  = $this->Auth->user('id');
        	if($this->Movie->deleteFromList($movie_id, $user_id)){

        		$this->redirect( '/users' );
        	}
        	
        			
    }

   public function getWatchingMovies($user_id){

        $result = $this->Movie->getWatchingMovies($user_id);

        return $result;

    }


  public function getWatchedMovies($user_id){

       
        $result = $this->Movie->getWatchedMovies($user_id);
        return $result;

    }

    public function getRecommendedMovies($user_id){

       
        $result = $this->Movie->getRecommendedMovies($user_id);
        return $result;

    }

 





























    public function updateDatabase() {
        	ini_set('max_execution_time', 3000);
   
			$movies = array();
			$actors_data = array('Actor');
	        $file = $_SERVER['DOCUMENT_ROOT'] .'/data/tt0257800.json';
	        $data = json_decode(file_get_contents($file));
	        $movies = (array)$data;

	        foreach ($movies as $mv) {

	        	$movie =(array)$mv;

	        	if($movie['Response']=='True' && $movie['Poster']!='N\/A' && $movie['Plot']!='N\/A'  ){

	        	$title = $movie['Title'];
	        	$year = $movie['Year'];
	        	$description = $movie['Plot'];
	        	$rating = $movie['imdbRating'];
	        	$poster = $movie['Poster'];
	        	$type = $movie['Type'];

	        	$this->Movie->add($title, $year, $description, $rating, $poster, $type);

	        	$this->Movie->recursive = -1;
	        	$result = $this->Movie->find('all', array(
            		'conditions'=>array('Movie.title'=>$title)));

	        	$movie_id = $result[0]['Movie']['id'];
	        

	        	$actors =explode(",", $movie['Actors']) ;

	        	foreach ($actors as $actr) {

	        		$this->addActor($actr);

	        		$this->addActorMovie($actr, $movie_id);

	        	}
	        	
	        	$country = explode(",", $movie['Country']) ;

	        	foreach ($country as $ctr) {

	        		$this->addCountry($ctr);
	        		$this->addCountryMovie($ctr,$movie_id);
	        	}

	        	$directors = explode(",", $movie['Director']) ;

	        	   foreach ($directors as $dir) {

	        	   	$this->addDirector($dir);
	        	   	$this->addDirectorMovie($dir, $movie_id );	
	        	   }

	        	$genre = explode(",", $movie['Genre']) ;

	        	  foreach ($genre as $gnr) {

	        	  	$this->addGenre($gnr);
	        	  	$this->addGenreMovie($gnr,  $movie_id);
	        	}

	        	$writers = explode(",", $movie['Writer']) ;

	        	 foreach ($writers as $wrt) {

	        	 	$this->addWriter($wrt);
	        	 	$this->addWriterMovie($wrt, $movie_id);

	        	}
	        }
	     }
    }


    public function addActor($actr){

    	$this->loadmodel('Actor');
	    $result = $this->Actor->find('first',array('conditions' => array('name' => $actr)));

	    if(count($result)==0){

	        $actor_data = array(

	        	'Actor' =>array(
	        	'name' =>$actr
	        	)
	        );

	    	$this->Actor->create();
	   		$this->Actor->save($actor_data);
	    }
    }

    public function addActorMovie($actr, $movie_id){

    	$this->loadmodel('Actor');
	    $result = $this->Actor->find('first',array('conditions' => array('name' => $actr)));


	    $act_id = $result['Actor']['id'];

	    $result_check = $this->ActorsMovie->find('first',array('conditions' => array('movie_id' => $movie_id, 'actor_id' => $act_id)));

	    	if(count($result_check)==0){

	    		$dt = array(

		   		     	'ActorsMovie' => array(
			      	     'movie_id' => $movie_id,
			      	     'actor_id' =>  $act_id
		    	     	 ) 
					);

        		$this->ActorsMovie->saveAll($dt['ActorsMovie']);
	    	}          
    }

    public function addCountry($ctr){

    	$this->loadmodel('Country');
	    $result = $this->Country->find('first',array('conditions' => array('country' => $ctr)));
	        
	    if(count($result)==0){

	      	$countries_data = array(

	        	'Country' =>array(
	        		'country' =>$ctr
	        	)
	        );

	        $this->Country->create();
	        $this->Country->save($countries_data);
	    }
    }

    public function addCountryMovie($ctr,$movie_id){


    	$this->loadmodel('Country');
	    $result = $this->Country->find('first',array('conditions' => array('country' => $ctr)));

	    $country_id = $result['Country']['id'];

	     $result_check = $this->CountriesMovie->find('first',array('conditions' => array('movie_id' => $movie_id, 'country_id' => $country_id)));

	     if(count($result_check)==0){

	     	$dt = array(
		   		'CountriesMovie' => array(
			        'movie_id' => $movie_id,
			      	'country_id' =>  $country_id
		    	) 
			);

        $this->CountriesMovie->saveAll($dt['CountriesMovie']);
	     }
    }

    public function addDirector($dir){

    	$this->loadmodel('Director');
	    $result = $this->Director->find('first',array('conditions' => array('name' => $dir)));
	        
	    if(count($result)==0){

	        $dir_data = array(
	        	'Director' =>array(
	        	'name' =>$dir
	        	)
	        );

	    	$this->Director->create();
	   		$this->Director->save($dir_data);
	    }
    }

    public function addDirectorMovie($dir, $movie_id ){

    	$this->loadmodel('Director');
	    $result = $this->Director->find('first',array('conditions' => array('name' => $dir)));

	    $director_id = $result['Director']['id'];
	     $result_check = $this->DirectorsMovie->find('first',array('conditions' => array('movie_id' => $movie_id, 'director_id' => $director_id)));

	    if(count($result_check)==0){

	    	$dt = array(
		   	'DirectorsMovie' => array(
				'movie_id' => $movie_id,
			    'director_id' =>  $director_id
		    	) 
		);

       $this->DirectorsMovie->saveAll($dt['DirectorsMovie']);

	    }
    }

    public function addGenre($gnr){

    	$this->loadmodel('Genre');
	    $result = $this->Genre->find('first',array('conditions' => array('genre' => $gnr)));

	    if(count($result)==0){

	        $gnr_data = array(
	        	'Genre' =>array(
	        		'genre' =>$gnr
	        	)
	        );

	    	$this->Genre->create();
	    	$this->Genre->save($gnr_data);
	    }
    }

    public function addGenreMovie($gnr,  $movie_id){

    	$this->loadmodel('Genre');
	    $result = $this->Genre->find('first',array('conditions' => array('genre' => $gnr)));

	    $genre_id = $result['Genre']['id'];

	    $result_check = $this->GenresMovie->find('first',array('conditions' => array('movie_id' => $movie_id, 'genre_id' => $genre_id)));

	    if( count($result_check)==0){

	    	$dt = array(
		   		'GenresMovie' => array(
			      	'movie_id' => $movie_id,
			      	'genre_id' =>  $genre_id
		    	) 
			);

        $this->GenresMovie->saveAll($dt['GenresMovie']);


	    }        
    }

    public function addWriter($wrt){

    	$this->loadmodel('Writer');
	    $result = $this->Writer->find('first',array('conditions' => array('name' => $wrt)));
	        
	    if(count($result)==0){

	        $wrt_data = array(
	        	'Writer' =>array(
	        		'name' =>$wrt
	        	)
	        );

	    	$this->Writer->create();
	    	$this->Writer->save($wrt_data);
	    }
    }

    public function addWriterMovie($wrt, $movie_id){

    	$this->loadmodel('Writer');
	    $result = $this->Writer->find('first',array('conditions' => array('name' => $wrt)));

	    $wrt_id = $result['Writer']['id'];

	     $result_check = $this->WritersMovie->find('first',array('conditions' => array('movie_id' => $movie_id, 'writer_id' => $wrt_id)));

	     	if(count($result_check)==0){

	     		 $dt = array(
		   		'WritersMovie' => array(
			      	'movie_id' => $movie_id,
			      	'writer_id' =>  $wrt_id
		    	) 
			);

        $this->WritersMovie->saveAll($dt['WritersMovie']);

	     	}  
    }

}