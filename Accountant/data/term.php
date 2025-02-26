<?php
function getAllTerms($conn){
    $sql = "SELECT * FROM terms";
    $stmt =$conn->prepare($sql);
          $stmt->execute();

   if ($stmt->rowCount() >= 1) {
       $terms = $stmt->fetchAll();
       return $terms;
   }else {
       return 0;
   }      
}


function getTermById($term_id, $conn){
    $sql = "SELECT * FROM terms WHERE term_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$term_id]);

   if ($stmt->rowCount() == 1) {
       $term = $stmt->fetch();
       return $term;
   }else {
       return 0;
   }      
}

//DELETE
function removeTerm($id, $conn){
    $sql = "DELETE FROM terms
    WHERE term_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}