<?php

session_start();

require_once('./setting_edit.php');
require_once('./getUserData.php');
$userId = $_SESSION['userId'];
$screenName = $_SESSION['screenName'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="navbar navbar-inverse navbar-static-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="./index.php">Amazon-wish</a>
                <ul class="nav pull-right">
                    <li><a href="./index.php">Home</a></li>
                    <?php
                    if(isset($userId)){
                        print "<li><a href='./settings.php'>Setting</a></li>";
                        print "<li><a href='./logout.php'>Logout</a></li>";
                    }else{
                        print "<li><a href='./login.php'>Setting</a></li>";
                        print "<li><a href='./login.php'>Login</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="container" >
        <div class="page-header"><h4>設定</h4></div>
        <?php
        echo "screenName:".$screenName;
        $wishIDArray = getWishArray($userId);

        foreach ($wishIDArray as $wishID) {
            print "<form role='form' action='deleteWish.php' method = 'post'>";
            print "<div class='input-group'>";
            print "<div class='form-inline'>";
            print "<input type='text' name ='wishID' class='form-control' readonly = 'readonly' value = '".$wishID."'>";
            print "<input class = 'btn btn-danger' type='submit' value = 'delete'></input>";
            print "</div>";
            print "</form>";
            print "</div>";
        }
        ?>

        <label for="addWish">追加したいほしいものリストのID</label>


        <form role="form" action="addWish.php" method = "post" >
            <div class="input-group">
                <div class="form-inline">
                    <input type="text" name = "wishID" class="form-control">
                    <input class="btn btn-primary" type="submit" value="add"></input>
                </div>
            </form>
        </div><!-- /input-group -->




    </div> <!-- container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>