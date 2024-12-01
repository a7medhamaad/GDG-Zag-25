<?php

    session_start();
    session_unset();//remove varible in session
    session_destroy();//remove session
    header('Location:login.php');
    exit(); 