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
        public function _getLesFraisForfait($id, $mois)
        {


            return $this->db->select('SELECT * from fichefrais
            inner join fraisforfaits on fichefrais.id = fraisforfaits.id_fichefrais
            inner join statuts on fichefrais.id_statut = statuts.id
            WHERE id_user =:id
            AND mois = :mois 
            /*AND statuts.id=1*/
            ORDER BY id_types ASC', [':id' => $id, ':mois' => $mois]);
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
        public function _getLesFraisHorsForfait($id, $mois)
        {


            return $this->db->select('SELECT * from fichefrais
            inner join fraishorsforfaits on fichefrais.id = fraishorsforfaits.id_fichefrais
            inner join situation on fraishorsforfaits.situation_id = situation.id_situation
            WHERE id_user =:id
            AND mois = :mois
            /*AND id_statut=1*/', [':id' => $id, ':mois' => $mois]);
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
         *
         */
        public function creeNouveauFraisHorsForfait()
        {


            $id_user = Session::get('id');
            $id = $this->_getLeDernierId($id_user);
            $data = [];
            $data['date_hf'] = $_POST['date_hf'];
            $data['libelle_hf'] = $_POST['libelle_hf'];
            $data['montant'] = $_POST['montant'];
            $date = date('Y-m-d');
            $verif = date('Y-m-d', strtotime('-1 year'));

            //Compter le nombre d'entrée
            $compt = count($data['date_hf']);


            for ($i = 0; $i < $compt; $i++) {

                if (!is_numeric($data['montant'][ $i ]))
                {
                    echo "le champ doit etre numerique</br>";
                    exit;
                }
                else if ($data['montant'] == "")
                {
                    echo "montant vide";
                    exit;
                }
                else if (preg_match("/\d{4}\-\d{2}-\d{2}/", implode("|", $data['date_hf'])) == false)
                {
                    echo "La date doit être du format Année - Mois - Jour";
                    exit;

                }


                else if (($verif < $data['date_hf'][ $i ]) && ($data['date_hf'][ $i ] < $date))
                {
                    $this->db->insert('test', [
                        'date'    => $data['date_hf'][ $i ],
                        'libelle' => $data['libelle_hf'][ $i ],
                        'montant' => $data['montant'][ $i ],
                        'id_user'=> $id[0]['max'],


                    ]);
                    {


                }

                }

                else{

                    echo "Date d'enregistrement du frais depassé de de plus de 1 an<br/>";
                    exit;
                }

            }
        }


        /**
         * @param $data
         */
        public function creeNouveauFraisForfait()
        {
            $id_user = Session::get('id');
            $id = $this->_getLeDernierId($id_user);
            $data = [];
            $data['type'] = $_POST['type'];
            $data['quantite'] = $_POST['quantite'];
            //$date = date('Y-m-d');
            //$verif = date('Y-m-d', strtotime('-1 year'));

            //Compter le nombre d'entrée

            $compt = count($data['type']);

            for ($i = 0; $i < $compt; $i++) {

                 if(!is_numeric($data['quantite'][ $i ]))
                {
                    echo "le champ doit etre numerique";
                    exit;
                }

                else if (empty($data['quantite']))
                {
                    echo "montant vide";
                    exit;
                }


               /* else if (preg_match("/\d{4}\-\d{2}-\d{2}/", implode("|", $data['date_hf'])) == false)
                {
                    echo "La date doit être du format Année/Mois/Jour";
                    exit;
                }*/
                else
                {
                $this->db->insert('test2', [
                    'type'      => $data['type'][ $i ],
                    'quantite'      => $data['quantite'][ $i ],
                    'id_fichefrais' => $id[0]['max'],

                ]);


                }

            }

            var_dump($data);
            var_dump($_POST);
            print_r($compt);
            var_dump($id_user);
            var_dump($id);
        }

        /**
         * @return mixed
         */
        public function _getLeDernierId($id)
        {
            return $this->db->select('SELECT max(id)AS max FROM fichefrais where id_user = :id', [':id' => $id]);
        }

        /**
         * Supprime le frais hors forfait dont l'id est passé en argument
         * @param $idFrais
         */
        public function supprimerFraisHorsForfait($id)
        {


            $this->db->delete('fraishorsforfaits',"id = '$id'");
        }

        /**
         * Retourne les mois pour lesquel un Visiteur a une fiche de frais
         * @param $idVisiteur
         * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant
         */
        public function _getLesMoisDisponibles($id)
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
        public function _getLesInfosFicheFrais($mois)
        {
            return $this->db->select('SELECT users.id as id, concat(prenom," ",nom)as nom , (DATE_FORMAT(dateAjout,"%d-%m-%Y")) as date,libelle,mois from fichefrais
            inner join users on fichefrais.id_user=users.id
            inner join statuts on fichefrais.id_statut=statuts.id
            where id_statut != 1
            and mois=:mois', [':mois' => $mois]);
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
        //Recuperer Les Types Pour Select
        public function _getToutLestypes()
        {
            return $this->db->select('SELECT * FROM types');
        }

        ///Recuperer les status pour Select
        public function _getLestatuts()
        {
            return $this->db->select('SELECT * FROM statuts');
        }

        ///Recuperer la situation pour Select
        public function _getLasituation()
        {
            return $this->db->select('SELECT * FROM situation');
        }

        ///Recuperer Les Visteurs Pour Select
        public function _getVisiteur()
        {
            return $this->db->select('SELECT id,concat(nom," ",prenom)AS name from users');
        }

        //Recuperer le nom du et prenom du visiteur
        public function _getLeVisiteur($id)
        {
            return $this->db->select('SELECT CONCAT(nom," ",prenom)AS nom FROM users WHERE id=:id', [':id' => $id]);
        }

        //Recuper tous les mois disponible en bdd
        public function _getToutLesMois()
        {
            return $this->db->select('SELECT mois from fichefrais WHERE mois <= (DATE_FORMAT( NOW( ) , "%Y%m" )) group by mois DESC');
        }

        /**
         * Verifie si une fiche de frais est existante pour le mois en cours.
         * Cree une nouvelle ligne si elle n'existe pas.
         *
         * @param $id
         */
        public function _VeriFicheFrais($id)
        {
            $verif = $this->db->prepare('SELECT id,mois from fichefrais WHERE id_user=:id and mois=(DATE_FORMAT(NOW(),"%Y%m"))', [':id' => $id]);
            $verif->execute([':id' => $id]);
            $count = $verif->rowCount();

            if ($count > 0) {

                echo 'YHIHAAAAAAAAAAAAAAAAAAAAA';

            }
                $this->db->insert('fichefrais', ['id_user' => $id]);


        }


    }

