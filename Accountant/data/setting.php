<?php


function getSetting($conn){
    $sql = "SELECT * FROM setting";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $setting = $stmt->fetch();
       return $setting;
   }else {
       return 0;
   }      
}

