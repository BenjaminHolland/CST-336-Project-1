<?php
    class VillianModel{
        public $Name;
        public $Address;
        public $VillianId;
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