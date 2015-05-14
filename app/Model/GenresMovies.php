<?php
App::uses('AppModel', 'Model');

class GenresMovies extends AppModel {

public $belongsTo = array(
        'Movie' => array(
            'className' => 'Movie',
            'foreignKey' => 'movie_id'
        )
    );





}