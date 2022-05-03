<?php
namespace MyModel;
require_once "../utilits/db.php";
require_once "../utilits/validators.php";
use MyDB\Jsondb;
use MyExceptions\LoginException;
use MyExceptions\PasswordException;
use MyExceptions\DbException;

class User{

    private $id;
    private $name;
    private $login;
    private $sha_pass;
    private $email;
    private $authToken;

    function __construct(string $login, string $password){
        try {
            $dbdata=Jsondb::getInstance()->find($login);
        }
        catch (DbException $e){
            throw new LoginException("Пользователь не найден");
        }
        $id = key($dbdata);
        if (sha1($password)==$dbdata[$id][1]){
            $this->login=$dbdata[$id][0];
            $this->sha_pass=$dbdata[$id][1];
            $this->email=$dbdata[$id][2];
            $this->name=$dbdata[$id][3];
            $this->id=$id;
        }
        else{
            throw new PasswordException("Пароль не подходит");
        }
    }

    public function getname(){
        return $this->name;
    }

    public static function getListUsersName(){
        $users = Jsondb::getInstance()->findAll();
        $ListUserName = array();
        foreach ($users as $user){
            $ListUserName[] = $user[3];
        }
        return $ListUserName;
    }

    public static function create(string $login, string $password, string $email, string $name){
            Jsondb::getInstance()->create(array($login, sha1($password), $email, $name));
    }

    public static function read(string $ext){
        try {
            $id=Jsondb::getInstance()->find($ext);
            return $id;
        }
        catch (DbException $e){
            return false;
        }

    }

    public function update(){

    }

    public function delete(){

    }


}
