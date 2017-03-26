<?php
   include '../lib/data/Context.php';
   $context=new Context();
   $henchpeople=$context->getAvailableHenchpeople(Context::HENCH_ORDER_BY_TITLE);
   
   echo $henchpeople[0]->Specialities[0];
?>