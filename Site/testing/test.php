<?php
   include '../lib/data/Context.php';
   $context=new Context();
   $henchpeople=$context->getAvailableHenchpeople(Context::HENCH_ORDER_BY_TITLE);
   
   foreach($henchpeople as $henchperson){
      echo "<div>".$henchperson->Name;
      
      echo "</div>";
   }

?>