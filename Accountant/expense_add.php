<?php
   session_start();
   if(isset($_SESSION['accountant_id']) && isset($_SESSION['role'])){

    if ($_SESSION['role'] == 'Accountant') {
        include "../DB_connection.php";
        include "data/departments.php";
        include "data/setting.php";
        include "data/via.php";
        $vias=getAllVias($conn);
         $departments = getAllDepartments($conn);  

         $description = '';
         $amount = '';
         $receipt_no = '';
         
         $term = '';
         $year = '';
         $date = '';

         $setting =  getSetting($conn);

         $term = $setting['current_term'];
         $year = $setting['current_year'];

         if (isset($_GET['description'])) $description = $_GET['description'];
         if (isset($_GET['amount'])) $amount = $_GET['amount'];
         if (isset($_GET['receipt_no'])) $receipt_no = $_GET['receipt_no'];
         if (isset($_GET['term'])) $term = $_GET['term'];
         
         if (isset($_GET['year'])) $year = $_GET['year'];
         if (isset($_GET['date'])) $date = $_GET['date'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,
        initial-scale=1.0">
        <title> Accountant - Add Expenditure </title>
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
        <a href="expenses.php"
        class="btn btn-dark">Go Back</a>
        
        <form method="post"
        class="shadow p-3 mt-5 form-w"
        action="req/expense_add.php">
        <h3>Add New Expenditure</h3><hr>
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
    <label class="form-label">Department</label>
    <select name="department"
     class="form-control">
     <?php foreach ($departments as $department)  {?>
     <option value="<?=$department['department_id']?>">
    <?=$department['department']?>
     </option>   
    <?php  }?>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Description</label>
    <input type="text" 
    class="form-control"
    value="<?=$description?>"
    name="description">
  </div>
  <div class="mb-3">
    <label class="form-label">Amount</label>
    <input type="int" 
    class="form-control"
    value="<?=$amount?>"
    name="amount">
                </div>
                <div class="mb-3">
    <label class="form-label">Spend Via</label>
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
    <label class="form-label">receipt_no</label>
    <input type="text" 
    class="form-control"
    value="<?=$receipt_no?>"
    name="receipt_no">
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
    <label class="form-label">Date</label>
    <input type="date" 
    class="form-control"
    name="date">
  </div>
  
  
  <button type="submit" class="btn btn-primary">Add</button>
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