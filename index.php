<?php

    require 'config.php';
    //require LIBS.'Form/Val.php';
    //AUtoloader

    function __autoload($class)
    {
        require LIBS.$class.'.php';
    }





    $app = new Bootstrap();

