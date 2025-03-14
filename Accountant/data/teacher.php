<?php


function getTeacherById($teacher_id, $conn){
    $sql = "SELECT * FROM teachers WHERE teacher_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$teacher_id]);

   if ($stmt->rowCount() == 1) {
       $teacher = $stmt->fetch();
       return $teacher;
   }else {
       return 0;
   }      
}

function getAllTeachers($conn){
     $sql = "SELECT * FROM teachers";
     $stmt =$conn->prepare($sql);
           $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $teachers = $stmt->fetchAll();
        return $teachers;
    }else {
        return 0;
    }      
}


//CHECK IF USERNAME IS UNIQUE
function unameIsUnique($uname, $conn, $teacher_id=0){
    $sql = "SELECT username FROM teachers
    WHERE username=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$uname]);
    
    if ($teacher_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        }else {
            return 1;
       }
    }else {
        if ($stmt->rowCount() >= 1) {
            $teacher = $stmt->fetch();
            if ($teacher['teacher_id'] == $teacher_id) {
               return 1;
            }else return 0;
        }else {
            return 1;
    }     
}
}


//DELETE
function removeTeacher($id, $conn){
    $sql = "DELETE FROM teachers
    WHERE teacher_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}

//SEARCH
function searchTeachers($key, $conn){
    $key = "%{$key}%";
    $sql = "SELECT * FROM teachers WHERE teacher_id LIKE ? 
    OR fname LIKE ? 
    OR lname LIKE ? 
    OR username LIKE ?
    OR address LIKE ?
    OR employee_number LIKE ?
    OR date_of_birth LIKE ?
    OR phone_number LIKE ?
    OR qualification LIKE ?
    OR email_address LIKE ?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$key, $key, $key,$key,$key,$key, $key, $key,$key,$key]);

   if ($stmt->rowCount() >= 1) {
       $teachers = $stmt->fetchAll();
       return $teachers;
   }else {
       return 0;
   }      
}