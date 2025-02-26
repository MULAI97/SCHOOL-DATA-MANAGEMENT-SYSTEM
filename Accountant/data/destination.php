<?php
function getAllDestinations($conn){
    $sql = "SELECT * FROM destinations";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $destinations = $stmt->fetchAll();
       return $destinations;
   }else {
       return 0;
   }      
}


function getDestinationById($destination_id, $conn){
    $sql = "SELECT * FROM destinations WHERE destination_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$destination_id]);

   if ($stmt->rowCount() == 1) {
       $destination = $stmt->fetch();
       return $destination;
   }else {
       return 0;
   }      
}


//DELETE
function removeDestination($id, $conn){
    $sql = "DELETE FROM destinations
    WHERE destination_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}

function getFareByDestination($destination, $bus, $term,$year, $conn){
$sql = "SELECT * FROM destinations WHERE destination=? AND 
bus=? AND term=? AND year=?";
$stmt = $conn->prepare($sql);
      $stmt->execute([$destination, $bus, $term, $year]);

if ($stmt->rowCount() == 1) {
   $fare = $stmt->fetch();
   return $fare;
}else {
   return 0;
}      
}