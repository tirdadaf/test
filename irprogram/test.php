<? php
    
    $sitename = "http://localhost/irprogram/";
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "irprogram_db";
    $tbl_name = "ads";
    $order_by = "title"

    $recod_limit =5 ;
    $connect = @mysqli_connect($hostname,$username,$password,$database)
    
?>