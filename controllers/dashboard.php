<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 17/11/15
     * Time: 20:54
     */
    class Dashboard extends Controller {

        function __construct() {
            parent::__construct();
            Session::init();
            $logged = Session::get('loggedIn');
            if ($logged == false) {
                Session::destroy();
                header('location:' .URL);
                exit;
            }
           //print_r($_SESSION);
            //Integrer Javascript
            $this->view->js = array('dashboard/js/default.js');

        }




        function index()
        {
            $this->view->listformations = $this->model->listformations(Session::get('id'));

            $this->view->render('dashboard/index');
        }

        function unsubscribe($id)
        {
            $this->model->unsubscribe($id);
            header('location:'.URL.'dashboard');
        }
        function profil()
        {
            $this->view->monprofil = $this->model->monprofil(Session::get('id'));
            $this->view->render('dashboard/profil');
        }


        function logout()
        {
            Session::destroy();
            header('location: ' . URL .  '');
            exit;
        }

        function xhrInsert()
        {
            $this->model->xhrInsert();
        }

        function xhrGetListings()

        {
            $this->model->xhrGetListings();
        }

        function xhrDeleteListing()
        {
            $this->model->xhrDeleteListing();
        }

        public function editprofil()
        {
            //$form = new Form();
            $data = array();
            $data['id'] = Session::get('id');
            $data['login'] = $_POST['login'];
            $data['password'] = $_POST['password'];
            $data['mail'] = $_POST['mail'];

            $this->model->editprofil($data);
            header('location:'.URL.'dashboard');
        }
    }