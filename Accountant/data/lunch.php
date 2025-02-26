<?php
function getAllLunch($conn){
    $sql = "SELECT * FROM lunch_fee ORDER BY term ASC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $lunch = $stmt->fetchAll();
       return $lunch;
   }else {
       return 0;
   }      
}


function getLunchById($fee_id, $conn){
    $sql = "SELECT * FROM lunch_fee WHERE fee_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$fee_id]);

   if ($stmt->rowCount() == 1) {
       $lunch = $stmt->fetch();
       return $lunch;
   }else {
       return 0;
   }      
}

//DELETE
function removeLunch($fee_id, $conn){
    $sql = "DELETE FROM lunch_fee
    WHERE fee_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$fee_id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}

function getFeeByLunch($lunch, $term,$year, $conn){
    $sql = "SELECT * FROM lunch_fee WHERE choice=? AND 
    term=? AND year=?";
    $stmt = $conn->prepare($sql);
          $stmt->execute([$lunch, $term,$year]);
    
    if ($stmt->rowCount() == 1) {
       $fee = $stmt->fetch();
       return $fee;
    }else {
       return 0;
    }      
    }