<?php
     require_once("include.php");
     $error = array();
     if ( isset($_POST['title']) && ( ! empty( $_POST['title']) ) &&
          isset($_POST['intro']) && ( ! empty( $_POST['intro']) ) &&
          isset($_POST['desc'])  && ( ! empty( $_POST['desc']) ) &&
          isset($_POST['seller']) && ( ! empty( $_POST['seller']) ) &&       
          isset($_POST['email']) && ( ! empty( $_POST['email']) ) &&
          isset($_POST['phone']) && ( ! empty( $_POST['phone']) ) &&
          isset($_POST['cat']) && ( ! empty( $_POST['cat']) ) &&
          isset($_POST['image']) && ( ! empty( $_POST['image']) ) )
        
          {
          
          $title = $_POST['title'];
          $intro = $_POST['intro'];
          $desc  = $_POST['desc'];
          $seller= $_POST['seller'];
          $email = $_POST['email'];
          $phone = $_POST['phone'];
          $cat   = $_POST['cat'];
          $image = $_POST['image'];
         
          $decodeimage = Base64_decode ($image);
        
          $location = "img/" . rand ( rand(5,50),rand(500,900))
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
                     $error['error']=$title;
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