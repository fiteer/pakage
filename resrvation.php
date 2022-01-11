<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="layout/css/control.css">
    <link rel="stylesheet" href="layout/css/bootstrap.min.css">
</head>
<body>

<?php

session_start();

$pageTitle = 'Resrvation';

include 'connect.php';
include 'include/functions/function.php';

if(isset($_SESSION['user'])){
    $pid = isset($_GET['pid']) && is_numeric($_GET['pid']) ? intval($_GET['pid']) : 0;
    $stmt = $con->prepare("SELECT * FROM package WHERE ID = ?");

    // Execute Query

    $stmt->execute(array($pid));

    // Fetch The Data

    $item = $stmt->fetch();

    // The Row Count

    $count = $stmt->rowCount();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $formErrors = array();

        $name      = $item['Title'];
        $date       = $_POST['date'];
        $location       = $_POST['location'];
        $totle       = $item['price'];
        $phone       = $_POST['phone'];

        
        if(empty($location)){
            $formErrors[] = 'Location ID Must Be Not Empty';
        }
        if(empty($phone)){
            $formErrors[] = 'Phone Must Be Not Empty';
        }
        if(empty($date)){
            $formErrors[] = 'Date Must Be Not Empty';
        }

        if(empty($formErrors)){

            $stmt = $con->prepare("INSERT INTO 
                                        `order`(`Name`, ordered, dateofevent, `Location`, total, costumer_id , `phone`, Email, pakage_id )
                                        VALUES(:zname, now(), :zevent, :zlocation, :ztotal, :zcostumer, :zphone, :zemail, :zpakage)");
            $stmt->execute(array(

                'zname'             => $name,
                'zevent'            => $date,
                'zlocation'         => $location,
                'ztotal'            => $totle,
                'zcostumer'         => $_SESSION['userid'],
                'zphone'            => $phone,
                'zemail'            => $_SESSION['user'],
                'zpakage'           => $pid
            ));

            if($stmt){

                    $theMessage =  "<div class='alert alert-success'>The Resrvation Was Booked</div>";
                    redirectHome($theMessage);
            }

        }

    }

?>


    <h1 class="text-center"><?php echo $pageTitle?></h1>
    <div class="information block">
        <div class="container ">
            <div class="card">
                <div class="card-header bg-primary text-white"><?php echo $pageTitle?></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form class="form-horizontal main-form" action="" method="POST">
                                
                                
                                <!-- Start Date Field -->
                                <div class="mb-2 row">
                                    <label class="col-sm-2 col-form-label">Date</label>
                                    <div class="col-sm-10 col-md-10">
                                        <input 
                                            class="form-control live" 
                                            type="date" 
                                            name="date" 
                                            placeholder="Enter The Number of Days"
                                            data-class=".live-price"
                                            required>
                                    </div>
                                </div>
                                <!-- End Date Field -->
                                <!-- Start Location Field -->
                                <div class="mb-2 row">
                                    <label class="col-sm-2 col-form-label">Location</label>
                                    <div class="col-sm-10 col-md-10">
                                        <input 
                                            class="form-control" 
                                            type="text" 
                                            name="location" 
                                            placeholder="Enter Your location"
                                            
                                            required>
                                    </div>
                                </div>
                                <!-- End Location Field -->
                              
                                <!-- Start phone Field -->
                                <div class="mb-2 row">
                                    <label class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10 col-md-10">
                                        <input 
                                            class="form-control" 
                                            type="text" 
                                            name="phone" 
                                            placeholder="Enter Your Phone Number"
                                            value="<?php echo $_SESSION['phone']?>"
                                            required>
                                    </div>
                                </div>
                                <!-- End phone Field -->
                                <!-- Start Email Field -->
                                <div class="mb-2 row">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10 col-md-10">
                                        <div class="form-control live"><?php echo $_SESSION['user']?></div>
                                    </div>
                                </div>
                                <!-- End Email Field -->
                                
                                <!-- Start Submit Field -->
                                <div class="mb-2 row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <input type="submit" value="Resrvation Now" class="btn btn-primary">
                                    </div>
                                </div>
                                <!-- End Submit Field -->
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class='view-items'>
                                <div class='card live-preview'>
                                    <span class='price-tag'>
                                        <span class="live-name"><?php echo $item['Title']?></span>
                                    </span>
                                    <div class='card-body'>
                                        <h3 class='card-title live-title'><?php echo $item['price']?></h3>
                                        <p class='card-text live-desc'><?php echo $_SESSION['user']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start Looping Through Errors -->
                    <?php 
                        if(! empty($formErrors)){
                            foreach($formErrors as $error){

                                echo "<div class='alert alert-danger'>" . $error . "</div>";

                            }
                        }

                        if(isset($successMas)){

                            echo "<div class='alert alert-success'>" . $successMas . "</div>";
        
                        }
                    ?>
                    <!-- End Looping Through Errors -->
                </div>
            </div>
        </div>
    </div>
    
    <script src="layout/js/jquery.min.js"></script>
</body>
</html>
<?php
}else{

    $theMessage =  "<div class='alert alert-danger'>Sorry, You Cant Resrvation Before Your Register and than Return The Booking</div>";
    redirectHome($theMessage, 'login.php', 10);

}



ob_end_flush();
?>