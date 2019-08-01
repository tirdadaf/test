<?php
    
    require_once("include.php");
    $tbl_name = "ads";
    $order_by = "title";

    $record_limit =3 ;
    $connect = @mysqli_connect($hostname,$username,$password,$database);
    if ($connect)
    {
        @mysqli_query($connect,"set character set utf8;");
        $temp1 = @mysqli_query($connect,"select count(*) from ".$tblname);
        $temp2 = @mysqli_fetch_row( $temp1 );
        $total_records = $temp2[0];
        
        if(isset($_GET['page']))
        {   
            $page = $_GET['page'];
            $offset = $page * $record_limit;
        }            
        else
        {
            $page = 0;
            $offset = 0;            
        }
        
        $myquery = "select a.*,trim(name) as cat from ads a , cat b where a.cat_id = b.id order by title limit ".strval($offset).",3";
        
        $result = @mysqli_query($connect , $myquery);
        if ( $result )
        {
            $response['ads'] = array();
            $response['success'] = 1;
            while ($row = @mysqli_fetch_array($result) )
            {
                $ads = array ();
                @$ads['id']     = $row['id'];
                $ads['title']   = $row['title'];
                $ads['intro']   = $row['intro'];
                $ads['desc']    = $row['description'];
                $ads['image']   = $sitename . $row['image'];
                $ads['seller']  = $row['seller'];
                $ads['email']   = $row['email'];
                $ads['phone']   = $row['phone'];
                $ads['date']    = $row['date'];
                $ads['cat']     = $row['cat'];
                
                array_push($response['ads'],$ads);
                
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