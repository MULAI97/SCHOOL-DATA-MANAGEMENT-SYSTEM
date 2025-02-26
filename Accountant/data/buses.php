<?php
function getAllBuses($conn){
    $sql = "SELECT * FROM buses";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $buses = $stmt->fetchAll();
       return $buses;
   }else {
       return 0;
   }      
}


function getBusById($bus_id, $conn){
    $sql = "SELECT * FROM buses WHERE bus_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$bus_id]);

   if ($stmt->rowCount() == 1) {
       $bus = $stmt->fetch();
       return $bus;
   }else {
       return 0;
   }      
}

function getBusByDestinationId($destination_id, $conn){
    $sql = "SELECT * FROM destinations WHERE bus=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$destination_id]);

   if ($stmt->rowCount() == 1) {
       $bus = $stmt->fetch();
       return $bus;
   }else {
       return 0;
   }      
}

//DELETE
function removeBus($id, $conn){
    $sql = "DELETE FROM buses
    WHERE bus_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}