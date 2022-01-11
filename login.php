<?php
    session_start();
    $pageTitle = 'Login';
    include 'connect.php';
    include 'include/functions/function.php';
    if(isset($_SESSION['sid'])){
        header('Location: index.php');
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['login'])){
            $user = $_POST['email'];
            $pass = $_POST['password'];
            $hashedPass = sha1($pass);
            $stmt = $con->prepare("SELECT
                                        UserID, FullName, Email, `Password`, Phone
                                    FROM
                                        customer
                                    WHERE
                                        Email = ?
                                    AND
                                        `Password` = ?");
            $stmt->execute(array($user, $hashedPass));
            $get = $stmt->fetch();
            $check = $stmt->rowCount();
            if($check > 0){               
                $_SESSION['user'] = $user; // Register Session Name
                $_SESSION['userid'] = $get['UserID']; // Register Session ID
                $_SESSION['phone'] = $get['Phone']; // Register Session image

                 // Register User ID In Session
                //  if($get['GroupID'] == 2){
                //      $_SESSION['sid'] = $get['UserID'];
                //  }else{
                //      $_SESSION['uid'] = $get['UserID'];
                //  } 
                header('Location: index.php'); // Redirect To Dashboard Page
                exit();
            }
        }else{
            $formErrors = array();
            
            $fullname   = $_POST['fullname'];
            $email      = $_POST['email'];
            $password   = $_POST['password'];
            $phone      = $_POST['phone'];
            if(isset($fullname)){
                $filterUser = filter_var($fullname, FILTER_SANITIZE_STRING);
                if(strlen($filterUser) < 5){
                    $formErrors [] = 'Full Name Must Be Lager Than 5 Characters';
                }
            }
            if(empty($password)){
                $formErrors[] = 'Sorry Password Cant Be Empty ';
            }
            
            if(isset($email)){
                $filterEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
                if(filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true){
                    $formErrors[] = 'Sorry This Email Is Not Valid';
                }
            }
            if(empty($phone)){
                $formErrors[] = 'Sorry Phone Empty, Enter The Your Phone Number';
            }
            if(strlen($phone) > 10){
                $formErrors[] = 'Sorry Phone Empty, Enter The Your Phone Number';
            }
            if(!preg_match("/^0[0-9]{9}/", $phone)){
                $formErrors[] = 'Invalid Phone Number';
            }
            if(empty($formErrors)){
                $check = chickItem("Email", "customer", $email);
                if($check == 1){
                    $formErrors[] = 'This Username Is Exsit';
                }else{
                    // Insert Userinfo Into Database
                    $stmt = $con->prepare("INSERT INTO 
                                                customer(FullName, Email, `Password`, Phone)
                                            VALUES(:zuser, :zmail, :zpass, :zphone)");
                    $stmt->execute(array(
                        'zuser'  => $fullname,
                        'zmail'  => $email,
                        'zpass'  => sha1($password),
                        'zphone'  => $phone
                        
                    ));
                    //Echo Success Message
                    $successMas = 'Congerat You Are Now Regestiret User';                    
                } 
            }
        }
    }?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="layout/css/styles.css">
    </head>
    <body>
    <div class="background"></div>
    <div class="container login-page">
        <h1 class="text-center">
            <span class="selected" data-class="login">Login</span> | 
            <span data-class="signup">Signup</span>
        </h1>
        <!-- Start Login Form -->
        <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <div class="form-item">
                <span class="material-icons-outlined">
                    Email
                </span>
                <input
                    type="email" 
                    name="email"
                    autocomplete="off"
                    
                    placeholder="Type Your Email" />
            </div>
            <div class="form-item">
                <span class="material-icons-outlined">
                    lock
                </span>
                <input 
                    class="form-control password" 
                    type="password"
                    name="password"
                    autocomplete="new-password"
                    required
                    placeholder="Type Your Password" />
            </div>
            <button type="submit" name="login">LOGIN</button>
        </form>
        <!-- End Login Form -->
        <!-- Start Signup Form -->
        <form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">         
            <div class="form-item">
                <span class="material-icons-outlined">
                    Full Name
                </span>
                <input
                    type="text" 
                    name="fullname"
                    autocomplete="off"
                    required
                    placeholder="Enter Your Full Name" />
            </div>
            <div class="form-item">
                <span class="material-icons-outlined">
                    email
                </span>
                <input
                    type="email"
                    name="email"
                    required
                    placeholder="Enter Your Email" />
            </div>
            <div class="form-item">
                <span class="material-icons-outlined">
                    password
                </span>
                <input 
                    type="password"
                    name="password"
                    autocomplete="new-password"
                    required
                    placeholder="Enter Complex Password" />
            </div>
            <div class="form-item">
                <span class="material-icons-outlined">
                    phone
                </span>
                <input 
                    type="number"
                    name="phone"
                    required
                    placeholder="Enter a Phone Number" />
            </div>
            <button type="submit" name="signup">SignUp</button>
        </form>
        <!-- End Signup Form -->
        <div class="the-errors text-center">
            <?php             
                if(!empty($formErrors)){
                    foreach($formErrors as $error){ echo "<div class='masg error'>" . $error . "</div>";}
                }
                if(isset($successMas)){ echo "<div class='masg success'>" . $successMas . "</div>";}?>
        </div>
    </div>
    <script src="layout/js/jquery.min.js"></script>
    <script src="layout/js/control.js"></script>
    </body>
    </html>
