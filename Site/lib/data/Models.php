<?php

  class HenchpersonModel{
      public $Id;
      public $Name;
      public $Specialities;
      public $Description;
      public function __construct($id,$name,$description,$specialities){
          $this->Id=$id;
          $this->Name=$name;
          $this->Description=$description;
          $this->Specialities=$specialities;
      }
  }
?>