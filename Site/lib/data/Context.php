<?php
    class Context{
        
        private $connection;
        function __construct(){
            try {
                $this->connection=new PDO("mysql:dbname=VillianDb;host=127.0.0.1","guest","");
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        
        public function getVillians(){
            $text=

"
SELECT *
FROM Villian
";
            $statement=$this->connection->prepare($text);
            $statement->execute();
            $result=$statement->fetchAll();
            return $result;
        }
    }
?>