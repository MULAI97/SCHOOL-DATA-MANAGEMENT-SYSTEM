<?php
function getAllMeals($conn){
    $sql = "SELECT * FROM meals";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $meals = $stmt->fetchAll();
       return $meals;
   }else {
       return 0;
   }      
}


function getMealById($meal_id, $conn){
    $sql = "SELECT * FROM meals WHERE meal_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$meal_id]);

   if ($stmt->rowCount() == 1) {
       $meal = $stmt->fetch();
       return $meal;
   }else {
       return 0;
   }      
}

//DELETE
function removeMeal($id, $conn){
    $sql = "DELETE FROM meals
    WHERE meal_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}