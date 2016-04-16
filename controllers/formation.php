<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 27/02/16
     * Time: 22:22
     */
    class Formation extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            Session::init();
            $logged = Session::get('loggedIn');
            if ($logged == false) {
                Session::destroy();
                header('location: '.URL.'');
                exit;
            }
        }
        public function index()
        {
            $this->view->listformation = $this->model->listformation();
            $this->view->listformateur  = $this->model->listformateur();
            $this->view->listcategorie  = $this->model->listcategorie();
            $this->view->verifinscription = $this->model->verifinscription(Session::get('id'));
            $this->view->render('formation/index');
        }

        public function delete($id){
            $this->model->delete($id);
            header('location:'.URL.'formation');
        }

        public function edit($id)
        {
            $this->view->formation = $this->model->formationSingleList($id);
            $this->model->listformateur();
            $this->model->listcategorie();
            $this->view->render('formation/edit');
        }

        public function editSave($id){

            $data = array();
            $data['id'] = $id;
            $data['login'] = $_POST['login'];
            $data['password'] = $_POST['password'];
            $data['mail'] = $_POST['mail'];

            $this->model->editSave($data);
            header('location:'.URL.'user');
        }


        public function create()
        {
            if(Session::get('role')=='owner')
            $data = array();
            $data['libelle_formation'] = $_POST['formation'];
            $data['date_formation'] = $_POST['date'];
            $data['nbrplace'] = $_POST['place'];
            $data['formateur_id_formateur'] = $_POST['formateur'];
            $data['categorie_idCategorie'] = $_POST['categorie'];

            $this->model->create($data);
            header('location:'.URL.'formation');
        }

        public function inscription($id)
        {
            $data = array();
            $data['idFormation']=$id;
            $data['membre_id']= Session::get('id');
            //print_r($data);
            $this->model->inscription($data);
            header('location:'.URL.'formation');
        }

        public function details($id)
        {


           $this->view->details =  $this->model->details($id);
            $this->view->render('formation/details');





        }

       /*public function register()
        {
            $data = array();
            $data['name']=$_POST['name'];
            $data['age']=$_POST['age'];
            $data['mail']=$_POST['mail'];
            $data['gender']=$_POST['gender'];



            $this->model->register();
            header('location : '.URL.'formation');
        }*/


    }