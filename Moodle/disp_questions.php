<?php

            session_start();

            $student = $_SESSION['name'];
            $teacher = $_SESSION['teacher'];
            $testname = $_SESSION['testname'];


?>
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

<!--    <link rel="stylesheet" type="text/css" href="answer_panel.css">-->
        <link rel="stylesheet" type="text/css" href="answer_panel1.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Hi <?php echo $student; ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"> Logout </a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->

        </div><!-- /.container-fluid -->
    </nav>

</div>

<!--note --- this is for students so take a note of it-->

<div class="container">
    <ol class="breadcrumb">
        <li><a href="#">Welcome <?php echo $student; ?></a></li>
        <li> Student Dashboard </li>
        <li> Computer Science And Engineering </li>
        <li class="active"> Answer_paper </li>
    </ol>
</div>

<?php
include "db_connect.php";
$query = "SELECT * FROM $teacher WHERE testname LIKE '%$testname%'";

$result = mysqli_query($connection,$query);

if(!$result)
{
    die('Query Failed'.mysqli_error($connection));
}
while($row = mysqli_fetch_assoc($result))
{
//              $positive = $row['positive'];
//              $negative = $row['negative'];
    $nquestions = $row['nquestions'];
//              echo $testname;
//              echo $positive;
//              echo $negative;
    $questions = $row['questions'];
    $options = $row['options'];
    $time = $row['testtime'];

}
?>

<div class="container-fluid">
    <div class="row">
        <h3 style="text-align: center;"><?php echo $testname; ?></h3>
        <div style="text-align: right;margin-right: 10%;font-weight: 900;font-size: 20px; ">time left : <span id="time"><?php echo $time; ?>:00</span> </div>
        <h3 style="margin-left: 20px;" > Questions </h3>
        <div class="col-md-3">
            <!-- <div class="row"> -->
            <?php
            for ($i=0;$i<$nquestions;$i++){
            //                echo $questions_explode[$i];

            ?>

            <div class="col-md-3" style="background-color: lightgrey;border-radius: 5px;padding: 4px 0px;margin: 2px;" > <p style="text-align: center;padding-top: 10px;font-size: 12px;font-weight: 700;" ><?php echo $i+1; ?> </p></div>


            <?php } ?>

        </div>

<!--        do the internal linking of all question on LHS with question on righ hand side-->



        <div class="col-md-7 col-md-offset-1 ">
            <?php
            $questions_substr = substr($questions,3);
            $questions_explode = explode(" $ ",$questions_substr);
            $options_substr = substr($options,3);
            $options_explode = explode(" $ ",$options_substr);
//            $answers_substr = substr($questions,3);
//            $answers_explode = explode(" $ ",$answers_substr);
//            print_r($questions_explode);
            for ($i=0;$i<$nquestions;$i++){
//                echo $questions_explode[$i];

            ?>
                <form action="validate1.php" method="post">
            <div class="outer_layer" id="<?php echo $i+1; ?>">

                <div class="row">

                    <p class="question_name" > Question - <?php echo $i+1; ?> </p>
                    <p class="question" > <?php echo $questions_explode[$i]; ?></p>


                    <br>
                    <div class="col-md-3 text-center"> <label class="radio-inline"> <input type="radio" name="<?php echo $i+1; ?>" id="inlineRadio1" value="<?php echo $options_explode[$i*4]?>"> <?php echo $options_explode[$i*4]?> </label> </div>
                    <div class="col-md-3 text-center"> <label class="radio-inline"> <input type="radio" name="<?php echo $i+1; ?>" id="inlineRadio1" value="<?php echo $options_explode[$i*4+1]?>"> <?php echo $options_explode[$i*4+1]?> </label> </div>
                    <div class="col-md-3 text-center"> <label class="radio-inline"> <input type="radio" name="<?php echo $i+1; ?>" id="inlineRadio1" value="<?php echo $options_explode[$i*4+2]?>">  <?php echo $options_explode[$i*4+2]?> </label> </div>
                    <div class="col-md-3 text-center"> <label class="radio-inline"> <input type="radio" name="<?php echo $i+1; ?>" id="inlineRadio1" value="<?php echo $options_explode[$i*4+3]?>">  <?php echo $options_explode[$i*4+3]?> </label> </div>
                    <br><br>
                </div>

            </div>
            <br>
            <?php } ?>

            <button class="btn btn-success" id="submit"> Submit All Answers </button>
            <br><br>
                </form>
        </div>



    </div>

</div>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
<script>


    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                timer = 0;
                document.getElementById("time").innerHTML = "over.";
                document.getElementById("submit").click();

            }
        }, 1000);
    }

    window.onload = function () {
        var oneMinutes = 60 * <?php echo $time; ?>,
            display = document.querySelector('#time');
        startTimer(oneMinutes, display);
    };
</script>
</html>
