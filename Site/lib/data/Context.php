<?php
    include 'Models.php';
    class Context{
        
        public const HENCH_ORDER_BY_ID=1;
        public const HENCH_ORDER_BY_TITLE=2;
        public const HENCH_ORDER_BY_SKILL_COUNT=3;
        private $connection;
        function __construct(){
            try {
                $this->connection=new PDO("mysql:dbname=VillianDb;host=127.0.0.1","guest","");
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        
        public function getHenchpeopleForVillian($Id,$henchOrder){
            $text=
"
SELECT Henchperson.Id AS Id,Henchperson.Title AS Name,Henchperson.Description AS Description
FROM Contract
JOIN Villian ON Contract.VillianId=Villian.Id
JOIN Henchperson ON Contract.HenchpersonId=Henchperson.Id
WHERE Contract.ContractStatusId=0 AND Contract.VillianId=:Id
";
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
            $statement=$this->connection->prepare($text);
            $statement->bindParam(":Id",$Id);
            $statement->execute();
            $return=[];
            foreach($statement->fetchAll() as $record){
                $skills=getSpecialitiesForHenchperson($record["Id"]);
                array_push($return, new HenchpersonModel($henchperson['Id'],$henchperson['Name'],$henchperson['Description'],$skills,false));
            }
            return $return;
        }
        /**
         * Returns a list of skills for a specified henchperson.
         */
        public function getSpecialitiesForHenchperson($Id){
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
                case Context::ORDER_BY_TITLE:
                    $text.="ORDER BY Henchperson.Title";
                    break;
                case Context::ORDER_BY_SKILL_COUNT:
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