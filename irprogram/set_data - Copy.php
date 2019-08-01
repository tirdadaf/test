<?php
     require_once("include.php");
     $error = array();
     if ( isset($_post['title']) && ( ! empty( $_post['title']) ) &&
          isset($_post['intro']) && ( ! empty( $_post['intro']) ) &&
          isset($_post['desc'])  && ( ! empty( $_post['desc']) ) &&
          isset($_post['seller']) && ( ! empty( $_post['seller']) ) &&       
          isset($_post['email']) && ( ! empty( $_post['email']) ) &&
          isset($_post['phone']) && ( ! empty( $_post['phone']) ) &&
          isset($_post['cat']) && ( ! empty( $_post['cat']) ) &&
          isset($_post['image']) && ( ! empty( $_post['image']) ) )
        
          {
          
          $title = $_post['title'];
          $intro = $_post['intro'];
          $desc  = $_post['desc'];
          $seller= $_post['seller'];
          $email = $_post['email'];
          $phone = $_post['phone'];
          $cat   = $_post['cat'];
          $image = $_post['image'];
         
          $decodeimage = Base64_decode ($image);
        
          $location = "img/" . $title . "_" . rand ( rand(5,50),rand(500,900))
                      . "_" . date("i") . "_" . date("d-m-Y") . ".jpg";
          $resultofcreatingImage = file_put_contents($location, $decodeimage);
          if ($resultofcreatingImage) 
             
             {
              $query = "INSERT INTO ads ( title,intro,description,image,seller,
                        email,phone,cat_id) " .
                  "VALUES ('".$title."','".$intro."','".$desc."','".$location."',
                           '".$seller."','".$email."','".$phone."','".$cat."')";
             $connect = @mysqli_connect($hostname,$username,$password,$database);
             if ($connect)
                {
                 @mysqli_query($connect,"set character set utf8;");
                 @mysqli_query($connect,$query);

                 if (@mysqli_affected_rows($connect) > 0)
                    {
                     $error['error']="done";
                    }
                 else
                    {
                     
                     $error['error']="Failure_inserting_database";
                    }

                }
                else
                    {
                     
                     $error['error']="Failure_connecting_database";
                    }
             }
         else
             {
              $error['error'] = "Failure_creating_image";
             }
           
          }
    else
     {
          
          $error['error']= "Failure_post";
     }

    die (json_encode ($error['error']));
























?>