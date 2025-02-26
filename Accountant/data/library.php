<?php
function getBookById($book_id, $conn){
    $sql = "SELECT * FROM books WHERE book_id=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$book_id]);

   if ($stmt->rowCount() == 1) {
       $book = $stmt->fetch();
       return $book;
   }else {
       return 0;
   }      
}


function getAllBooks($conn){
     $sql = "SELECT * FROM books ORDER BY class ASC";
     $stmt =$conn->prepare($sql);
           $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $books = $stmt->fetchAll();
        return $books;
    }else {
        return 0;
    }      
}



//CHECK IF USERNAME IS UNIQUE
function book_numberIsUnique($book_number, $conn, $book_id=0){
    $sql = "SELECT book_number FROM books
    WHERE book_number=?";
    $stmt =$conn->prepare($sql);
          $stmt->execute([$book_number]);
    
    if ($book_id == 0) {
        if ($stmt->rowCount() >= 1) {
            return 0;
        }else {
            return 1;
       }
    }else {
        if ($stmt->rowCount() >= 1) {
            $book = $stmt->fetch();
            if ($book['book_id'] == $book_id) {
               return 1;
            }else return 0;
        }else {
            return 1;
    }     
}
}

//DELETE
function removeBook($id, $conn){
    $sql = "DELETE FROM books
    WHERE book_id=?";
    $stmt =$conn->prepare($sql);
    $re = $stmt->execute([$id]);

   if ($re) {
       return 1;
   }else {
       return 0;
   }      
}

//SEARCH
function searchBooks($key, $conn){
    $key = "%{$key}%";
    $sql = "SELECT * FROM books WHERE book_id LIKE ? 
    OR fname LIKE ? 
    OR lname LIKE ? 
    OR username LIKE ?
    OR destination LIKE ?
    OR bus LIKE ?
    OR type LIKE ?
    OR parent_fname LIKE ?
    OR parent_lname LIKE ?
    OR parent_phone_number LIKE ?
    OR email_address LIKE ?";
    
    $stmt =$conn->prepare($sql);
          $stmt->execute([$key, $key,$key,$key,$key,$key, $key,$key, $key,$key,$key]);

   if ($stmt->rowCount() >= 1) {
       $students = $stmt->fetchAll();
       return $students;
   }else {
       return 0;
   }      
}
