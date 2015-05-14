<?php
App::uses('AppModel', 'Model');

class Friend extends AppModel {

	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );


	public function add($friend_id, $user_id ){

        $data = array(
            'Friend' =>array(
                'user_id' =>$user_id,
                'friend_id'=>$friend_id
            )
        );

        $data_friend = array(

            'Friend' =>array(
                'user_id' =>$friend_id,
                'friend_id'=>$user_id
            )
        );

        $result_check = $this->find('first',array('conditions' => array('friend_id' => $friend_id, 'user_id' => $user_id)));

        if(count($result_check)==0){

            $this->save($data);
            $this->save($data_friend);
        }
    }       

	public function getByUserId($id){

	 	$friends = $this->find('all', array('conditions' => array('friend_id' => $id), 'contain' => 'User'));
	 	return $friends;
    }


}