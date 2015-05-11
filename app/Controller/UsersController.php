<?php


App::import('Controller', 'Notifications');

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


    public function index() {

        if($this->Auth->user('id')!=null){

            $user_id = $this->Auth->user('id');

            $result_to_watch = $this->getUserToWatchMovies($user_id);
            $result_watched = $this->getUserWatchedMovies($user_id);
            $result_recommended = $this->getUserRecommendedMovies($user_id);

            $this->set('to_watch_movies',$result_to_watch);
            $this->set('watched_movies',$result_watched);
            $this->set('recommended_movies',$result_recommended);
        }

    }


    public function getUserToWatchMovies($user_id){

        $this->loadModel('Movie');
        $result = $this->Movie->query('SELECT movies.id,movies.year, movies.title, movies.poster,
         movies.rating, movies.description  
         FROM users_movies, movies
          Where  movies.id = users_movies.movie_id AND users_movies.status =1 AND  users_movies.user_id ='.$user_id);

        return $result;

    }

    public function getUserWatchedMovies($user_id){

        $this->loadModel('Movie');
        $result = $this->Movie->query('SELECT movies.id,movies.year, movies.title, movies.poster,
         movies.rating, movies.description  
         FROM users_movies, movies
          Where  movies.id = users_movies.movie_id AND users_movies.status =2 AND  users_movies.user_id ='.$user_id);

        return $result;

    }

    public function getUserRecommendedMovies($user_id){

        $this->loadModel('Recommendation');
        $result = $this->Recommendation->query('SELECT movies.id,movies.year, movies.title, movies.poster,
         movies.rating, movies.description  
         FROM recommendations, movies
          Where  movies.id = recommendations.movie_id AND recommendations.reciever_id ='.$user_id);

        return $result;

    }



    public function allusers() {

        if($this->Auth->user('id')!=null){

            $user_id = $this->Auth->user('id');
            $this->loadModel('User');

            $result = $this->User->query('SELECT *
                                                FROM users');

            $this->set('users',$result);


      

        }
    }


    public function friends() {

        if($this->Auth->user('id')!=null){

            $user_id = $this->Auth->user('id');

     
            $this->loadModel('Friend');
            $result = $this->Friend->query('SELECT users.username,users.email,users.id
                                        FROM users, friends
                                        Where  users.id = friends.friend_id AND friends.user_id ='.$user_id);

            $this->set('users',$result);

        }
    }


    public function view($id = null) {

        $this->User->id = $id;

        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Your account is crated, Login with your username and password', 'positive_flash'));
                 $this->Auth->user('id');
                return $this->redirect("/users/login");
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

    public function addUserFriends(){

        $this->autoRender = false; // We don't render a view in this example
         $this->request->onlyAllow('ajax'); // No direct access via browser URL



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

            $result = $this->getUserMovies($user_id);

            $this->set('movies',$result);

    }



    public function addFriend($friend_id, $user_id ){


          $data = array(

                'Friend' =>array(
                    'user_id' =>$user_id,
                    'friend_id'=>$friend_id
                )
            );

          debug($data);

          $data_friend = array(

                'Friend' =>array(
                    'user_id' =>$friend_id,
                    'friend_id'=>$user_id
                )
            );

          $this->loadmodel('Friend');

         $result_check = $this->Friend->find('first',array('conditions' => array('friend_id' => $friend_id, 'user_id' => $user_id)));

            if(count($result_check)==0){

               $this->Friend->create();
               $this->Friend->save($data['Friend']);
               $this->Friend->create();
               $this->Friend->save($data_friend['Friend']);
            }

    }       

}