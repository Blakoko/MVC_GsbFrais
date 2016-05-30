<div class="bg-info col-md-10">
    <div class="form-group" data-pg-collapsed>
        <label class="control-label" for="formInput11">Selectionner un mois dans la liste</label>
        <form action="" method="post">
            <select id="formInput11" class="form-control" name="val_mois">
                <option selected="selected">--CHoisir Un mois--</option>
                <?php foreach ($this->LesMoisDisponibles as $key => $value): ?>
                    <option value="<?php echo $value['mois'] ?>"><?php echo $value['mois'] ?></option>
                <?php endforeach ?>
            </select>
            <button id="btn2" type="submit" class="btn btn-primary">Valider</button>
        </form>

    </div>
    <?php if(!empty($this->LesFraisForfait)):?>
    <hr id="separateur1"/>
    <div id="fichefrais" data-pg-collapsed>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h3>Fiches Frais</h3>
                    <h4>Total des fiches : <?php echo $this->TotalDesFrais ?></h4>
                    <table class="table table-bordered table-striped table-hover table-condensed">
                        <thead>
                        
                        <tr class="bg-primary">
                            <th>Forfait Etape</th>
                            <th>Nuitée Hotel</th>
                            <th>Kilometre</th>
                            <th>Repas Midi</th>
                            <th>Situation</th>
                            <th>Date d'ajout</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php //foreach ($this->LesFraisForfait as $key => $val): ?>
                        <tr>
                            <td><?php echo $this->LesFraisForfait[0]['quantite'] ?></td>
                            <td><?php echo $this->LesFraisForfait[1]['quantite'] ?></td>
                            <td><?php echo $this->LesFraisForfait[2]['quantite'] ?></td>
                            <td><?php echo $this->LesFraisForfait[3]['quantite'] ?></td>
                            <td><?php echo $this->LesFraisForfait[0]['libelle'] ?></td>
                            <td><?php echo $this->LesFraisForfait[0]['dateAjout'] ?></td>
                        </tr>
                        <?php //endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- FIn DIV Fiche FRais -->
    </div>
    <?php endif;?>
    <?php if(!empty($this->LesFraisHorsForfait)):?>
    <hr id="separateur2"/>
    <div id="elementshorsforfait" data-pg-collapsed>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <h3>Hors Forfait</h3>
                    <h4><?php ?></h4>
                    <table class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                        
                        <tr class="bg-primary">
                            <th>Date</th>
                            <th>Description</th>
                            <th>Montant
                                <br>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->LesFraisHorsForfait as $key => $val): ?>
                            <tr>
                                <td><?php echo $val['date'] ?></td>
                                <td><?php echo $val['libelle'] ?></td>
                                <td><?php echo $val['montant'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- FIN DIV hors forfait-->
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
</div>