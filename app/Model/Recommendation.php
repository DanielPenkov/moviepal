<?php
App::uses('AppModel', 'Model');


class Recommendation extends AppModel {

		 public $belongsTo = array(
        'Movie' => array(
            'className' => 'Movie',
            'foreignKey' => 'movie_id'
        )
    );

	

}