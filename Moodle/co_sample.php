<!DOCTYPE html>
<html lang="en">
  <head>
   
   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
   <link href="co_sample1.css" rel="stylesheet"> 
    
    <script src="key.js" ></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->     
  </head>
  <body>
   
   <?php    
      
      include "db_connect.php";
      session_start();
      
  
          if($_POST)
          {
              $sname = "";
              foreach($_POST as $name => $content) 
                {
                  global $name;
                }
              
                global $name;
          }
      
//      echo $name;
            $id_comb_explode = explode("_",$name);
//            echo ($id_comb_explode[0].$id_comb_explode[1]);
            
            $id_no = $id_comb_explode[0];
            $ass_no = $id_comb_explode[1];
            $branch = $id_comb_explode[2];
            
      
      
      
//      echo $branch;
      $active_name = $_SESSION['name']; 
                 
  ?>
   
   <div class="container-fluid">
           
           
           
            
            <nav class="navbar navbar-default navbar-fixed-top ">
                  <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#"> Foodle Moodle </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="<main_page1></main_page1>.php"> Home Page </a></li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Hi <?php echo $active_name; ?> <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="#"> Logout </a></li>
                          </ul>
                        </li>
                      </ul>
                    </div><!-- /.navbar-collapse -->

                  </div><!-- /.container-fluid -->
            </nav>
            
        </div>
    
    <div class="container">
       
       <div class="container">
        <ol class="breadcrumb">
          <li>Welcome <?php echo $active_name; ?> </li>
            <li> Dashboard </li>
            <li><a href="co1.php"> <?php echo ucfirst($branch); ?> </a></li>
            <li class="active"> Assigment - <?php echo $ass_no; ?> </li>
        </ol>   
        </div>
        
<!--
        <div class="container">
        <ol class="breadcrumb">
            <li><a href="co1.php"> Back </a></li>
        </ol>   
        </div>
-->
        
        <div class="row">
           
           <?php
            
            
            
            
            
            $query = "SELECT * FROM admin WHERE id LIKE '%$id_no%' ";
        
                $result = mysqli_query($connection,$query);

                if(!$result)
                {
                    die('Query Failed'.mysqli_error($connection));
                }

                while($row = mysqli_fetch_assoc($result))
                {
                    $id = $row['id'];
                    $ass_no = $row['ass_no'];
                    $ass_name = $row['ass_name'];
                    $file_name = $row['file_name'];
                    $time = $row['submission_date'];
                    
               // echo $file_name;
            
            ?>
                    
            <div class="page-header">
                
                <h3 style="margin-left:50px;" > <?php echo "Assignment - ".$ass_no; ?> </h3> 
                
            </div>
            
            <p style="margin-left:50px;" > <img src="uploads/<?php echo $file_name; ?>" width="50%" height=50% > </p>
            
            
            
        <?php 
            
                }
        
        ?>
        
        <?php 
            
            $active_name = $_SESSION['name'];
//            $branch = $_SESSION['branch'];
            
//            echo $active_name.$branch;
            
        $fetch_query_student = "SELECT * FROM student WHERE (uploader_name = '$active_name' AND branch = '$branch') ";
        
            $fetch_result_student = mysqli_query($connection,$fetch_query_student);
            
            
            $count = mysqli_num_rows($fetch_result_student);
//            echo $count;
            
            if($count != 0)
            {

                if(!$fetch_result_student)
                {
                    die('Query Failed'.mysqli_error($connection));
                }
                while($row = mysqli_fetch_assoc($fetch_result_student))
                {
                    $assignment_no_student = $row['ass_no'];
                    $assignment_name_student = $row['ass_name'];
                    $file_upload_student = $row['uploads'];
                    $uploaded_time_student = $row['uploaded_time'];
                    $status_student = $row['status'];

    //                echo $assignment_no_student;
                }


                    $substr = substr($assignment_no_student,3);



                $explode = explode(" , ",$substr);    

                $post_total = count($explode);

    //            print_r($explode);
    //            
    //            echo ($explode[$num_no-1]);

    //            echo "posttotal".$post_total;

                if (in_array($ass_no, $explode)) 
                {
    //                echo "Got Irix";
                }
                else
                {
    //                echo "no";
                }
            }
            
        ?>    
        
        </div>
        <br><br><br>
        
        <div class="container">
        <div class="table-responsive">
        <form action="upload.php" method="post" enctype="multipart/form-data" >                
         <table class="table table-striped">
                <tbody>
                   
                   <?php
                    
                $query = "SELECT * FROM admin WHERE id LIKE '%$id_no%' ";
        
                $result = mysqli_query($connection,$query);

                if(!$result)
                {
                    die('Query Failed'.mysqli_error($connection));
                }

                while($row = mysqli_fetch_assoc($result))
                {
                    $id = $row['id'];
                    $ass_no = $row['ass_no'];
                    $branch = $row['branch'];
                    $ass_name = $row['ass_name'];
                    $file_name = $row['file_name'];
                    $s_time = $row['submission_date'];
                    $u_time = $row['uploaded_time'];
                    
//                    echo $ass_no;
//                    print_r($explode);
//                    if($count != 0)
//                    {    
                    $current_time = time();
//                    echo date("Y-m-d",$current_time);
//                    
                        if (in_array($ass_no, $explode)) 
                    {
                            if($current_time >  $s_time)
                            {
                                
                        ?>     
                                <tr  class="danger" >
                                    <td id=tr > Status </td>
                                    <td > Submitted   </td>       
                                </tr>    
                    <?php  }         
                             
                            else
                            {  ?>
                                
                            
                
                    ?>        
                         <tr  class="success" >
                            <td id=tr > Status </td>
                            <td > Submitted </td>
                        </tr>
                                
                       <?php
                            
                            }
                    
                    }
                    else
                    {
//                        echo "no";

                ?>
                             <tr>
                                <td id=tr> Uploaded On </td>
                                <td> <?php echo $u_time; ?> </td>
                            </tr>
                            <tr>f
                                <td id=tr> Submit Before </td>
                                <td> <?php echo $s_time; ?> </td>
                            </tr>
                            <tr>
                                <td id=tr> Assingment Name </td>
                                <td name=ass_name > <?php echo $ass_name; ?> </td>
                            </tr>
                            <tr>
                                <td id=tr> Assignment Number </td>
                                <td name="ass_no" > <?php echo $ass_no; ?> </td>
                            </tr>
                            <tr>
                                <td id=tr> Uploaded Your Assignment </td>
                                <td> <input type="file" name=file  > </td>
                            </tr>
                            <tr>
                                <td colspan="2" > <button type="submit" name="<?php echo $id." ".$branch; ?>" class="btn btn-default"> Upload </button></td>
                            </tr>
            <?php  }                
                    }    
                    
//                echo $ass_no;
            
            ?>
                

            
            
        <?php 
            
            
            
//            $file = 'people'.$name.".html";
//            $person = ob_get_contents();
//            file_put_contents($file, $person);
            
//            header('Location: co.php');
                    
            
            
        
        ?>
                   
                    
                    
                    
                </tbody>
         </table>
            </form>
         
            </div>
        </div>

        
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>