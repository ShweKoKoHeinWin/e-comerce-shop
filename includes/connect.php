<?php

    $connect = mysqli_connect('localhost', 'shwe', 'shwe', 'ecommerce');

    if(!$connect) {
        echo 'one';
        die(mysql_error($connect));
    }

?>