<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */
App::uses('Controller', 'Controller','AuthComponent', 'Controller/Component');



/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {


public $components = array('Session', 'Auth' => array(
    'loginRedirect' => array('controller' => 'movies', 'action' => 'index'),
    'logoutRedirect' => array('controller' => 'movies', 'action' => 'index'), 'authenticate' => array('Form' => array('passwordHasher' => 'Blowfish'))), 'Security');


	public function beforeFilter() {


	$this->set('loggedIn', $this->Auth->loggedIn());

    $this->Auth->allow('index', 'add', 'login','get_all_movies','movie_id', 'addMovieWatchingList','addMovieWatchedList',
        'getUserToWatchMovies', 'register');
    $this->Security->unlockedActions = array('edit','delete','add','view', 'get_all_movies','getUserToWatchMovies',
         'addMovieWatchedList', 'addMovieWatchingList','sendFriendRequest', 'find', 'movie_id','register');

    if ($this->Auth->user('id')) {
        $this->set('loggedIn', true);
        $this->set('userName',  $this->Auth->user('username'));
        $this->set('userId',  $this->Auth->user('id'));
        $uid = $this->Auth->user('id');
  

        $this->loadModel('Notifications');
        $result = $this->Notifications->query('SELECT users.id,users.username,notifications.id, notifications.type
                                                FROM notifications, users
                                        Where  users.id = notifications.sender_id AND notifications.recipient_id ='.$uid.' AND notifications.status = 0');

         
        $this->set('vat', count($result));
        
    }

     $this->Security->blackHoleCallback = 'blackhole';
}


public function blackhole($type) {
    debug($type);
    throw new BadRequestException(__d('cake_dev', 'The request has been black-holed'));
}
}
