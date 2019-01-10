<?php

    include "db_connect.php";

        session_start();

        $active_name = $_SESSION['name'];

        echo "include".$id_no;
        echo "include".$branch;

        $fetch_query_admin = "SELECT * FROM student WHERE (uploader_name = '$active_name' AND branch = '$branch' ) ";
        $fetch_result_admin = mysqli_query($connection,$fetch_query_admin);
    
        $count = mysqli_num_rows($fetch_result_admin);
    
        echo $count;    
        if(!$fetch_result_admin)
        { 
            die('Query Failed'.mysqli_error($connection));
        }
        
        if($count != 0)
        {
            echo " not to do ";
            
        }
        else
        {
            echo "to do";
            
            
            $query = "INSERT INTO student(uploader_name,branch)";
            $query .= "VALUES ('$active_name','$branch')";

            $result = mysqli_query($connection,$query);

            if(!$result)
            {
                die('Query Failed'.mysqli_error($connection)); 
            }
        }
        
//        header('Location: upload.php');


?>