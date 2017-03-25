<?php

    class VillianModel{
        public $VillianId;
        public $Name;
        public $Address;
    }
    
    class OrderModel{
        public $OrderId;
        public $VillianId;
        public $OrderStatusId;
    }
    
    class OrderLineModel{
        public $OrderLineId;
        public $OrderId;
        public $HenchpersonId;
    }
    
    class HenchpersonModel{
        public $HenchpersonId;
        public $Name;
        public $Description;
        public $HenchpersonStatusId;
        public $SpecialityId;
    }
    
    class SpecialityModel{
        public $SpecialityId;
        public $Description;
    }
    
    class HenchpersonStatusModel{
        public $HenchpersonStatusId;
        public $Description;
    }
?>