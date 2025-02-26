<?php 
function getAllPayments($conn){
    $sql = "SELECT * FROM fees_payments";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $fees_payments = $stmt->fetchAll();
       return $fees_payments;
   }else {
       return 0;
   }      
}

function getPaymentById($payment_id, $student_id, $term, $year, $conn){
    $sql = "SELECT * FROM fees_payments WHERE student_id=? AND 
    term=? AND year=?";
    $stmt = $conn->prepare($sql);
          $stmt->execute([$student_id, $term, $year]);

   if ($stmt->rowCount() == 1) {
       $fees_payments = $stmt->fetch();
       return $fees_payments;
   }else {
       return 0;
   }      
}

function getPayById($student_id, $term, $year,$conn){
    $sql = "SELECT * FROM fees_paid WHERE student_id=? AND 
    term=? AND year=?";
    $stmt = $conn->prepare($sql);
          $stmt->execute([$student_id, $term, $year]);

   if ($stmt->rowCount() > 0) {
       $payments = $stmt->fetchAll();
       return $payments;
   }else {
       return 0;
   }      
}


//SEARCH

function getFees($student_id, $term, $year, $conn)
{
    $sql = "SELECT SUM(amount) FROM fees_paid WHERE student_id=? AND term=? 
    AND year=? /*GROUP BY student_id*/";
  
    $stmt =$conn->prepare($sql);
          $stmt->execute([$student_id,$term,$year]);

   if ($stmt->rowCount() == 1) {
       $fees = $stmt->fetch();
       return $fees;
   }else {
       return 0;
   }     
}


