<?php


function getR_usersById($r_user_id, $conn){
    $sql = "SELECT * FROM registry_office WHERE r_user_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$r_user_id]);

   if ($stmt->rowCount() == 1) {
       $teacher = $stmt->fetch();
       return $teacher;
   }else {
       return 0;
   }      
}

function getAllR_users($conn){
     $sql = "SELECT * FROM registry_office";
     $stmt =$conn->prepare($sql);
           $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $r_users = $stmt->fetchAll();
        return $r_users;
    }else {
        return 0;
    }      
}


//CHECK IF USERNAME IS UNIQUE
function unameIsUnique($uname, $conn, $r_user_id=0){
    $sql = "SELECT username FROM registry_office
    WHERE username=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$uname]);
    
    if ($r_user_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        }else {
            return 1;
       }
    }else {
        if ($stmt->rowCount() == 1) {
            $r_user = $stmt->fetch();
            if ($r_user['r_user_id'] == $r_user_id) {
               return 1;
            }else return 0;
        }else {
            return 1;
    }     
}
}

//DELETE
function removeRUser($id, $conn){
    $sql = "DELETE FROM registry_office
    WHERE r_user_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}