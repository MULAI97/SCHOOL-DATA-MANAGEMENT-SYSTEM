<?php
   session_start();
   if(isset($_SESSION['accountant_id']) && isset($_SESSION['role'])){

    if ($_SESSION['role'] == 'Accountant') {
        include "../DB_connection.php";
         include "data/student.php";
         include "data/setting.php";
         include "data/grade.php";
         include "data/destination.php";
        include "data/fees_payments.php"; 
        include "data/fees.php";
        include "data/boarding.php";
        include "data/breakfast.php";
        include "data/lunch.php";
        /* if (!isset($_GET['student_id'])) {
          header("location: fees_payments.php");
          exit;
         }*/
      #  $fees = getAllFees($conn);
         $students =  getAllStudents($conn);
         $setting =  getSetting($conn);
        
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,
        initial-scale=1.0">
        <title> Accountant - Fees Payments</title>
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
      if ($students != 0 && $setting !=0 ) { 
             
    ?>
     <div class="container mt-5">
        <a href="fees_foward.php"
        class="btn btn-primary">Fees Foward</a>
        <a href="#.php"
        class="btn btn-dark">Filter By Destination</a>
        <a href="#.php"
        class="btn btn-dark">Filter By Bus</a>
        <a href="#.php"
        class="btn btn-dark">Filter By Balance</a>
        <a href="#.php"
        class="btn btn-dark">Filter By Term</a>
        <a href="#.php"
        class="btn btn-dark">Filter By %</a>

        <form action="#studentacc_search.php"
        class="mt-3 n-table"
        method="get">
        <div class="input-group mb-3">
    <input type="text" 
    class="form-control"
    name="searchKey"
    placeholder="Search...">
    <button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>
  </button>
    </div>
        </form>

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
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Username</th>
      <th scope="col">Class</th>
      <th scope="col">Bal C/F</th>
      <th scope="col">Amount Payable</th>
      <th scope="col">Amount Paid</th>
      <th scope="col">Fees Balance</th>
      <th scope="col">% Fees Balance</th>
      <th scope="col">Action</th> 
      <th scope="col">Action</th> 
    </tr>
  </thead>
  <tbody>
    <?php $i = 0; foreach ($students as $student ) {  
      $i++; ?>

    <tr>
    <th scope="row"><?=$i?></th>
      <td hidden><?=$student['student_id']?></td>
      <td><a href="student_acc_view.php?student_id=<?=$student['student_id']?>">
        <?=$student['fname']?></a></td>
      <td><?=$student['lname']?></td>
      <td><?=$student['username']?></td>
      
      <td>  
        <?php 
            $grade = $student['grade'];
                $g_temp = getGradeById($grade, $conn);
                 if ($g_temp != 0) {

                echo $g_temp['grade_code'].'-'.
                $g_temp['grade'];
                 }
        ?>
        </td>
        <td><?=$student['balance_bd']?></td>
      <td>Ksh.
      <?php 
      $grade = $student['grade'];
      $term = $setting['current_term'];
      $year = $setting['current_year'];
      $destination = $student['destination'];
      $bus = $student['bus'];
      $type =$student['type'];
      $breakfast =$student['breakfast'];
      $lunch =$student['lunch'];
         #   $tuition = $grade['tuition'];
            $g_temp = getFeesByGrade($grade, $term,$year, $conn);
            #     if ($g_temp != 0) {

              $fee1= $g_temp['tuition'] += $g_temp['assessment'] += $g_temp['exam']
              += $g_temp['graduation'] += $g_temp['activity'] += $g_temp['health'];
              
              $s_temp = getFareByDestination($destination, $bus, $term,$year, $conn);
             # $fare1 = $fare['amount'];
              $fee2= $s_temp['amount'];
              $h_temp = getFeeByType($type, $term,$year, $conn);
              $fee3= $h_temp['amount'];
              $j_temp = getFeeByBreakfast($breakfast, $term,$year, $conn);
              $fee4= $j_temp['amount'];
              $k_temp = getFeeByLunch($lunch, $term,$year, $conn);
              $fee5= $k_temp['amount'];
              $fee6= $student['balance_bd'];
             print_r($fee1+=$fee2+=$fee3+=$fee4+=$fee5+=$fee6);
             # echo $fee1 += $fee2;
             #    }
        ?>

      </td>
      <td>Ksh.
      <?php 
     $fee = getFees($student['student_id'],$term,$year, $conn);
    
     print_r($fee[0]);
        ?>
        

      </td>
      <td>Ksh.
      <?php 
      $grade = $student['grade'];
      $term = $setting['current_term'];
      $year = $setting['current_year'];
      $destination = $student['destination'];
      $bus = $student['bus'];
      $type =$student['type'];
      $breakfast =$student['breakfast'];
      $lunch =$student['lunch'];
         #   $tuition = $grade['tuition'];
            $g_temp = getFeesByGrade($grade, $term,$year, $conn);
            #     if ($g_temp != 0) {

              $fee1= $g_temp['tuition'] += $g_temp['assessment'] += $g_temp['exam']
              += $g_temp['graduation'] += $g_temp['activity'] += $g_temp['health'];
              
              $s_temp = getFareByDestination($destination, $bus, $term,$year, $conn);
             # $fare1 = $fare['amount'];
              $fee2= $s_temp['amount'];
              $h_temp = getFeeByType($type, $term,$year, $conn);
              $fee3= $h_temp['amount'];
              $j_temp = getFeeByBreakfast($breakfast, $term,$year, $conn);
              $fee4= $j_temp['amount'];
              $k_temp = getFeeByLunch($lunch, $term,$year, $conn);
              $fee5= $k_temp['amount'];
              $fee6= $student['balance_bd'];
             $payable=($fee1+=$fee2+=$fee3+=$fee4+=$fee5+=$fee6);

             $fee = getFees($student['student_id'],$term,$year, $conn);
    
             $paid=($fee[0]);
             $balance=($payable-$paid);
             echo $balance;
        ?>

     

      </td>
     
      <td>  <?php 
      $grade = $student['grade'];
      $term = $setting['current_term'];
      $year = $setting['current_year'];
      $destination = $student['destination'];
      $bus = $student['bus'];
      $type =$student['type'];
      $breakfast =$student['breakfast'];
      $lunch =$student['lunch'];
         #   $tuition = $grade['tuition'];
            $g_temp = getFeesByGrade($grade, $term,$year, $conn);
            #     if ($g_temp != 0) {

              $fee1= $g_temp['tuition'] += $g_temp['assessment'] += $g_temp['exam']
              += $g_temp['graduation'] += $g_temp['activity'] += $g_temp['health'];
              
              $s_temp = getFareByDestination($destination, $bus, $term,$year, $conn);
             # $fare1 = $fare['amount'];
              $fee2= $s_temp['amount'];
              $h_temp = getFeeByType($type, $term,$year, $conn);
              $fee3= $h_temp['amount'];
              $j_temp = getFeeByBreakfast($breakfast, $term,$year, $conn);
              $fee4= $j_temp['amount'];
              $k_temp = getFeeByLunch($lunch, $term,$year, $conn);
              $fee5= $k_temp['amount'];
              $fee6= $student['balance_bd'];
             $payable=($fee1+=$fee2+=$fee3+=$fee4+=$fee5+=$fee6);

             $fee = getFees($student['student_id'],$term,$year, $conn);
    
             $paid=($fee[0]);
             $balance=($payable-$paid);
             $percentage =($balance/$payable)*100;
             echo $percentage >= 0 ? floor($percentage) : ceil($percentage);?>
      %</td>
      <td>
          <a href="fees_pay.php?student_id=
          <?=$student['student_id']?>"
          class="btn btn-success">Pay</a>
      </td>
     <td>
      <a href="#.php?student_id=
          <?=$student['student_id']?>"
          class="btn btn-warning">View</a>
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
        $("#navLinks li:nth-child(6) a").addClass('active');
});
       </script>
</body>
</html>
<?php 

}else {
    header("location: ../login.php");
    exit;
}
}else {
    header("location: ../login.php");
    exit;
}

?>