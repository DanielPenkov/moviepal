<?php
class Movie extends AppModel {

		 public $hasAndBelongsToMany = array(
        'Actor' =>
            array(
                'className' => 'Actor',
                'joinTable' => 'actors_movies',
                'foreignKey' => 'movie_id',
                'associationForeignKey' => 'actor_id'
            ),
        'Country' =>
            array(
                'className' => 'Country',
                'joinTable' => 'countries_movies',
                'foreignKey' => 'movie_id',
                'associationForeignKey' => 'country_id'

            ),
         'Director' =>
            array(
                'className' => 'Director',
                'joinTable' => 'directors_movies',
                'foreignKey' => 'movie_id',
                'associationForeignKey' => 'director_id'
            ),

         'Genre' =>
            array(
                'className' => 'Genre',
                'joinTable' => 'genres_movies',
                'foreignKey' => 'movie_id',
                'associationForeignKey' => 'genre_id'
            ),
        'User' =>
            array(
                'className' => 'User',
                'joinTable' => 'users_movies',
                'foreignKey' => 'movie_id',
                'associationForeignKey' => 'user_id'
            ),
        'Writer' =>
            array(
                'className' => 'Writer',
                'joinTable' => 'writers_movies',
                'foreignKey' => 'movie_id',
                'associationForeignKey' => 'writer_id'
            )


    );




}