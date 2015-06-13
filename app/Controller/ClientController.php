<?php
App::uses('HttpSocket', 'Network/Http');
class ClientController extends AppController {
	public $components = array('RequestHandler');
	
	public function index(){
		
	}

	public function request_index(){

		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_movies.json';
		
		$data = null;
		$httpSocket = new HttpSocket();
		$response = $httpSocket->get($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}

	
	public function request_addMovieWatchingList(){
	
		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_movies/addMovieWatchingList.json';
		$data = null;
		$httpSocket = new HttpSocket();
		$data['movie_id'] = '413';
		$data['status'] = '1';
		$data['user_id'] = '1';
		$response = $httpSocket->post($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}
	

	public function request_addMovieWatchedList(){
	
		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_movies/addMovieWatchedList.json';
		$data = null;
		$httpSocket = new HttpSocket();
		$data['movie_id'] = '7001';
		$data['status'] = '2';
		$data['user_id'] = '1';
		$response = $httpSocket->post($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}
	


	public function movie_id(){
	
	
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_movies/movie_id.json';
		$data = null;
		$httpSocket = new HttpSocket();
		$data['Phone']['name'] = 'New Phone';
		$data['Phone']['manufacturer'] = 'New Phone Manufacturer';
		$data['Phone']['name'] = 'New Phone Description';
		$response = $httpSocket->post($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}


	public function request_getUserToWatchMovies(){

		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_users/getUserToWatchMovies/'.$id.'.json';
		
		$data = null;
		$httpSocket = new HttpSocket();
		$response = $httpSocket->get($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}


	public function request_getUserWatchedMovies(){

		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_users/getUserWatchedMovies/'.$id.'.json';
		
		$data = null;
		$httpSocket = new HttpSocket();
		$response = $httpSocket->get($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}



	public function request_getUserFriends(){

		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_users/getUserFriends/'.$id.'.json';
		
		$data = null;
		$httpSocket = new HttpSocket();
		$response = $httpSocket->get($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}
}