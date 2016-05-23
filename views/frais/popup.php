<div class="col-md-10 bg-warning" id="popup_suivi">
    <div id="attention">
    <div class="row" id="Titre">
        <h1><?php echo($this->InfoVisiteur[0]['nom'])?></h1>
        <h3>Etat: <?php echo($this->situationfiche[0]['libelle'])?></h3>
        <h3>Etat: <?php echo($this->situationfiche[0]['num'])?></h3>
        <h3>Montant valide:</h3>
    </div>
    <div class="row" id="FraisauForfait">
        <h1>Element(s) Forfaitisé</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-condensed bg-primary">
                <thead>
                <tr>
                    <th>Repas Midi</th>
                    <th>Nuitée</th>
                    <th>Etape</th>
                    <th>Km</th>
                </tr>
                </thead>
                <tbody>
                <?php// foreach ($this->LesFraisForfait as $key =>$val):?>
                <tr class="repeat">
                    <td><?php echo $this->LesFraisForfait[0]['quantite'] ?></td>
                    <td><?php echo $this->LesFraisForfait[1]['quantite'] ?></td>
                    <td><?php echo $this->LesFraisForfait[2]['quantite'] ?></td>
                    <td><?php echo $this->LesFraisForfait[3]['quantite'] ?></td>
                </tr>
                <?php //endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" id="HorsForfait">
        <h1>Hors Forfait</h1>
        <h2>Montant:</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                <tr class="bg-primary">
                    <th>Date<br></th>
                    <th>Description</th>
                    <th>Montant</th>
                    <th>Situation</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->LesFraisHorsForfait as $key => $val): ?>
                    <tr>
                        <td><?php echo $val['date'] ?></td>
                        <td><?php echo $val['libelle'] ?></td>
                        <td><?php echo $val['montant'] ?></td>
                        <td><?php echo $val['libelle_situation']?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" id="Validation">
        <form action="majfiche" method="post">
        <div class="col-md-4">
            <h5>Changer le Statut:<br></h5>
        </div>
        <div class="col-md-3">
            <select class="form-control" name="id_statut">
                <?php foreach ($this->lestatuts as $key => $value):?>
                <option value="<?php echo $value['id'] ?>"><?php echo $value['libelle'] ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col-md-5 text-right">
            <input type="hidden" name="id" value="<?php echo($this->situationfiche[0]['num'])?>">
            <button type="submit" class="btn btn-primary btn-sm btn-block">Valider</button>
        </div>
        </form>
    </div>
    </div>
</div>

