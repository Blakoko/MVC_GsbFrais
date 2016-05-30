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

        public function MajSaisie()
        {


            //Recuperer Le Denier Id De la Fiche
            $id = $this->_getLeDernierId(Session::get('id'));
            $id_fiche = $id[0]['max'];
            $data = $_POST;

            $postRepas = ['quantite' => $data['ff_repas']];
            $postNuit = ['quantite' => $data['ff_hotel']];
            $postEtape = ['quantite' => $data['ff_etape']];
            $postKm = ['quantite' => $data['ff_km']];

            $this->db->update('fraisforfaits', $postRepas, "`id_types` = '4' AND `id_fichefrais`={$id_fiche}");
            $this->db->update('fraisforfaits', $postNuit, "`id_types` = '2' AND `id_fichefrais`={$id_fiche}");
            $this->db->update('fraisforfaits', $postEtape, "`id_types` = '1' AND `id_fichefrais`={$id_fiche}");
            $this->db->update('fraisforfaits', $postKm, "`id_types` = '3' AND `id_fichefrais` = {$id_fiche}");

        }

        public function MajJustif()

        {
            $id = $this->_getLeDernierId(Session::get('id'));
            $id_fiche = $id[0]['max'];

            $data = $_POST;

            $postData = [
                'nb_justificatifs' => $data['justif']
            ];

            $this->db->update('fichefrais', $postData, "`id_fichefrais`={$id_fiche}");
        }

        /**
         * @param $id
         * @return mixed
         */
        public function _getLeDernierId($id)
        {
            return $this->db->select('SELECT max(id)AS max FROM fichefrais WHERE id_user = :id', [':id' => $id]);
        }

        /**
         * Calcul Le montant total des fiches forfait et hors forfait.
         * @param $id
         * @return string
         */
        public function TotalFiche($id)
        {

            $totalff = $this->TotalFraisForfait($id);
            $totalhf = $this->TotalFraisHorsForfait($id);
            $total = $totalff + $totalhf;

            return $total;
        }

        /**
         * Retourne Le Total De la fiche en fonction de Son id
         * @param $id
         * @return mixed
         */
        public function TotalFraisForfait($id)
        {
            $total = $this->db->prepare('SELECT round(sum((quantite*montant)),2)AS total FROM fraisforfaits 
            INNER JOIN types ON fraisforfaits.id_types = types.id
            INNER JOIN fichefrais ON fraisforfaits.id_fichefrais = fichefrais.id
            WHERE id_fichefrais=:id
            AND (id_statut = 2 OR id_statut = 3 OR id_statut = 5)
            ', [':id' => $id]);

            $total->execute([':id' => $id]);

            //Recuperer Le resultat
            $result = $total->fetchColumn();

            return $result;
        }

        /**
         * Le Total De la fiche en fonction de Son id
         * @param $id
         * @return mixed
         */
        public function TotalFraisHorsForfait($id)
        {
            $total = $this->db->prepare('SELECT round(sum((montant)),2) AS total FROM fraishorsforfaits
            INNER JOIN fichefrais on fraishorsforfaits.id_fichefrais = fichefrais.id
            WHERE id_fichefrais=:id
            AND situation_id = 1
            AND (id_statut = 2 OR id_statut = 3 OR id_statut = 5)
            ', [':id' => $id]);

            $total->execute([':id' => $id]);

            //Recuper Le resultat
            $result = $total->fetchColumn();

            return $result;


        }

        /**
         * met à jour le nombre de justificatifs de la table fichefrais
         * pour le mois et le Visiteur concerné
         * @internal param $idVisiteur
         * @internal param sous $mois la forme aaaamm
         */

        public function Val_MajFicheFrais()
        {
            $data = $_POST;
            $postData =
                [
                    'nb_justificatifs' => $data['justif'],
                    'id_statut'        => $data ['statut']
                ];
            $this->db->update('fichefrais', $postData, "`id` = {$data['id_fichefrais']}");
        }

        /**
         * Met à jour la table ligneFraisForfait
         * Met à jour la table ligneFraisForfait pour un Visiteur et
         * un mois donné en enregistrant les nouveaux montants
         * @return un tableau associatif
         * @internal param $idVisiteur
         * @internal param sous $mois la forme aaaamm
         * @internal param tableau $lesFrais associatif de clé idFrais et de valeur la quantité pour ce frais
         */
        public function Val_MajFraisForfait()
        {
            $data = $_POST;
            $postRepas = [
                'quantite' => $data['ff_repas']
                //'id_types'=> 4
            ];
            $postNuit = [
                'quantite' => $data['ff_nuit']
                //'id_types'=> 2
            ];

            $postEtape = [
                'quantite' => $data['ff_etape']
                //'id_types'=> 1
            ];
            $postKm = [
                'quantite' => $data['ff_km']
                //'id_types'=> 3
            ];
            $this->db->update('fraisforfaits', $postRepas, "`id` = {$data['id_repas']}");
            $this->db->update('fraisforfaits', $postNuit, "`id` = {$data['id_nuit']}");
            $this->db->update('fraisforfaits', $postEtape, "`id` = {$data['id_etape']}");
            $this->db->update('fraisforfaits', $postKm, "`id` = {$data['id_km']}");

        }

        //Insertion

        public function Val_MajFraisHorsForfaits()
        {
            $data = $_POST;
            $cpt = count($data['hf_situation']);
            for ($i = 0; $i < $cpt; $i++) {
                $postData = [
                    'date'         => $data['hf_date'][ $i ],
                    'libelle'      => $data['hf_libelle'][ $i ],
                    'montant'      => $data['hf_montant'][ $i ],
                    'situation_id' => $data['hf_situation'][ $i ]

                ];

                $this->db->update('fraishorsforfaits', $postData, "`id` = {$data['id'][$i]}");
            }

        }

        /**
         * Verifie si une fiche de frais est existante pour le mois en cours.
         * Cree une nouvelle ligne si elle n'existe pas.
         *
         * @param $id
         */
        public function _VeriFicheFrais($id)
        {
            $mois = date('Ym', strtotime("+1 month"));

            $verif = $this->db->prepare('SELECT id,mois FROM fichefrais WHERE id_user=:id AND mois=(DATE_FORMAT(NOW(),"%Y%m"))', [':id' => $id]);
            $verif->execute([':id' => $id]);

            $creation = $this->db->prepare('SELECT id_statut FROM fichefrais WHERE id_user=:id AND mois=(DATE_FORMAT(NOW(),"%Y%m"))', [':id' => $id]);
            $creation->execute([':id' => $id]);

            //Recuper Le resultat
            $allo = $creation->fetchColumn();

            //Recuperer le nombre d'enregistrement
            $count = $verif->rowCount();


            if ($count > 0) {

                $this->db->update();
                $this->db->insert('fichefrais', ['id_user' => $id]);

            } else
                //echo "YHAOOOOOOOO";

            if ($allo != 1) {

                $this->db->insert('fichefrais', ['mois' => $mois, 'id_user' => $id]);
                $this->db->update();

                //echo "YHIAAAAAAA";
            }


        }

        /**
         * Retourne le dernier id enregistré d'une fiche frais
         * en fonction du mois et de l'id du visiteur.
         * @param $id
         * @param $mois
         * @return mixed
         */
        public function _getDernieridFiche($id, $mois)
        {
            return $this->db->select('SELECT MAX(id)AS max FROM fichefrais WHERE id_user=:id AND mois=:mois AND id_statut=1', [':id' => $id, ':mois' => $mois]);
        }

        public function _getLasituation()
        {
            return $this->db->select('SELECT * FROM situation');
        }

        public function _getLeVisiteur($id)
        {
            return $this->db->select('SELECT CONCAT(nom," ",prenom)AS nom FROM users WHERE id=:id', [':id' => $id]);
        }

        /**
         * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
         * concernées par les deux arguments
         * @param $id
         * @param $mois sous la forme aaaamm
         * @return l 'id, le libelle et la quantité sous la forme d'un tableau associatif
         * @internal param $idVisiteur
         */
        public function _getLesFraisForfait($id, $mois)
        {

            return $this->db->select('SELECT *,fraisforfaits.id AS WA FROM fichefrais
            INNER JOIN fraisforfaits ON fichefrais.id = fraisforfaits.id_fichefrais
            INNER JOIN statuts ON fichefrais.id_statut = statuts.id
            WHERE id_user =:id
            AND fichefrais.mois = :mois 
            /*AND statuts.id=1*/
            ORDER BY id_types ASC', [':id' => $id, ':mois' => $mois]);
        }

        /**
         * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
         * concernées par les deux arguments
         * La boucle foreach ne peut être utilisée ici car on procède
         * à une modification de la structure itérée - transformation du champ date-
         * @param $id
         * @param $mois sous la forme aaaamm
         * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif
         * @internal param $idVisiteur
         */
        public function _getLesFraisHorsForfait($id, $mois)
        {


            return $this->db->select('SELECT * FROM fichefrais
            INNER JOIN fraishorsforfaits ON fichefrais.id = fraishorsforfaits.id_fichefrais
            INNER JOIN situation ON fraishorsforfaits.situation_id = situation.id_situation
            WHERE id_user =:id
            AND fichefrais.mois = :mois
            AND situation_id = 1
            /*AND id_statut=1*/', [':id' => $id, ':mois' => $mois]);
        }

        /**
         * Retourne les informations d'une fiche de frais d'un Visiteur pour un mois donné
         * @param $mois sous la forme aaaamm
         * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état
         * @internal param $idVisiteur
         */
        public function _getLesInfosFicheFrais($mois)
        {
            return $this->db->select('SELECT users.id AS id, concat(prenom," ",nom)AS nom , (DATE_FORMAT(dateAjout,"%d-%m-%Y")) AS date,libelle,mois,fichefrais.id AS idfiche FROM fichefrais
            INNER JOIN users ON fichefrais.id_user=users.id
            INNER JOIN statuts ON fichefrais.id_statut=statuts.id
            WHERE id_statut != 1
            AND mois=:mois', [':mois' => $mois]);
        }

        /**
         * Retourne les mois pour lesquel un Visiteur a une fiche de frais
         * @param $id
         * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant
         * @internal param $idVisiteur
         */
        public function _getLesMoisDisponibles($id)
        {
            return $this->db->select('SELECT * FROM fichefrais WHERE fichefrais.id_user =:id
            ORDER BY fichefrais.mois DESC', [':id' => $id]);
        }

        public function _getLestatuts()
        {
            return $this->db->select('SELECT * FROM statuts');
        }

        /**
         * @return mixed
         */
        //Recuperer Les Types Pour Select
        /**
         * Retourne le nombre de justificatif d'un Visiteur pour un mois donné
         * @param $id
         * @param $mois sous la forme aaaamm
         * @return le nombre entier de justificatifs
         * @internal param $idVisiteur
         */
        public function _getNbjustificatifs($id, $mois)
        {
            return $this->db->select('SELECT nb_justificatifs AS justif FROM fichefrais WHERE id_user=:id AND mois=:mois', [':id' => $id, ':mois' => $mois]);
        }

        ///Recuperer les status pour Select

        public function _getSituationFiche($id, $mois)
        {
            return $this->db->select('SELECT id_statut ,libelle,fichefrais.id AS num FROM fichefrais
            INNER JOIN statuts ON fichefrais.id_statut = statuts.id
            WHERE id_user=:id
            AND mois=:mois', [':id' => $id, ':mois' => $mois]);
        }

        ///Recuperer la situation pour Select


        public function _getToutLesMois()
        {
            return $this->db->select('SELECT mois FROM fichefrais WHERE mois <= (DATE_FORMAT( NOW( ) , "%Y%m" )) GROUP BY mois DESC');
        }

        ///Recuperer Les Visteurs Pour Select

        public function _getToutLestypes()
        {
            return $this->db->select('SELECT * FROM types');
        }

        //Recuperer le nom du et prenom du visiteur

        public function _getVisiteur()
        {
            return $this->db->select('SELECT id,concat(nom," ",prenom)AS name FROM users');
        }

        //Recuper tous les mois disponible en bdd

        /**
         * Supprime le frais hors forfait dont l'id est passé en argument
         * @param $id
         * @internal param $idFrais
         */
        public function _supprimerFraisHorsForfait($id)
        {
            $id_user = Session::get('id');
            $this->db->delete('fraishorsforfaits', "id_fichefrais in (select fichefrais.id from fichefrais
              where fichefrais.id_user='$id_user' AND fichefrais.id_statut='1')", "id='$id'");
        }

        //Recuperer le statut de la fiche en cours(Validation)

        /**
         * @internal param $data
         */
        public function creeNouveauFraisForfait()
        {
            $id_user = Session::get('id');
            $id = $this->_getLeDernierId($id_user);
            $data = [];
            $data['type'] = $_POST['type'];
            $data['quantite'] = $_POST['quantite'];
            $date = date('Ym');
            //$verif = date('Y-m-d', strtotime('-1 year'));

            //Compter le nombre d'entrée

            $compt = count($data['type']);

            for ($i = 0; $i < $compt; $i++) {

                if (!is_numeric($data['quantite'][ $i ])) {
                    echo "le champ doit etre numerique";
                    exit;
                } else if (empty($data['quantite'])) {
                    echo "montant vide";
                    exit;
                }/*else if (preg_match("/\d{4}\-\d{2}-\d{2}/", implode("|", $data['date_hf'])) == false)
                {
                    echo "La date doit être du format Année/Mois/Jour";
                    exit;
                }*/
                else {
                    $this->db->insert('fraisforfaits', [
                        'id_types'      => $data['type'][ $i ],
                        'quantite'      => $data['quantite'][ $i ],
                        'id_fichefrais' => $id[0]['max'],
                        'mois'          => $date,

                    ]);


                }

            }
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

                if (!is_numeric($data['montant'][ $i ])) {
                    echo "le champ doit etre numerique</br>";
                    exit;
                } else if ($data['montant'] == "") {
                    echo "montant vide";
                    exit;
                } else if (preg_match("/\d{4}\-\d{2}-\d{2}/", implode("|", $data['date_hf'])) == false) {
                    echo "La date doit être du format Année - Mois - Jour";
                    exit;

                } else if (($verif < $data['date_hf'][ $i ]) && ($data['date_hf'][ $i ] < $date)) {
                    $this->db->insert('fraishorsforfaits', [
                        'date'          => $data['date_hf'][ $i ],
                        'libelle'       => $data['libelle_hf'][ $i ],
                        'montant'       => $data['montant'][ $i ],
                        'id_fichefrais' => $id[0]['max'],
                    ]);
                    {

                    }

                } else {

                    echo "Date d'enregistrement du frais depassé de de plus de 1 an<br/>";
                    exit;
                }

            }
        }

        /**
         * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un Visiteur et un mois donnés
         * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
         * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles
         * @internal param $idVisiteur
         * @internal param sous $mois la forme aaaamm
         */
        public function creeNouvellesLignesFrais()
        {

            $this->db->insert('fichefrais', [
                'id_user' => $data['id_user']

            ]);
        }

        /**
         * Retourne le dernier mois en cours d'un Visiteur
         * @return le mois sous la forme aaaamm
         * @internal param $idVisiteur
         */
        public function dernierMoisSaisi($id)
        {

            $dernier = $this->db->prepare('SELECT max(mois) FROM fichefrais WHERE id_user=:id',[':id' => $id]);
            $dernier->execute([':id' => $id]);

            //Recuper Le resultat
            $mois = $dernier->fetchColumn();

            return $mois;
        }

        /**
         * Modifie l'état et la date de modification d'une fiche de frais
         * Modifie le champ idEtat et met la date de modif à aujourd'hui
         * @internal param $idVisiteur
         * @internal param sous $mois la forme aaaamm
         */
        public function majEtatFicheFrais()
        {
            $data = $_POST;

            $postData = [
                'id_statut' => $data['id_statut']
            ];

            $this->db->update('fichefrais', $postData, "`id` = {$data['id']}");
        }

    }

