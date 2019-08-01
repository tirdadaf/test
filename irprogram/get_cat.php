<?php
    require_once("include.php");
   
    $tbl_name = "cat";
    $order_by = "name";

    
    $connect = @mysqli_connect($hostname,$username,$password,$database);
    if ($connect)
    {
        @mysqli_query($connect,"set character set utf8;");
        
        $myquery = "SELECT id,name,coalesce(cnt,0) as amount FROM `cat` a left join (select cat_id ,count(*) as cnt from ads group by cat_id) b on a.id = b.cat_id";
        
        $result = @mysqli_query($connect , $myquery);
        if ( $result )
        {
            $response['cat'] = array();
            $response['success'] = 1;
            while ($row = @mysqli_fetch_array($result) )
            {
                $cat = array ();
                $cat['id']   = $row['id'];
                $cat['name'] = $row['name'];
                $cat['amount']   = $row['amount'];
                array_push($response['cat'],$cat);
            }
            
        }
        else
        {
            $response['success'] = 0;
            $response['message'] ="not found";
        }
        
        echo ( json_encode($response ) );
        @mysqli_close( $connectj );
        
    }
?>