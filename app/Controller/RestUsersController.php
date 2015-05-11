<?php

class RestUsersController extends AppController {

	public $uses = array('User');
    public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');



    public function getUserToWatchMovies($user_id){
    	 $this->response->header('Access-Control-Allow-Origin', '*');

        $this->loadModel('Movie');
        $result = $this->Movie->query('SELECT movies.id,movies.year, movies.title, movies.poster,
         movies.rating, movies.description  
         FROM users_movies, movies
          Where  movies.id = users_movies.movie_id AND users_movies.status =1 AND  users_movies.user_id ='.$user_id);

        

        $this->set(array(
            'MoviesToWatch' => $result,
            '_serialize' => array('MoviesToWatch')
        ));

    }


        public function getUserWatchedMovies($user_id){

        $this->loadModel('Movie');
        $result = $this->Movie->query('SELECT movies.id,movies.year, movies.title, movies.poster,
         movies.rating, movies.description  
         FROM users_movies, movies
          Where  movies.id = users_movies.movie_id AND users_movies.status =2 AND  users_movies.user_id ='.$user_id);

         $this->set(array(
            'WatchedMovies' => $result,
            '_serialize' => array('WatchedMovies')
        ));

    }


    public function getUserFriends($user_id) {

     
            $this->loadModel('Friend');
            $result = $this->Friend->query('SELECT users.username,users.email,users.id
                                        FROM users, friends
                                        Where  users.id = friends.friend_id AND friends.user_id ='.$user_id);

           

                  $this->set(array(
            'UserFriends' => $result,
            '_serialize' => array('UserFriends')
        ));

        
    }

}
