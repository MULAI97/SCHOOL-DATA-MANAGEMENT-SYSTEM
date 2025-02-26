<?php
function getAllDrivers($conn){
    $sql = "SELECT * FROM drivers";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $drivers = $stmt->fetchAll();
       return $drivers;
   }else {
       return 0;
   }      
}


function getDriverById($driver_id, $conn){
    $sql = "SELECT * FROM drivers WHERE driver_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$driver_id]);

   if ($stmt->rowCount() == 1) {
       $driver = $stmt->fetch();
       return $driver;
   }else {
       return 0;
   }      
}

//DELETE
function removeDriver($id, $conn){
    $sql = "DELETE FROM drivers
    WHERE driver_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}

function unameIsUnique($uname, $conn, $driver_id=0){
    $sql = "SELECT username FROM drivers
    WHERE username=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$uname]);
    
    if ($driver_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        }else {
            return 1;
       }
    }else {
        if ($stmt->rowCount() >= 1) {
            $driver = $stmt->fetch();
            if ($driver['driver_id'] == $driver_id) {
               return 1;
            }else return 0;
        }else {
            return 1;
    }     
}
}