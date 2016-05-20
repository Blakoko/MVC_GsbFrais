<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 17/11/15
     * Time: 23:52
     */
    class Dashboard_Model extends Model
    {

        function __construct()
        {
            parent::__construct();
        }


        public function monprofil($id)
        {

            return $this->db->select('SELECT * FROM users
            inner join profiles on users.id_profile = profiles.id  WHERE users.id=:id', [':id' => $id]);
        }

        /*function xhrInsert()
        {
            $text = $_POST['text'];
            $this->db->insert('data', ['text' => $text]);

            $data = ['text' => $text, 'id' => $this->db->lastInsertId()];
            echo json_encode($data);
        }

        function xhrGetListings()
        {
            $data = $this->db->select("SELECT * FROM data");
            echo json_encode($data);
        }

        function xhrDeleteListing()
        {
            $id = (int)$_POST['id'];
            $this->db->delete('data', "id = '$id'");
        }*/

        /*Editer son profil (User)*/
        /*public function editprofil($data)
        {

            $postData = [
                'id'         => Session::get('id'),
                'login'      => $data['login'],
                'password'   => Hash::create('sha1', $data['password'], HASH_PASSWORD_KEY),
                'mail'       => $data['mail'],
                'role'       => Session::get('role'),
                'lastupdate' => date("Y-m-d H:i:s"),
            ];


            if (!empty($_POST['login'] AND $_POST['password'] AND $_POST['mail'])) {

                $this->db->update('membre', $postData, "`id` ={$data['id']}");


            } else if (!empty($_POST['mail'])) {
                $postData = [
                    'mail'       => $data['mail'],
                    'lastupdate' => date("Y-m-d H:i:s"),
                ];
                $this->db->update('membre', $postData, "`id` ={$data['id']}");
                
            } else if (!empty($_POST['login'])) {
                $postData = [
                    'login'      => $data['login'],
                    'lastupdate' => date("Y-m-d H:i:s"),
                ];
                $this->db->update('membre', $postData, "`id` ={$data['id']}");
                
            } else if (!empty($_POST['password'])) {
                $postData = [
                    'password'   => Hash::create('sha1', $data['password'], HASH_PASSWORD_KEY),
                    'lastupdate' => date("Y-m-d H:i:s"),
                ];
                $this->db->update('membre', $postData, "`id` ={$data['id']}");

            } else {
                $postData = [
                    'id' => Session::get('id'),
                ];
                $this->db->update('membre', $postData, "`id` ={$data['id']}");
            }

        }*/

    }
