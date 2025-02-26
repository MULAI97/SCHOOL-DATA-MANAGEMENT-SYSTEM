<?php
   session_start();
   if(isset($_SESSION['accountant_id']) && isset($_SESSION['role'])){

    if ($_SESSION['role'] == 'Accountant') {

    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,
        initial-scale=1.0">
        <title> Home - EBENEZER ACCOUNTS </title>
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
        <div class="container text-center">
            <div class="row row-cols-5">
                <a href="fees_payments.php" class="col btn btn-danger m-2 py-3">
                <i class="fa fa-group fs-1" aria-hidden="true"></i><br>

                    All Students
                </a>
                <a href="#.php" class="col btn btn-warning m-2 py-3">
                <i class="fa fa-dollar fs-1" aria-hidden="true"></i><br>

                    Fees Payable
                </a>
                <a href="#" class="col btn btn-secondary m-2 py-3">
                <i class="fa fa-euro fs-1" aria-hidden="true"></i><br>

                Fees Paid
                </a>
                <a href="#" class="col btn btn-success m-2 py-3">
                <i class="fa fa-gbp fs-1" aria-hidden="true"></i><br>

                    Fees Unpaid
                </a>
               
            </div>
        </div>
    </div>
    
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
       <script>
        $(document).ready(function(){
        $("#navLinks li:nth-child(1) a").addClass('active');
});
       </script>
</body>
</html>
<?php 
include "inc/footer.php";
}else  {
    header("location: ../login.php");
    exit;
}
}else  {
    header("location: ../login.php");
    exit;
}

?>