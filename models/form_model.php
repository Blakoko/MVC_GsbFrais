<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 23/11/15
     * Time: 23:31
     */
    class Form_Model extends Form
    {
    public function __construct()
    {
        parent::__construct();
    }

        /**
         *
         */
        public function register(){

            if (isset($_REQUEST['run'])) {
                try {

                    $form = new Form();

                    $form    ->post('name')
                        ->val('minlength', 2)
                        ->val('mail')

                        ->post('age')
                        ->val('minlength', 2)
                        ->val('digit')

                        ->post('mail')
                        ->val('mail')

                        ->post('gender');

                    $form    ->submit();

                    echo 'The form passed!';
                    $data = $form->fetch();

                    echo '<pre>';
                    print_r($data);
                    echo '</pre>';

                    $this->db->insert('person', $data);

                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
    }