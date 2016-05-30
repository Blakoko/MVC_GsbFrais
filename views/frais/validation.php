<div class="col-md-10 bg-warning">
    <form action="" method="post">
        <div class="row" id="Visiteur">
            <h1>Validation des frais par Visiteur</h1>
            <div class="col-md-4">
                <h5>Choisir le visiteur :</h5>
            </div>
            <div class="col-md-4">
                <select class="form-control" name="id_user" class="iduser" onChange="getMois(this.value);">
                    <option selected="selected">--Choisir Un Utilisateur--</option>
                    <?php foreach ($this->getlesvisiteurs as $key => $value): ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row" id="Mois">
            <div class="col-md-4">
                <h5>
                    Mois:</h5>
            </div>
            <div class="col-md-4">
                <select class="form-control" name="val_mois" class="valmois" id="list_mois">
                    <option value="">--Choisir Un Mois--</option>
                    <?php
                        /*
               *   <?php foreach($this->LesMoisDisponibles as $key => $value):?>
                    <option value="<?php echo $value['mois'] ?>"><?php echo $value['mois'] ?></option>
                <?php endforeach; ?>
              */
                    ?>
                </select>
                <button type="submit" class="btn btn-default">Valider</button>
            </div>
        </div>
    </form>

    <?php if (empty($this->LesFraisForfait || $this->LesFraisHorsForfait)): ?>
        <h3>SELECTIONNER UN VISITEUR ET LE MOIS</h3>
    <?php else : ?>
        <h3><?php echo $this->LeVisiteur[0]['nom'] ?></h3>
    <?php endif; ?>
    <form action="validationfiche" method="post">
        <?php if (empty($this->LesFraisForfait)): ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                PAS DE FRAIS FORFAITS
            </div>
        <?php else: ?>
            <input type="hidden" value="<?php echo $this->LesFraisForfait[0]['id_fichefrais']?>" name="id_fichefrais">
            <div class="row" id="FraisauForfait">
                <h1>Frais au Forfait</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Repas Midi</th>
                            <th>Nuitée</th>
                            <th>Etape</th>
                            <th>Km</th>
                            <th>Situation</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr class="repeat">

                            <td>
                                <input type="text" class="form-control" placeholder="" name="ff_repas"
                                       value="<?php echo $this->LesFraisForfait[0]['quantite'] ?>">
                                <input type="hidden" name="id_repas" value="<?php echo $this->LesFraisForfait[0]['WA']?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="" name="ff_nuit"
                                       value="<?php echo $this->LesFraisForfait[1]['quantite'] ?>">
                                <input type="hidden" name="id_nuit" value="<?php echo $this->LesFraisForfait[1]['WA']?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="" name="ff_etape"
                                       value="<?php echo $this->LesFraisForfait[2]['quantite'] ?>">
                                <input type="hidden" name="id_etape" value="<?php echo $this->LesFraisForfait[2]['WA']?>">
                            </td>
                            <td>
                                <input type="text" class="form-control" placeholder="" name="ff_km"
                                       value="<?php echo $this->LesFraisForfait[3]['quantite'] ?>">
                                <input type="hidden" name="id_km" value="<?php echo $this->LesFraisForfait[3]['WA']?>">
                            </td>
                            <td>
                                <select class="form-control" multiple="multiple" name="statut">
                                    <?php foreach ($this->getlestatuts as $key => $value) : ?>
                                        <option value="<?php echo $value['id'] ?>"
                                                <?php if ($value['id'] == $this->LesFraisForfait[0]['id_statut']): ?>selected="selected"<?php endif; ?>>
                                            <?php echo $value['libelle'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        <?php endif; ?>

        <?php if (empty($this->LesFraisHorsForfait)): ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                PAS DE FRAIS HORS FORFAITS
            </div>
        <?php else: ?>
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
                        <?php foreach ($this->LesFraisHorsForfait as $key => $item): ?>

                            <tr>
                                <td><?php echo $key+1 ?></td>
                                <td>
                                    <input type="date" class="form-control" placeholder="" name="hf_date[]"
                                           value="<?php echo $item['date'] ?>">
                                    <input type="hidden" name="id[]" value="<?php echo $item['id']?>"
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="" name="hf_libelle[]"
                                           value="<?php echo $item['libelle'] ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="" name="hf_montant[]"
                                           value="<?php echo $item['montant'] ?>">
                                </td>
                                <td>
                                    <select size="2" class="form-control" multiple="multiple" name="hf_situation[]">
                                        <?php foreach ($this->LaSituation as $cle => $val): ?>
                                            <option value="<?php echo $val['id_situation'] ?>"
                                                    <?php if ($val['id_situation'] == $this->LesFraisHorsForfait[0]['situation_id']): ?>selected="selected"<?php endif; ?>>
                                                <?php echo $val['libelle_situation'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="row" id="Justificatifs">
                <div class="col-md-3">
                    <h5>Nb Justificatifs<br></h5>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="" name="justif"
                           value="<?php echo $this->LesFraisHorsForfait[0]['nb_justificatifs'] ?>">
                </div>
            </div>

        <div class="row" id="Validation">
            <button type="submit" class="btn btn-default">Valider</button>
            <?php endif; ?>

    </form>

</div>
<?php //var_dump($_POST) ?>
<?php //var_dump(count($_POST['hf_date']))?>
