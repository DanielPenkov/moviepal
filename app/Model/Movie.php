<?php
class Movie extends AppModel {




    public $hasAndBelongsToMany = array(
        'Actor' =>
            array(
                'className' => 'Actor',
                'joinTable' => 'actors_movies',
                'foreignKey' => 'movie_id',
                'associationForeignKey' => 'actor_id'
            ),
        'Country' =>
            array(
                'className' => 'Country',
                'joinTable' => 'countries_movies',
                'foreignKey' => 'movie_id',
                'associationForeignKey' => 'country_id'

            ),
         'Director' =>
            array(
                'className' => 'Director',
                'joinTable' => 'directors_movies',
                'foreignKey' => 'movie_id',
                'associationForeignKey' => 'director_id'
            ),

         'Genre' =>
            array(
                'className' => 'Genre',
                'joinTable' => 'genres_movies',
                'foreignKey' => 'movie_id',
                'associationForeignKey' => 'genre_id'
            ),
        'User' =>
            array(
                'className' => 'User',
                'joinTable' => 'users_movies',
                'foreignKey' => 'movie_id',
                'associationForeignKey' => 'user_id'
            ),
        'Writer' =>
            array(
                'className' => 'Writer',
                'joinTable' => 'writers_movies',
                'foreignKey' => 'movie_id',
                'associationForeignKey' => 'writer_id'
            )
    );

    public $hasMany = array(
        'Recommendation' => array(
            'className' => 'Recommendation',
            'foreignKey' => 'movie_id',
            'dependent' => true
        ),
        'UsersMovie' => array(
            'className' => 'UsersMovie',
            'foreignKey' => 'movie_id',
            'dependent' => true
        )

    );

    


    public function add($title, $year, $description, $rating, $poster, $type){

        if(getMovieById($title)!=false){

            $movie_data = array(
                'Movie' => array(
                    'title' => $title,
                    'year' => $year,
                    'description' => $description,
                    'rating' => $rating,
                    'poster' => $poster,
                    'type' =>$type
                     ) 
            );

            $this->save($movie_data);
        }
    }


    public function getMovieByTitle($title){

         $result = $this->find('all', array(
            'conditions' => array('title LIKE' =>'%'.$title.'%',
             'type' => 'movie', "not" => array ( "Movie.poster" => 'N/A'))));

        if($result!=null){

            $movie = $result;
            return $movie;

        } else{

            return false;
        }       
    }

    public function getMoviesByGenre($genre){

        App::import('Model','GenresMovies');
        $GenresMovies = new GenresMovies();
         $result = $GenresMovies->find('all', array(
            'conditions' => array('genre_id' => $genre,
             'type' => 'movie', "not" => array ( "Movie.poster" => 'N/A'))));

        if($result!=null){

            $movie = $result;
            return $movie;

        } else{

            return false;
        }       
    }

    public function getMovieByGenreAndTitle($title, $genre){
                
        $result = $this->find('all', 
                array('conditions' => array('Movie.title LIKE' =>'%'.$title.'%', 'Movie.type' => 'movie',
                "not" => array ( "Movie.poster" => 'N/A')), 'joins' => array(
                array(
                    'table' => 'genres_movies',
                    'alias' => 'GenresMovies',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions'=> array('GenresMovies.genre_id='.$genre,'GenresMovies.movie_id= Movie.id' )
            ))));

        return $result;


    }

    

    public function addToWatchedList($movie_id, $user_id){

        $data = array(
            'UsersMovie' =>array(
                'user_id' =>$user_id,
                'movie_id'=>$movie_id,
                'status' => 2
            )
        );

        if($this->isInList($movie_id, $user_id) == false){

            $this->UsersMovie->save($data);
            $message = 'inserted';
                
        }else{

           $this->UsersMovie->updateAll(array('status' => '2'),array('user_id'=>$user_id,'movie_id' => $movie_id));
           $message = 'updated';
        } 

        return $message;    

    }

    public function addToWatchingList($movie_id, $user_id){

        $data = array(
            'UsersMovie' =>array(
                'user_id' =>$user_id,
                'movie_id'=>$movie_id,
                'status' => 1
            )
        );

        if($this->isInList($movie_id, $user_id) == false){

            $this->UsersMovie->save($data);
            $message = 'inserted';
                
        }

        return $message;    
  
    }
    public function deleteFromList($movie_id, $user_id){

        if($this->UsersMovie->deleteAll(array('UsersMovie.user_id' => $user_id,'UsersMovie.movie_id' => $movie_id),false)){

            return true;
        }else{
            return false;
        }
            
    }

    public function isInList($movie_id, $user_id){

        $result = $this->UsersMovie->find('first',
         array('conditions' => array('user_id' => $user_id, 'movie_id' => $movie_id), 'contain' => false));

        if($result!=null){

            $response = true;
        }else{

            $response = false;
        }

        return $response;
    }


    public function getWatchingMovies($user_id){

        $result = $this->query('SELECT movies.id,movies.year, movies.title, movies.poster,
         movies.rating, movies.description  
         FROM users_movies, movies
          Where  movies.id = users_movies.movie_id AND users_movies.status =1 AND  users_movies.user_id ='.$user_id);

        return $result;

    }


  public function getWatchedMovies($user_id){

       
        $result = $this->query('SELECT movies.id,movies.year, movies.title, movies.poster,
         movies.rating, movies.description  
         FROM users_movies, movies
          Where  movies.id = users_movies.movie_id AND users_movies.status =2 AND  users_movies.user_id ='.$user_id);

        return $result;

    }

    public function getRecommendedMovies($user_id){

        //$this->loadmodel('Recommendation');
        $result = $this->Recommendation->query('SELECT movies.id,movies.year, movies.title, movies.poster,
         movies.rating, movies.description  
         FROM recommendations, movies
          Where  movies.id = recommendations.movie_id AND recommendations.reciever_id ='.$user_id);

        return $result;

    }

}