<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 17/11/15
     * Time: 16:12
     */


    class Help extends Controller {

        function __construct() {
            parent::__construct();
        }

        function index() {
            $this->view->render('help/index');
        }

        public function other($arg = false) {

            require 'models/help_model.php';
            $model = new Help_Model();
            $this->view->blah = $this->$model->blah();

        }

    }