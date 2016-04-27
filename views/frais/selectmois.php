<div class="bg-info col-md-10">
    <div class="form-group" data-pg-collapsed>
        <label class="control-label" for="formInput11">Field label</label>
        <form action="" method="post">
            <select id="formInput11" class="form-control" name="val_mois">
                <option selected="selected">--CHoisir Un mois--</option>
                <?php foreach ($this->getLesMoisDisponibles as $key => $value): ?>
                    <option value="<?php echo $value['mois'] ?>"><?php echo $value['mois'] ?></option>
                <?php endforeach ?>
            </select>
            <button id="btn2" type="submit" class="btn btn-primary">Valider</button>
        </form>

    </div>
    <hr id="separateur1"/>
    <div id="fichefrais" data-pg-collapsed>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-condensed">
                        <thead>
                        <h3>Fiches Frais<br><br></h3>
                        <tr class="bg-primary">
                            <th>Repas Midi</th>
                            <th>Nuitée Hotel</th>
                            <th>Forfait Etape</th>
                            <th>Kilometre</th>
                            <th>Situation</th>
                            <th>Date d'ajout</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php //foreach ($this->allo as $key => $val): ?>
                            <tr>
                                <td><?php echo $this->allo[3]['quantite'] ?></td>
                                <td><?php echo $this->allo[1]['quantite'] ?></td>
                                <td><?php echo $this->allo[0]['quantite'] ?></td>
                                <td><?php echo $this->allo[2]['quantite'] ?></td>
                                <td class="text-uppercase bg-success text-center">++</td>
                                <td><?php echo $this->allo[0]['dateAjout'] ?></td>
                            </tr>
                        <?php //endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- FIn DIV Fiche FRais -->
    </div>
    <hr id="separateur2"/>
    <div id="elementshorsforfait" data-pg-collapsed>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                        <h3>Hors Forfait<br></h3>
                        <tr class="bg-primary">
                            <th>Date</th>
                            <th>Description</th>
                            <th>Montant
                                <br>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->ello as $key => $val): ?>
                            <tr>
                                <td><?php echo $val['date'] ?></td>
                                <td><?php echo $val['libelle'] ?></td>
                                <td><?php echo $val['montant'] ?></td>
                                <td class="text-center bg-success">SUPPRIMER</td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- FIN DIV hors forfait-->
                </div>
            </div>
        </div>
    </div>
    <hr id="separateur3">
</div>
<?php print_r($this->allo) ?>
