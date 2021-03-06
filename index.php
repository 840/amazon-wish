<?php


session_start();

require_once('./setting_edit.php');
require_once('./getUserData.php');

$userId = $_SESSION['userId'];
$screenName = $_SESSION['screenName'];

$userArray = getUserArray();
$userIDArray = getUserIDArray();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Amazon-wish</title>

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



    <div class="container">


        <?php
        foreach ($userIDArray as $userID) {
            $wishcount = getWishCount($userID);
            $wishIDArray = getWishArray($userID);
            ?>
            <div class="panel-group" id="accordion">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <?php
                    print '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse'.getNamefromID($userID).'">';
                    print getNamefromID($userID)."のほしいものリスト";
                    print '<a href="#"><span class="badge">'.$wishcount.'</span></a>';
                    ?>
                </a>
            </h4>
        </div>
        <?php print '<div id="collapse'.getNamefromID($userID).'" class="panel-collapse collapse in">';
        foreach ($wishIDArray as $wishID) {
            print "<div class='panel-body'>";
            print "<a href = './wish_view.php?wishID=".$wishID."'>".$wishID."</a>";
            print "</div>";
        }
        ?>
    </div>
</div>

</div>
<?php } ?>


</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>