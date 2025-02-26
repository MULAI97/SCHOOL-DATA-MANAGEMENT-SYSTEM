<?php
function getAllFoods($conn){
    $sql = "SELECT * FROM lunch";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $foods = $stmt->fetchAll();
       return $foods;
   }else {
       return 0;
   }      
}


function getFoodById($choice_id, $conn){
    $sql = "SELECT * FROM lunch WHERE choice_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$choice_id]);

   if ($stmt->rowCount() == 1) {
       $food = $stmt->fetch();
       return $food;
   }else {
       return 0;
   }      
}

//DELETE
function removeFood($choice_id, $conn){
    $sql = "DELETE FROM lunch
    WHERE choice_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$choice_id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}