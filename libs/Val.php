<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 19/11/15
     * Time: 01:30
     */
    class Val extends Form
    {

        /**
         * @param $data
         * @param $arg
         * @return string
         */


        //Fonction pour une chaine mini
        public static function minlength($data, $arg)
        {
            $data = (array)$data;
            $arg =(array)$arg;
            if (strlen($data) < $arg) {
                return "Votre Texte ne peut etre moins de  $arg lettres";
            }
        }

        //Fonction pour une chaine maxi
        public static function maxlength($data, $arg)
        {
            if (strlen($data) > $arg) {
                return "Votre Texte ne peut etre moins de  $arg lettres";
            }
        }

        //Fonction qui n'autorise que des numeros
        public static function digit($data)
        {
            if (ctype_digit($data) == false) {
                return "vous ne pouvez entrez que des numeros";
            }
        }

        //Fonction de verification du mail ex: evite les kkkJKD.com
        public static function mail($data)
        {
            if ( preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $data )== false) {
                return "Votre email n'est pas valide";
            }
        }

        //Fonction de validation de date ex: 78/98/456 ne sera pas accepté
        public static function date($data)
        {
            if(preg_match ( " \^([0-3][0-9]})(/)([0-9]{2,2})(/)([0-3]{2,2})$\ " , $data ) == false)
            {
                return "La date n'est pas valide";
            }
        }

        //FOnction de comparaison de mot depasse
        public static function password($data,$arg)
        {
            if($data!=$arg)
            {
                return "Votre mot de passe est different ";
            }

        }

        public function __call($name, $arguments)
        {
            throw new Exception("$name does not exist inside of: " . __CLASS__);
        }
    }