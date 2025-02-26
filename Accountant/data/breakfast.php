<?php
function getAllMeals($conn){
    $sql = "SELECT * FROM breakfast_fee ORDER BY term ASC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $meals = $stmt->fetchAll();
       return $meals;
   }else {
       return 0;
   }      
}


function getMealById($fee_id, $conn){
    $sql = "SELECT * FROM breakfast_fee WHERE fee_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$fee_id]);

   if ($stmt->rowCount() == 1) {
       $meal = $stmt->fetch();
       return $meal;
   }else {
       return 0;
   }      
}

//DELETE
function removeMeal($fee_id, $conn){
    $sql = "DELETE FROM breakfast_fee
    WHERE fee_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$fee_id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}

function getFeeByBreakfast($breakfast, $term,$year, $conn){
    $sql = "SELECT * FROM breakfast_fee WHERE choice=? AND 
    term=? AND year=?";
    $stmt = $conn->prepare($sql);
          $stmt->execute([$breakfast, $term,$year]);
    
    if ($stmt->rowCount() == 1) {
       $fee = $stmt->fetch();
       return $fee;
    }else {
       return 0;
    }      
    }