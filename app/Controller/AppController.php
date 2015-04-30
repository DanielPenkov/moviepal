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

App::uses('Controller', 'Controller');

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
    'logoutRedirect' => array('controller' => 'movies', 'action' => 'index'), 'authenticate' => array('Form' => array('passwordHasher' => 'Blowfish'))));


	public function beforeFilter() {
	$this->set('loggedIn', $this->Auth->loggedIn());
    $this->Auth->allow('index', 'add', 'login');
    if ($this->Auth->user('id')) {
        $this->set('loggedIn', true);
        $this->set('userName',  $this->Auth->user('username'));
        $this->set('userId',  $this->Auth->user('id'));
    }
}
}
