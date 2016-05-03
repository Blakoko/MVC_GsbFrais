<div class="col-md-10 bg-warning" id="popup_suivi">
    <div id="attention">
    <div class="row bg-primary" id="Titre">
        <h1>Fiche de Frais de :</h1>
    </div>
    <div class="row" id="Titre">
        <h3>Etat:</h3>
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
                <tr class="repeat">
                    <td><?php var_dump($_POST)?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" id="HorsForfait">
        <h1>Hors Forfait</h1>
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
        <div class="col-md-4">
            <h5>Changer le Statut:<br></h5>
        </div>
        <div class="col-md-3">
            <select class="form-control">
                <?php foreach ($this->lestatuts as $key => $value):?>
                <option value="<?php echo $value['id'] ?>"><?php echo $value['libelle'] ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="col-md-5 text-right">
            <button type="button" class="btn btn-primary btn-sm btn-block">Valider</button>
        </div>
    </div>
    </div>
</div>
