<?php
/*  LO QUE HE FET YO
// Clase Core:
// App Class Core será el encargado de crear las URL y cargar el controlador
// (controller) correspondiente

class Core{
    
    // el controlador por defecto
    private $currentController = 'Pages';
    // el método por defecto
    private $currentMethod = 'index';
    private $params = [];

    public function __construct(){
        $url = $this->getUrl();
        print_r($url);

        // mirar en controllers según el primer valor de url
        if(file_exists('../app/controllers/'.ucwords($url[0]).'php')){
            // si existe actualizamos el controlador
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        // require del controlador:
        require_once '../app/controllers/'.$this->currentController.'php';

        // instanciar dinámicamente la clase de controlador correspondiente 
        // según lo que se pida en la url 
        $this->currentController = new $this->currentController();
        // mirar el segundo parámetro de la URL. Si existe el método CurrentController
        // actualizamos, si no lo dejamos como está
        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
            }
            unset($url[1]);

        }

        // recoger los parámetros de la url
        $this->params = array_values($url);
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    // método para obtener lo que nos llega desde la url. Mirará que nos llegue
    // por get el índice url
    private function getUrl(){
        $url = [$this->currentController];
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/'); // con rtrim le decimos que la barra 
            // de después de la url no aparezca.
            $url = filter_var($url, FILTER_SANITIZE_URL); // filter_sanitize_url
            // sirve para limpiar lo que viene a través de get y limpiar la url
            $url = explode('/', $url); // explode separa un string en otros strings
            // a partir del parámetro que le indicamos que tiene que mirar ('/') para 
            // hacer las partes del string ($url) y lo convierte en un array.
        }

        return $url;

    }

}
*/
class Core
{   
    private $currentController = 'Pages';
    private $currentMethod = 'index';
    private $params = [];
    public function __construct()
    {       
        $url = $this->getUrl();
        //print_r($url);

        //Mirar en controllers segun el primer valor de URL
        if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
            //Si existe establecemos el controller
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        
        //Require del controlador
        require_once '../app/controllers/'.$this->currentController.'.php';

        //Instanciar la classe del controlador correspondiente
        // $Pages = new Pages();
        // $Posts = new Posts();
        $this->currentController = new $this->currentController();

        //Mirar el segundo parametro de la URL
        if(isset($url[1])){
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
            }
            unset($url[1]);
        }

        //recoger los parametros
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        //$Posts->edit(1, 2, 3);
    }


    private function getUrl(){
        $url = [$this->currentController];
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            
        }
        return $url;
    }
}