<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 01/12/15
     * Time: 19:54
     */
    class test
    {

        function Getechance($madate)

        {
            $echeance = $madate;
            echo 'Nb de jours restants : ', floor((strtotime($echeance) - time()) / 86400);
        }

    AND TIMESTAMPDIFF(DAY , NOW( ) , DLC) < 12


    function Getreduction()
    {



}

        function datediff()
        {
            $date1=date_create("2013-03-15");
            $date2=date_create("2013-12-12");
            $diff=date_diff($date1,$date2);
        }
    }

///
//if form has been submitted process it
    if(isset($_POST['submit'])){
        //very basic validation
        if(strlen($_POST['username']) < 3){
            $error[] = 'Username is too short.';
        } else {
            $stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
            $stmt->execute(array(':username' => $_POST['username']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!empty($row['username'])){
                $error[] = 'Username provided is already in use.';
            }
        }
        if(strlen($_POST['password']) < 3){
            $error[] = 'Password is too short.';
        }
        if(strlen($_POST['passwordConfirm']) < 3){
            $error[] = 'Confirm password is too short.';
        }
        if($_POST['password'] != $_POST['passwordConfirm']){
            $error[] = 'Passwords do not match.';
        }
        //email validation
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $error[] = 'Please enter a valid email address';
        } else {
            $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
            $stmt->execute(array(':email' => $_POST['email']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!empty($row['email'])){
                $error[] = 'Email provided is already in use.';
            }
        }
        //if no errors have been created carry on
        if(!isset($error)){

        }
/////