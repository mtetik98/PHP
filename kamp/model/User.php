<?php

class User extends Model {

    //protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $salt;
    protected $role;

    private function __construct($username = "") {
        if($username != "") {
            $this->username = $username;
        }
    }

    public static function login($username, $password) {
        $res = User::findBy('username', $username);

        if (count($res) > 0) {
            $user = $res[0];

            if ($user->checkPassword($password)) {
                App::setLoggedInUser($user);
                return $user;
            }
        }
        return false;
    }

    public static function register($username, $email, $password, $role) {
        $user = new User($username);
        $user->email = $email;
        $user->role = $role;
        $user->setPassword($password);
        $user->save();
        // if($user->getId()) {
        //     App::setLoggedInUser($user);
        //     return $user;
        // } else {
        //     return false;
        // }
    }

    public function setPassword($password)
    {
        $this->salt = self::generateSalt();
        $this->password = hash('sha256', $password . $this->salt);
    }

    public static function generateSalt()
    {
        return uniqid();
    }

    public static function getLoginForm()
    {

        $form = new Form();
        $form->addField(new FormField("username", "text", "username"));
        return $form->getHTML();

    }

    // Change encryption method if you experience problems. Don't forget to alter 'checkPassword()' as well.

    protected static function newModel($obj)
    {

        $email = $obj->email;

        $existing = User::findBy('email', $email);
        if(count($existing) > 0) return false;

        //Check if user is valid
        return true;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }


    public function setEmail($email) {
        $this->email = $email;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getId()
    {
        return $this->id;
    }

    // public function setRole($role)
    // {

    //     $possible = ['user', 'admin', 'customer'];
    //     if (array_search($role, $possible)) {
    //         $this->role = $role;
    //         return true;
    //     }
    //     return false;
    // }

    private function checkPassword($password)
    {
        $hash = hash('sha256', $password . $this->salt);
        return ($hash == $this->password);
    }

    public static function change($id, $email, $username, $role){
        $user = User::findById($id);
        $user->setEmail($email);
        $user->setUsername($username);
        $user->setRole($role);
        
        $user->save();
        App::redirect("users");
    }

    public function getChangeForm() {
        $form = new Form();
        $emailField = new FormField("email", "text", "email", User::getEmail());
        $emailField->required();

        $usernameField = new FormField("username", "text", "username", User::getUsername());
        $usernameField->required();

        $form->addField($emailField);
        $form->addField($usernameField);
        $form->addField(new FormField("role", "text", "role", User::getRole()));

        return $form;
    }
    
}
