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


}