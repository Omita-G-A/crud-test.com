<?php
// Base Controller: Cargará los modelos y las vistas

class Controller {

    // método para cargar el modelo
    public function model($model){
        // requerimos el modelo y devuelve una instancia
        // de ese modelo. Aquí se podría añdir un if para 
        // asegurarnos de que existe el modelo que requerimos.
        if(file_exists('../app/models/'. $model. '.php')){
            require_once '../app/models/'. $model . '.php';
            return new $model();
        } else {
            die('El modelo no existe.');
        }
    }

    public function view($view, $data = []){
         if(file_exists('../app/views/'. $view. '.php')){
             require_once '../app/views/'. $view. '.php';
         } else {
             die ('La vista no existe');
         }

    }

}