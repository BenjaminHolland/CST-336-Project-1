<?php
   include '../lib/data/Context.php';
   $context=new Context();
   $villians=$context->getVillians();
   var_dump($villians);
?>