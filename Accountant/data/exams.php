<?php
function getAllExams($conn){
    $sql = "SELECT * FROM exams";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $exams = $stmt->fetchAll();
       return $exams;
   }else {
       return 0;
   }      
}


function getExamsById($exams_id, $conn){
    $sql = "SELECT * FROM exams WHERE exams_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$exams_id]);

   if ($stmt->rowCount() == 1) {
       $exams = $stmt->fetch();
       return $exams;
   }else {
       return 0;
   }      
}

//DELETE
function removeExams($id, $conn){
    $sql = "DELETE FROM exams
    WHERE exams_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}