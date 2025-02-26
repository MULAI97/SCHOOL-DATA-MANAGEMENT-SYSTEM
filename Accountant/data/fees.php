<?php
function getFeesByGrade($grade, $term, $year, $conn){
    $sql = "SELECT * FROM fees WHERE grade=? AND 
    term=? AND year=?";
    $stmt = $conn->prepare($sql);
          $stmt->execute([$grade, $term, $year]);

   if ($stmt->rowCount() == 1) {
       $fees = $stmt->fetch();
       return $fees;
   }else {
       return 0;
   }      
}


function payment_codeIsUnique($payment_code, $conn, $payment_id=0){
    $sql = "SELECT payment_code FROM fees_paid
    WHERE payment_code=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$payment_code]);
    
    if ($payment_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        }else {
            return 1;
       }
    }else {
        if ($stmt->rowCount() >= 1) {
            $payment = $stmt->fetch();
            if ($payment_id['payment_id'] == $payment_id) {
               return 1;
            }else return 0;
        }else {
            return 1;
    }     
}
}
