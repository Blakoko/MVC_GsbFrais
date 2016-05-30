<?php Session::init(); ?>
<html>
<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URL ?>public/css/main.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <title>Gestion des frais</title>
</head>

<body>
<div class="container-fluid">
    <div class="row" id="header-logo">
        <div class="col-md-3" id="header-img">

            <a href="<?php echo URL ?>"><img src="<?php echo URL ?>public/img/logo.jpg" alt="GSB GESTION DE FRAIS"></a>

        </div>
        <div class="col-md-9" id="banniere">
            <h3>GESTION DES FRAIS<br></h3>
        </div>
    </div>
    <div class="row" id="main">
        <?php if (Session::get('loggedIn')): ?>
            <div class="col-md-2" id="gauche">
                <h3>BIENVENUE</h3>
                <h4><?php echo Session::get('prenom') ?>&nbsp;<?php echo Session::get('nom') ?></h4>
                <ul class="list-group">

                    <?php if (Session::get('profil') == 1): ?>
                        <li class="list-group-item"><a href="<?php echo URL ?>frais/validation">Validation</a></li>
                        <li class="list-group-item"><a href="<?php echo URL ?>frais/suivi">Suivi</a></li>
                    <?php else: ?>
                        <li class="list-group-item"><a href="<?php echo URL ?>frais/saisir">Nouveau</a></li>
                        <li class="list-group-item"><a href="<?php echo URL ?>frais/selectionmois">Consulter</a></li>
                    <?php endif; ?>
                    <li class="list-group-item"><a href="<?php echo URL ?>dashboard/profil">Profil</a></li>
                    <li class="list-group-item"><a href="<?php echo URL ?>dashboard/logout">Deconnexion</a></li>
                </ul>
            </div>
        <?php endif; ?>

        <?php //var_dump($_SESSION) ?>
