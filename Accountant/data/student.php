<?php
function getStudentById($student_id, $conn){
    $sql = "SELECT * FROM students WHERE student_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$student_id]);

   if ($stmt->rowCount() == 1) {
       $student = $stmt->fetch();
       return $student;
   }else {
       return 0;
   }      
}


function getAllStudents($conn){
     $sql = "SELECT * FROM students WHERE status=1 ORDER BY grade DESC";
     $stmt =$conn->prepare($sql);
           $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $students = $stmt->fetchAll();
        return $students;
    }else {
        return 0;
    }      
}

function getAllTransferredStudents($conn){
    $sql = "SELECT * FROM students WHERE status=2 ORDER BY grade DESC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $students = $stmt->fetchAll();
       return $students;
   }else {
       return 0;
   }      
}

function getAllBoys($conn){
    $sql = "SELECT * FROM students WHERE gender='male' And status=1 ORDER BY grade DESC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $students = $stmt->fetchAll();
       return $students;
   }else {
       return 0;
   }      
}

function getAllGirls($conn){
    $sql = "SELECT * FROM students WHERE gender='female' And status=1 ORDER BY grade DESC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $students = $stmt->fetchAll();
       return $students;
   }else {
       return 0;
   }      
}

function getAllDayscholars($conn){
    $sql = "SELECT * FROM students WHERE type=1 And status=1 ORDER BY grade DESC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $students = $stmt->fetchAll();
       return $students;
   }else {
       return 0;
   }      
}

function getAllBoarders($conn){
    $sql = "SELECT * FROM students WHERE type=2 And status=1 ORDER BY grade DESC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $students = $stmt->fetchAll();
       return $students;
   }else {
       return 0;
   }      
}

function getAllBoardersboys($conn){
    $sql = "SELECT * FROM students WHERE type=2 And status=1 AND gender='male' ORDER BY grade DESC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $students = $stmt->fetchAll();
       return $students;
   }else {
       return 0;
   }      
}

function getAllBoardersgirls($conn){
    $sql = "SELECT * FROM students WHERE type=2 And status=1 AND gender='female' ORDER BY grade DESC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $students = $stmt->fetchAll();
       return $students;
   }else {
       return 0;
   }      
}

function getAllDaygirls($conn){
    $sql = "SELECT * FROM students WHERE type=1 And status=1 AND gender='female' ORDER BY grade DESC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $students = $stmt->fetchAll();
       return $students;
   }else {
       return 0;
   }      
}

function getAllDayboys($conn){
    $sql = "SELECT * FROM students WHERE type=1 And status=1 AND gender='male' ORDER BY grade DESC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $students = $stmt->fetchAll();
       return $students;
   }else {
       return 0;
   }      
}

function getAllEndedStudents($conn){
    $sql = "SELECT * FROM students WHERE status=3 ORDER BY grade DESC";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $students = $stmt->fetchAll();
       return $students;
   }else {
       return 0;
   }      
}
function getStudentByDestinationId($destination_id, $conn){
    $sql = "SELECT * FROM students WHERE destination_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$destination_id]);

   if ($stmt->rowCount() == 1) {
       $student = $stmt->fetch();
       return $student;
   }else {
       return 0;
   }      
}


//CHECK IF USERNAME IS UNIQUE
function unameIsUnique($uname, $conn, $student_id=0){
    $sql = "SELECT username FROM students
    WHERE username=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$uname]);
    
    if ($student_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        }else {
            return 1;
       }
    }else {
        if ($stmt->rowCount() >= 1) {
            $student = $stmt->fetch();
            if ($student['student_id'] == $student_id) {
               return 1;
            }else return 0;
        }else {
            return 1;
    }     
}
}

//DELETE
function removeStudent($id, $conn){
    $sql = "DELETE FROM students
    WHERE student_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}

//SEARCH
function searchStudents($key, $conn){
    $key = "%{$key}%";
    $sql = "SELECT * FROM students WHERE student_id LIKE ? 
    OR fname LIKE ? 
    OR lname LIKE ? 
    OR username LIKE ?
    OR destination LIKE ?
    OR bus LIKE ?
    OR type LIKE ?
    OR parent_fname LIKE ?
    OR parent_lname LIKE ?
    OR parent_phone_number LIKE ?
    OR email_address LIKE ?";
    
    $stmt =$conn->prepare($sql);
          $stmt->execute([$key, $key,$key,$key,$key,$key, $key,$key, $key,$key,$key]);

   if ($stmt->rowCount() >= 1) {
       $students = $stmt->fetchAll();
       return $students;
   }else {
       return 0;
   }      
}
