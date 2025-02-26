<?php
function getAllTeas($conn){
    $sql = "SELECT * FROM breakfast";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $teas = $stmt->fetchAll();
       return $teas;
   }else {
       return 0;
   }      
}


function getTeaById($choice_id, $conn){
    $sql = "SELECT * FROM breakfast WHERE choice_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$choice_id]);

   if ($stmt->rowCount() == 1) {
       $tea = $stmt->fetch();
       return $tea;
   }else {
       return 0;
   }      
}

//DELETE
function removeTea($choice_id, $conn){
    $sql = "DELETE FROM breakfast
    WHERE choice_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$choice_id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}