<?php
namespace MyDB;
require_once "../utilits/exceptions.php";
use MyExceptions\DbException;


class Jsondb{

    private array $db;
    private string $dbpath;
    private $table;
    private static $instance;

    function __construct(string $dbpath, string $tabname){
        if (file_exists($dbpath)){
            $this->dbpath=$dbpath;
            $this->db = json_decode(file_get_contents($dbpath,true),true);
            if (key_exists($tabname,$this->db)){
                $this->table=&$this->db[$tabname];
            }elseif (!is_null($tabname)){
                throw new DbException("table does not exist");
            }
        }
        else{
            throw new DbException("File DB does not exist");
        }
    }

    public static function createdb(string $dbn){
        $db=fopen($dbn,"w+");
        fwrite($db,"{}");
        fclose($db);
    }

    public static function createTable( string $dbpath, string $tabname){
        $db=json_decode(file_get_contents($dbpath,true),true);
        $db[$tabname]=array();
        file_put_contents($dbpath,json_encode($db));
    }

    public function save(){
        file_put_contents($this->dbpath, json_encode($this->db));
    }

    public static function getInstance(string $path="../dbjson.json", string $tabname="Users"): self
    {
        if(!file_exists($path)){
            self::createdb($path);
            self::createTable($path, $tabname);
        }
        if (self::$instance === null) {
            self::$instance = new self($path, $tabname);
        }

        return self::$instance;
    }

    public function find(string $ext, int $numcol=null){
        if (!empty($this->table)){
            foreach ($this->table as $id=>$row){
                if(is_null($numcol)){
                    foreach ($row as $value){
                        if($ext==$value){
                            return array($id=>$row);
                        }
                    }
                }
                else{
                    if($row[$numcol]==$ext){
                        return array($id=>$row);
                    }
                }
            }
            throw new DbException("extention do not exist");
        }
        else{
            throw new DbException("table does not exist");
        }
    }

    public function findAll(){
        if (!empty($this->table)){
            return $this->table;
        }
        else{
            throw new DbException("table does not exist");
        }
    }

    public function create( array $arr){
        $this->table[]=$arr;
        $this->save();
    }

    public function select(int $id){
        return $this->table[$id];
    }
    public function update(int $id, array $arr){
        $this->table[$id]=$arr;
        $this->save();
    }
    public function delete(int $id){
        $this->table[$id]=array();
        $this->save();
    }

    function __destruct(){
        $this->save();
    }
}
