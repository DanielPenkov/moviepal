<?php
// app/Model/User.php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {





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
            )
        )
        
    );


    public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {

        $passwordHasher = new BlowfishPasswordHasher();
        $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']

        );
        debug('password');
    }
    return true;
}


    public function validate_passwords() {
    return $this->data[$this->alias]['password'] === $this->data[$this->alias]['pwd_repeat'];
}


}

