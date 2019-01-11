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
    
    <link href="login_next_page.css" rel="stylesheet">

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
      
      if(isset($_POST['create_new']))
      {
          $name = $_POST['name'];
          $password = $_POST['password'];
          $email = $_POST['email'];
          $uni_name = $_POST['university_name'];
          $branch = $_POST['branch'];
          $year = $_POST['year'];
          $number = $_POST['number'];
          
          $_SESSION['name'] = $name;
          $_SESSION['branch'] = $branch;
          $_SESSION['email'] = $email;
          
            $i = 0;
            $pin = "";
            while($i < 4)
            {
                $pin .= mt_rand(0, 9);
                $i++;
            }

            echo $pin, '<br>';

//            $_SESSION['otp'] = $pin;
          
          $to = $email;
        $subject = "Email Verification";
        $txt = "Your OTP is  : $pin "  ; 
        $headers = "From: savanjasanidot5@gmail.com" . "\r\n" ;

        $mail = mail($to,$subject,$txt,$headers);
          
          if($mail)
          {
              $create_table = "CREATE TABLE IF NOT EXISTS $name(
                id int(10) NOT NULL AUTO_INCREMENT,
                testname varchar(256) NOT NULL ,
                response varchar(256) NOT NULL ,
                marks int(10) NOT NULL,
                total_marks int(10) NOT NULL,
                PRIMARY KEY (id)
              )";
              
                $create_table_result = mysqli_query($connection,$create_table);
              
                if(!$create_table_result)
                {
                    die('Query Failed'.mysqli_error($connection)); 
                }
              
                $query = "INSERT INTO student_login(name,email,password,branch,year,university_name,phone_number,otp)";
                $query .= "VALUES ('$name','$email','$password','$branch','$year','$uni_name','$number','$pin')";
              
                $another_query = "INSERT INTO student_login(uploader_name,branch)";
                $another_query .= "VALUES ('$name','$branch')";

                $result = mysqli_query($connection,$query);
                $another_result = mysqli_query($connection,$another_query);
              
                
              
              
            if(!$result)
                {
                    die('Query Failed'.mysqli_error($connection)); 
                }
              
             else
              {
                 header('Location: verify_account.php');
              }      
          }
          else
          {
              echo "mail not sent";
              
              $create_table = "CREATE TABLE IF NOT EXISTS $name(
                id int(10) NOT NULL AUTO_INCREMENT,
                testname varchar(256) NOT NULL ,
                response varchar(256) NOT NULL ,
                marks int(10) NOT NULL,
                total_marks int(10) NOT NULL,
                PRIMARY KEY (id)
              )";
              
                $create_table_result = mysqli_query($connection,$create_table);
              
                if(!$create_table_result)
                {
                    die('Query Failed'.mysqli_error($connection)); 
                }
              
                $query = "INSERT INTO student_login(name,email,password,branch,year,university_name,phone_number,otp)";
                $query .= "VALUES ('$name','$email','$password','$branch','$year','$uni_name','$number','$pin')";
              
                $another_query = "INSERT INTO student_login(uploader_name,branch)";
                $another_query .= "VALUES ('$name','$branch')";

                $result = mysqli_query($connection,$query);
                $another_result = mysqli_query($connection,$another_query);
              
              
                if(!$result)
                {
                    die('Query Failed'.mysqli_error($connection)); 
                }

                 else
                  {
                     header('Location: verify_account.php');
                  }      
          }
        
      }
      
    ?>  
    
    <div class="container">
    
        <form action=login_next_page.php method="post" >
    
        <div class="row" id=row1>
            
            <div class="col-md-6" id=col1 >
                
                <input type="text" class="form-control" name="name" placeholder="Enter Your Name" id="input1">
                <br>
                <input type="text" class="form-control" name="password" placeholder="Enter Your Password" id="input1">
                <br>
                <input type="text" class="form-control" name="email" placeholder="Enter Your Email" id="input1">
                <br>
                <input type="text" class="form-control" name="university_name" placeholder="University Name" id="input1">
            </div>
            
            <div class="col-md-6">
                
                <input type="text" class="form-control" name="branch" placeholder="Enter Your Branch " id="input1">
                <br>
                <input type="text" class="form-control" name="year" placeholder="Enter Your Year" id="input1">
                <br>
                <input type="text" class="form-control" name="number" placeholder="Phone Number" id="input1">
                <br>
                <input type="text" class="form-control" placeholder="Enter Your District" id="input1">
                
            </div>
                 <button type="submit" name="create_new" class="btn btn-default col-md-12 " id=verify_button > Verify The Account </button>
                
            
        </div>
        
        </form>
    
    </div>

    <br><br><br><br>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>