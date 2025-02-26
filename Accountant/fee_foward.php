<?php
   session_start();
   if(isset($_SESSION['accountant_id']) && 
   isset($_SESSION['role']) &&
   isset($_GET['student_id'])) {

    if ($_SESSION['role'] == 'Accountant') {
        include "../DB_connection.php";
         include "data/grade.php";
         include "data/section.php";
         include "data/student.php"; 
         include "data/destination.php";
         include "data/buses.php";
         include "data/studysystem.php";
         include "data/tea.php";
         include "data/buspoint.php";
         include "data/food.php";
         $grades = getAllGrades($conn); 
         $destinations = getAllDestinations($conn); 
         $buspoints = getAllBuspoints($conn);
         $sections = getAllSections($conn);
         $buses = getAllBuses($conn);
         $types =getAllStudySystems($conn);
         $student_id = $_GET['student_id'];
         $student = getStudentById($student_id, $conn);    
         $teas=getAllTeas($conn);
         $foods=getAllFoods($conn);

         if ($student == 0) {
            header("location: student.php");
            exit;
         }
         
       
         
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,
        initial-scale=1.0">
        <title> Accountant - Edit Student </title>
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

    ?>
    <div class="container mt-5">
        <a href="fees_foward.php"
        class="btn btn-dark">Go Back</a>
        
        <form method="post"
        class="shadow p-3 mt-5 form-w" 
        action="req/fee_foward.php">
        <h3>Edit Student Fee</h3><hr>
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?=$_GET['error']?>
            </div>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?=$_GET['success']?>
            </div>
                <?php } ?>
  <div class="mb-3">
    <label class="form-label">First name</label>
    <input type="text" 
    class="form-control"
    value="<?=$student['fname']?>"
    name="fname">
  </div>

  <div class="mb-3">
    <label class="form-label">Last name</label>
    <input type="text" 
    class="form-control"
    value="<?=$student['lname']?>"
    name="lname">
  </div>
 
  <div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" 
    class="form-control"
    value="<?=$student['username']?>"
    name="username">
  </div>
  <input type="text"
          value="<?=$student['student_id']?>"
          name="student_id"
          hidden>
  
  <div class="mb-3">
    <label class="form-label">Fees Balance</label>
    <input type="text" 
    class="form-control"
    value="<?=$student['balance_bd']?>"
    name="balance_bd">
  </div>
  

  <button type="submit" class="btn btn-primary">Foward</button>
</form>

                </div>
                </div>
            
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
       <script>
        $(document).ready(function(){
        $("#navLinks li:nth-child() a").addClass('active');

      
});



function makePass(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;
    while (counter < length) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
      counter += 1;
      var passInput = document.getElementById('passInput');
    }
    var passInput = document.getElementById('passInput');
    var passInput2 = document.getElementById('passInput2');
    passInput.value = result;
    passInput2.value = result;
}
var gBtn = document.getElementById('gBtn');
gBtn.addEventListener('click', function(e){
e.preventDefault();
makePass(4)
});
       </script>
</body>
</html>
<?php 
include "inc/footer.php";
}else {
    header("location: student.php");
    exit;
}
}else {
    header("location: student.php");
    exit;
}

?>