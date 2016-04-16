

            <?php if(Session::get('loggedIn') == false):?>
            <div class="col-md-4 col-md-offset-4" id="cpt-user">
                <div id="ack" class="alert"></div>
                <div class="panel" id="user-all">
                    <div class="panel-heading" id="user">CONNEXION UTILISATEUR</div>
                </div>



                <div>
                    <form action="<?php echo URL ;?>login/run" method="post" id="myform">
                        <input type="text" class="form-control" placeholder="Nom d'utilisateur" name="login" id="login" >
                        <input type="password" class="form-control" placeholder="Mot de passe" name="password" id="password">
                        <button type="submit" class="btn btn-default btn-block" id="submit">Connexion <i class="fa fa-angle-right" ></i></button>

                    </form>
                </div>


            </div>
            <?php endif; ?>
            <?php if(Session::get('loggedIn') == true):?>
            <div class="col-md-4 col-md-offset-4" id="cpt-user" >
                <div class="panel" id="user-all">
                    <div class="panel-heading" id="user">Bienvenue <br><?php echo Session::get('login');?>

                    <div><a href="<?php echo URL ;?>dashboard/profil/">Editer Mon Profil</a></div>
                </div>
                </div>

            </div>
            <?php endif; ?>


    <div>

<br>

        <p id="message"></p>
<br>

       

    </div>


