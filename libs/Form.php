<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 19/11/15
     * Time: 00:59
     */

    /**
     * - Remplir le Formulaire
     * - ENvoyer a Php
     * - Verifier
     * - Valider
     * - Ecrire dans la BDD
     */

    class Form extends Val
    {
        /**@var array $_currentItem */
        private $_currentItem = null;
        /**@var array $_postData garde les données postés */
        private $_postData = [];
        /**@var objet $_val L'objet de validation */
        private $_val = [];
        /**@var array $_error Garde l'erreur du formulaire courant */
        private $_error = [];

        /**initaliser le constructeur*/
        public function __construct()
        {
            $this->_val = new Val();
        }


        /**
         * @param string $field - Nom de field(a traduire) a remplir
         * @return $this
         */
        public function post($field)
        {
            $this->_postData[ $field ] = $_POST[ $field ];
            $this->_currentItem = $field;

            return $this;

        }

        /** Retourne les données Postés
         * @param mixed $fieldName
         * @return mixed string ou array
         */
        public function fetch($fieldName = false)
        {
            if ($fieldName) {
                if (isset($this->_postData[ $fieldName ]))
                    return $this->_postData[ $fieldName ];
                else
                    return false;
            } else {
                return $this->_postData;
            }

        }

        /** Function de validation
         * @param      $typeOfValidator
         * @param null $arg
         * @return $this
         */
        public function validate($typeOfValidator, $arg = null)
        {

            if ($arg == null)
                $error = $this->_val->{$typeOfValidator}($this->_postData[ $this->_currentItem ]);
            else
                $error = $this->_val->{$typeOfValidator}($this->_postData[ $this->_currentItem ], $arg);


            if ($error)
                $this->_error[ $this->_currentItem ] = $error;

            //print_r($this->_error);
            return $this;
        }

        public function submit()
        {
            if (empty($this->_error)) {
                return true;
            } else {
                $e = implode(', ', $this->_error);
                throw new Exception($e);
            }
        }
    }