<?php
   include '../lib/data/Context.php';
   $context=new Context();
   $villians=$context->getAvailableHenchpeople();
   var_dump($villians);
?>