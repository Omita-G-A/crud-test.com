<?php
/* meu
class User
{
    // instancia privada db que conectará con la
    // base de datos y nos permitirá hacer las consultas
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // registrar un usuario
    public function register($data)
    {
        $this->db->query('INSERT INTO users (name, email, password) 
                        VALUES (:name, :email, :password)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        // encriptamos (hasheamos) el password
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->db->bind(':password', $hashed_password);

        return $this->db->execute();
    }

    public function emailExist($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $this->db->single(); // aunque parezca que no, necesitamos el
        // método single porque tiene un execute() en su interior. PDO funciona
        // así, necesita un execute. Luego con rowCount es cuando realmente
        // comprobamos que existe o no el email en base si es true o false
        // el return de la condición en el rowCount.
        return $this->db->rowCount() > 0;
    }

    public function findUserByIde(){

    }

    public function checkUser($email, $password){
        $this->db->query('SELECT * FROM users WHERE email = :email' );
        $this->db->bind(':email', $email);
        $user = $this->db->single(); 


    }
}
*/
// profe
class User {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    //Registrar un usuario
    public function register($data){
        $this->db->query('INSERT INTO users (name, email,password)
                            VALUES (:name, :email,:password)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        //hash password
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->db->bind(':password', $hashed_password);

        return $this->db->execute();
    }

    public function emailExists($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->single();

        return $this->db->rowCount() > 0;   
    }

    public function checkUser($email, $password){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $user = $this->db->single();
        $hashed_password = $user->password;
        return password_verify($password, $hashed_password) ? $user : false;
       
    }
    public function findUserById(){

    }
}