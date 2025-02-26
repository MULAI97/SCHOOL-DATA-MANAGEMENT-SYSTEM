<?php
   session_start();
   if(isset($_SESSION['accountant_id']) && isset($_SESSION['role'])){

    if ($_SESSION['role'] == 'Accountant') {
        include "../DB_connection.php";
        include "data/student.php";
        include "data/setting.php";
        include "data/grade.php";
        include "data/destination.php";
      # include "data/fees_payments.php"; 
       include "data/fees.php";
       include "data/via.php";
       
        $student_id = $_GET['student_id'];
        $student = getStudentById($student_id, $conn);
        $username = $student['username'];
        $vias=getAllVias($conn);
         $setting =  getSetting($conn); 

         $student_id = '';
         $username = '';
         $url = '';
         $amount = '';
         $payment_code= '';
         $phone_number= '';
         $term = $setting['current_term'];
         $year = $setting['current_year'];

         if (isset($_GET['student_id'])) $student_id = $_GET['student_id'];
         if (isset($student['username'])) $username = $student['username'];
         if (isset($setting['current_term'])) $term = $setting['current_term'];
         if (isset($setting['current_year'])) $year = $setting['current_year'];
        # if (isset($_GET['amount'])) $amount = $_GET['amount'];
         
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,
        initial-scale=1.0">
        <title> Accountant - Fees Pay </title>
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
        <a href="fees_payments.php"
        class="btn btn-dark">Go Back</a>
        
        <form method="post"
        class="shadow p-3 mt-5 form-w"
        action="req/fees_pay.php">
        <h3> Fees Pay</h3><hr>
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
  <div class="mb-3" hidden>
    <label class="form-label">Student Id</label>
    <input type="text" 
    class="form-control"
    value="<?=$student_id?>"
    name="student_id">
  </div>
  
  <div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" 
    class="form-control"
    value="<?=$username?>"
    name="username">
  </div>

  <div class="mb-3">
    <label class="form-label">Term</label>
    <input type="text" 
    class="form-control"
    value="<?=$term?>"
    name="term">
  </div>
  <div class="mb-3">
    <label class="form-label">Year</label>
    <input type="text" 
    class="form-control"
    value="<?=$year?>"
    name="year">
  </div>
  <div class="mb-3">
    <label class="form-label">Paid Via</label>
    <select name="via[]"
     class="form-control">
     <?php foreach ($vias as $via)  {?>
     <option value="<?=$via['via_id']?>">
     <?=$via['via']?>
     </option>   
    <?php  }?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Phone Number</label>
    <input type="number" 
    class="form-control"
    value="<?=$phone_number?>"
    placeholder="Enter Mpesa phone number here"
    name="phone">
  </div>
  <div class="mb-3">
    <label class="form-label">Payment Code</label>
    <input type="text" 
    class="form-control"
    value="<?=$payment_code?>"
    name="payment_code">
  </div>
  <div class="mb-3">
    <label class="form-label">Amount</label>
    <input type="text" 
    class="form-control"
    value="<?=$amount?>"
    name="amount">
  </div>
 
  
  
  <button type="submit" class="btn btn-primary">Pay</button>
</form>
    </div>
            
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
       <script>
        $(document).ready(function(){
        $("#navLinks li:nth-child(7) a").addClass('active');

      
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
    passInput.value = result;
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
    header("location: ../login.php");
    exit;
}
}else {
    header("location: ../login.php");
    exit;
}

?>