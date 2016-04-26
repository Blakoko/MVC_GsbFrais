<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 17/11/15
     * Time: 19:10
     */
    class Login_Model extends Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function run()
        {
            $sth = $this->db->prepare("SELECT * FROM users WHERE login = :login AND password = :password");

            $sth->execute([
                ':login'    => $_POST['login'],
                ':password' => /*Hash::create('sha1',*/
                    $_POST['password']/*,HASH_PASSWORD_KEY)*/
            ]);

            $data = $sth->fetch();
            $count = $sth->rowCount();

            if ($count > 0) {

                Session::init();
                Session::set('id', $data['id']);
                Session::set('nom', $data['nom']);
                Session::set('prenom', $data['prenom']);
                Session::set('profil', $data['id_profile']);
                Session::set('loggedIn', true);
                echo "Bienvenue";

            } else {

                echo "Mauvais Mot de Passe Ou Login";
            }

        }

    }
