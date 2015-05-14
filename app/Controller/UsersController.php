<?php


App::import('Controller', array('Notifications', 'Movies'));

App::uses('AppController', 'Controller', 'Movie','Actor', 'Country', 'Director', 'Genre', 'Writer', 'ActorsMovie', 
            'CountriesMovie', 'DirectorsMovie', 'GenresMovie', 'WritersMovie','User','UsersMovie', 'Friend', 'User', 'Notification');

class UsersController extends AppController {

    public $helpers = array('Html', 'Form');
    public $components = array('RequestHandler');


    public function login() {

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect('/movies/index');
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {

        return $this->redirect($this->Auth->logout());
    }

    public function register() {
        if ($this->request->is('post')) {
       
            if ($this->User->add($this->request->data)) {

                $this->Session->setFlash(__('Your account is crated!'));
                $this->Auth->user('id');
                $this->Auth->login();
                return $this->redirect("/movies/index");
            }

            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function allusers() {

        if($this->Auth->user('id')!=null){

            $users = $this->User->getAll();
            $this->set('users',$users);
        }
    }


    public function allFriends() {

        if($this->Auth->user('id')!=null){

            $user_id = $this->Auth->user('id');

            $this->loadModel('Friend');
            $result = $this->Friend->getByUserId($user_id);
            $this->set('users',$result);

        }
    }

    public function addFriend($friend_id, $user_id){

        $this->loadmodel('Friend');
        $this->Friend->add($friend_id, $user_id);

    }       


  public function index() {

        if($this->Auth->user('id')!=null){

            $Movies = new MoviesController;

            $user_id = $this->Auth->user('id');
            $result_to_watch = $Movies->getWatchingMovies($user_id);
            $result_watched = $Movies->getWatchedMovies($user_id);
            $result_recommended = $Movies->getRecommendedMovies($user_id);

            $this->set('to_watch_movies',$result_to_watch);
            $this->set('watched_movies',$result_watched);
            $this->set('recommended_movies',$result_recommended);
        }

    }




    public function view($id = null) {

        $this->User->id = $id;

        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        $this->set('user', $this->User->read(null, $id));
    }



    public function sendFriendRequest(){

        $this->autoRender = false; 
        $this->request->onlyAllow('ajax'); 

        $user_id = json_encode($this->request->data['user_id']);
        $user = $this->User->find('first', array('conditions' => array('id' => $user_id)));
        $username = $user['User']['username'];
  

        $this->loadmodel('Friend');

        $result_check = $this->Friend->find('first',array('conditions' => array('friend_id' => $user_id, 'user_id' => $this->Auth->user('id'))));

            if(count($result_check)==0){

                $Notifications = new NotificationsController;

                $Notifications->setNotification($this->Auth->user('id'), $user_id, 0, 1);

            }

            $this->set('_serialize', 'username');
            return json_encode($username);
           
    }

    public function publicProfile($user_id){

            $user = $this->User->get($user_id);
            $this->set('username',$user['User']['username']);

            $Movies = new MoviesController;
            $result= $Movies->getWatchedMovies($user_id);

            $this->set('movies',$result);
    }
 

}