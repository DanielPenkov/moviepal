<?php
// app/Model/User.php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
        var $uses = array('Movie','Actor', 'Country', 'Director', 'Genre', 'Writer', 'ActorsMovie', 
            'CountriesMovie', 'DirectorsMovie', 'GenresMovie', 'WritersMovie','User','UsersMovie');

    public $hasAndBelongsToMany = array(
        'Movie' =>
            array(
                'className' => 'Movie',
                'joinTable' => 'users_movies',
                'foreignKey' => 'user_id',
                'associationForeignKey' => 'movie_id'
            )
    );

    public $hasMany = array(
        'Friend' => array(
            'className' => 'Friend',
            'foreignKey' => 'user_id',
            'dependent' => true
        ),
        'Recommendation' => array(
            'className' => 'Recommendation',
            'foreignKey' => 'reciever_id',
            'dependent' => true
        ),
        'Notification' => array(
            'className' => 'Notification',
            'foreignKey' => 'recipient_id',
            'order' => 'Notification.date_sent DESC',
            'dependent' => true
        )

    );


    public $validate = array(

        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
       'pwd_repeat' => array(
            'compare'    => array(
            'rule'      => array('validate_passwords'),
            'message' => 'The passwords you entered do not match.',
            )
        ),
        'email' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'E-mail is required'
            ),
            'isUnique'=>array(
                'rule'=>'isUnique',
                'message'=>'Account with this email already exists!'
            ),
        )
        
    );

    public function add($data) {

        if ($this->save($data)) { 
              return true;  
        }else{
             return false;   
        }    
    }

    public function get($id) {

        $user = $this->find('first', array('conditions' => array('user.id' => $id), 'contain' => false));
        return $user;      
    }

    public function getAll() {

        $result = $this->find('all', array('contain' => false));

        return $result;
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {

            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

    public function validate_passwords() {

        return $this->data[$this->alias]['password'] === $this->data[$this->alias]['pwd_repeat'];
    }






}

