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

        /**
         *
         */
        public function test3()
        {
            $id = $_POST['id_user'];
            $narval = ($this->model->_getLesMoisDisponibles($id));
            $cpt = count($narval);
            echo '<option value="">--Choisir Un Mois--</option>';
            for ($i = 0; $i < $cpt; $i++) {

                echo '<option' . ' value=' . $narval[ $i ]['mois'] . '>' . $narval[ $i ]['mois'] . '</option>';
            }

        }

        public function suivi()
        {
            $mois = $_POST['mois'];

            $this->view->js = ['frais/js/default.js'];
            $this->view->Lesinfos = $this->model->_getLesInfosFicheFrais($mois);
            $this->view->ToutLesMois = $this->model->_getToutLesMois();
            $this->view->render('frais/suivi');
            var_dump($mois);

        }
        public function popup()
        {
            
            $this->view->render('frais/popup');
        }
        public function test()
        {
                echo "<a class=\"close\" href=\"#\">x</a><h3>Here is some text</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Id: 1</p>";
        }
        /**
         *
         */
        public function validation()
        {
            $this->view->js = ['frais/js/default.js'];

            ///
            $id = $_POST['id_user'];
            $mois = $_POST['val_mois'];
            ///
            $this->view->LaSituation = $this->model->_getLasituation();
            $fraisforfait = ($this->view->LesFraisForfait = $this->model->_getLesFraisForfait($id, $mois));
            $fraishorsforfait = ($this->view->LesFraisHorsForfait = $this->model->_getLesFraisHorsForfait($id, $mois));
            ///
            $this->view->LesMoisDisponibles = $this->model->_getLesMoisDisponibles($id);

            //Original
            $this->view->getlesvisiteurs = $this->model->_getVisiteur();
            $this->view->getlestatuts = $this->model->_getLestatuts();
            $this->view->render('frais/validation');

            //Roue LIBRE
            var_dump($fraisforfait);
            var_dump($fraishorsforfait);

        }

        /**
         *
         */
        public function liste()
        {


            $this->view->LesFraisForfait = $this->model->_getLesFraisForfait();
            $this->view->LesFraisHorsForfait = $this->model->_getLesFraisHorsForfait();
            $this->view->render('frais/list');
        }

        /**
         *
         */
        public function saisir()
        {

            $this->view->VeriFicheFrais = $this->model->_VeriFicheFrais(Session::get('id'));
            $this->view->getLestypes = $this->model->_getToutLestypes();
            $this->view->LesFraisForfait = $this->model->_getLesFraisForfait();
            $this->view->LesFraisHorsForfait = $this->model->_getLesFraisHorsForfait();


            //CHarger Le JS (DATEPICKER,APPEND)
            $this->view->js = ['frais/js/jquery.js', 'frais/js/default.js'];
            $this->view->render('frais/saisir');

        }

        /**
         *
         */
        public function ValFraishorforfaits()
        {
            $data = [];
            $data['date_hf'] = $_POST['date_hf'];
            $data['libelle_hf'] = $_POST['libelle_hf'];
            $data['montant'] = $_POST['montant'];

            $this->model->creeNouveauFraisHorsForfait($data);
            header('location:' . URL . 'frais/saisir');
            exit;


        }

        /**
         *
         */
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
            unset($data);
            header('location:' . URL . 'frais/saisir');
            exit;
        }


        /**
         *
         */
        public function afficher()
        {
            $this->view->LesFraisForfait = $this->model->_getLesFraisForfait();
            $this->view->LesFraisHorsForfait = $this->model->_getLesFraisHorsForfait();
            $this->view->render('frais/etat');
        }


        /**
         *
         */
        public function selectionmois()
        {


            ///
            $id = Session::get('id');
            $mois = $_POST['val_mois'];
            ///
            $this->view->LaSituation = $this->model->_getLasituation();
            $fraisforfait = ($this->view->LesFraisForfait = $this->model->_getLesFraisForfait($id, $mois));
            $fraishorsforfait = ($this->view->LesFraisHorsForfait = $this->model->_getLesFraisHorsForfait($id, $mois));
            ///
            $this->view->LesMoisDisponibles = $this->model->_getLesMoisDisponibles($id);
            $this->view->render('frais/selectmois');
            var_dump($fraisforfait);
            var_dump($fraishorsforfait);
        }

    }