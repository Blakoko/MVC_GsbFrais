<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 07/04/16
     * Time: 16:36
     */
    class Frais_Model extends Model
    {
        public function __construct()
        {
            parent::__construct();

        }


        /**
         * Retourne le dernier id enregistré d'une fiche frais
         * en fonction du mois et de l'id du visiteur.
         * @param $id
         * @param $mois
         * @return mixed
         */
        public function getDernieridFiche($id, $mois)
        {
            return $this->db->select('SELECT MAX(id)AS max FROM fichefrais WHERE id_user=:id AND mois=:mois AND id_statut=1', [':id' => $id, ':mois' => $mois]);
        }

        /**
         * Retourne le nombre de justificatif d'un Visiteur pour un mois donné
         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         * @return le nombre entier de justificatifs
         */
        public function getNbjustificatifs($id, $mois)
        {
            return $this->db->select('SELECT nb_justificatifs as justif FROM fichefrais WHERE id_user=:id AND mois=:mois', [':id' => $id, ':mois' => $mois]);
        }

        /**
         * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
         * concernées par les deux arguments
         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif
         */
        public function getLesFraisForfait($id, $mois)
        {
            return $this->db->select('SELECT * from fichefrais
            inner join fraisforfaits on fichefrais.id = fraisforfaits.id_fichefrais
            WHERE id_user =:id
            AND mois = :mois ORDER BY id_types ASC' , [':id' => $id, ':mois' => $mois]);
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
        public function getLesFraisHorsForfait($id,$mois)
        {
            return $this->db->select('SELECT * from fichefrais
            inner join fraishorsforfaits on fichefrais.id = fraishorsforfaits.id_fichefrais
            WHERE id_user =:id
            AND mois = :mois',[':id' => $id, ':mois' => $mois]);
        }

        /**
         * Met à jour la table ligneFraisForfait
         * Met à jour la table ligneFraisForfait pour un Visiteur et
         * un mois donné en enregistrant les nouveaux montants
         * @param $idVisiteur
         * @param $mois     sous la forme aaaamm
         * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
         * @return un tableau associatif
         */
        public function majFraisForfait()
        {
            return $this->db->update('');
        }

        /**
         * met à jour le nombre de justificatifs de la table fichefrais
         * pour le mois et le Visiteur concerné
         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         */

        public function majNbJustificatifs()
        {
            return $this->db->update('');
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
        public function creeNouvellesLignesFrais()
        {

            $this->db->insert('fichefrais', [
                'id_user' => $data['id_user']

            ]);
        }


        /**
         * @param $data
         */
        public function creeNouveauFraisHorsForfait($data)
        {
            //Compter le nombre d'entrée

            $compt = count($data);
            for ($i = 0; $i < $compt; $i++) {
                $this->db->insert('fraishorsforfaits', [
                    'date'    => $data['date'][ $i ],
                    'libelle' => $data['libelle'][ $i ],
                    'montant' => $data['montant'][ $i ],

                ]);
            }
        }


        /**
         * @param $data
         */
        public function creeNouveauFraisForfait($data)
        {
            //Compter le nombre d'entrée

            $compt = count($data);
            for ($i = 0; $i < $compt; $i++) {

                $this->db->insert('fraisforfaits', [
                    'id_type'        => $data['id_type'][ $i ],
                    'quantite'         => $data['quantite'][$i],

                ]);
            }
        }

        /**
         * @return mixed
         */
        public function compter()
        {
            return $this->db->select('SELECT count(id)AS cont FROM fichefrais');
        }

        /**
         * Supprime le frais hors forfait dont l'id est passé en argument
         * @param $idFrais
         */
        public function supprimerFraisHorsForfait($id)
        {

            return $this->db->delete('');
        }

        /**
         * Retourne les mois pour lesquel un Visiteur a une fiche de frais
         * @param $idVisiteur
         * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant
         */
        public function getLesMoisDisponibles($id)
        {
            return $this->db->select('SELECT * FROM fichefrais WHERE fichefrais.id_user =:id
            ORDER BY fichefrais.mois DESC', [':id' => $id]);
        }

        /**
         * Retourne les informations d'une fiche de frais d'un Visiteur pour un mois donné
         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état
         */
        public function getLesInfosFicheFrais()
        {
            return $this->db->select('');
        }

        /**
         * Modifie l'état et la date de modification d'une fiche de frais
         * Modifie le champ idEtat et met la date de modif à aujourd'hui
         * @param $idVisiteur
         * @param $mois sous la forme aaaamm
         */
        public function majEtatFicheFrais()
        {
            return $this->db->update('');
        }

        /**
         * @return mixed
         */
        public function getLestypes()
        {
            return $this->db->select('SELECT * FROM types');
        }

        public function getLestatuts()
        {
            return $this->db->select('SELECT * FROM statuts');
        }

        public function getLestest($id)
        {
            return $this->db->select('SELECT * FROM test WHERE id=:id',[':id'=>$id]);
        }

        public function getLestest2()
        {
            return $this->db->select('SELECT * FROM test2');
        }


        /**
         * Verifie si une fiche de frais est existante pour le mois en cours.
         * Cree une nouvelle ligne si elle n'existe pas.
         *
         * @param $id
         */
        public function veriffichefrais($id)
        {
            $verif = $this->db->prepare('SELECT id,mois from fichefrais WHERE id_user=:id and mois=(DATE_FORMAT(NOW(),"%Y%m"))', [':id' => $id]);
            $verif->execute([':id' => $id]);
            $count = $verif->rowCount();

            if ($count > 0) {

                echo 'YHIHAAAAAAAAAAAAAAAAAAAAA';

            } else {
                $this->db->insert('fichefrais', ['id_test' => $id]);
            }

        }

        public function getVisiteur()
        {
            return $this->db->select('SELECT id,concat(nom," ",prenom)AS name from users');
        }




    }

