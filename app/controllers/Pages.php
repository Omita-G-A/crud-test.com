<?php

class Pages extends Controller {
    public function __construct(){
        // echo 'Pages controller loaded';
    }

    public function index(){
        $data = ['title' => 'Bienvenidos'];
        $this->view('pages/index', $data);
    }

    public function about(){
        $data = ['title' => 'Sobre mí'];
        $this->view('pages/about', $data);   
    }
}