<?php
function getAllVias($conn){
    $sql = "SELECT * FROM via";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $vias = $stmt->fetchAll();
       return $vias;
   }else {
       return 0;
   }      
}


function getViaById($via_id, $conn){
    $sql = "SELECT * FROM via WHERE via_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$via_id]);

   if ($stmt->rowCount() == 1) {
       $via = $stmt->fetch();
       return $via;
   }else {
       return 0;
   }      
}

//DELETE
function removeVia($via_id, $conn){
    $sql = "DELETE FROM via
    WHERE via_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$via_id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}