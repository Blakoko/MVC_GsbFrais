<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 07/04/16
     * Time: 16:36
     */
    class Frais_Model extends Model
    {
        public function __construct() {
            parent::__construct();

        }

//SELECT
        /**
         * Retourne le nombre de justificatif d'un Visiteur pour un mois donné

         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         * @return le nombre entier de justificatifs
         */
        public function getNbjustificatifs()
        {

        }
        /**
         * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
         * concernées par les deux arguments

         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif
         */
        public function getLesFraisForfait()
        {

        }
        /**
         * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
         * concernées par les deux arguments

         * La boucle foreach ne peut être utilisée ici car on procède
         * à une modification de la structure itérée - transformation du champ date-

         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif
         */
        public function getLesFraisHorsForfait()
        {
            return $this->db->select('');
        }
        /**
         * Fonction statique qui crée l'unique instance de la classe

         * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();

         * @return l'unique objet de la classe PdoGsb
         */
        public function getInfoVisiteur(){

            return $this->db->select('');
        }
        /**
         * Met à jour la table ligneFraisForfait

         * Met à jour la table ligneFraisForfait pour un Visiteur et
         * un mois donné en enregistrant les nouveaux montants

         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
         * @return un tableau associatif
         */
        public function majFraisForfait(){
            return $this->db->update('');
        }
        /**
         * met à jour le nombre de justificatifs de la table fichefrais
         * pour le mois et le Visiteur concerné

         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         */

        public function majNbJustificatifs(){
            return $this->db->update('');
        }
        /**
         * Teste si un Visiteur possède une fiche de frais pour le mois passé en argument

         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         * @return vrai ou faux
         */
        public function estPremierFraisMois()
        {
            return $this->db->select('');
        }
        /**
         * Retourne le dernier mois en cours d'un Visiteur

         * @param $idVisiteur
         * @return le mois sous la forme aaaamm
         */
        public function dernierMoisSaisi()
        {
            return $this->db->select('');
        }

        //Insertion
        /**
         * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un Visiteur et un mois donnés

         * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
         * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles
         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         */
        public function creeNouvellesLignesFrais($data){

           $this->db->insert('fichefrais',array(
               'id_user'=>$data['id_user']
               
           ));
        }
        /**
         * Crée un nouveau frais hors forfait pour un Visiteur un mois donné
         * à partir des informations fournies en paramètre

         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         * @param $libelle : le libelle du frais
         * @param $date : la date du frais au format français jj//mm/aaaa
         * @param $montant : le montant
         */
        public function creeNouveauFraisHorsForfait($data){


            $this->db->insert ('fraishorsforfait',array(
                'montant'=>$data['montant'],
                'date'=>$data['date'],
                'montant'=>$data['montant'],
                'libelle'=>$data['libelle'],
                'nb_justificatif' => $data['nb_justificatif'],
                'id_fichefrais'=>$data['id_fichefrais']
            ));

           
        }
        /**
         * Supprime le frais hors forfait dont l'id est passé en argument

         * @param $idFrais
         */
        public function supprimerFraisHorsForfait(){

            return $this->db->delete('');
        }
        /**
         * Retourne les mois pour lesquel un Visiteur a une fiche de frais

         * @param $idVisiteur
         * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant
         */
        public function getLesMoisDisponibles($id){
            return  $this->db->select('SELECT fichefrais.mois AS mois FROM fichefrais WHERE fichefrais.id_user =:id
            ORDER BY fichefrais.mois DESC',array(':id' =>$id));
        }
        /**
         * Retourne les informations d'une fiche de frais d'un Visiteur pour un mois donné

         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état
         */
        public function getLesInfosFicheFrais(){
            return $this->db->select('');
        }
        /**
         * Modifie l'état et la date de modification d'une fiche de frais

         * Modifie le champ idEtat et met la date de modif à aujourd'hui
         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         */
        public function majEtatFicheFrais(){
            return $this->db->update('');
        }

        public function getLestypes(){
            return $this->db->select('SELECT * FROM types');
        }

    }