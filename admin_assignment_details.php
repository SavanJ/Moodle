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
      
      if(isset($_FILES['file']))
      {
      $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
          
          move_uploaded_file($file_tmp,"uploads/".$file_name);
       
       echo "FIle Successfully Uploaded ";
       
      }
      
      if(isset($_POST['submit']))
      {
          $branch = $_POST['branch'];
          $ass_no = $_POST['ass_no'];
          $ass_name = $_POST['ass_name'];
        
        $query = "INSERT INTO admin(branch,ass_no,ass_name)";
        $query .= "VALUES ('$branch','$ass_no','$ass_name')";
        
        $result = mysqli_query($connection,$query);
        
        if(!$result)
        {
            die('Query Failed'.mysqli_error($connection)); 
        }
          
      }
      
      
      
      
    ?>  
   
    <br><br><br><br>
    <div class="container">
        
        <div class="row"  >
           
           <form action="admin_assignment_details.php" method="post" enctype="multipart/form-data">
             
            <input type="text" name="branch" id="input" class="form-control" value="" placeholder=" Branch ">
            <br>
            <input type="text" name="ass_no" id="input" class="form-control" value="" placeholder=" Assignment number ">
            <br>
            <input type="text" name="ass_name" id="input" class="form-control" value="" placeholder=" Assignment name ">
            <br>
            <input type="file" name="file" id="input"  >
            <br>
            <button type="submit" name="submit" class="btn btn-default col-md-6 "> Upload </button>

          </form>
            
        </div>
        
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>