<?php

namespace MyValidators;
require_once "../models/model.php";
require_once "exceptions.php";

use MyModel\User;
use MyExceptions\LoginException;
use MyExceptions\PasswordException;

interface Validator{
    public function check();
    public function returnErrors();
}

class LoginValidator implements Validator{
    private string $login;
    private string $password;
    private array $err=array();

    function __construct(array $form_data){
        $this->login=$form_data["login"];
        $this->password=$form_data["password"];
    }

    public function check(){
        try {
            $user = new User($this->login, $this->password);
            unset($user);
            return true;
        }
        catch (PasswordException $e){
            $this->err["password"]=$e->getMessage();
            return false;
        }
        catch (LoginException $e){
            $this->err["login"]=$e->getMessage();
            return false;
        }

    }
    public function returnErrors()
    {
        return $this->err;
    }
}

class RegistrationValidator implements Validator {

    private string $login;
    private string $password;
    private string $confirmpassword;
    private string $email;
    private string $name;
    private array $err=array();


    function __construct(array $form_data){
        $this->login=$form_data["login"];
        $this->password=$form_data["password"];
        $this->confirmpassword=$form_data["confirmpassword"];
        $this->email=$form_data["email"];
        $this->name=$form_data["name"];
    }

    public function check()
    {
        if(strlen($this->login)<6){
            $this->err["login"]="Логин меньше 6 символов";
        }
        if(User::read($this->login)){
            $this->err["login"]="Такой логин уже существует";
        }
        if(!preg_match("/^[A-Za-z0-9]{6,12}$/", $this->password)){
            $this->err["password"]="Пароль должен быть не менее 6 символов и состоять из цифр и букв латиницы";
        }
        if($this->password!==$this->confirmpassword){
            $this->err["confirmpassword"]="Пароли не совпадают";
        }
        if(!preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $this->email)){
            $this->err["email"]="email введен некорректно";
        }
        if(User::read($this->email)){
            $this->err["email"]="Такой email уже существует";
        }
        if(!preg_match("/^[a-zA-Zа-яёА-ЯЁ]{2,}$/", $this->name)){
            $this->err["name"]="Имя должно стотоять только из букв и не меньше 2 символов";
        }
        if(!empty($this->err)){
            return false;
        }
        return true;
    }

    public function returnErrors()
    {
        return $this->err;
    }
}
