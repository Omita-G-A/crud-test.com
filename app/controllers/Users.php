<?php
/* LO QUE HE FET JO
class Users extends Controller
{
    // declaramos una propiedad privada $userModel que será una instancia
    // de model con la que construir el modelo de User
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        echo 'lista de usuarios por hacer';
    }

    // método register
    public function register()
    {
        // miramos si es POST
        if ($_SERVER['REQUEST METHOD'] === 'POST') {
            // procesar el formulario
            // sanitizar los datos para evitar que nos pasen
            // etiquetas, carácteres "extraños", etc
            $_POST = filter_input_array(
                INPUT_POST,
                FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
            // inicializar los datos.
            $data = [
                'name' => trim($_POST['name']), //le aplicamos un trim para quitar espacios
                // en blanco no deseados. Importante que los nombres de post coincidan con
                // los names del form
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'con' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'con_password_err' => ''
            ];
            // validar el email
            if (empty($data['email'])) {
                // si el campo del email aparece en blanco
                $data['email_err'] = 'el campo no puede estar vacío';
            } else  {
                if($this->userModel->emailExists($data['email'])){
                // verificar que el email no exista en la base de datos
                $data['email_err'] = 'este e-mail ya está registrado';
                }
            }

            // validar name
            if (empty($data['name'])) {
                // si el campo del email aparece en blanco:
                $data['name_err'] = 'el campo no puede estar vacío';
            }

            // validar password
            if (empty($data['password'])) {
                // si el campo del email aparece en blanco:
                $data['password_err'] = 'el campo no puede estar vacío';
            } elseif (mb_strlem($data['password']) < 6) {
                $data['password_err'] =
                    'la contraseña debe tener 6 o más carateres';
            }

            // validar confirmación password
            if (empty($data['con'])) {
                // si el campo del email aparece en blanco
                $data['con_password_err'] = 'introduce el password';
            } elseif ($data['password'] !== $data['con']) {
                $data['con_password_err'] = 'las constraseñas no coinciden';
            }

            // si no hay errores procedemos a registrar el usuario
            if (
                empty($data['email_err']) && 
                empty($data['name_err']) && 
                empty($data['password_err']) && 
                empty($data['con_password_err'])
            ) {
                // registras el usuario
                if ($this->userModel->register($data)) {
                    // AUX Funcs...
                    // header('Location: '. URLROOT . '/users/login');
                    redirect('users/login');
                    echo 'usuario registrado correctamente';
                } else {
                    die('algo ha ido mal...');
                }
            } else {
                // si hay errores cargamos la vista con los errores.
                $this->view('users/register', $data);
            }
        } else {
            // inicializar los datos
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'con' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'con_password_err' => ''
            ];
            // enseñar la vista
            echo 'no furula';
            // $this->view('users/register');
        }
    }

    // método para loguearse
    public function login()
    {
        if(isLoggedIn()){
            redirect('/');
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(
                INPUT_POST,
                FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
            echo 'post login ok';
        
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            if (empty($data['email'])) {
                // si el campo del email aparece en blanco
                $data['email_err'] = 'introduce tu email para empezar';
            }

            if (empty($data['password'])) {
                // si el campo del email aparece en blanco
                $data['password_err'] = 'introduce tu contraseña';
            }
    
            // si hay errores se los pasamos a la vista
            if(empty($data['email_err']) && empty($data['password_err'])) {
                // mirar si existe el email
                if($this->userModel->emailExists($data['email'])){
                    // si se cumple comprobar que el password coincida
                    $loggedInUser = $this->userModel->checkUser($data['email'], $data['password']); // como está 
                    // sanitizado también podríamos pasar $_POST (o sea, lo que introduce el usuario)
                    // si es correcro iniciamos sesión
                    if($loggedInUser){
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['password_err'] = 'contraseña incorrecta';
                        $this->view('users/login', $data);
                    }
                // si no es correcto devolver error
                } else {
                    $data['email_err'] = 'el usuario no existe';
                    $this->view('users/login', $data);
                }

            } else {
                $this->view('users/login', $data);
            }
        } else {
            
            // enseñamos vista
            $this->view('/users/login', $data);

        }
    }

    // método para crear sesión
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
    }

    // método para cerrar sesión
    public function logOut(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);

    }
    
}
*/
// CÓDIGO TONI
class Users extends Controller
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    public function index()
    {
        echo "Lista de usuarios por hacer...";
    }

    public function register()
    {
        //Mirar si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Procesar el formulario
            //Sanitizar los datos
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //Inicializar los datos
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            //Validar email 
            if (empty($data['email'])) {
                $data['email_err'] = 'Por favor rellena el email';
            } else {
                //TODO Veificar que no exista en la bd
                if ($this->userModel->emailExists($data['email'])) {
                    $data['email_err'] = 'Este email la esta registrado';
                }
            }

            //Validar name
            if (empty($data['name'])) {
                $data['name_err'] = 'Escribe un nombre';
            }

            //Validar password
            if (empty($data['password'])) {
                $data['password_err'] = 'Te falta el password';
            } elseif (mb_strlen($data['password']) < 6) {
                $data['password_err'] = 'EL password debe tener 6 o más caracteres';
            }

            //Validar confirmacion password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Confirma el password';
            } elseif ($data['password'] !== $data['confirm_password']) {
                $data['confirm_password_err'] = 'Los passwords no coinciden';
            }


            //Si no hay errores registramos el usuario
            if (
                empty($data['email_err'])
                && empty($data['name_err'])
                && empty($data['password_err'])
                && empty($data['confirm_password_err'])
            ) {
                //Registrar el User
                if ($this->userModel->register($data)) {
                    redirect('users/login');
                } else {
                    die("Algo ha ido mal");
                }
            } else {
                //Si hay errores cargamos la vista con los errores
                $this->view('users/register', $data);
            }
        } else {
            //Inicializar los datos
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            //
            //Cargar la vista
            $this->view('users/register', $data);
        }
    }

    public function login(){
        // if(isLoggedIn()){
        //     redirect('/');
        //     exit();
        // }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Sanitizar los datos
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //Inicializar los datos
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];

            if (empty($data['email'])) {
                $data['email_err'] = 'Escribe un email';
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Escribe un password';
            }


            //Si hay errores se los pasamos a la vista
            if(empty($data['email_err']) && empty($data['password_err'])){
                //Mirar si existe el email
                if($this->userModel->emailExists($data['email'])){
                    //Si existe mirar que el password coincida
                    $loggedInUSer = $this->userModel->checkUser($data['email'], $data['password']);
                    
                    if($loggedInUSer){
                        //Si el password es correcto iniciamos session
                        $this->createUserSession($loggedInUSer);
                        redirect('/');
                        // echo 'se ha logueado bien';
                    }else{
                        //Si el password no es correcto devolvemos el error al usuario
                        $data['password_err'] = "Contrasseña incorrecta";
                        $this->view('users/login', $data);
                    }
                    
                }else{
                    //Si no existe el email devolvemos el error al usuario
                    $data['email_err'] = "El usuario no existe";
                    $this->view('users/login', $data);
                }
               

                

            }else{
                //Cargar la vista con los errores
                $this->view('users/login', $data);
            }

        } else {
            // Init data 
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            //Cargamos la vista
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        // session_unset();
        session_destroy();
        redirect('users/login');
    }
}