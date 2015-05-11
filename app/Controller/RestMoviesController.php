<?php

class RestMoviesController extends AppController {

	public $uses = array('Movie');
    public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');


	public function index() {
        $this->response->header('Access-Control-Allow-Origin', '*');
		$movies = $this->Movie->find('all', array('limit' => 5));
        $this->set(array(
            'movies' => $movies,
            '_serialize' => array('movies')
        ));

    }


    public function movie_id() {

        $movies = $this->request->data;

        $this->response->header('Access-Control-Allow-Origin', '*');
        // $movies = $this->Movie->find('all');
        $this->set(array(
            'movies' => $movies,
            '_serialize' => array('movies')
        ));
    }


    public function addMovieWatchingList(){
       
        $data = $this->request->data;
        $dataUserMovie = array(

                'UsersMovie' =>array(
                    'user_id' =>$data['User']['user_id'],
                    'movie_id'=>$data['Movie']['movie_id'],
                    'status' => $data['Movie']['status']
                )
            );

            $this->loadModel('UsersMovie');
         $result_check = $this->UsersMovie->find('first',array('conditions' => array('movie_id' => $data['Movie']['movie_id'], 'user_id' => $data['User']['user_id'])));

            if(count($result_check)==0){

                  if($this->UsersMovie->saveAll( $dataUserMovie['UsersMovie'])){

                    $message = 'inserted';
                  }else{

                    $message = 'error';
                  }
                   

            }
                   $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));



    }

    public function addMovieWatchedList(){
       
        $data = $this->request->data;
        $dataUserMovie = array(

                'UsersMovie' =>array(
                    'user_id' =>$data['User']['user_id'],
                    'movie_id'=>$data['Movie']['movie_id'],
                    'status' => $data['Movie']['status']
                )
            );

            $this->loadModel('UsersMovie');
         $result_check = $this->UsersMovie->find('first',array('conditions' => array('movie_id' => $data['Movie']['movie_id'], 'user_id' => $data['User']['user_id'])));

            if(count($result_check)==0){

                  if($this->UsersMovie->saveAll( $dataUserMovie['UsersMovie'])){

                    $message = 'inserted';
                  }else{

                    $message = 'error';
                  }
                   

            }
                   $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));



    }

	
}