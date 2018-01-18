<?php

class User extends Model {

    //protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $salt;
    protected $role;

    private function __construct($username = ""){
        if($username != "") {
            $this->username = $username;
        }
    }

    public static function login($username, $password){
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

    public static function register($username, $email, $password, $role){
        $user = new User($username);
        $user->email = $email;
        $user->role = $role;
        $user->setPassword($password);
        $user->save();
        if($user->getId()) {
            App::setLoggedInUser($user);
            return $user;
        } else {
            return false;
        }
    }

    private function setPassword($password){
        $this->salt = self::generateSalt();
        $this->password = hash('sha256', $password . $this->salt);
    }

    public static function generateSalt(){
        return uniqid();
    }


    protected static function newModel($obj){

        $email = $obj->email;

        $existing = User::findBy('email', $email);
        if(count($existing) > 0) return false;

        //Check if user is valid
        return true;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){

        $possible = ['user', 'admin', 'customer'];
        if (array_search($role, $possible)) {
            $this->role = $role;
            return true;
        }
        return false;
    }

    private function checkPassword($password){
        $hash = hash('sha256', $password . $this->salt);
        return ($hash == $this->password);
    }


    public function getLaptops(){
        return $this->hasMany("Laptop");
    }
}
