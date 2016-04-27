<div class="col-md-10 bg-warning">
    <form action="" method="post">
    <div class="row" id="Visiteur">
        <h1>Validation des frais par Visiteur<br><br></h1>
        <div class="col-md-4">
            <h5>
                Choisir le visiteur :</h5>
        </div>
        <div class="col-md-4">
            <select class="form-control" name="id_vis">
                <?php foreach($this->getlesvisiteurs as $key => $value):?>
                <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>

    <div class="row" id="Mois">
        <div class="col-md-4">
            <h5>
                Mois:</h5>
        </div>
        <div class="col-md-4">
            <select class="form-control">
                <?php foreach($this->getlesmois  as $key => $value):?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value['mois'] ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-default">Valider</button>
        </div>
    </div>
    </form>
    <form action="" method="post">
    <div class="row" id="FraisauForfait">
        <h1>Frais au Forfait</h1>
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>1<br></th>
                <th>Repas Midi</th>
                <th>Nuitée</th>
                <th>Etape</th>
                <th>Km</th>
                <th>Situation</th>
            </tr>
            </thead>
            <tbody>
            <tr class="repeat">
                <td>1</td>
                <td>
                    <input type="text" class="form-control" placeholder="" name="ff_repas">
                </td>
                <td>
                    <input type="text" class="form-control" placeholder="" name="ff_nuit">
                </td>
                <td>
                    <input type="text" class="form-control" placeholder="" name="ff_etape">
                </td>
                <td>
                    <input type="text" class="form-control" placeholder="" name="ff_km">
                </td>
                <td>
                    <select size="3" class="form-control" multiple="multiple" name="statuts">
                        <?php foreach ($this->getlestatuts as $key => $value) : ?>
                        <option value="<?php echo $value['id']?>"><?php echo $value['libelle']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="row" id="HorsForfait">
        <h1>Frais Hors Forfait</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date<br></th>
                    <th>Libellé</th>
                    <th>Montant</th>
                    <th>Situation</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <input type="date" class="form-control" placeholder="" name="hf_date[]">
                    </td>
                    <td>
                        <input type="text" class="form-control" placeholder="" name="hf_libelle[]">
                    </td>
                    <td>
                        <input type="text" class="form-control" placeholder="" name="hf_montant[]">
                    </td>
                    <td>
                        <select size="3" class="form-control" multiple="multiple" >
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" id="Justificatifs">
        <div class="col-md-3">
            <h5>Nb Justificatifs<br></h5>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="" size="4" name="justif">
        </div>
    </div>
    <div class="row" id="Validation">
        <button type="reset" class="btn btn-default">Reset</button>
        <button type="submit" class="btn btn-default">Valider</button>
        </form>
    </div>
</div>

<form action="" method="post" >

    <input type="text" name="idmois">
    <button type="submit">hiiii</button>
</form>

<?php //var_dump($_POST)?>
<?php //var_dump($this->getlestest)?>
<?php //print_r($this->mala)?>
