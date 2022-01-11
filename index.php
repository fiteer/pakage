<?php
ob_start();
session_start();
$pageTitle = 'HomePage';
include 'init.php';?>
    <div id="main">
    <div class="inner">
        <header id="header">
            <a href="#" class="logo"><strong style="font: bold;">Pakages</strong></a>
            <div class="icons">
                <span class="iconify" data-icon="bx:bx-user-circle"></span>
                <span class="iconify facebook" data-icon="bx:bxl-facebook"></span>
                <span class="iconify snapchat" data-icon="bx:bxl-snapchat"></span>
                <span class="iconify" data-icon="bi:instagram"></span>
                <span class="iconify medium" data-icon="fa-brands:medium-m"></span>
            </div>
        </header>
        <section class="algorithms" id="algorithms" style="margin-top:3%">
            <h3 class="sub-heading">PhotoGraph</h3>
            <h1 class="heading">Pakage</h1>
            <div class="box-container">
            <?php $itemsAll = getAllTable("*", "package", "", "", "ID");
                if(empty($itemsAll)){ echo "<div class='naice-message'>Sorry This Category Is Empty</div>";
                }else{         
                    foreach($itemsAll as $key=>$value){ ?>              
                        <div class="box">
                            <h3><?php echo $value['Title']?></h3>
                            <h3><?php echo $value['package_name']?></h3>
                            <h3><?php echo $value['price']?></h3>
                            <?php
                                if(isset($_SESSION['user'])){?>
                                    <a href="resrvation.php?pid=<?php echo $value['ID'] ?>" class="btn btn-lg">Resrvation</a>
                            <?php }else{?>
                                    <a href="login.php" class="btn btn-lg">Login</a>
                            <?php }?>
                            
                        </div>
                        
                    <?php }
                }?> 
        </section> 
    </div>
    </div>


            

<?php 
include $tepl . 'footer.php';
ob_end_flush();?>