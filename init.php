<?php

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    include 'connect.php';

    $sessionUser = '';
    if(isset($_SESSION['user'])){
        $sessionUser = $_SESSION['user'];
    }
    $sid = '';
    if(isset($_SESSION['sid'])){
        $sid = $_SESSION['sid'];
    }

    $tepl    = 'include/templates/'; // Templates Directory
    $css     = 'layout/css/'; // Css Directory
    $js      = 'layout/js/';  // JS Directory
    $func    = 'include/functions/'; // Functions Directory

    // Include The Impottant Files

    include $func . 'function.php';
    include $tepl . 'header.php';
 


  
    
 