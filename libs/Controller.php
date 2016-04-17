<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 17/11/15
     * Time: 16:44
     */
    class Controller
    {
        function __construct()
        {
            //echo 'main controller <br/>';
            $this->view = new View ();
        }

        public function loadmodel($name)
        {
            $path = 'models/' . $name . '_model.php';
            if (file_exists($path)) {
                require 'models/' . $name . '_model.php';
                $modelName = $name . '_Model';
                $this->model = new $modelName();
            }
        }

    }