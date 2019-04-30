<?php

/**
 * App Controller
 * Loads view and uses models
 */

class Controller{
    public function model($model){
        //Require model
        require_once APPROOT . '/models/' .  $model . '.php';
        //Instantiate model
        return new $model;

    }
    
    public function view($view, $data = []){
        if(file_exists(APPROOT . '/views/' .  $view . '.php')){
            require_once APPROOT . '/views/' .  $view . '.php';    
        }else{
            die("View doesn't exists");
        }
    }
}