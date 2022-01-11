<?php
function chickItem($select, $from, $value){

    global $con;

    $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

    $statement->execute(array($value));

    $count = $statement->rowCount();

    return $count;
}
    /**
     *  Get All Function v1.0 
     *  Function To Get Categories From Database
     */

    function getAllTable($field, $allTable, $where = NULL, $and = NULL, $orderField= NULL, $ordering = 'DESC'){

        global $con;

        $getAll = $con->prepare("SELECT $field FROM $allTable $where $and ORDER BY $orderField $ordering");

        $getAll->execute();

        $all = $getAll->fetchAll();

        return $all;

    }


    /**
     *  Title Function V1.0
     *  Title Function That Echo The Page Title In Case The Page 
     *  Has The Vairable $pageTitle And Echo Defult Title For Other Pages
     */

    function getTitle(){

        global $pageTitle;

        if(isset($pageTitle)){

            echo $pageTitle;

        }else{
            
            echo "Defult";
        }
     }

    

   /**
     *  Home Redirect Function V2.0
     *  This Function Accept Parameters
     *  $TheMsg = Echo The Error Message
     * $seconds   = Seconds Befor Redirecting
     */

    function redirectHome($TheMsg, $url = null, $seconds = 3){

        if($url === null){
            $url = 'index.php';
            $link = 'HomePage';
        }else{
            if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){

                $url = $_SERVER['HTTP_REFERER'];
                $link = 'Previous Page';

            }else{
                
                $url = 'index.php'; 
                $link = 'HomePage';
            } 
        }

        echo "<div class='container'>";
        echo $TheMsg;
        echo "<div class='alert alert-info'>You Will Redirected To $link After $seconds Seconds.</div>";

            header("refresh:$seconds;url=$url");
            
            exit(); 

        echo "</div>";
     }




// ________________________________________________________________________________________________________________

 



     

    