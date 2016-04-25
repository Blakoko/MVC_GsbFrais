<?php Session::init(); ?>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo URL ?>public/css/main.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <title>Blank Template for Bootstrap</title>
    </head>

<body>
<div class="container-fluid">
    <div class="row" id="header-logo">
        <div class="col-md-3" id="header-img">

            <img src="<?php echo URL ?>public/img/logo.jpg" alt="GSB GESTION DE FRAIS">

        </div>
        <div class="col-md-9" id="banniere">
            <h3>GESTION DES FRAIS<br></h3>
        </div>
    </div>
    <div class="row" id="main">
<?php if (Session::get('loggedIn')): ?>


    <div class="col-md-2" id="gauche">
        <h3>BIENVENUE</h3>
        <h4><?php echo Session::get('prenom') ?><?php echo Session::get('nom') ?></h4>

        <ul class="list-group">
            <li class="list-group-item"><a href="<?php echo URL ?>frais/saisir">Nouveau</a></li>
            <li class="list-group-item"><a href="<?php echo URL ?>frais/selectionmois">Consulter</a></li>
            <li class="list-group-item"><a href="<?php echo URL ?>dashboard/profil">Profil</a></li>
            <li class="list-group-item"><a href="<?php echo URL ?>dashboard/logout">Deconnexion</a></li>
        </ul>
    </div>
    <div class="bg-info col-md-10 pg-empty-placeholder">
<?php endif ?>