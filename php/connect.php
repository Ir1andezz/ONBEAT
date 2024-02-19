<?php

    $connect = mysqli_connect('localhost', 'root', '', 'onbeat');

    if (!$connect) {
        die('Error connect to DataBase');
    }