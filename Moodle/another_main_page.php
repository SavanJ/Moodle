<!DOCTYPE html>
<html lang="en">
  <head>
   <link type="text/css" rel="stylesheet" href="admin_main_page.css" >
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>   
  <body>
  
  <?php
      
  if($_POST)
  {
      foreach($_POST as $name => $content) 
        {
          global $name;
        }
      
//        echo $name;
        
        $name = explode("_",$name);
//        print_r($name);
        
        $new_name = "";
        $total = count($name);
        while($total != 0)
        {
            $ori_name = $name;
            $dub_name = $ori_name[$total - 1];
//            echo $dub_name;
            $new_name = $dub_name." ".$new_name;
//            echo $new_name;
            $total = $total - 1;
        }
//        echo $new_name."<br>";
        
        $name = $new_name;
      
//        echo $name."<br>";
      
       if($name == "Computer Sciecne And Engineering "){ $name = "cse" ;}
       elseif($name == 'Electronics And Communicaton Engineering '){ $name = "ece";  }
       elseif($name == 'Statistics And Probability '){ $name = "maths";  }
      
//      echo $name;
      
      
  }
      
      
      
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
                <!--        <li><a href="#">Link</a></li>-->
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Hi Admin <span class="caret"></span></a>
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
        <ol class="breadcrumb">
          <li><a href="#">Welcome Jignesh</a></li>
          <li><a href="admin_main_page.php" > Admin Dashboard </a></li>
          <li class="active"> <?php echo $new_name; ?> </li>
        </ol>   
        </div>
        
        <div class="container-fluid">
        <div class="row">
        
        <div class="col-md-4" id=course >
           <div id="list-example" class="list-group">
           
           <form action="another_main_page.php" method=post> 
           <?php 
            
            include "db_connect.php";
            
            $query = "SELECT * FROM admin ORDER BY id DESC ";
        
                $result = mysqli_query($connection,$query);

                if(!$result)
                {
                    die('Query Failed'.mysqli_error($connection));
                }
               $branch = array();
                while($row = mysqli_fetch_assoc($result))
                {
                    $fetch_branch = $row['branch'];
                    
                    array_push($branch , $fetch_branch); 
                    
//                    $branch = $branch." , ".$fetch_branch;
                }
               
                
//               print_r($branch);
               $uni_explode = array_unique($branch);
               $explode = array_values($uni_explode);
//               print_r($uni_explode);
//               print_r($explode);
               
                $total = count($explode);
               
//               echo $total;
               
               while($total != 0)
                {
                   if($explode[$total-1] == 'cse'){ $explode[$total-1] = "Computer Sciecne And Engineering";  }
                   elseif($explode[$total-1] == 'ece'){ $explode[$total-1] = "Electronics And Communicaton Engineering";  }
                   elseif($explode[$total-1] == 'maths'){ $explode[$total-1] = "Statistics And Probability";  }
                   else{ $explode[$total-1] = "Others";  }
                
                   if($explode[$total-1] == "")
                   {
                       $total = $total - 1;
                   }
                
                   else
                   {
                   
             ?>
                 
               <button type="submit" name="<?php echo $explode[$total-1]; ?>" class="list-group-item list-group-item-action"> <?php echo $explode[$total-1]; ?> </button>
                 
            
            <?php
                $total = $total - 1; } }
               ?>                       
                              
               </form>
            </div>
        </div>
        
        <div class="col-md-4">
            
            <div class="page-header">
                
                <h3> Your Uploaded Assignments </h3>
                
            </div>
            
            
            <div id="list-example" class="list-group">
             
             <?php 
                 
//                 uploader_name LIKE '%$active_admin%'
                
                include "db_connect.php";
                $active_admin = "jignesh";
                    
                $query = "SELECT * FROM admin WHERE (branch = '$name') ";
        
                $result = mysqli_query($connection,$query);

                if(!$result)
                {
                    die('Query Failed'.mysqli_error($connection));
                }

                while($row = mysqli_fetch_assoc($result))
                {
                    $id = $row['id'];
                    $u_name = $row['uploader_name'];
                    $ass_no = $row['ass_no'];
                    $ass_name = $row['ass_name'];
                    $branch = $row['branch'];
                    $file_name = $row['file_name'];
                    $uploaded_time = $row['uploaded_time'];
                    $time = $row['submission_date'];
                ?>    
             
                <a class="list-group-item list-group-item-action" id=link7 >  <b>Assignment</b> - <?php echo "<b>".$ass_no."</b>"." of topic "."<b>".$ass_name." ( ".$branch."</b>". " ) was uploaded on ".$uploaded_time." by ".$u_name; ?> </a>
                
            <?php
                
                }
                
                ?>
                  
            </div> 
            
<!--       MODAL STARTS     -->
           
            
            <button class="btn btn-default" data-toggle=modal data-target=#abc id=upload > +  Upload a new one </button>

              <form action="upload_ass.php" method="post" enctype="multipart/form-data"  >
               
                <div class="modal" id=abc>
                  <div class="modal-dialog modal-md">

                    <div class="modal-content">

                      <div class="modal-header">

                        <div class="close" data-dismiss="modal">  &times;</div>
                        <h3> Assignment Upload </h3>

                      </div>

                      <div class="modal-body">
                        <div class="row">
                            
                            <div class="col-md-6"> 
                            
                                <select name="branch" id="input" class="form-control">
                                     
                                      <option value="Branch"> Branch </option>   
                                      <option value="cse"> cse </option>
                                      <option value="ece"> ECE </option>
                                      <option value="maths"> MATHS </option>
                                      
                                </select>

                            
                            </div>
                            <div class="col-md-6"> <input type="text" name="ass_name" class="form-control" placeholder="Assignment Name..."> </div>
                            
                        </div>
                        <br>
                        <div class="row">
                            
                            <div class="col-md-6"> <input type="text" name="ass_no" class="form-control" placeholder="Assignment Number..."> </div>
                            <div class="col-md-6"> Submission Date : <input type="date" name="submission_date" placeholder="h" >  </div>
                            
                        </div>
                        <br>
                        <div class="row">
                        
                              
                           <div class="col-md-12"> <input type="file" name=file></div>
                            
                        </div>  

                      </div>

                      <div class="modal-footer">
                        <div class="text text-right" style="width: 60%;float: left;">
                          <button class="btn btn-primary col-md-4" name=upload data-toggle=modal data-target="#def" > Submit </button>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-default"  data-dismiss="modal" class="close"> Close </button>
                        </div>
                      </div>


                    </div>

                  </div>
                </div>
           
            </form>
<!--    MODAL ENDS                   -->
            
        </div>
        
        <div class="col-md-4">
           
           
            <div class="page-header">
                
                <h3> Your Conducted Exams </h3> 
                
            </div>
            
            

            
        </div>
    
    

      </div>    
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>