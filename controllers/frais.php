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


        public function validation()
        {
            //double roue libre
            $mois=$_POST['idmois'];
            $malo=($this->view->getlesmois = $this->model->getLesMoisDisponibles($mois));
            
            //Roue Libre
            $id = $_POST['idtest'];
            $mala=($this->view->getlestest = $this->model->getLestest($id));
            
            //Original
            $this->view->getlesvisiteurs = $this->model->getVisiteur();
            $this->view->getlestatuts = $this->model->getLestatuts();
            $this->view->render('frais/validation');
            
            //Roue LIBRE
            var_dump($mala);
            var_dump($malo);

        }
        public function liste()
        {


            $this->view->getLesFraisForfait = $this->model->getLesFraisForfait();
            $this->view->getLesFraisHorsForfait = $this->model->getLesFraisHorsForfait();
            $this->view->render('frais/list');
        }

        public function saisir()
        {

            $this->view->veriffichefrais = $this->model->veriffichefrais(Session::get('id'));
            $this->view->getLestypes = $this->model->getLestypes();
            $this->view->getLesFraisForfait = $this->model->getLesFraisForfait();
            $this->view->getLesFraisHorsForfait = $this->model->getLesFraisHorsForfait();


            //CHarger Le JS (DATEPICKER,APPEND)
            $this->view->js = ['frais/js/jquery.js', 'frais/js/default.js'];
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
            //selectionner le dernier id de la fichefrais enregistre par l'utilisateur
            $gar = ($this->view->compter = $this->model->compter());

            $data = [];
            $data['type'] = $_POST['type'];
            $data['description'] = $_POST['description'];
            $data['gar'] = $gar[0]['cont'];
            $this->model->creeNouveauFraisForfait($data);
            //var_dump($gar);
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
            $id = 3;//Session::get('id');
            $mois = $_POST['val_mois'];
            ///
            $maoam=($this->view->allo = $this->model->getLesFraisForfait($id, $mois));
            $maori=($this->view->ello = $this->model->getLesFraisHorsForfait($id,$mois));
            ///
            $this->view->getLesMoisDisponibles = $this->model->getLesMoisDisponibles($id);
            $this->view->render('frais/selectmois');
            var_dump($maoam);
            var_dump($maori);
        }

    }