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


            if ( Session::get('loggedIn') == true) {

                $this->view->render('dashboard/profil');

            }
            else {
                header('location:'.URL);
                exit;
            }
        }

        function run()
        {
            $this->model->run();
            header('location:'.URL);
            exit;
        }
    }