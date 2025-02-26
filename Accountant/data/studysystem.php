<?php
function getAllStudySystems($conn){
    $sql = "SELECT * FROM study_type";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $study_systems = $stmt->fetchAll();
       return $study_systems;
   }else {
       return 0;
   }      
}


function getStudySystemById($study_id, $conn){
    $sql = "SELECT * FROM study_type WHERE study_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$study_id]);

   if ($stmt->rowCount() == 1) {
       $study_system = $stmt->fetch();
       return $study_system;
   }else {
       return 0;
   }      
}

//DELETE
function removeStydySystem($study_id, $conn){
    $sql = "DELETE FROM study_type
    WHERE study_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}