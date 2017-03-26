<?php

  class VillianModel{
    public $Id;
    public $NamePrefix;
    public $FirstName;
    public $LastName;
    public $NameSuffix;
    public $DropzoneLon;
    public $DropzoneLat;
    public function getFullName(){
      return $this->NamePrefix." ".$this->FirstName." ".$this->LastName." ".$this->NameSuffix;
    }
    public function __construct($id,$prefix,$first,$last,$suffix,$lat,$lon){
      $this->Id=$id;
      $this->NamePrefix=$prefix;
      $this->FirstName=$first;
      $this->LastName=$last;
      $this->NameSuffix=$suffix;
      $this->DropzoneLat=$lat;
      $this->DropzoneLon=$lon;
    }
  }
  
  class HenchpersonModel{
      public $Id;
      public $Name;
      public $Specialities;
      public $Description;
      public $IsAvailable;
      public function __construct($id,$name,$description,$specialities,$isAvailable){
          $this->Id=$id;
          $this->Name=$name;
          $this->Description=$description;
          $this->Specialities=$specialities;
          $this->IsAvailable=$isAvailable;
      }
  }
?>