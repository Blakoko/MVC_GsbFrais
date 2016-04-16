<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 18/11/15
     * Time: 18:41
     */
    class Hash



{
        /**
         * @param string $algo L'algorithme (md5,sha1 etc)
         * @param $data (donnée a crypter)
         * @param $salt (Salage)
         * @return string (La donnée cryptée/salée ;))
         */
        public static function create($algo, $data, $salt)
        {
           $context = hash_init($algo,HASH_HMAC,$salt);
            hash_update($context,$data);

            return hash_final($context);
        }
    }