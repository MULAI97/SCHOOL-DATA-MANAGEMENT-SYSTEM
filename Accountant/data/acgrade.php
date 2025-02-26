<?php
function getAllAcgrades($conn){
    $sql = "SELECT * FROM fees ORDER BY grade ASC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $acgrades = $stmt->fetchAll();
       return $acgrades;
   }else {
       return 0;
   }      
}


function getAcgradeById($acgrade_id, $conn){
    $sql = "SELECT * FROM fees WHERE id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$acgrade_id]);

   if ($stmt->rowCount() == 1) {
       $grade = $stmt->fetch();
       return $grade;
   }else {
       return 0;
   }      
}

//DELETE
function removeAcgrade($acgrade_id, $conn){
    $sql = "DELETE FROM fees
    WHERE id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$acgrade_id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}


function getAllGrades($conn){
    $sql = "SELECT * FROM grades";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $grades = $stmt->fetchAll();
       return $grades;
   }else {
       return 0;
   }      
}


function getGradeById($grade_id, $conn){
    $sql = "SELECT * FROM grades WHERE grade_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$grade_id]);

   if ($stmt->rowCount() == 1) {
       $grade = $stmt->fetch();
       return $grade;
   }else {
       return 0;
   }      
}

//DELETE
function removeGrade($id, $conn){
    $sql = "DELETE FROM grades
    WHERE grade_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}