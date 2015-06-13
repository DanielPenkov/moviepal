<?php
App::uses('AppModel', 'Model');

class Notification extends AppModel {
	 public $hasOne = 'Recommendation';

	 public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'sender_id'
        )
    );




    public function get($user_id){

        $this->recursive = 2;
        $result = $this->find('all',array('conditions' => array('recipient_id' => $user_id , 
           'status' => 0, 'type'=> 4), 'order'=>'Notification.date_sent DESC'));
        return $result;

    }

    public function add($sender_id, $recipient_id, $status, $type){

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

        $this->saveAll($dt['Notification']);
    }

    public function getAcceptedFriendRequest($id){

    	$notification_id = $id;
    	$this->updateAll(array('status' => '1'),array('Notification.id'=>$notification_id));

    }



    public function ignoreFriendRequest($id){

    	$this->updateAll(array('status' => '12'),array('Notification.id'=>$id));
    		
    }

    

}