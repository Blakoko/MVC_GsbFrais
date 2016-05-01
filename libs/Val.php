<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 19/11/15
     * Time: 01:30
     */
    
    class Val
    {

        /**
         * @param $data
         * @param $arg
         * @return string
         */




        public static function vide($data)
        {
            if(strlen($data)==0)
            {
                return "Remplissez les Champs";
                
            }
        }

        //Fonction pour une chaine mini
        public static function minlength($data, $arg)
        {
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
            $cpt = count($data);

            for($i=0;$i<$cpt;$i++)
            {
                if (ctype_digit($data[$i]) == false) {
                    
                    echo "vous ne pouvez entrez que des numeros";
                    exit;

                }
            }
        }

        //Fonction de verification du mail ex: evite les kkkJKD.com
        public static function mail($data)
        {
            if (preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $data) == false) {
                return "Votre email n'est pas valide";
            }
        }

        //Fonction de validation de date ex: 78/98/456 ne sera pas accepté
        public static function date($data)
        {
            if (preg_match(" \^([0-3][0-9]})(-)([0-9]{2,2})(-)([0-3]{2,2})$\ ", $data) == false) {
                return "La date doit etre au format Année-Mois-Jour";
            }
        }

        //FOnction de comparaison de mot depasse
        public static function password($data, $arg)
        {
            if ($data != $arg) {
                return "Votre mot de passe est different ";
            }

        }

        public function __call($name, $arguments)
        {
            throw new Exception("$name does not exist inside of: " . __CLASS__);
        }
    }