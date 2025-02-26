<?php


function getAccountantById($accountant_id, $conn){
    $sql = "SELECT * FROM accountant WHERE accountant_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$accountant_id]);

   if ($stmt->rowCount() == 1) {
       $accountant = $stmt->fetch();
       return $accountant;
   }else {
       return 0;
   }      
}

function getAllAccountants($conn){
     $sql = "SELECT * FROM accountant";
     $stmt =$conn->prepare($sql);
           $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $accountants = $stmt->fetchAll();
        return $accountants;
    }else {
        return 0;
    }      
}


//CHECK IF USERNAME IS UNIQUE
function unameIsUnique($uname, $conn, $accountant_id=0){
    $sql = "SELECT username FROM accountant
    WHERE username=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$uname]);
    
    if ($accountant_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        }else {
            return 1;
       }
    }else {
        if ($stmt->rowCount() >= 1) {
            $accountant = $stmt->fetch();
            if ($accountant['accountant_id'] == $accountant_id) {
               return 1;
            }else return 0;
        }else {
            return 1;
    }     
}
}


//DELETE
function removeAccountant($id, $conn){
    $sql = "DELETE FROM accountant
    WHERE accountant_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}

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