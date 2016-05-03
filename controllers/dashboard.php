<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 17/11/15
     * Time: 20:54
     */
    class Dashboard extends Controller
    {

        function __construct()
        {
            parent::__construct();
            Session::init();
            $logged = Session::get('loggedIn');
            if ($logged == false) {
                Session::destroy();
                header('location:' . URL);
                exit;
            }
            //print_r($_SESSION);
            //Integrer Javascript
            $this->view->js = ['dashboard/js/default.js'];

        }


        function index()
        {

            $this->view->render('dashboard/index');
        }

        function profil()
        {
            $this->view->monprofil = $this->model->monprofil(Session::get('id'));
            $this->view->render('dashboard/profil');
        }


        function logout()
        {
            Session::destroy();
            header('location: ' . URL . '');
            exit;
        }

    }