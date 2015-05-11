<?php

App::import('Controller', 'Notifications');

class RecommendationsController extends AppController {



    public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');
		var $uses = array('Movie','User', 'Notification');

	
   public function index($id) {

    $movie_id=$id;
    $this->set('movie_id', $movie_id);

   		$this->layout = false;

        if($this->Auth->user('id')!=null){

            $user_id = $this->Auth->user('id');

     
            $this->loadModel('Friend');
            $result = $this->Friend->query('SELECT users.username,users.email,users.id
                                        FROM users, friends
                                        Where  users.id = friends.friend_id AND friends.user_id ='.$user_id);

            $this->set('users',$result);

        }
    }

    public function recommend($friend_id, $movie_id) {

        $this->layout = false;
        $user_id = $this->Auth->user('id');
        $date = date('Y-m-d H:i:s');
        $this->loadModel('Notification');

        $this->data = array(


            'Notification' => array(
                'sender_id' => $user_id,
                'recipient_id' => $friend_id,
                'date_sent' => $date,
                'status'=> 0,
                'type' => 4
            ),            
            'Recommendation' => array(
                'sender_id' => $user_id,
                'reciever_id' => $friend_id,
                'movie_id' => $movie_id,


            )
        );


        $this->Notification->saveAll($this->data, array('validate'=>'first'));

    }

    public function getRecommended($sender_id){

        $user_id = $this->Auth->user('id');
        $this->loadmodel('Recommendation');
        $result = $this->Recommendation->find('first',array('conditions' => array('reciever_id' => $user_id , 'sender_id' => $sender_id )));

        return $result;




    }



		

}