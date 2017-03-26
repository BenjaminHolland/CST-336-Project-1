<html>
   <head>
      <style>
         @import url(test.css);
      </style>
      <?php
         include '../lib/data/Context.php';
         $context=new Context();
      ?>
   </head>
   <body>
   <div class='TableContainer'>
      <table>
         <caption>Context::getVillians() Test</caption>
         <tr>
            <th>Id</th>
            <th>Full Name</th>
            <th>Dropzone Lat</th>
            <th>Dropzone Lon</th>
         </tr>
         <?php
            foreach($context->getVillians() as $villian){
               echo "<tr>";
                  echo "<td>".$villian->Id."</td>";
                  echo "<td>".$villian->getFullName()."</td>";
                  echo "<td>".$villian->DropzoneLat."</td>";
                  echo "<td>".$villian->DropzoneLon."</td>";
               echo "</tr>";   
            }
         ?>
      </table>
   </div>
   
   <div class='TableContainer'>
      <table>
         <caption>Context::getAvailableHenchpeople() Test</caption>
         <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Skills</th>
         </tr>
         <?php
            foreach($context->getAvailableHenchpeople(CONTEXT::HENCH_ORDER_BY_ID) as $hench){
               echo "<tr>";
                  echo "<td>".$hench->Id."</td>";
                  echo "<td>".$hench->Name."</td>";
                  echo "<td>".$hench->Description."</td>";
                  $skills=implode(",",$hench->Specialities);
                  echo "<td>".$skills."</td>";
               echo "</tr>";   
            }
         ?>
      </table>
   </div>
   
   <?php
      $villians=$context->getVillians();
      foreach($villians as $villian){
         echo "<table>";
            echo "<caption>Context::getHenchpeopleForVillian() for ".$villian->getFullName()."</caption>";
            echo "<tr>";
               echo "<th>Id</th><th>Name</th><th>Description</th><th>Skills</th>";
            echo "</tr>";
            $henchpeople=$context->getHenchpeopleForVillian($villian->Id,Context::HENCH_ORDER_BY_ID);
            foreach($henchpeople as $hench){
                echo "<tr>";
                  echo "<td>".$hench->Id."</td>";
                  echo "<td>".$hench->Name."</td>";
                  echo "<td>".$hench->Description."</td>";
                  $skills=implode(",",$hench->Specialities);
                  echo "<td>".$skills."</td>";
               echo "</tr>";   
            }
         echo "</table>";
      }
   ?>
   </body>
</html>