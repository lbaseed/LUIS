<?php  

    session_start();
	error_reporting(0);

   

    class Config{
        
        private $_host, 
                $_dbname, 
                $_dbuser, 
                $_dbpass;
        
        public function connect(){

            $this->_host = "localhost";
            $this->_dbname = "uis";
            $this->_dbuser = "root";
            $this->_dbpass = "";

            $dsn = "mysql:host=".$this->_host.";dbname=".$this->_dbname;
            $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];

            try{
                $pdo = new PDO($dsn , $this->_dbuser, $this->_dbpass, $options);
                return $pdo;
            }
            catch(PDOException $e){
                die($e->getMessage());
                //die("Unable to connect to Remote Server");
            }

        }
        
    }

    $Config = new Config;
    $conn = $Config->connect();
?>