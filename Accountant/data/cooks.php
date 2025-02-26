<?php
function getAllCooks($conn){
    $sql = "SELECT * FROM cooks";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $cooks = $stmt->fetchAll();
       return $cooks;
   }else {
       return 0;
   }      
}


function getCookById($cook_id, $conn){
    $sql = "SELECT * FROM cooks WHERE cook_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$cook_id]);

   if ($stmt->rowCount() == 1) {
       $cook = $stmt->fetch();
       return $cook;
   }else {
       return 0;
   }      
}

//DELETE
function removeCook($id, $conn){
    $sql = "DELETE FROM cooks
    WHERE cook_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}

function unameIsUnique($uname, $conn, $cook_id=0){
    $sql = "SELECT username FROM cooks
    WHERE username=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$uname]);
    
    if ($cook_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        }else {
            return 1;
       }
    }else {
        if ($stmt->rowCount() >= 1) {
            $cook = $stmt->fetch();
            if ($cook['cook_id'] == $cook_id) {
               return 1;
            }else return 0;
        }else {
            return 1;
    }     
}
}