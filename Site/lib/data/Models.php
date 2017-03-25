<?php

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