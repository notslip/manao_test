<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../utilits/validators.php";
require_once "../models/model.php";
use MyValidators\LoginValidator;
use MyValidators\RegistrationValidator;
use MyModel\User;

class Controller{
    private array $request;
    function __construct(array $req)
    {
        $this->request = $req;
    }

    public function rout(){
        switch (array_key_first($this->request)){
            case "login":
                $validator = new LoginValidator($this->request["login"]);
                if($validator->check()){
                    session_start();
                    $user=new User($this->request["login"]["login"],$this->request["login"]['password']);
                    $_SESSION["name"] = $user->getname();
                    echo json_encode(array("check"=>"true"));

                }
                else{
                    echo json_encode(array("check"=>"false", "errors"=>$validator->returnErrors()));
                }
                break;
            case "registration":
                $validator=new RegistrationValidator($this->request["registration"]);
                if($validator->check()){
                    User::create($this->request["registration"]["login"],
                        $this->request["registration"]["password"],
                        $this->request["registration"]["email"],
                        $this->request["registration"]["name"]);
                    echo json_encode(array("check"=>"true"));
                }
                else{
                    echo json_encode(array("check"=>"false","erorrs"=>$validator->returnErrors()));
                }
                break;
//            case "exit":
//                session_destroy();
//                echo json_encode(array("exit"=>"true"));
//                break;
        }
    }
}

$req = json_decode(file_get_contents("php://input"),true);
$controller= new Controller($req);
$controller->rout();
