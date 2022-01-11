<?php
ob_flush();
session_start();
$pageTitle = 'Edit Profile';
include 'connect.php';
include 'include/functions/function.php';
if(isset($_SESSION['user'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="layout/css/control.css">
    <link rel="stylesheet" href="layout/css/main.css">
    <link rel="stylesheet" href="layout/css/style.css">

    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/
ui-lightness/jquery-ui.css' rel='stylesheet'>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
	</script>

	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
</head>
<body class="is-preload">
<?php 

// Check If Get Request userid Is Numeric & Get The Integer Value Of It                
$userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
// Select All Data Depend On This ID
$stmt = $con->prepare("SELECT * FROM customer WHERE UserID = ? LIMIT 1");
// Execute Query
$stmt->execute(array($userid));
// Fecth The Data
$row = $stmt->fetch();
// The Row Count
$count = $stmt->rowCount();
// If There's Such ID Show The Form
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get Vairables From The Form
        $id     = $_POST['userid'];
        $user   = $_POST['name'];
        $email  = $_POST['email'];
        $phone  = $_POST['phone'];
        $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
        $formArray = array();
        if(empty($user)){
            $formArray[] = 'Username Cant Be <strong>Empty</strong>';
        }
        if(empty($email)){
            $formArray[] = 'Email Cant Be <strong>Empty</strong>';
        }
        if(empty($phone)){
            $formArray[] = 'Gender Cant Be <strong>Empty</strong>';
        }
        
        if(empty($formArray)){
        
            $stmt2 = $con->prepare("SELECT * FROM customer WHERE Email != ? AND UserID != ?");
            $stmt2->execute(array($email, $id));
            $count = $stmt2->rowCount();
            if($count == 1){
                $TheMsg = "<div class='alert alert-danger'>Sorry This User Is Exist</div>";
                redirectHome($TheMsg, 'back');
            }else{
                // Update The Database With This Info
                $stmt = $con->prepare("UPDATE customer SET FullName = ?, Email = ?, `Password` = ?, Phone = ? WHERE UserID = ?");
                $stmt->execute(array($user, $email, $pass, $phone, $id));
                //Echo Success Message
                $TheMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Update</div>';
                redirectHome($TheMsg);
            }
        }
    }?>
    <div id="wrapper">
        <div id="main">
            <div class="inner">
                <header id="header">
                    <a href="profile.php" class="logo"><strong style="font: bold;">User Profile</strong></a>
                    <div class="icons">
                        <span class="iconify" data-icon="bx:bx-user-circle"></span>
                        <span class="iconify facebook" data-icon="bx:bxl-facebook"></span>
                        <span class="iconify snapchat" data-icon="bx:bxl-snapchat"></span>
                        <span class="iconify" data-icon="bi:instagram"></span>
                        <span class="iconify medium" data-icon="fa-brands:medium-m"></span>
                    </div>
                </header>
                <section id="banner" style="background-color:white">
                    <div class="content">
                        <header>
                            <h1>photographers</h1>
                            <h1>programm</h1>
                        </header>
                    </div>
                    <div class="col-md-3">
                        <span class="image small">
                            <img src="images/background-img.jpg" alt="" style="border-radius: 10%">
                        </span>
                    </div>
                </section>
            </div>
            <h1 class="text-center"><?php echo $pageTitle?></h1>
            <div class="information block">
                
                    <div class="card">
                        <div class="card-header bg-primary text-white"><?php echo $pageTitle?></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <form class="form-horizontal main-form" action="" method="POST" enctype="multipart/form-data">
                                        <!-- Start Name Field -->
                                        <div class="mb-2 row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10 col-md-10">
                                                <input type="hidden" name="userid" value="<?php echo $row['UserID']?>">
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <label class="col-sm-2 col-form-label">Full Name</label>
                                            <div class="col-sm-10 col-md-10">
                                                <input 
                                                    pattern=".{5,}"
                                                    title="This Field Require At Least 5 Characters"
                                                    class="form-control" 
                                                    type="text" 
                                                    name="name" 
                                                    placeholder="Your Full Name"
                                                    value="<?php echo $row['FullName']?>"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10 col-md-10">
                                                <input 
                                                    class="form-control" 
                                                    type="email" 
                                                    name="email" 
                                                    placeholder="Your Email"
                                                    value="<?php echo $row['Email']?>"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <label class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10 col-md-10">
                                                <input type="hidden" name="oldpassword" value="<?php echo $row['Password']; ?>"> 
                                                <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave Bland If You Dont WantTo Change" optional>
                                            </div>
                                        </div>
                                        <div class="mb-2 row">
                                            <label class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10 col-md-10">
                                                <input 
                                                    class="form-control" 
                                                    type="text" 
                                                    name="phone" 
                                                    placeholder="Your Phone"
                                                    value="<?php echo $row['Phone']?>"
                                                    required>
                                            </div>
                                        </div>
                                        <!-- Start Submit Field -->
                                        <div class="mb-2 row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <input type="submit" value="Update Profile" class="btn btn-primary">
                                            </div>
                                        </div>
                                        <!-- End Submit Field -->
                                    </form>
                                </div>
                            </div>
                            <!-- Start Looping Through Errors -->
                        <?php if(! empty($formArray)){
                                    foreach($formArray as $error){ echo "<div class='alert alert-danger'>" . $error . "</div>";}
                                }
                                if(isset($successMas)){ echo "<div class='alert alert-success'>" . $successMas . "</div>";}?>
                            <!-- End Looping Through Errors -->
                        </div>
                    </div>
            </div>
        </div>
<?php 
include 'include/templates/footer.php';
}// End If Row Count
//If There's No Such ID Show Error Message
else{
    $TheMsg = '<div class="alert alert-danger">Thete\'s No Such ID</div>';
    redirectHome($TheMsg);
} // End Else RowCount

ob_end_flush();?>