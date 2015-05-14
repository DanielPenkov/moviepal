<?php
App::uses('AppModel', 'Model');

class UsersMovies extends AppModel {

	public $belongsTo = array(
        'Movie' => array(
            'className' => 'Movie',
            'foreignKey' => 'movie_id'
        )
    );





}