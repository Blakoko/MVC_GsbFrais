<br>
<div class="bg-info col-md-10">
    <div id="profil" data-pg-collapsed>
        <div class="row">
            <div>
                <div class="table-responsive">
                    <table class="table lead clearfix table-condensed table-hover table-bordered table-striped">
                        <thead class="bg-primary">
                        <tr>
                            <th>MON PROFIL</th>
                            <th>
                                <br>
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>

                            <td>Profil</td>
                            <td><?php echo $this->monprofil[0]['libelle']?></td>
                        </tr>

                        <tr>

                            <td>NOM</td>
                            <td><?php echo $this->monprofil[0]['nom']?></td>
                        </tr>

                        <tr>

                            <td>PRENOM</td>
                            <td><?php echo $this->monprofil[0]['prenom']?></td>
                        </tr>
                        <tr>

                            <td>VIILLE</td>
                            <td><?php echo $this->monprofil[0]['ville']?></td>
                        </tr>
                        <tr>

                            <td>DATE D'EMBAUCHE</td>
                            <td><?php echo $this->monprofil[0]['dateEmbauche']?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                </div>
            </div>
        </div>
        <!-- FIn DIV Fiche FRais -->
    </div>
</div>