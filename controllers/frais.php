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
        }

        public function index()
        {
            //Charge La vue index.php
            $this->view->render('frais/index');
        }

        public function moisdispo()
        {
            if(!empty($_POST)) {
                $id = $_POST['id_user'];

                $lesmois = ($this->model->_getLesMoisDisponibles($id));
                $cpt = count($lesmois);
                echo '<option value="">--Choisir Un Mois--</option>';
                for ($i = 0; $i < $cpt; $i++) {
                    echo '<option' . ' value=' . $lesmois[ $i ]['mois'] . '>' . $lesmois[ $i ]['mois'] . '</option>';
                }
            } else{
                header('location:' .URL.'');
            }
        }

        public function suivi()
        {
            if (Session::get('profil') == 1) {
                $id = $_POST['id'];
                $mois = $_POST['mois'];
                $this->view->js = ['frais/js/default.js'];
                $this->view->Lesinfos = $this->model->_getLesInfosFicheFrais($mois);
                $this->view->ToutLesMois = $this->model->_getToutLesMois();
                $this->view->InfoVisiteur = $this->model->_getLeVisiteur($id);
                //charge la vue suivie.php
                $this->view->render('frais/suivi');
            } else {
                header('location: ' . URL . '');
            }
        }

        public function popup()
        {
            if(!empty($_POST)) {

                if (Session::get('profil') == 1) {

                    $id = $_POST['id'];
                    $mois = $_POST['mois'];


                    $this->view->LesFraisForfait = $this->model->_getLesFraisForfait($id, $mois);
                    $this->view->LesFraisHorsForfait = $this->model->_getLesFraisHorsForfait($id, $mois);
                    $this->view->situationfiche = $this->model->_getSituationFiche($id, $mois);
                    $this->view->lestatuts = $this->model->_getLestatuts();
                    $this->view->InfoVisiteur = $this->model->_getLeVisiteur($id);
                    //charge la vue popup.php
                    $this->view->render('frais/popup');


                } else {
                    header('location: ' . URL . '');
                }
            }
            else {
                header('location:' . URL);
            }

        }

        public function validation()
        {
            if (Session::get('profil') == 1) {
                //Charge les fichiers Js
                $this->view->js = ['frais/js/default.js'];

                //L'id de l'utilisateur et le mois selectionné.
                $id = $_POST['id_user'];
                $mois = $_POST['val_mois'];
                ///
                $this->view->LaSituation = $this->model->_getLasituation();
                $fraisforfait = ($this->view->LesFraisForfait = $this->model->_getLesFraisForfait($id, $mois));
                $fraishorsforfait = ($this->view->LesFraisHorsForfait = $this->model->_getLesFraisHorsForfait($id, $mois));
                $this->view->LesMoisDisponibles = $this->model->_getLesMoisDisponibles($id);

                //Original
                $visiteur = ($this->view->LeVisiteur = $this->model->_getLeVisiteur($id));
                $this->view->getlesvisiteurs = $this->model->_getVisiteur();
                $this->view->getlestatuts = $this->model->_getLestatuts();

                //charge la vue validation.php
                $this->view->render('frais/validation');
                
            } else {
                header('location: ' . URL . '');
            }

        }

        public function saisir()
        {   //Charge les fichiers Js
            $this->view->js = ['frais/js/jquery.js', 'frais/js/default.js'];
            //L'id de lutilisateur de le mois actuel formaté en AnnéeMois
            $id = Session::get('id');
            $mois = date('Ym');
            //Fonctions du model
            $this->view->getLestypes = $this->model->_getToutLestypes();
            $this->view->VeriFicheFrais = $this->model->_VeriFicheFrais($id);
            $this->view->LesFraisForfait = $this->model->_getLesFraisForfait($id, $mois);
            $this->view->LesFraisHorsForfait = $this->model->_getLesFraisHorsForfait($id, $mois);

            echo ($id);
            //charge la vue saisir.php
            $this->view->render('frais/saisir');
        }


        public function valfraishorforfaits()
        {
            /*$data = [];
            $data['date_hf'] = $_POST['date_hf'];
            $data['libelle_hf'] = $_POST['libelle_hf'];
            $data['montant'] = $_POST['montant'];*/

            $this->model->creeNouveauFraisHorsForfait();
            //header('location:' . URL . 'frais/saisir');
            exit;


        }

        public function delete($id)
        {
            $this->model->_supprimerFraisHorsForfait($id);
            header('location:'.URL.'frais/saisir');
        }

        /**
         *
         */
        public function valfraisforfaits()
        {
            //selectionner le dernier id de la fichefrais enregistré par l'utilisateur
            //$id = ($this->view->LeDernierId = $this->model->_getLeDernierId(Session::get('id')));

            //$data = [];
            //$data['type'] = $_POST['type'];
            //$data['quantite'] = $_POST['quantite'];
            //$data['id'] = $id[0]['max'];


            $this->model->creeNouveauFraisForfait();
            //var_dump($_POST);
            //unset($data);
            //header('location:' . URL . 'frais/saisir');
            exit;
        }


        /**
         *
         */
        public function selectionmois()
        {
            //Charge les fichiers Js
            $this->view->js = ['frais/js/jquery.js', 'frais/js/default.js'];
            //Le Mois correspondant et l'id de l'utilisateur
            $id = Session::get('id');
            $mois = $_POST['val_mois'];
            ///Charge Les Fonctions  du model 
            $this->view->LaSituation = $this->model->_getLasituation();
            $this->view->LesMoisDisponibles = $this->model->_getLesMoisDisponibles($id);
            $this->view->LesFraisForfait = $this->model->_getLesFraisForfait($id, $mois);
            $this->view->LesFraisHorsForfait = $this->model->_getLesFraisHorsForfait($id, $mois);
            //charge la vue selectmois.php
            $this->view->render('frais/selectmois');

        }
    }