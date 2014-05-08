<?php




$query ='4DXR1E475D8';
$file ='http://133.208.22.43/amazon-wish/amazon-wish-lister/src/wishlist.php?id=' ;
$json = file_get_contents($file.$query,false);

$wish_array = json_decode($json);

print_r($wish_array);