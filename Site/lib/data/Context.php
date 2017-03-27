<?php
    include 'Models.php';
    /**
     * Context Class
     * Encapsulates access to the database. Provides simple utility methods for reading data out of the database.
     */
    class Context{
        /**
         * Specifies the order in which to have the results of a query of henchmen ordered.
         * This description is terrible.
         */
         
         //Order the retrieved henchmen by ID
        const HENCH_ORDER_BY_ID=1;
        
        //Order the retrieved henchmen by name.
        const HENCH_ORDER_BY_TITLE=2;
        
        //Order the retrieved henchmen by the number of skills they have.
        const HENCH_ORDER_BY_SKILL_COUNT=3;
        
        //This contexts connection to the database. 
        private $connection;
        
        function __construct(){
            try {
                $this->connection=new PDO("mysql:dbname=VillianDb;host=127.0.0.1","guest","");
                
                //Treat errors for this connection as PHP Exceptions.
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        
        //Retrieve all henchpeople currently employed by a specific villian.
        public function getHenchpeopleForVillian($Id,$henchOrder){
            //The main SQL text for the query. 
            $text=
"
SELECT Henchperson.Id AS Id,Henchperson.Title AS Name,Henchperson.Description AS Description
FROM Contract
JOIN Villian ON Contract.VillianId=Villian.Id
JOIN Henchperson ON Contract.HenchpersonId=Henchperson.Id
WHERE Contract.ContractStatusId=0 AND Contract.VillianId=:Id
";

            //Append an "ORDER BY " statement based on the requested order.
            switch($henchOrder){
                case Context::HENCH_ORDER_BY_ID:
                    $text.="ORDER BY Henchperson.Id";
                    break;
                case Context::ORDER_BY_TITLE:
                    $text.="ORDER BY Henchperson.Title";
                    break;
                case Context::ORDER_BY_SKILL_COUNT:
                    $text.="ORDER BY (SELECT COUNT(*) FROM HenchpersonSpeciality WHERE HenchpersonSpeciality.HenchpersonId=Henchperson.Id)";
                    break;
            }
            
            //Prepare the sql query.
            $statement=$this->connection->prepare($text);
            
            //Bind the Id variable to the :Id specifier. 
            $statement->bindParam(":Id",$Id);
            
            //Query the database. 
            $statement->execute();
            
            //The array of henchpeople to return.
            $return=[];
            
            //Loop through each selected henchperson
            foreach($statement->fetchAll() as $henchperson){
                
                //Get an array of skills for the henchperson.
                $skills=$this->getSpecialitiesForHenchperson($henchperson["Id"]);
                
                //Push a new henchperson model into the array.
                array_push($return, new HenchpersonModel($henchperson['Id'],$henchperson['Name'],$henchperson['Description'],$skills,false));
            }
            
            //Return the array.
            return $return;
        }
        
        public function getVillians(){
            $text=
"
SELECT * 
FROM Villian
ORDER BY NameFirst DESC;
";
            $statement=$this->connection->prepare($text);
            $statement->execute();
            $return=[];
            foreach($statement->fetchAll() as $record){
                array_push($return,new VillianModel(
                    $record['Id'],
                    $record['NamePrefix'],
                    $record['NameFirst'],
                    $record['NameLast'],
                    $record['NameSuffix'],
                    $record['DropLat'],
                    $record['DropLon']));
            }
            return $return;
        }
        /**
         * Returns a list of skills for a specified henchperson.
         */
        public function getSpecialitiesForHenchperson($Id){
            //The text of the SQL query.
            $text=
"
SELECT Description
FROM HenchpersonSpeciality AS hs
JOIN Speciality ON hs.SpecialityId=Speciality.Id
WHERE hs.HenchpersonId=:Id
";
            
            $statement=$this->connection->prepare($text);
            $statement->bindParam(":Id",$Id);
            $statement->execute();
            $return=[];
            foreach($statement->fetchAll() as $record){
                array_push($return,$record["Description"]);
            }
            return $return;
        }
        
        
    
        /**
         * Retrieves a list of Henchpeople that are available for hire
         */
        public function getAvailableHenchpeople($henchOrder){
            $text=
"
SELECT *
FROM Henchperson
WHERE (SELECT COUNT(*) FROM Contract WHERE Contract.HenchpersonId=Henchperson.Id AND Contract.ContractStatusId=1)=0
";
            switch($henchOrder){
                case Context::HENCH_ORDER_BY_ID:
                    $text.="ORDER BY Henchperson.Id";
                    break;
                case Context::HENCH_ORDER_BY_TITLE:
                    $text.="ORDER BY Henchperson.Title";
                    break;
                case Context::HENCH_ORDER_BY_SKILL_COUNT:
                    $text.="ORDER BY (SELECT COUNT(*) FROM HenchpersonSpeciality WHERE HenchpersonSpeciality.HenchpersonId=Henchperson.Id)";
                    break;
            }
            $statement=$this->connection->prepare($text);
            $statement->execute();
            $result=$statement->fetchAll();
            $return=[];
            foreach($result as $henchperson){
                
                $skills=$this->getSpecialitiesForHenchperson($henchperson['Id']);
                $model=new HenchpersonModel($henchperson['Id'],$henchperson['Title'],$henchperson['Description'],$skills,true);
                array_push($return,$model);
            }
            return $return;
        }
    }
?>