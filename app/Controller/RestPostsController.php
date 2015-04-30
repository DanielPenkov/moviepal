<?php

class RestPostsController extends AppController {

	public $uses = array('Post');
    public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');


	public function index() {
        $this->response->header('Access-Control-Allow-Origin', '*');
		$posts = $this->Post->find('all');
        $this->set(array(
            'posts' => $posts,
            '_serialize' => array('posts')
        ));
    }

	
}