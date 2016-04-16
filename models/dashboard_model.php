<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 17/11/15
     * Time: 23:52
     */
    class Dashboard_Model extends Model {

        function __construct() {
            parent::__construct();
        }

        public function listformations($id)
        {
            return $this->db->select('SELECT formation.idFormation,libelle_formation,date_formation,nbrplace,nom_formateur,categorie.libelle ,((nbrplace) - Count( * )) AS placerestante
            FROM inscrire
            INNER JOIN formation,categorie,formateur
            WHERE formation.idFormation = inscrire.idFormation
            AND categorie_idCategorie = categorie.idCategorie
            AND formateur_id_Formateur = formateur.id_Formateur
            AND membre_id=:id
            GROUP BY formation.idFormation',array(':id'=>$id));
        }

        public function monprofil($id){

            return $this->db->select('SELECT * FROM users
            inner join profiles on users.id_profile = profiles.id  WHERE users.id=:id',array(':id'=>$id));
        }

        public function unsubscribe($id)
        {
            $idx = Session::get('id');
            $this->db->delete('inscrire',"idFormation = '$id'", "membre_id = '$idx'");
        }

        function xhrInsert()
        {
            $text = $_POST['text'];
            $this->db->insert('data',array('text' => $text));

            $data = array('text' => $text, 'id' => $this->db->lastInsertId());
            echo json_encode($data);
        }

        function xhrGetListings()
        {
            $data = $this->db->select("SELECT * FROM data");
            echo json_encode($data);
        }

        function xhrDeleteListing()
        {
            $id = (int) $_POST['id'];
            $this->db->delete('data', "id = '$id'");
        }

        /*Editer son profil (User)*/
        public function editprofil($data){

https://search.disconnect.me/searchTerms/serp?search=4fce1239-aaf1-44bc-97eb-9356e9415a32
            $postData = array(
                'id' => Session::get('id'),
                'login'=>$data['login'],
                'password' => Hash::create('sha1',$data['password'],HASH_PASSWORD_KEY),
                'mail'=>$data['mail'],
                'role'=> Session::get('role'),
                'lastupdate' => date("Y-m-d H:i:s"),
            );


            if(!empty($_POST['login'] AND $_POST['password'] AND $_POST['mail'])) {

                $this->db->update('membre', $postData, "`id` ={$data['id']}");


            }

            else if(!empty($_POST['mail'])){
                $postData = array(
                    'mail'=>$data['mail'],
                    'lastupdate' => date("Y-m-d H:i:s"),
                );
                $this->db->update('membre', $postData, "`id` ={$data['id']}");
            }
            else if(!empty($_POST['login'])){
                $postData = array(
                    'login'=>$data['login'],
                    'lastupdate' => date("Y-m-d H:i:s"),
                );
                $this->db->update('membre', $postData, "`id` ={$data['id']}");
            }
            else if (!empty($_POST['password'])){
                $postData = array(
                    'password' => Hash::create('sha1',$data['password'],HASH_PASSWORD_KEY),
                    'lastupdate' => date("Y-m-d H:i:s"),
                );
                $this->db->update('membre', $postData, "`id` ={$data['id']}");

            }
            else {
                $postData = array(
                    'id' => Session::get('id'),
                );
                $this->db->update('membre', $postData, "`id` ={$data['id']}");
            }

        }

    }
