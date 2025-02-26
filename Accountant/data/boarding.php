<?php
function getAllStudytypes($conn){
    $sql = "SELECT * FROM boarding_fee ORDER BY term ASC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $study_types = $stmt->fetchAll();
       return $study_types;
   }else {
       return 0;
   }      
}


function getStudyTypeById($fee_id, $conn){
    $sql = "SELECT * FROM boarding_fee WHERE fee_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$fee_id]);

   if ($stmt->rowCount() == 1) {
       $study_type = $stmt->fetch();
       return $study_type;
   }else {
       return 0;
   }      
}

//DELETE
function removeStudyType($fee_id, $conn){
    $sql = "DELETE FROM boarding_fee
    WHERE fee_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$fee_id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}

function getFeeByType($type, $term, $year, $conn){
    $sql = "SELECT * FROM boarding_fee WHERE study_type=? AND 
    term=? AND year=?";
    $stmt = $conn->prepare($sql);
          $stmt->execute([$type, $term, $year]);
    
    if ($stmt->rowCount() == 1) {
       $fee = $stmt->fetch();
       return $fee;
    }else {
       return 0;
    }      
    }