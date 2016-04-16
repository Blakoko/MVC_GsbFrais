<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 17/11/15
     * Time: 18:08
     */
    class Login extends Controller
    {
        function __construct()
        {
            parent::__construct();

        }

        function index()
        {
            $this->view->msg ='we are inside Login </br>';
            $this->view->render('login/index');
        }

        function run()
        {
            $this->model->run();

        }
    }