<!DOCTYPE html>
<html lang="en">
  <head>
   <link href="moodle_index.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Mali|Patrick+Hand" rel="stylesheet"> 
    
    

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
      $count_error = 0;
      if(isset($_POST['login']))
      {
          $username = $_POST['username'];
          $password = $_POST['password'];
          
        
      
        $query = "SELECT * FROM admin_login WHERE(name = '$username' AND password = '$password') ";
        
        $result = mysqli_query($connection,$query);
          
        $row_count = mysqli_num_rows($result);  
        
        if(!$result)
        {
            die('Query Failed'.mysqli_error($connection));
        }
        if($row_count != 0)
        {  
            while($row = mysqli_fetch_assoc($result))
            {

                $fetch_password = $row['password'];
                $fetch_username = $row['name'];
                $branch = $row['branch'];
            }

            if($username == $fetch_username && $password == $fetch_password)
            {
                $_SESSION['name'] = $fetch_username;
                $_SESSION['branch'] = $branch;

                header('Location: admin_main_page.php');

            }
        }
        else
        {
            $count_error = 1;
            $error = "Please insert the correct username or password";
//            header('Location: admin_moodle_index.php');
        }
      
        
      }
      
    ?>  
    
    <div class="container-fluid">
        
        <div class="row">
            
            <a href="moodle_index.php" type="button" class="btn btn-default" style="float: right;margin: 30px 20px;" > Student Login </a>
            
            <h2 class="logo_name" > <span class="f" >F</span>oo<span class="f" >d</span>le  <small class="logo_name_small" > Welcome to Online Examination System. </small> </h2>
            
            
            
        </div>
        
    </div>
    
    <div class="container">
       
        <div class="row" id=moodle_row >
            
            <div class="col-xs-12 col-sm-12 col-md-3"></div>
            
            <div class="col-xs-12 col-sm-12 col-md-6" id=moodle_layout >
                
            <div id=moodle_inner_layout     >

                    <div class="page-header" id="moodle_header" >  
                          <h4> Welcome To <small> Foodle </small> Moodle ( Admin Login ) </h4>

                    <br>
                    <p style="color:red;" ><?php if($count_error == 1){ echo $error; } else {  } ?> </p>

                    </div>

                <form action="admin_moodle_index.php" method="POST" role="form">

                        <input type="text" name="username"  class="form-control" id="input1" placeholder="Enter Your Username">
                        <br>
                        <input type="text" class="form-control" name="password" id="input2" placeholder="Enter Your Password">
                        <br>

                    <button type="submit" class="btn btn-primary col-md-12 " name="login" id="moodle_login" >Submit</button>
                    <br><br>
                    
                </form>

    


            </div>
                    
                
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-3" id="moodle_layou" ></div>

            
        </div>
        
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>