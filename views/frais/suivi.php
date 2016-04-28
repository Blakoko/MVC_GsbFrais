 <div class="col-md-10 bg-warning">
    <div class="row" id="Suivi">
        <h1>Suivi des fiches</h1>
        <div class="col-md-4">
            <h4>Choisir le mois :</h4>
        </div>
        <form action="" method="post">
        <div class="col-md-4">
            <select class="form-control" name="mois">
                <option>--Choisir Un Mois--</option>
                <?php foreach ($this->ToutLesMois as $key =>$value):?>
                <option value="<?php echo $value['mois'] ?>"><?php echo $value['mois']?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div class="col-md-4 text-center">
            <button type="submit" class="btn btn-default">Valider</button>
        </div>
        </form>
    </div>
    <hr />
    <div class="row" id="Fiche">
        <h1>Fiches de Frais a valider et mise en paiement</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-condensed" id="products">
                <thead>
                <tr>
                    <th>NOM</th>
                    <th>DATE D'AJOUT</th>
                    <th>STATUT</th>
                    <th>Situation</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->Lesinfos as $key=>$value):?>
                <tr class="repeat">
                    <td><?php echo $value['nom']?></td>
                    <td><?php echo $value['date']?></td>
                    <td><?php echo $value['libelle']?></td>
                    <td><button type="button" class="btn btn-default btn-block button" value="<?php echo $value['']?>" name="id_user">Afficher</button></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
 
