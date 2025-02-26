<?php

function adminPasswordVerify($admin_pass, $conn, $admin_id){
    $sql = "SELECT * FROM admin WHERE admin_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$admin_id]);

   if ($stmt->rowCount() == 1) {
       $admin = $stmt->fetch();
       $pass = $admin['password'];

       if (password_verify($admin_pass, $pass)) {
          return 1;
       }else {
        return 0;
       }
   }else {
       return 0;
   }      
}

function getAllAdmins($conn){
    $sql = "SELECT * FROM admin";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $admins = $stmt->fetchAll();
       return $admins;
   }else {
       return 0;
   }      
}

function unameIsUnique($uname, $conn, $admin_id=0){
    $sql = "SELECT username FROM admin
    WHERE username=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$uname]);
    
    if ($admin_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        }else {
            return 1;
       }
    }else {
        if ($stmt->rowCount() >= 1) {
            $admin = $stmt->fetch();
            if ($admin['admin_id'] == $admin_id) {
               return 1;
            }else return 0;
        }else {
            return 1;
    }     
}
}

function getAdminById($admin_id, $conn){
    $sql = "SELECT * FROM admin WHERE admin_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$admin_id]);

   if ($stmt->rowCount() == 1) {
       $admin = $stmt->fetch();
       return $admin;
   }else {
       return 0;
   }      
}


