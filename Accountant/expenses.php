<?php
   session_start();
   if(isset($_SESSION['accountant_id']) && isset($_SESSION['role'])){

    if ($_SESSION['role'] == 'Accountant') {
        include "../DB_connection.php";
         include "data/departments.php";
         include "data/expenses.php";
         include "data/term.php";
         include "data/via.php";
         $expenses = getAllExpenses($conn);      
         
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,
        initial-scale=1.0">
        <title> Accountant - Expenses </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="../logo.png.jpg">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
      include "inc/navbar.php";
      include "inc/accnavbar.php";
      if ($expenses >= 0) {

    ?>
    <div class="container mt-5">
        <a href="expense_add.php"
        class="btn btn-dark">Add Expenditure</a>


        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3 n-table" role="alert">
                <?=$_GET['error']?>
            </div>
                <?php } ?>


                <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table" role="alert">
                <?=$_GET['success']?>
            </div>
                <?php } ?>


        <div class="table-responsive">
        <table class="table table-bordered mt-3 n-table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Department</th> 
      <th scope="col">Description</th>  
      <th scope="col">Amount</th> 
      <th scope="col">Via</th>
      <th scope="col">Receipt No</th> 
      <th scope="col">Term</th>
      <th scope="col">Year</th>
      <th scope="col">Date spent</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 0; foreach ($expenses as $expense ) {  
      $i++; ?>

    <tr>
      <th scope="row"><?=$i?></th>
      <td>
        <?php
         $department = getDepartmentById($expense['department'], $conn);

          echo $department['department'];
        ?>
      
    </td>
     <td>
        <?php
          echo $expense['description'];
        ?>
     </td>
     <td>Ksh.
        <?php
          echo $expense['amount'];
        ?>
     </td>
     <td>
     <?php 
            $via = $expense['via'];
                $g_temp = getViaById($via, $conn);
                 if ($g_temp != 0) {

                  echo $g_temp['via'];
                 }
        ?>

      </td>
     <td>
        <?php
          echo $expense['receipt_no'];
        ?>
     </td>
     <td>
     <?php 
            $term = $expense['term'];
                $g_temp = getTermById($term, $conn);
                 if ($g_temp != 0) {

                  echo $g_temp['term'];
                 }
        ?>

      </td>
     <td>
        <?php
          echo $expense['year'];
        ?>
     </td>
     <td>
        <?php
          echo $expense['date'];
        ?>
     </td>
    </tr>
            <?php }  ?>
  </tbody>
</table>
        </div>
        <?php  }else {?>
            <div class="alert alert-info .w-450 m-5" role="alert">
            Empty!
            </div>

            <?php } ?>
    </div>
            
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
       <script>
        $(document).ready(function(){
        $("#navLinks li:nth-child(7) a").addClass('active');
});
       </script>
</body>
</html>
<?php 
include "inc/footer.php";
}else {
    header("location: ../login.php");
    exit;
}
}else {
    header("location: ../login.php");
    exit;
}

?>