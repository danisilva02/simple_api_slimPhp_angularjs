<?php

class Db {
   private $con = null;
   
   public function con(){
       if($this->con==null){
           $this->con = new PDO(
                \sprintf("mysql:host=%s;dbname=%s;charset=utf8", "127.0.0.1", "bd_profmauro_v2"),
                "root", 
                "",
                array(
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    )
            );
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
       }
       
       return $this->con;
       
   }
}
