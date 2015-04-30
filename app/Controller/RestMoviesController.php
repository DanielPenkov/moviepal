<?php

class RestMoviesController extends AppController {

	public $uses = array('Movie');
    public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');


	public function get_all_movies() {
        $this->response->header('Access-Control-Allow-Origin', '*');
		$movies = $this->Movie->find('all');
        $this->set(array(
            'movies' => $movies,
            '_serialize' => array('movies')
        ));
    }

	
}