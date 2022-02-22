<?php
class Users extends Controller {

    // método register
    public function register(){
        // miramos si es POST
        if($_SERVER['REQUEST METHOD'] == 'POST'){
            // procesar el formulario
            // sanitizar los datos para evitar que nos pasen
            // etiquetas, carácteres "extraños", etc
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
            if(empty($data['email'])) {
                // si el campo del email aparece en blanco 
                $data['email_err'] = 'el campo no puede estar vacío';
            } else {
                // verificar que el email no exista en la base de datos
                $data['email_err'] = 'este e-mail ya está registrado';
                
            }

            // validar name
            if(empty($data['name'])) {
                // si el campo del email aparece en blanco 
                $data['name_err'] = 'el campo no puede estar vacío';
            }

            // validar password
            if(empty($data['password'])) {
                // si el campo del email aparece en blanco 
                $data['password_err'] = 'el campo no puede estar vacío';
            } else if(mb_strlem($data['password']) < 6) {
                $data['password_err'] = 'la contraseña debe tener 6 o más carateres';
            }

            // validar confirmación password
            if(empty($data['con'])) {
                // si el campo del email aparece en blanco 
                $data['con_password_err'] = 'introduce el password';
            } elseif($data['password'] !== $data['con']) {
                $data['con_password_err'] = 'las constraseñas no coinciden';
            }

            // si no hay errores procedemos a registrar el usuario
            if(empty($data['email_err'])
             && empty($data['name_err'])
             && empty($data['password_err']) 
             && empty($data['con_password_err'])){

                // encriptamos (hasheamos) el password

                // registras el usuario
             } else {  // si hay errores cargamos la vista con los errores.
                $this->view('/users/register', $data);

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
            $this->view('/users/register');

        }
    }
}