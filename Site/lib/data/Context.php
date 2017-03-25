<?php
    include 'Models.php';
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
        
        public function nextContractId(){
            $text="SELECT Max(Id) FROM Contract";
            return $connection->query($text)->fetch()+1;
        }
        
        /**
         * Opens a contract;
         */
        public function openContract($villianId,$henchpersonId,$salary){
            $text=
"
INSERT INTO Contract(Id,VillianId,HenchpersonId,WhenOpened,ContractStatusId,Salary)
VALUES (:Id,:VID,:HID,UTC_TIMESTAMP,0,:Salary);
";
            $statement=$this->prepare($text);
            $statement->bindParam(":Id",nextContractId());
            $statement->bindParam(":VID",$villianId);
            $statement->bindParam(":HID",$henchpersonId);
            $statement->bindParam(":Salary",$salary);
            $statement->execute();
        }
        
        /**
         * Closes a contract
         */
        public function closeContract($id){
            $text=
"
UPDATE Contract
SET ContractStatusId=1
WHERE Id=:Id;
";        
            $statement=$this->prepare($text);
            $statement->bindParam(":Id",$id);
            $statement->execute();
            
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
        public function getAvailableHenchpeople(){
            $text=
"
SELECT *
FROM Henchperson
WHERE (SELECT COUNT(*) FROM Contract WHERE Contract.HenchpersonId=Henchperson.Id AND Contract.ContractStatusId=1)=0
";
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