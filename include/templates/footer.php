        <div id="sidebar">
            <div class="inner">
                <nav id="menu">
                    <header class="major">
                        <h1>Menu</h1>
                    </header>
                    <ul>
                        <?php
                            if(isset($_SESSION['user'])){
                                echo '<li><a href="profile.php">User Profile</a></li>';
                            }
                        ?>
                        <li><a href="index.php">Pakage</a></li>
                        <?php
                            if(isset($_SESSION['user'])){
                                
                                echo '<li><a href="logout.php">Logout</a></li>';
                            }else{
                                echo '<li><a href="login.php">Login</a></li>';
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>

    </div>

        <script src="<?php echo $js ?>browser.min.js"></script>
        <script src="<?php echo $js ?>breakpoints.min.js"></script>
        <script src="<?php echo $js ?>jquery.min.js"></script>
        <script src="<?php echo $js ?>util.js"></script>
        <script src="<?php echo $js ?>main.js"></script>
    </body>
</html>