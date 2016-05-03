<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 17/11/15
     * Time: 16:35
     */
    class Error extends Controller
    {
        function __construct()
        {
            parent::__construct();
        }

        /**
         *
         */
        function index()
        {
            $this->view->msg = 'Cette Page N\'existe pas';
            $this->view->render('error/index');
        }
    }