<?php

function getExpenseById($expense_id, $conn){
    $sql = "SELECT * FROM expenses WHERE expense_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$expense_id]);

   if ($stmt->rowCount() == 1) {
       $expense = $stmt->fetch();
       return $expense;
   }else {
       return 0;
   }      
}

function getAllExpenses($conn){
     $sql = "SELECT * FROM expenses ORDER BY date DESC";
     $stmt =$conn->prepare($sql);
           $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $expenses = $stmt->fetchAll();
        return $expenses;
    }else {
        return 0;
    }      
}


//DELETE
function removeExpense($id, $conn){
    $sql = "DELETE FROM expenses
    WHERE expense_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}

