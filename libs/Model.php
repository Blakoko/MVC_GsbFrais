<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 17/11/15
     * Time: 17:25
     */
    class Model
    {
        function __construct()
        {
            $this->db= new Database(DB_TYPE,DB_HOST,DB_NAME,DB_USER,DB_PASS);
        }
    }