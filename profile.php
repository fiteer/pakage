<?php session_start();
$pageTitle = 'Profile';
include 'init.php';
if(isset($_SESSION['user'])){
    $getUser = $con->prepare("SELECT * FROM customer WHERE Email = ?");
    $getUser->execute(array($sessionUser));
    $infoUser = $getUser->fetch();
    $userid = $infoUser['UserID']; ?>
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
        <h4 style="margin: 10px">Information</h4>
        <div class="table-wrapper">
            <table>
                <tbody style="margin: 10px; font: 1em sans-serif;">
                    <tr>
                        <th>Your Name</th>
                        <th>Your Email</th>
                        <th>Your Phone</th>
                        <th>Edit</th>
                    </tr>
                    <tr>
                        <td><?php echo $infoUser['FullName'] ?></td>
                        <td><?php echo $infoUser['Email'] ?></td>
                        <td><?php echo $infoUser['Phone'] ?></td>
                        <td><a href="editprofile.php?userid=<?php echo $infoUser['UserID'] ?>" class="btn btn-lg">Edit</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php
}else{ header('Location: login.php'); exit();}
include $tepl . 'footer.php';
ob_end_flush();?>