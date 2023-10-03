<?php

class Database
{       //Na SZTYWNO
 private $host = "localhost";
 private $user = "musza";
 private $pwd = "qwe123";
 private $dbName = "minima_db";

 public function db_connect() {
    try{

        $dsn = "mysql:host=" . $this->host . ';dbname=' .$this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
       
        return $pdo;

    }catch(PDOException $e){
        die($e ->getMessage());
    }
 


}



public function read($query, $data =[])
{
    $DB = $this->db_connect();
    $stm =$DB->prepare($query);

    if(count($data) == 0)
    {
        $stm = $DB->query($query);
        $check =0;
        if($stm){
           $check =1; 
        }
    }else{
        $check =$stm->execute($data);

    }

    if($check)
    {
      return  $data = $stm->fetchAll(PDO::FETCH_OBJ);
    }else
    {
        return false;
    }

}


public function write($query, $data =[])
{
    $DB = $this->db_connect();
    $stm =$DB->prepare($query);

    if(count($data) == 0)
    {
        $stm = $DB->query($query);
        $check =0;
        if($stm){
           $check =1; 
        }
    }else{
        $check =$stm->execute($data);

    }

    if($check)
    {
      return  $data =true;
    }else
    {
        return false;
    } 
}





}
