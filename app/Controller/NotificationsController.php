<?php

App::import('Controller', 'Users','Recommendations');
App::uses('AppController', 'Controller', 'Movie','User', 'Notification', 'Recommendation');


class NotificationsController extends AppController {


	public function index($userId) {

	    $usr_id = $userId;
	    $result = $this->Notification->get($usr_id);
	    $this->set('notifications',$result);   
    }

    public function setNotification($sender_id, $recipient_id, $status, $type){

        $this->Notification->add($sender_id, $recipient_id, $status, $type);
    }


    public function acceptedFriendRequest($id, $sender_id){


    	$this->Notification->getAcceptedFriendRequest($id);
   	
    	$this->redirect( '/notifications/index/'.$this->Auth->user('id') );

    }

    public function acceptFriendRequest($id , $sender_id){


    	$this->setNotification($this->Auth->user('id'), $sender_id, 0, 2);

    	$notification_id = $id;
    	$friend_id = $sender_id;
    	 $this->loadModel('Notifications');
    	$this->Notifications->query('UPDATE notifications
    								 SET status = 1
          							 Where  notifications.id ='.$notification_id);

    	$Users = new UsersController;

		$Users->addFriend($friend_id, $this->Auth->user('id'));

    	$this->redirect( '/notifications/index/'.$this->Auth->user('id') );

    }


    public function ignoreFriendRequest($id){

    	$this->Notification->ignoreFriendRequest($id);

    	$this->redirect( '/notifications/index/'.$this->Auth->user('id'));
    }




}