<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 17/11/15
     * Time: 16:09
     */
    class Index extends Controller {

        function __construct() {
            parent::__construct();
            $this->view->js = array('index/js/default.js');
        }
        

        function index() {
            $this->view->render('index/index');
        }
        

    }