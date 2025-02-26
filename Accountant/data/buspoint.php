<?php
function getAllBuspoints($conn){
    $sql = "SELECT * FROM buspoints";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $buspoints = $stmt->fetchAll();
       return $buspoints;
   }else {
       return 0;
   }      
}


function getBuspointById($buspoint_id, $conn){
    $sql = "SELECT * FROM buspoints WHERE buspoint_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$buspoint_id]);

   if ($stmt->rowCount() == 1) {
       $buspoint = $stmt->fetch();
       return $buspoint;
   }else {
       return 0;
   }      
}

//DELETE
function removeBuspoint($id, $conn){
    $sql = "DELETE FROM buspoints
    WHERE buspoint_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}