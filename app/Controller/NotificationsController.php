<?php

App::import('Controller', 'Users','Recommendations');
App::uses('AppController', 'Controller', 'Movie','User', 'Notification', 'Recommendation');


class NotificationsController extends AppController {


	public function index($userId) {

	    $usr_id = $userId;

	    $result = $this->getNotifications($usr_id);
        //debug($result);

	    $this->set('notifications',$result);
          
    }


    
    public function getNotifications($user_id){

       
        $this->loadModel('Notifications');
        $this->Notification->recursive = 2;

        // $result = $this->Notifications->query('SELECT users.id,users.username,notifications.id, notifications.type, notifications.sender_id,recommendations.movie_id
        //  										FROM notifications, users, recommendations
        //   								Where recommendations.notification_id = notifications.id AND users.id = notifications.sender_id AND notifications.recipient_id ='.$user_id.' AND notifications.status = 0');

        $result = $this->Notification->find('all',array('conditions' => array('recipient_id' => $user_id , 'status' => 0)));
        return $result;

    }

    public function acceptedFriendRequest($id , $sender_id){


    	$notification_id = $id;
    	$friend_id = $sender_id;
    	 $this->loadModel('Notifications');
    	$this->Notifications->query('UPDATE notifications
    								 SET status = 1
          							 Where  notifications.id ='.$notification_id);

    	

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

    	$notification_id = $id;
    	 $this->loadModel('Notifications');
    	$this->Notifications->query('UPDATE notifications
    								 SET status = 12
          							 Where  notifications.id ='.$notification_id);

    	$this->redirect( '/notifications/index/'.$this->Auth->user('id'));
    }


    public function setNotification($sender_id, $recipient_id, $status, $type){

        $this->loadmodel('Notification');
        $date_sent = date('Y-m-d H:i:s');
      

                 $dt = array(
                'Notification' => array(
                    'sender_id' => $sender_id,
                    'recipient_id' => $recipient_id,
                    'date_sent' => $date_sent,
                    'status' => $status,
                    'type' => $type

                ) 
            );

        $this->Notification->saveAll($dt['Notification']);
    }

}