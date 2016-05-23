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

        /**
         * @param $id
         * @return mixed
         */
        public function _getLeDernierId($id)
        {
            return $this->db->select('SELECT max(id)AS max FROM fichefrais WHERE id_user = :id', [':id' => $id]);
        }

        /**
         * met � jour le nombre de justificatifs de la table fichefrais
         * pour le mois et le Visiteur concern�
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
         * Met � jour la table ligneFraisForfait
         * Met � jour la table ligneFraisForfait pour un Visiteur et
         * un mois donn� en enregistrant les nouveaux montants
         * @return un tableau associatif
         * @internal param $idVisiteur
         * @internal param sous $mois la forme aaaamm
         * @internal param tableau $lesFrais associatif de cl� idFrais et de valeur la quantit� pour ce frais
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
            $verif = $this->db->prepare('SELECT id,mois FROM fichefrais WHERE id_user=:id AND mois=(DATE_FORMAT(NOW(),"%Y%m"))', [':id' => $id]);
            $verif->execute([':id' => $id]);
            $count = $verif->rowCount();

            if ($count > 0) {

                //echo 'YHIHAAAAAAAAAAAAAAAAAAAAA';

            }
            $this->db->insert('fichefrais', ['id_user' => $id]);


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
         * concern�es par les deux arguments
         * @param $id
         * @param $mois sous la forme aaaamm
         * @return l 'id, le libelle et la quantit� sous la forme d'un tableau associatif
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

        //Insertion

        /**
         * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
         * concern�es par les deux arguments
         * La boucle foreach ne peut �tre utilis�e ici car on proc�de
         * � une modification de la structure it�r�e - transformation du champ date-
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
            /*AND id_statut=1*/', [':id' => $id, ':mois' => $mois]);
        }

        /**
         * Retourne les informations d'une fiche de frais d'un Visiteur pour un mois donn�
         * @param $mois sous la forme aaaamm
         * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'�tat
         * @internal param $idVisiteur
         */
        public function _getLesInfosFicheFrais($mois)
        {
            return $this->db->select('SELECT users.id AS id, concat(prenom," ",nom)AS nom , (DATE_FORMAT(dateAjout,"%d-%m-%Y")) AS date,libelle,mois FROM fichefrais
            INNER JOIN users ON fichefrais.id_user=users.id
            INNER JOIN statuts ON fichefrais.id_statut=statuts.id
            WHERE id_statut != 1
            AND mois=:mois', [':mois' => $mois]);
        }

        /**
         * Retourne les mois pour lesquel un Visiteur a une fiche de frais
         * @param $id
         * @return un tableau associatif de cl� un mois -aaaamm- et de valeurs l'ann�e et le mois correspondant
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

        public function _getSituationFiche($id, $mois)
        {
            return $this->db->select('SELECT id_statut ,libelle,fichefrais.id AS num FROM fichefrais
            INNER JOIN statuts ON fichefrais.id_statut = statuts.id
            WHERE id_user=:id
            AND mois=:mois', [':id' => $id, ':mois' => $mois]);
        }

        public function _getToutLesMois()
        {
            return $this->db->select('SELECT mois FROM fichefrais WHERE mois <= (DATE_FORMAT( NOW( ) , "%Y%m" )) GROUP BY mois DESC');
        }

        public function _getToutLestypes()
        {
            return $this->db->select('SELECT * FROM types');
        }

        public function _getVisiteur()
        {
            return $this->db->select('SELECT id,concat(nom," ",prenom)AS name FROM users');
        }

        /**
         * Supprime le frais hors forfait dont l'id est pass� en argument
         * @param $id
         * @internal param $idFrais
         */
        public function _supprimerFraisHorsForfait($id)
        {
            $id_user = Session::get('id');
            $this->db->delete('fraishorsforfaits', "id_fichefrais in (select fichefrais.id from fichefrais
              where fichefrais.id_user='$id_user' AND fichefrais.id_statut='1')", "id='$id'");
        }

        /**
         * @return mixed
         */
        //Recuperer Les Types Pour Select

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

            //Compter le nombre d'entr�e

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
                    echo "La date doit �tre du format Ann�e/Mois/Jour";
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

            var_dump($data);
            var_dump($_POST);
            print_r($compt);
            var_dump($id_user);
            var_dump($id);
        }

        ///Recuperer les status pour Select

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

            //Compter le nombre d'entr�e
            $compt = count($data['date_hf']);


            for ($i = 0; $i < $compt; $i++) {

                if (!is_numeric($data['montant'][ $i ])) {
                    echo "le champ doit etre numerique</br>";
                    exit;
                } else if ($data['montant'] == "") {
                    echo "montant vide";
                    exit;
                } else if (preg_match("/\d{4}\-\d{2}-\d{2}/", implode("|", $data['date_hf'])) == false) {
                    echo "La date doit �tre du format Ann�e - Mois - Jour";
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

                    echo "Date d'enregistrement du frais depass� de de plus de 1 an<br/>";
                    exit;
                }

            }
        }

        ///Recuperer la situation pour Select

        /**
         * Cr�e une nouvelle fiche de frais et les lignes de frais au forfait pour un Visiteur et un mois donn�s
         * r�cup�re le dernier mois en cours de traitement, met � 'CL' son champs idEtat, cr�e une nouvelle fiche de frais
         * avec un idEtat � 'CR' et cr�e les lignes de frais forfait de quantit�s nulles
         * @internal param $idVisiteur
         * @internal param sous $mois la forme aaaamm
         */
        public function creeNouvellesLignesFrais()
        {

            $this->db->insert('fichefrais', [
                'id_user' => $data['id_user']

            ]);
        }

        ///Recuperer Les Visteurs Pour Select

        /**
         * Retourne le dernier mois en cours d'un Visiteur
         * @return le mois sous la forme aaaamm
         * @internal param $idVisiteur
         */
        public function dernierMoisSaisi()
        {
            return $this->db->select('');
        }

        //Recuperer le nom du et prenom du visiteur

        /**
         * Retourne le dernier id enregistr� d'une fiche frais
         * en fonction du mois et de l'id du visiteur.
         * @param $id
         * @param $mois
         * @return mixed
         */
        public function getDernieridFiche($id, $mois)
        {
            return $this->db->select('SELECT MAX(id)AS max FROM fichefrais WHERE id_user=:id AND mois=:mois AND id_statut=1', [':id' => $id, ':mois' => $mois]);
        }

        //Recuper tous les mois disponible en bdd

        /**
         * Retourne le nombre de justificatif d'un Visiteur pour un mois donn�
         * @param $id
         * @param $mois sous la forme aaaamm
         * @return le nombre entier de justificatifs
         * @internal param $idVisiteur
         */
        public function getNbjustificatifs($id, $mois)
        {
            return $this->db->select('SELECT nb_justificatifs AS justif FROM fichefrais WHERE id_user=:id AND mois=:mois', [':id' => $id, ':mois' => $mois]);
        }

        //Recuperer le statut de la fiche en cours(Validation)

        /**
         * Modifie l'�tat et la date de modification d'une fiche de frais
         * Modifie le champ idEtat et met la date de modif � aujourd'hui
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

