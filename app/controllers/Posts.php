<?php

class Posts extends Controller
{
    private $postModel;

    public function __construct()
    {
        echo 'Posts Controller Loaded...';
        $this->postModel = $this->model('Posts');
    }

    public function index()
    {
        echo 'POST metodo index...';
        $posts = $this->postModel->getPosts();
        // recordar que en php los array son arrays asociativos,
        // por eso hay que escribir clave => valor.
        $data = ['title' => 'Mis Posts', 'posts' => $posts];
        $this->view('posts/index', $posts);

    }

    public function edit($id = null)
    {
        echo 'POST metodo edit...'.$id;
    }
    
}