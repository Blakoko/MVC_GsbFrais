<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 17/11/15
     * Time: 16:52
     */
    class View
    {
        function __construct()
        {
            // echo 'this is the view';
        }

        public function render($name, $noInclude = false)
        {
            if ($noInclude == true) {
                require 'views/' . $name . '.php';
            } else {


                require 'views/header.php';
                require 'views/' . $name . '.php';
                require 'views/footer.php';
            }

        }
    }