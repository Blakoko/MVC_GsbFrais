<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 07/04/16
     * Time: 16:35
     */
    class Frais extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            Session::init();
            $logged = Session::get('loggedIn');
            if ($logged == false) {
                Session::destroy();
                header('location: ' . URL . '');
                exit;
            }

            //$this->view->js = ['frais/js/jquery.js','frais/js/default.js'];
        }

        public function index()
        {
            //$this->view->listformation = $this->model->listformation();
            //$this->view->listformateur  = $this->model->listformateur();
            //$this->view->listcategorie  = $this->model->listcategorie();
            //$this->view->verifinscription = $this->model->verifinscription(Session::get('id'));
            $this->view->render('frais/index');
        }

        public function liste()
        {


            $this->view->getLesFraisForfait = $this->model->getLesFraisForfait();
            $this->view->getLesFraisHorsForfait = $this->model->getLesFraisHorsForfait();
            $this->view->render('frais/list');
        }

        public function saisir()
        {


            $data = [];
            $data['date_hf'] = $_POST['date_hf'];
            $data['libelle_hf'] = $_POST['libelle_hf'];
            $data['montant'] = $_POST['montant'];
            //$data['id_user'] = Session::get('id');
            $this->view->getLestypes = $this->model->getLestypes();
            $this->view->getLesFraisForfait = $this->model->getLesFraisForfait();
            $this->view->getLesFraisHorsForfait = $this->model->getLesFraisHorsForfait();
            $this->model->creeNouveauFraisHorsForfait($data);

            //$this->model->creeNouvellesLignesFrais($data);

            //CHarger Le JS (DATEPICKER,APPEND)
            $this->view->js = ['frais/js/jquery.js','frais/js/default.js'];
            $this->view->render('frais/saisir');
        }
        
        public function ValFraishorforfaits()
        {
            $data = [];
            $data['date_hf'] = $_POST['date_hf'];
            $data['libelle_hf'] = $_POST['libelle_hf'];
            $data['montant'] = $_POST['montant'];
            $this->model->creeNouveauFraisHorsForfait($data);
            header('location:' . URL . 'frais/saisir');
            
            
        }

        public function ValFraisForfaits()
        {
            $data = [];
            $data['type']=$_POST['type'];
            $data['description']=$_POST['description'];
            $this->model->creeNouveauFraisForfait($data);
            header('location:' . URL . 'frais/saisir');
        }


        public function afficher()
        {
            $this->view->getLesFraisForfait = $this->model->getLesFraisForfait();
            $this->view->getLesFraisHorsForfait = $this->model->getLesFraisHorsForfait();
            $this->view->render('frais/etat');
        }


        public function selectionmois()
        {

            $this->view->getLesMoisDisponibles = $this->model->getLesMoisDisponibles(Session::get('id'));
            $this->view->render('frais/selectmois');
        }

    }